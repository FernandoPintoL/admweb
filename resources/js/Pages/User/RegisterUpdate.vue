<script setup>
import { ref, computed } from "vue";
import FormRegisterUpdate from "@/Pages/User/FormRegisterUpdate.vue";
import FormChangePassword from "@/Pages/User/FormChangePassword.vue";
import FormProfile from "@/Pages/User/FormProfile.vue";

var props = defineProps({
    isRegister: {
        type: Boolean,
        default: false,
    },
    isEdit: {
        type: Boolean,
        default: false,
    },
    userData: {
        type: Object,
        default: {},
    },
});
var titulo = computed(() =>
    props.isRegister
        ? "Registro de Usuario"
        : `Editar Usuario : ${props.userData.id}`
);
</script>
<template>
    <div
        class="offcanvas offcanvas-start w-50"
        data-bs-scroll="true"
        data-bs-backdrop="true"
        tabindex="-1"
        id="registerUpdateData"
        aria-labelledby="offcanvasScrollingLabel"
    >
        <h5 class="offcanvas-header">
            <div class="offcanvas-title" id="offcanvasScrollingLabel">
                <span class="text-muted">{{ titulo }}</span>
                <div
                    v-if="props.isEdit"
                    class="nav-link dropdown-toggle nav-user arrow-none me-0"
                >
                    <span class="account-user-avatar">
                        <img
                            :src="props.userData.profile_photo_url"
                            :alt="props.userData.name"
                            class="rounded-circle"
                        />
                    </span>
                    <span>
                        <span class="account-user-name">{{
                            props.userData.name
                        }}</span>
                        <span class="account-position">{{
                            props.userData.nick
                        }}</span>
                        <span class="account-position">{{
                            props.userData.email
                        }}</span>
                    </span>
                </div>
            </div>
            <button
                type="button"
                class="btn-close text-reset"
                data-bs-dismiss="offcanvas"
                aria-label="Close"
            ></button>
        </h5>
        <hr />
        <div class="offcanvas-body">
            <div class="tab-pane show active" id="default-tabs-preview">
                <ul class="nav nav-tabs mb-3">
                    <li class="nav-item">
                        <a
                            href="#home"
                            data-bs-toggle="tab"
                            aria-expanded="false"
                            class="nav-link active"
                        >
                            <i
                                class="mdi mdi-home-variant d-md-none d-block"
                            ></i>
                            <span class="d-none d-md-block"
                                >Datos de Inicio</span
                            >
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            href="#profile"
                            data-bs-toggle="tab"
                            aria-expanded="true"
                            class="nav-link"
                        >
                            <i
                                class="mdi mdi-account-circle d-md-none d-block"
                            ></i>
                            <span class="d-none d-md-block"
                                >Cambiar password</span
                            >
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            href="#settings"
                            data-bs-toggle="tab"
                            aria-expanded="false"
                            class="nav-link"
                        >
                            <i
                                class="mdi mdi-settings-outline d-md-none d-block"
                            ></i>
                            <span class="d-none d-md-block"
                                >Información Personal</span
                            >
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane show active" id="home">
                        <div class="container-fluid">
                            <FormRegisterUpdate
                                v-bind:isRegister="props.isRegister"
                                v-bind:isEdit="props.isEdit"
                                v-bind:isPageRegister="false"
                                v-bind:userData="props.userData"
                            />
                        </div>
                    </div>
                    <div class="tab-pane" id="profile">
                        <!-- <FormChangePassword
                            v-bind:isRegister="isRegister"
                            v-bind:isEdit="isEdit"
                            v-bind:userData="userData"
                        /> -->
                    </div>
                    <div class="tab-pane" id="settings">
                        <!-- <FormProfile
                            v-bind:isRegister="isRegister"
                            v-bind:isEdit="isEdit"
                            v-bind:userData="userData"
                        /> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
