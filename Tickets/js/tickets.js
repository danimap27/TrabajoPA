$(document).ready(function () {
    var dataTable = $('#ticket-list').DataTable();

    $('#ordenar-nombre').on('click', function () {
        dataTable.order([0, 'asc']).draw();
    });

    $('#ordenar-prioridad').on('click', function () {
        dataTable.order([2, 'asc']).draw(); 
    });

    $('#agrupar-cliente').on('click', function () {
        dataTable.rowGroup().dataSrc(4).draw(); 
    });

    $('#agrupar-agente').on('click', function () {
        dataTable.rowGroup().dataSrc(5).draw();
    });
});


