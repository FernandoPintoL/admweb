<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import globalView from "@/Globales/globalView.vue";
import Table from "@/Components/Table.vue";
import RegisterUpdate from "@/Pages/User/RegisterUpdate.vue";
import { onMounted, ref } from "vue";
var props = defineProps({
    roles: {
        type: Object,
        default: [],
    },
});
var dataEdit = ref({});
var isRegister = ref(false);
var isEdit = ref(false);

var editar = (data) => {
    dataEdit.value = data;
    isEdit.value = true;
    isRegister.value = false;
};

function crear() {
    isEdit.value = false;
    isRegister.value = true;
    dataEdit.value = {};
}
</script>
<template>
    <AppLayout title="Gestion de Roles">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="javascript: void(0);">AdmFpl</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Gestion de Roles
                            </li>
                        </ol>
                    </div>
                    <h4 class="page-title">Gestion de Roles</h4>
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
                                    @click="crear"
                                >
                                    <i class="mdi mdi-plus-circle me-2"></i>
                                    Registrar Nuevo Rol
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
                                    <th class="all">Descripcion</th>
                                    <th>Status</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in props.roles" :key="item.id">
                                    <td>
                                        <p class="text-body">{{ item.id }}</p>
                                    </td>
                                    <td>
                                        <div
                                            class="m-0 d-inline-block align-middle font-16"
                                        >
                                            <p class="text-body">
                                                {{ item.descripcion }}
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        <div
                                            :class="
                                                item.status === 'active'
                                                    ? 'badge bg-success'
                                                    : 'badge bg-danger'
                                            "
                                        >
                                            {{ item.status }}
                                        </div>
                                    </td>
                                    <td class="table-action">
                                        <button
                                            class="action-icon"
                                            type="button"
                                            data-bs-toggle="offcanvas"
                                            data-bs-target="#registerUpdateData"
                                            aria-controls="offcanvasScrolling"
                                            @click="editar(item)"
                                        >
                                            <i
                                                class="mdi mdi-square-edit-outline text-primary"
                                            ></i>
                                        </button>
                                        <a
                                            href="javascript:void(0);"
                                            class="action-icon"
                                        >
                                            <i
                                                class="mdi mdi-delete text-danger"
                                            ></i
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
        <!-- <RegisterUpdate
            v-bind:isRegister="isRegister"
            v-bind:isEdit="isEdit"
            v-bind:userData="userEdit"
            v-bind:isView="true"
        /> -->
    </AppLayout>
</template>
