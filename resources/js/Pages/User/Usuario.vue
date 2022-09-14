<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import global from "@/Globales/global.vue";
import globalView from "@/Globales/globalView.vue";
import Table from "@/Components/Table.vue";
import RegisterUpdate from "@/Pages/User/RegisterUpdate.vue";
import { CAlert } from "@coreui/vue";

export default {
    components: {
        AppLayout,
        global,
        Table,
        globalView,
        RegisterUpdate,
        CAlert,
    },
    data() {
        return {
            usuarios: [],
            encabezados: [
                { data: "id", name: "id" },
                { data: "name", name: "name" },
                { data: "nick", name: "nick" },
                { data: "email", name: "email" },
                { data: "status", name: "status" },
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
        };
    },
    methods: {
        abrirOffcanvas() {
            // console.log(window.document);
            // var myOffcanvas = document.getElementById("offcanvasScrolling");
            // var myOffcanvas = $("#offcanvasScrolling");
            // console.log(myOffcanvas);
            const myOffcanvas = document.getElementById("myOffcanvas");
            myOffcanvas.addEventListener("hidden.bs.offcanvas", (event) => {
                // do something...
                console.log(event);
            });
        },
        async cargarUser() {
            globalView.dataTables(
                "#laravel-tables",
                "/api/users/datatables",
                this.encabezados
            );
            // var users = await axios.get("/api/users/datatables");
            // console.log(users.data["data"]);
            // this.usuarios = users.data["data"];
            // console.log(this.usuarios);
            // globalView.tabla("#tables");
            // console.log(route("/api/users/datatables"));
            /*$(document).ready(function () {
                $("#laravel-tables").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "/api/users/datatables",
                    ajax: url("/api/users/datatables"),
                    columns: [
                        { data: "id", name: "id" },
                        { data: "name", name: "name" },
                        { data: "nick", name: "nick" },
                        { data: "email", name: "email" },
                        { data: "status", name: "status" },
                        {
                            data: "action",
                            name: "action",
                            orderable: false,
                            searchable: false,
                        },
                    ],
                });
            });*/
        },
    },
    mounted() {
        this.cargarUser();
    },
};
</script>
<template>
    <AppLayout title="Usuario">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="javascript: void(0);">AdmFpl</a>
                            </li>
                            <li class="breadcrumb-item active">Usuarios</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Usuarios</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <button
                                    class="btn btn-danger"
                                    type="button"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasScrolling"
                                    aria-controls="offcanvasScrolling"
                                >
                                    <i class="mdi mdi-plus-circle me-2"></i>
                                    Registrar Usuario
                                </button>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-end">
                                    <button
                                        type="button"
                                        @onclick="abrirOffcanvas"
                                        class="btn btn-success mb-2 me-1 bg-green-500"
                                    >
                                        <i class="mdi mdi-cog-outline"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- end col-->
                        </div>
                        <div id="buttons-table-preview">
                            <table
                                class="table dt-responsive nowrap w-100"
                                id="laravel-tables"
                            >
                                <thead class="table-light">
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Nick</th>
                                        <th>Email</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <!-- <Table :list="usuarios" /> -->
                    </div>
                    <!-- end card-body-->
                </div>
                <!-- end card-->
            </div>
            <!-- end col -->
        </div>
        <RegisterUpdate :isRegister="true" :isEdit="false" />
    </AppLayout>
</template>
