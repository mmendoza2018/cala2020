let dataTableProducts = null;

document.addEventListener("DOMContentLoaded", () => {
    if (document.getElementById("tableProducts") !== null) {
        dataTableProducts = $("#tableProducts").DataTable({
            info: false,
        });
    }
});
