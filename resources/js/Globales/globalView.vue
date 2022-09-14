<script>
var tabla = function (idTable) {
    $(document).ready(function () {
        $(idTable).DataTable({
            // lengthChange: false,
            dom: "Bfrtip",
            buttons: ["copy", "excel", "pdf"],
            info: "Mostrando items _START_ para _END_ de _TOTAL_",
            columns: [],
            pageLength: 5,
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
    tabla,
    dataTables,
};
</script>
