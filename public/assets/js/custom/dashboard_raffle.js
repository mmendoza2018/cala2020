let choicesInstances = [];
let genderChart, ageChart, departmentChart;

document.addEventListener("DOMContentLoaded", () => {
    initializeChoices();
    getDataforCharts();

});

const generateChartGender = (femenino, masculino) => {
    if (genderChart) genderChart.destroy();

    const chartOptions = {
        chart: {
            type: 'pie', // Tipo de gráfico (pastel)
            height: 350 // Tamaño del gráfico
        },
        labels: ['Hombres', 'Mujeres'], // Etiquetas
        series: [masculino, femenino], // Datos de los porcentajes
        colors: ['#36A2EB', '#FF6384'], // Colores de las secciones
        title: {
            text: 'Porcentaje de Compras por Género',
            align: 'center',
            style: {
                fontSize: '18px',
                fontWeight: 'bold',
                fontFamily: 'Arial'
            }
        },
        tooltip: {
            y: {
                formatter: function (value) {
                    return value.toFixed(2) + "%"; // Muestra el porcentaje con dos decimales
                }
            }
        },
        legend: {
            position: 'top', // Posición de la leyenda
            horizontalAlign: 'center', // Alineación horizontal
        }
    };

    // Crear el gráfico en el contenedor con el ID 'genderChart'
    genderChart = new ApexCharts(document.querySelector("#genderChart"), chartOptions);
    genderChart.render();
};

const generateChartAge = (data) => {
    if (ageChart) ageChart.destroy();

    const labels = Object.keys(data);  // Las edades agrupadas (por ejemplo: "24-28", "29-33")
    const values = Object.values(data).map(val => parseFloat(val.toFixed(2))); // Redondear valores

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
            tickAmount: 5,  // Divisiones en el eje Y
            labels: {
                formatter: function (val) {
                    return `${val}%`; // Agregar el símbolo % al eje Y
                }
            }
        },
        title: {
            text: 'Distribución de ventas por edad',
            align: 'center'
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return `${Math.round(val)}%`;  // Agregar el símbolo % a las etiquetas de los datos
            }
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return `${val.toFixed(2)}%`; // Mostrar con dos decimales y % en el tooltip
                }
            }
        }
    };

    // Crear el gráfico con los datos
    ageChart = new ApexCharts(document.querySelector("#agePercentilesChart"), options);
    ageChart.render();
};


// Función para inicializar el gráfico
const generateChartDepartment = (data) => {

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
};

const getDataforCharts = async () => {

    const idRaffle = document.getElementById("raffleId").value;

    try {
        let response = await customFetch(ROUTES.DASHBOARD + `/sorteos/` + idRaffle);
        if (response.status === "success") {
            console.log('response :>> ', response);
            let data = response.data;
            const { Femenino, Masculino } = data.gender;

            generateChartGender(Femenino, Masculino);
            generateChartAge(data.age);
            generateChartDepartment(data.department);

            document.getElementById("totalTicketSales").textContent = data.totalTicketSales;
            document.getElementById("totalWithCulqiCommission").textContent = data.totalWithCulqiCommission;
            document.getElementById("quantityTicketSales").textContent = data.quantityTicketSales;

        } else {
            boxAlertValidation(response.errors)
        }
    } catch (error) {
        console.log('error :>> ', error);
    }


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