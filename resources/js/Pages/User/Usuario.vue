<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import global from "@/Globales/global.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
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

var ocultar = () => {
    const offcanvas = window.$('#registerUpdateData');
    offcanvas.removeClass('.show');
    offcanvas.addClass('.hide');
    console.log(offcanvas);
    console.log(offcanvas.hasClass('offcanvas'));
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
                                    data-bs-target="#offcanvasFormularios"
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
                            <Table>
                                <thead class="table-light">
                                    <tr>
                                        <th>Id</th>
                                        <th class="all">Name</th>
                                        <th>Nick</th>
                                        <th>Email</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in props.users" :key="item.id">
                                        <td>
                                            <p class="text-body">{{ item.id }}</p>
                                        </td>
                                        <td>
                                            <img
                                                v-bind:src="item.profile_photo_path ? item.profile_photo_path : item.profile_photo_url"
                                                v-bind:alt="item.name"
                                                title="contact-img" class="rounded me-3" height="35"
                                            />
                                            <div class="m-0 d-inline-block align-middle font-16">
                                                <p class="text-body">{{ item.name }}</p>
                                            </div>
                                        </td>
                                        <td>{{ item.nick }}</td>
                                        <td>{{ item.email }}</td>
                                        <td>
                                            <div :class="item.status === 'active' ? 'badge bg-success' : 'badge bg-danger'">
                                                {{ item.status.toUpperCase() }}
                                            </div>
                                        </td>
                                        <td class="table-action">
                                            <button
                                                class="action-icon"
                                                type="button"
                                                data-bs-toggle="offcanvas"
                                                data-bs-target="#offcanvasFormularios"
                                                aria-controls="offcanvasScrolling"
                                                @click="editarUsuario(item)"
                                            >
                                                <i
                                                    class="mdi mdi-square-edit-outline text-primary"
                                                ></i>
                                            </button>
                                            <a
                                                href="javascript:void(0);"
                                                class="action-icon"
                                            >
                                                <i class="mdi mdi-delete text-danger"></i
                                                ></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </Table>
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
