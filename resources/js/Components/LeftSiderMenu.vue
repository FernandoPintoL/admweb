<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
export default {
    name: "LeftSiderMenu",
    components: {
        Head,
        Link,
        Inertia,
    },
    methods: {
        userEdit() {
            Inertia.get("usuarios/1");
        },
    },
};
</script>
<template>
    <div class="leftside-menu">
        <!-- LOGO -->
        <Link href="/" class="logo text-center logo-light ml-2 my-3">
            <span class="logo-lg">
                <img v-bind:src="'assets/images/logo.png'" alt="" height="14" />
            </span>
            <span class="logo-sm">
                <img v-bind:src="'assets/images/logo.png'" alt="" height="14" />
            </span>
        </Link>

        <!-- LOGO -->
        <Link href="/" class="logo text-center logo-dark ml-2 my-3">
            <span class="logo-lg">
                <img
                    v-bind:src="'assets/images/logo-dark.png'"
                    alt=""
                    height="14"
                />
            </span>
            <span class="logo-sm">
                <img
                    v-bind:src="'assets/images/logo_sm_dark.png'"
                    alt=""
                    height="14"
                />
            </span>
        </Link>

        <div class="h-100" id="leftside-menu-container" data-simplebar="">
            <!--- Sidemenu -->
            <ul class="side-nav">
                <li class="side-nav-title side-nav-item">Navigation</li>

                <li class="side-nav-item">
                    <a
                        data-bs-toggle="collapse"
                        href="#sidebarDashboards"
                        aria-expanded="false"
                        aria-controls="sidebarDashboards"
                        class="side-nav-link"
                    >
                        <i class="uil-home-alt"></i>
                        <span class="badge bg-success float-end">4</span>
                        <span> Dashboards </span>
                    </a>
                    <div class="collapse" id="sidebarDashboards">
                        <ul class="side-nav-second-level">
                            <li @click="userEdit">
                                <a>Analytics</a>
                            </li>
                            <li>
                                <a href="dashboard-crm.html">CRM</a>
                            </li>
                            <li>
                                <a href="index.html">Ecommerce</a>
                            </li>
                            <li>
                                <a href="dashboard-projects.html">Projects</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="side-nav-title side-nav-item">MODULOS</li>

                <li class="side-nav-item">
                    <Link :href="route('user.index')" class="side-nav-link">
                        <i class="mdi mdi-account-settings-outline"></i>
                        <span> Usuarios </span>
                    </Link>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -left -->
    </div>
</template>
