let dataTableBrandProduct = null;

window.addEventListener("load", () => {
    dataTableBrandProduct = $("#tableProductVariant").DataTable({
        info: false,
        columnDefs: [
            {
                targets: 2, // Índice de la columna del botón
                className: 'text-center' // Aplica clase a toda la columna (si es necesario)
            }
        ],
        language: languageDataTable
    });
});