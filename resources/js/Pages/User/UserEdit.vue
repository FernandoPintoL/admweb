<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import global from "@/Globales/global.vue";
import globalView from "@/Globales/globalView.vue";
import Table from "@/Components/Table.vue";
export default {
    name: "UserEdit",
    props: ["user"],
    components: {
        Head,
        Link,
        AppLayout,
        global,
        Table,
        globalView,
    },
};
</script>
<template>
    <AppLayout title="Editar Usuario">
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
                                Editar Usuario {{ this.user.name }}
                            </li>
                        </ol>
                    </div>
                    <h4 class="page-title">Editar Usuario</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </AppLayout>
</template>
