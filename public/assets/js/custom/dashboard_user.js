let departmentChart;

document.addEventListener("DOMContentLoaded", () => {
    getDataforCharts();
});


// Función para inicializar el gráfico
const generateChartDepartment = (data) => {

    if (departmentChart) departmentChart.destroy();

    const departments = Object.keys(data);
    const userCounts = Object.values(data);

    // Configurar el gráfico de barras
    const options = {
        series: [{
            name: 'Cantidad de Usuarios',
            data: userCounts
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
                return val.toFixed(0); // Muestra los valores enteros
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
                text: 'Cantidad de Usuarios'
            },
            labels: {
                formatter: function (val) {
                    return val.toFixed(0); // Mostrar valores enteros sin decimales
                }
            }
        },
        title: {
            text: 'Cantidad de Usuarios Registrados por Departamento',
            align: 'center'
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val.toFixed(0); // Formateo para el tooltip en números enteros
                }
            }
        }
    };

    // Renderizar el gráfico
    departmentChart = new ApexCharts(document.querySelector("#departmentsChart"), options);
    departmentChart.render();
};


const getDataforCharts = async () => {

    try {
        let response = await customFetch(ROUTES.DASHBOARD + `/usuarios`, "POST", null);
        if (response.status === "success") {
            console.log('response :>> ', response);
            let data = response.data;
            generateChartDepartment(data.department);
            generateTableSaleByUser(data.salesByUser);
            

            document.getElementById("totalWebUsers").textContent = data.totalWebUsers;
        } else {
            boxAlertValidation(response.errors)
        }
    } catch (error) {
        console.log('error :>> ', error);
    }


}

const generateTableSaleByUser = (data) => {
    if ($.fn.DataTable.isDataTable('#tableSaleByUser')) {
        $('#tableSaleByUser').DataTable().clear().destroy();
    }

    // Inicializar DataTable
    $('#tableSaleByUser').DataTable({
        data: data, // Datos recibidos
        columns: [
            { data: 'full_name' }, // Columna Categoría
            { data: 'email' }, // Columna Cantidad Vendida
            { data: 'dni' }, // Columna Total de Ventas
            { data: 'phone' }, // Columna Total de Ventas
            { data: 'department' }, // Columna Total de Ventas
            { data: 'total_purchases' }, // Columna Total de Ventas
            { data: 'total_products_purchased' }, // Columna Total de Ventas
        ],
        order: [[1, 'desc']], // Ordenar por la segunda columna (cantidad vendida) en orden descendente
        responsive: true,
        language: languageDataTable
    });
}

const exportRaffleData = async () => {
    try {
        const idRaffle = document.getElementById("raffleId").value;
        const url = `${ROUTES.EXPORT_EXCEL}/sorteos?raffle_id=${idRaffle}`;
        const response = await customFetch( url, "GET", null, "buffer" ); // Usar el tipo "buffer" para manejar archivos binarios

        // Crear un blob con la respuesta
        const blob = new Blob([response], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });

        // Crear una URL temporal para descargar el archivo
        const downloadUrl = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = downloadUrl;
        a.download = 'RaffleData.xlsx'; // Nombre del archivo
        document.body.appendChild(a);
        a.click();
        a.remove();

        // Liberar la URL temporal
        window.URL.revokeObjectURL(downloadUrl);
    } catch (error) {
        console.error("Error al exportar el archivo Excel:", error);
    }
};