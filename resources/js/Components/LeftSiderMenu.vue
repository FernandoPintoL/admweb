<script>
import { ref } from "vue";
export default {
    name: "LeftSiderMenu",
    components: {
        ref,
    },
};
</script>
<template>
    <div class="leftside-menu">
        <!-- LOGO -->
        <a :href="'/'" class="logo text-center logo-light ml-2 my-3">
            <span class="logo-lg">
                <img src="assets/images/logo.png" alt="" height="14" />
            </span>
            <span class="logo-sm">
                <img src="assets/images/logo_sm.png" alt="" height="14" />
            </span>
        </a>

        <!-- LOGO -->
        <a :href="'/'" class="logo text-center logo-dark ml-2 my-3">
            <span class="logo-lg">
                <img src="assets/images/logo-dark.png" alt="" height="14" />
            </span>
            <span class="logo-sm">
                <img src="assets/images/logo_sm_dark.png" alt="" height="14" />
            </span>
        </a>

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
                            <li>
                                <a href="dashboard-analytics.html">Analytics</a>
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
                    <a :href="route('usuario')" class="side-nav-link">
                        <i class="mdi mdi-account-settings-outline"></i>
                        <span> Usuarios </span>
                    </a>
                </li>
            </ul>

            <!-- Help Box -->
            <!-- end Help Box -->
            <!-- End Sidebar -->

            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -left -->
    </div>
</template>
