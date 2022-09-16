<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import FormRegisterUpdate from "@/Pages/User/FormRegisterUpdate.vue";

export default {
    components: {
        Head,
        Link,
        JetValidationErrors,
        FormRegisterUpdate,
    },
};
</script>

<style>
.check {
    border-color: green !important;
}

.uncheck {
    border-color: red !important;
}
</style>
<template>
    <Head title="Registrate" />
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <section
        class="authentication-bg pb-0"
        data-layout-config='{"darkMode":true}'
    >
        <div class="auth-fluid">
            <!--Auth fluid left content -->
            <div class="auth-fluid-form-box">
                <div class="align-items-center d-flex h-100">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="auth-brand text-center text-lg-start">
                            <a :href="'/'" class="logo-dark">
                                <span
                                    ><img
                                        src="assets/images/logo-dark.png"
                                        alt=""
                                        height="18"
                                /></span>
                            </a>
                            <a :href="'/'" class="logo-light">
                                <span
                                    ><img
                                        src="assets/images/logo.png"
                                        alt=""
                                        height="18"
                                /></span>
                            </a>
                        </div>
                        <!-- title-->
                        <h4 class="mt-3">Registrate Gratis</h4>
                        <p class="text-muted mb-4">
                            ¿No tienes una cuenta? Crea tu cuenta, se tarda
                            menos de un minuto
                        </p>
                        <!-- form -->
                        <FormRegisterUpdate
                            :isRegister="true"
                            :isEdit="false"
                            :isPageRegister="true"
                        />
                        <div class="text-center mt-4">
                            <p class="text-muted font-16">Inicia con</p>
                            <ul class="social-list list-inline mt-3">
                                <li class="list-inline-item">
                                    <a
                                        href="javascript: void(0);"
                                        class="social-list-item border-primary text-primary"
                                        ><i class="mdi mdi-facebook"></i
                                    ></a>
                                </li>
                                <li class="list-inline-item">
                                    <a
                                        href="javascript: void(0);"
                                        class="social-list-item border-danger text-danger"
                                        ><i class="mdi mdi-google"></i
                                    ></a>
                                </li>
                                <li class="list-inline-item">
                                    <a
                                        href="javascript: void(0);"
                                        class="social-list-item border-info text-info"
                                        ><i class="mdi mdi-twitter"></i
                                    ></a>
                                </li>
                                <li class="list-inline-item">
                                    <a
                                        href="javascript: void(0);"
                                        class="social-list-item border-secondary text-secondary"
                                        ><i class="mdi mdi-github"></i
                                    ></a>
                                </li>
                            </ul>
                        </div>
                        <!-- end form-->
                        <!-- Footer-->
                        <footer class="footer footer-alt">
                            <p class="text-muted">
                                Ya tienes tu cuenta?
                                <a
                                    :href="route('login')"
                                    class="text-muted ms-1"
                                    ><b>Inicia aqui</b></a
                                >
                            </p>
                        </footer>
                    </div>
                    <!-- end .card-body -->
                </div>
                <!-- end .align-items-center.d-flex.h-100-->
            </div>
            <!-- end auth-fluid-form-box-->

            <!-- Auth fluid right content -->
            <div class="auth-fluid-right text-center">
                <div class="auth-user-testimonial">
                    <h2 class="mb-3">I love the color!</h2>
                    <p class="lead">
                        <i class="mdi mdi-format-quote-open"></i> It's a elegent
                        templete. I love it very much! .
                        <i class="mdi mdi-format-quote-close"></i>
                    </p>
                    <p>- Hyper Admin User</p>
                </div>
                <!-- end auth-user-testimonial-->
            </div>
            <!-- end Auth fluid right content -->
        </div>
    </section>
</template>
