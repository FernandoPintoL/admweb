<!-- <script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";
import JetBanner from "@/Jetstream/Banner.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink.vue";

require("./../../../public/assets/js/theme-customizer/customizer.js");
// require("./../../../public/assets/js/sidebar-menu.js");

defineProps({
  title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
  Inertia.put(
    route("current-team.update"),
    {
      team_id: team.id,
    },
    {
      preserveState: false,
    }
  );
};

const logout = () => {
  Inertia.post(route("logout"));
};
</script> -->

<script>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink.vue";
import { Icon } from "@iconify/vue";
import gView_ from "./../Globales/globalView.vue";
// require("./../../../public/assets/js/theme-customizer/customizer.js");
// require("./../../../public/assets/js/script.js");
export default {
  components: {
    ref,
    Inertia,
    Head,
    Link,
    Icon,
    gView_,
  },
  props: ["title"],
  data() {
    return {
      isDarkBody: false,
      menuView: true,
    };
  },
  mounted() {
    gView_.siderbarmenu();
    gView_.script();
    gView_.customizer();
  },
  methods: {
    changeMode() {
      this.isDarkBody = !this.isDarkBody;
      console.log(this.isDarkBody);
    },
    changeMenu() {
      this.menuView = !this.menuView;
    },
  },
};
</script>

<template>
  <div>
    <Head :title="title" />
    <div class="page-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <div class="page-main-header" :class="menuView ? '' : 'close_icon'">
        <div class="main-header-right row m-0">
          <div class="main-header-left">
            <div class="logo-wrapper">
              <a :href="route('dashboard')"
                ><img class="img-fluid" src="assets/images/logo/logo.png" alt=""
              /></a>
            </div>
            <div class="dark-logo-wrapper">
              <a :href="route('dashboard')"
                ><img class="img-fluid" src="assets/images/logo/dark-logo.png" alt=""
              /></a>
            </div>
            <div class="toggle-sidebar" id="sidebar-toggle" @click="changeMenu">
              <i
                class="fa-solid fa-bars status_toggle middle"
                data-feather="align-center"
              ></i>
            </div>
          </div>
          <div class="left-menu-header col">
            <ul>
              <li>
                <form class="form-inline search-form">
                  <div class="search-bg">
                    <i class="fa fa-search"></i>
                    <input
                      class="form-control-plaintext"
                      placeholder="Search here....."
                    />
                  </div>
                </form>
                <span class="d-sm-none mobile-search search-bg"
                  ><i class="fa fa-search"></i
                ></span>
              </li>
            </ul>
          </div>
          <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav-menus">
              <li>
                <a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"
                  ><Icon icon="fluent:full-screen-maximize-16-filled"
                /></a>
              </li>
              <li class="onhover-dropdown">
                <div class="notification-box">
                  <span class="iconify" data-icon="akar-icons:bell"></span
                  ><span class="dot-animated"></span>
                </div>
                <ul class="notification-dropdown onhover-show-div">
                  <li>
                    <p class="f-w-700 mb-0">
                      You have 3 Notifications<span
                        class="pull-right badge badge-primary badge-pill"
                        >4</span
                      >
                    </p>
                  </li>
                  <li class="noti-primary">
                    <div class="media">
                      <span class="notification-bg bg-light-primary"
                        ><i data-feather="activity"> </i
                      ></span>
                      <div class="media-body">
                        <p>Delivery processing</p>
                        <span>10 minutes ago</span>
                      </div>
                    </div>
                  </li>
                  <li class="noti-secondary">
                    <div class="media">
                      <span class="notification-bg bg-light-secondary"
                        ><i data-feather="check-circle"> </i
                      ></span>
                      <div class="media-body">
                        <p>Order Complete</p>
                        <span>1 hour ago</span>
                      </div>
                    </div>
                  </li>
                  <li class="noti-success">
                    <div class="media">
                      <span class="notification-bg bg-light-success"
                        ><i data-feather="file-text"> </i
                      ></span>
                      <div class="media-body">
                        <p>Tickets Generated</p>
                        <span>3 hour ago</span>
                      </div>
                    </div>
                  </li>
                  <li class="noti-danger">
                    <div class="media">
                      <span class="notification-bg bg-light-danger"
                        ><i data-feather="user-check"> </i
                      ></span>
                      <div class="media-body">
                        <p>Delivery Complete</p>
                        <span>6 hour ago</span>
                      </div>
                    </div>
                  </li>
                </ul>
              </li>
              <li>
                <div class="mode">
                  <i id="iconMode" class="fa-solid fa-lightbulb"></i>
                  <!-- <div v-show="isDarkBody">
                    <i class="fa-solid fa-moon"></i>
                  </div> -->
                </div>
              </li>
              <li class="onhover-dropdown p-0">
                <button class="btn btn-primary-light" type="button">
                  <a href="login_two.html"><Icon icon="ci:log-out" />Log out</a>
                </button>
              </li>
            </ul>
          </div>
          <div class="d-lg-none mobile-toggle pull-right w-auto">
            <i data-feather="more-horizontal"></i>
          </div>
        </div>
      </div>
      <!-- Page Header Ends -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper horizontal-menu">
        <header class="main-nav" :class="menuView ? '' : 'close_icon'">
          <div class="sidebar-user text-center p-2">
            <a class="setting-primary" href="javascript:void(0)"
              ><i class="fa-solid fa-gear"></i></a
            ><img
              class="img-90 rounded-circle"
              :src="$page.props.user.profile_photo_url"
              :alt="$page.props.user.name"
            />
            <div class="mb-2">
              <span class="badge badge-primary">{{ $page.props.user.name }}</span>
            </div>
            <!-- <a href="user-profile.html">
              <h6 class="mt-3 f-14 f-w-600">{{ $page.props.user.name }}</h6></a
            > -->
            <p class="mb-0 font-roboto">{{ $page.props.user.email }}</p>
          </div>
          <nav>
            <div class="main-navbar">
              <div class="left-arrow" id="left-arrow">
                <i class="fa-solid fa-arrow-left"></i>
              </div>
              <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                  <li class="back-btn">
                    <div class="mobile-back text-end">
                      <span>Back</span>
                      <!-- <i class="fa fa-angle-right ps-2" aria-hidden="true"></i> -->
                      <i class="fa-solid fa-angle-right ps-2"></i>
                    </div>
                  </li>
                  <li class="sidebar-main-title">
                    <div>
                      <h6>General</h6>
                    </div>
                  </li>
                  <li class="dropdown">
                    <a class="nav-link menu-title link-nav" :href="route('dashboard')"
                      ><span><i class="fa-solid fa-house"></i>Dashboard</span></a
                    >
                  </li>
                  <li class="dropdown">
                    <a class="nav-link menu-title" href="javascript:void(0)"
                      ><i data-feather="layout"></i><span>Gestionador de User</span></a
                    >
                    <ul class="nav-submenu menu-content">
                      <li>
                        <a :href="route('teams.show', $page.props.user.current_team)"
                          >Ajustes de Teams</a
                        >
                      </li>
                      <li>
                        <a
                          v-if="$page.props.jetstream.canCreateTeams"
                          :href="route('teams.create')"
                          >Crear nuevo Teams</a
                        >
                      </li>
                    </ul>
                  </li>
                  <li class="sidebar-main-title">
                    <div>
                      <h6>Inventario</h6>
                    </div>
                  </li>
                  <!-- <li class="dropdown">
                    <a class="nav-link menu-title link-nav" :href="route('dashboard')"
                      ><span><i class="fa-solid fa-warehouse"></i>Almacen</span></a
                    >
                  </li> -->
                  <li class="dropdown">
                    <a class="nav-link menu-title link-nav" :href="route('articulo')"
                      ><span><i class="fa-solid fa-newspaper"></i>Articulo</span></a
                    >
                  </li>
                </ul>
              </div>
              <div class="right-arrow" id="right-arrow">
                <i class="fa-solid fa-arrow-right"></i>
              </div>
            </div>
          </nav>
        </header>
        <!-- Page Content -->
        <div class="page-body">
          <slot />
        </div>
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 footer-copyright">
                <p class="mb-0">Copyright 2021-22 © FPL All rights reserved.</p>
              </div>
              <div class="col-md-6">
                <p class="pull-right mb-0">
                  Hand crafted & made with <i class="fa fa-heart font-secondary"></i>
                </p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
  </div>
</template>
