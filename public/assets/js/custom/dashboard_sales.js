let genderChart, ageChart, departmentChart;

document.addEventListener("DOMContentLoaded", () => {
    getCurrentMonth();
    getDataforCharts();
});
// Función para renderizar el gráfico con los datos
/* const generateChartAge = (data) => {

    if (ageChart) ageChart.destroy();

    const labels = Object.keys(data);  // Las edades agrupadas (por ejemplo: "24-28", "29-33")
    const values = Object.values(data);  // Los porcentajes de ventas

    // Configuración de ApexCharts
    let options = {
        chart: {
            type: 'bar',
            height: 350
        },
        series: [{
            name: 'Porcentaje de ventas',
            data: values
        }],
        xaxis: {
            categories: labels,  // Rango de edades
        },
        yaxis: {
            title: {
                text: 'Porcentaje (%)'
            },
            min: 0,
            max: 100,
            tickAmount: 5
        },
        title: {
            text: 'Distribución de ventas por edad',
            align: 'center'
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val.toFixed(2) + "%";  // Mostrar porcentaje con dos decimales
            }
        }
    };

    // Crear el gráfico con los datos
    ageChart = new ApexCharts(document.querySelector("#agePercentilesChart"), options);
    ageChart.render();
} */

// Función para inicializar el gráfico
/* const generateChartDepartment = (data) => {

    if (departmentChart) departmentChart.destroy();

    const departments = Object.keys(data);
    const salesPercentages = Object.values(data);

    // Configurar el gráfico de barras
    const options = {
        series: [{
            name: 'Porcentaje de Ventas',
            data: salesPercentages
        }],
        chart: {
            type: 'bar',
            height: 400
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '50%',
            },
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val.toFixed(2) + "%";  // Muestra los porcentajes con dos decimales
            }
        },
        xaxis: {
            categories: departments,
            title: {
                text: 'Departamentos'
            }

        },
        yaxis: {
            title: {
                text: 'Porcentaje de Ventas'
            },
            labels: {
                formatter: function (val) {
                    return val.toFixed(0) + "%"; // Mostrar valores en porcentaje sin decimales
                }
            }
        },
        title: {
            text: 'Porcentaje de Ventas por Departamento',
            align: 'center'
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val.toFixed(2) + "%"; // Formateo para el tooltip en porcentaje
                }
            }
        }
    };

    // Renderizar el gráfico
    departmentChart = new ApexCharts(document.querySelector("#departmentsChart"), options);
    departmentChart.render();
}; */

const getDataforCharts = async () => {
    try {
        let formData = new FormData();
        formData.append("startDate", document.getElementById("startDate").value);
        formData.append("endDate", document.getElementById("endDate").value);

        let response = await customFetch(ROUTES.DASHBOARD + `/ventas`, "POST", formData);
        if (response.status === "success") {
            console.log('response :>> ', response);
            let data = response.data;
            //const { Femenino, Masculino } = data.gender;

            //generateChartGender(Femenino, Masculino);
            //generateChartDepartment(data.department);
           // generateChartAge(data.age);
            generateChartByCategory(data.category)
            generateChartByProduct(data.product)

            document.getElementById("totalEcommerceSales").textContent = data.totalEcommerceSales;
            //document.getElementById("totalWithCulqiCommission").textContent = data.totalWithCulqiCommission;
            document.getElementById("quantityEcommerceSale").textContent = data.quantityEcommerceSale;
            //quantityEcommerceSale

        } else {
            boxAlertValidation(response.errors)
        }
    } catch (error) {
        console.log('error :>> ', error);
    }


}

const generateChartByProduct = (data) => {
    if ($.fn.DataTable.isDataTable('#tableProduct')) {
        $('#tableProduct').DataTable().clear().destroy();
    }

    // Inicializar DataTable
    $('#tableProduct').DataTable({
        data: data, // Datos recibidos
        columns: [
            { data: 'product' }, // Columna Categoría
            { data: 'quantity_sold' }, // Columna Cantidad Vendida
            { data: 'total_sales' }, // Columna Total de Ventas
        ],
        order: [[1, 'desc']], // Ordenar por la segunda columna (cantidad vendida) en orden descendente
        responsive: true,
        language: languageDataTable
    });
}

const generateChartByCategory = (data) => {
    if ($.fn.DataTable.isDataTable('#tableCategory')) {
        $('#tableCategory').DataTable().clear().destroy();
    }

    // Inicializar DataTable
    $('#tableCategory').DataTable({
        data: data, // Datos recibidos
        columns: [
            { data: 'category' }, // Columna Categoría
            { data: 'quantity_sold' }, // Columna Cantidad Vendida
            { data: 'total_sales' }, // Columna Total de Ventas
        ],
        order: [[1, 'desc']], // Ordenar por la segunda columna (cantidad vendida) en orden descendente
        responsive: true,
        language: languageDataTable
    });
}


const exportEcommerceSaleTransaction = async () => {
    try {
        let formData = new FormData();
        formData.append("star_date", document.getElementById("startDate").value);
        formData.append("end_date", document.getElementById("endDate").value);

        const url = `${ROUTES.EXPORT_EXCEL}/ventas/transacciones`;
        const response = await customFetch(url, "POST", formData, "buffer"); // Usar el tipo "buffer" para manejar archivos binarios
        console.log('response :>> ', response);
        bufferToDownloadExcel(response, "Ventas transaciones.xlsx")
    } catch (error) {
        console.error("Error al exportar el archivo Excel:", error);
    }
};


const exportEcommerceSaleByProduct = async () => {
    try {
        const url = `${ROUTES.EXPORT_EXCEL}/ventas/por-producto`;
        let formData = new FormData();
        formData.append("star_date", document.getElementById("startDate").value);
        formData.append("end_date", document.getElementById("endDate").value);

        const response = await customFetch(url, "POST", formData, "buffer"); // Usar el tipo "buffer" para manejar archivos binarios
        console.log('response :>> ', response);
        bufferToDownloadExcel(response, "Ventas por producto.xlsx")
    } catch (error) {
        console.error("Error al exportar el archivo Excel:", error);
    }
};



const getCurrentMonth = () => {

    // Obtén la fecha actual
    const currentDate = new Date();

    // Obtén el primer día del mes (usamos el 1 para el día)
    const firstDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);

    // Obtén el último día del mes (ponemos 0 para el día y esto nos da el último día del mes anterior, luego sumamos 1 día)
    const lastDayOfMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);

    // Formatea las fechas al formato adecuado (YYYY-MM-DD)
    const formatDate = (date) => {
        return date.toISOString().split('T')[0];
    };

    // Establece los valores en los inputs
    document.getElementById('startDate').value = formatDate(firstDayOfMonth);
    document.getElementById('endDate').value = formatDate(lastDayOfMonth);
}