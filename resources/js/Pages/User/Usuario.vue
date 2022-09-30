<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import global from "@/Globales/global.vue";
import globalView from "@/Globales/globalView.vue";
import Table from "@/Components/Table.vue";
import RegisterUpdate from "@/Pages/User/RegisterUpdate.vue";
import { onMounted, ref } from "vue";
var props = defineProps({
    users: {
        type: Object,
        default: [],
    },
});

var userEdit = ref({});
var isRegister = ref(false);
var isEdit = ref(false);

const cargarTable = () => globalView.createtable("#tableUsers");

var editarUsuario = (data) => {
    userEdit.value = data;
    isEdit.value = true;
    isRegister.value = false;
};

function crearUsuario() {
    isEdit.value = false;
    isRegister.value = true;
    userEdit.value = {};
}

onMounted(() => {
    cargarTable();
});
</script>
<script>
export default {
    name: "Usuario",
};
</script>
<style>
.check {
    border-color: #0acf97 !important;
}

.uncheck {
    border-color: #96374a !important;
}
</style>
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
                                    data-bs-target="#registerUpdateData"
                                    aria-controls="offcanvasScrolling"
                                    @click="crearUsuario"
                                >
                                    <i class="mdi mdi-plus-circle me-2"></i>
                                    Registrar Usuario
                                </button>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-end">
                                    <button
                                        type="button"
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
                                id="tableUsers"
                            >
                                <thead class="table-light">
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Nick</th>
                                        <th>Email</th>
                                        <th>Estado</th>
                                        <th class="table-action">
                                            <a
                                                href="javascript:void(0);"
                                                class="action-icon"
                                            >
                                                <i class="mdi mdi-eye"></i
                                            ></a>
                                            <a
                                                href="javascript:void(0);"
                                                class="action-icon"
                                            >
                                                <i
                                                    class="mdi mdi-square-edit-outline"
                                                ></i
                                            ></a>
                                            <a
                                                href="javascript:void(0);"
                                                class="action-icon"
                                            >
                                                <i class="mdi mdi-delete"></i
                                            ></a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in users" :key="item.id">
                                        <td>{{ item.id }}</td>
                                        <td>{{ item.name }}</td>
                                        <td>{{ item.nick }}</td>
                                        <td>{{ item.email }}</td>
                                        <td>{{ item.status }}</td>
                                        <td>
                                            <button
                                                class="btn btn-info"
                                                type="button"
                                                data-bs-toggle="offcanvas"
                                                data-bs-target="#registerUpdateData"
                                                aria-controls="offcanvasScrolling"
                                                @click="editarUsuario(item)"
                                            >
                                                <i
                                                    class="mdi mdi-square-edit-outline"
                                                ></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
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
        <RegisterUpdate
            v-bind:isRegister="isRegister"
            v-bind:isEdit="isEdit"
            v-bind:userData="userEdit"
        />
    </AppLayout>
</template>
