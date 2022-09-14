<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
export default {
    props: ["user", "canLogin", "canRegister"],
    components: {
        Head,
        Link,
    },
};
</script>

<template>
    <Head title="BIENVENIDO" />
    <div>
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <div v-if="canLogin" class="breadcrumb m-0">
                                <Link
                                    v-if="$page.props.user"
                                    :href="route('dashboard')"
                                    class="breadcrumb-item"
                                    >Dashboard</Link
                                >

                                <template v-else>
                                    <Link
                                        :href="route('login')"
                                        class="breadcrumb-item"
                                        >Log in</Link
                                    >

                                    <Link
                                        v-if="canRegister"
                                        :href="route('register')"
                                        class="breadcrumb-item"
                                        >Register</Link
                                    >
                                </template>
                            </div>
                        </div>
                        <!-- <h4 class="page-title">Chat</h4> -->
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
        <div class="flex flex-wrap justify-center">
            <img
                class="object-fill max-w-full h-96"
                src="assets/images/maintenance.svg"
                alt="File not found Image"
            />
        </div>
        <!-- end col -->

        <footer class="footer footer-alt">2022 ADMFPL</footer>
    </div>
</template>
