<script>
var recargar = function (idTable, url, column) {
    $(document).ready(function () {
        $(idTable).DataTable().destroy();
        dataTables(idTable, url, column);
    });
};

var dataTables = function (idTable, url, column) {
    $(document).ready(function () {
        $(idTable).DataTable({
            processing: true,
            serverSide: true,
            ajax: url,
            dom: "Bflrtip",
            buttons: ["copy", "excel", "pdf"],
            columns: column,
            // pageLength: 5,
            info: "Mostrando items _START_ para _END_ de _TOTAL_",
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>",
                },
            },
            drawCallback: function () {
                $(".dataTables_paginate > .pagination").addClass(
                    "pagination-rounded"
                );
            },
        });
    });
};
export default {
    // tabla,
    dataTables,
    recargar,
};
</script>
