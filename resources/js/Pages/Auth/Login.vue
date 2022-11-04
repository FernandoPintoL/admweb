<script setup>
import {Inertia} from "@inertiajs/inertia";
import {Head, Link, useForm} from "@inertiajs/inertia-vue3";
import {ref, watch} from "vue";
import ControlGroup from "@/Components/ControlGroup.vue";
import InputGralVue from "@/Components/InputGral.vue";
import InputError from "@/Jetstream/InputError.vue";
import global from "@/Globales/global.vue";


defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    nick: "",
    password: "",
    remember: false,
});
const nick = ref("");
const password = ref("");

var icon = ref("mdi mdi-eye-outline");
var iconNick = ref("mdi mdi-account-circle");
var iconPassword = ref("mdi mdi-account-key-outline");
var inputTypePassword = ref(true);
var nickIsValidate = ref(false);
var nickIsCorrect = ref(false);
var passwordIsValidate = ref(false);
var passwordIsCorrect = ref(false);
var helpNick = ref("");
var helpPassword = ref("");

var message = (titulo, message, tipo)=>{
    window.$.NotificationApp.send(titulo,message,"top-right","rgba(0,0,0,0.2)",tipo);
}

const changeTypePassword = () => {
    inputTypePassword.value = !inputTypePassword.value;
    icon.value = inputTypePassword.value ? 'mdi mdi-eye-outline' : 'mdi mdi-eye-off-outline'
};

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

watch(
    () => form.nick,
    async (newNick) => {
        if (newNick.length >= 6) {
            helpNick.value = "";
            var response = await global.postQuery("api/existe/nick",{"query" : newNick});
            if(response.status === 200){
                var data = response.data['cantidad'];
                if(data > 0){
                    iconNick.value = 'mdi mdi-account-circle';
                    nickIsCorrect.value = true;
                    nickIsValidate.value = true;
                }else{
                    helpNick.value = `${newNick} no se encuentran en nuestros registros`;
                    iconNick.value = 'mdi mdi-account-alert-outline';
                    nickIsCorrect.value = false;
                    nickIsValidate.value = true;
                }
            }else{
                global.messageNotify(`Error : ${response.status}`, `Error: ${response.statusText} - ${newNick}`, 'error');
                helpNick.value = `Ocurrio algun error de consulta`;
                iconNick.value = 'mdi mdi-account-alert-outline';
                nickIsCorrect.value = false;
                nickIsValidate.value = true;
            }
        } else {
            iconNick.value = 'mdi mdi-account-alert-outline';
            helpNick.value = "Este campo requiere mas de 6 caracteres";
            nickIsCorrect.value = false;
            nickIsValidate.value = true;
        }
    }
);

watch(
    () => form.password,
    async (newPassword) => {
        if (newPassword.length >= 6) {
            iconPassword.value = "mdi mdi-account-key-outline";
            passwordIsCorrect.value = true;
            passwordIsValidate.value = true;
        } else {
            iconPassword.value = "mdi mdi-account-key";
            passwordIsCorrect.value = false;
            passwordIsValidate.value = true;
            helpPassword.value = "Este campo requiere mas de 6 caracteres";
        }
    }
);
</script>

<template>
    <Head title="Acceder"/>
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
                            <Link :href="'/'" class="logo-dark">
                                <span
                                ><img
                                    src="assets/images/logo-dark.png"
                                    alt=""
                                    height="18"
                                /></span>
                            </Link>
                            <Link :href="'/'" class="logo-light">
                                <span
                                ><img
                                    src="assets/images/logo.png"
                                    alt=""
                                    height="18"
                                /></span>
                            </Link>
                        </div>
                        <!-- title-->
                        <h4 class="mt-0" @click="message">Accede!</h4>
                        <p class="text-muted mb-4">
                            Ingresa tu nick y password para acceder al portal!...
                        </p>
                        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                            {{ status }}
                        </div>
                        <form @submit.prevent="submit">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <ControlGroup
                                        class="mb-3"
                                        :label="'Nick de inicio'"
                                        :help="form.errors.nick ? form.errors.nick : helpNick"
                                        :icon="iconNick"
                                        :isCorrect="nickIsCorrect"
                                        :isValidate="nickIsValidate"
                                    >
<!--                                        <InputError class="mt-1" :message="form.errors.nick"/>-->
                                        <InputGralVue
                                            id="nick"
                                            ref="nick"
                                            name="nick"
                                            v-model="form.nick"
                                            :isCorrect="nickIsCorrect"
                                            :isValidate="nickIsValidate"
                                            required
                                        />
                                    </ControlGroup>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <ControlGroup
                                        class="mb-3"
                                        :label="'Password'"
                                        :help="form.errors.password ? form.errors.password : helpPassword "
                                        :isCorrect="passwordIsCorrect"
                                        :isValidate="passwordIsValidate"
                                        :icon="iconPassword"
                                    >
<!--                                        <InputError class="mt-1" :message="form.errors.password"/>-->
                                        <InputGralVue
                                            id="password"
                                            name="password"
                                            ref="password"
                                            :type="inputTypePassword ? 'password' : 'text'"
                                            v-model="form.password"
                                            :isCorrect="passwordIsCorrect"
                                            :isValidate="passwordIsValidate"
                                            required
                                        />
                                        <i v-bind:class="icon" @click="changeTypePassword" style="font-size: 25px !important;"></i>
                                    </ControlGroup>
                                </div>
                            </div>
                            <div class="d-grid mb-3 text-center">
                                <button
                                    class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded"
                                    type="submit"
                                >
                                    <i class="mdi mdi-login"></i>
                                    Acceder
                                </button>
                            </div>
                            <div class="mb-3">
                                <a
                                    class="text-muted"
                                    :href="route('password.request')"
                                >
                                    <i class="mdi mdi-lock-alert"></i> Olvidaste
                                    tu password?</a
                                >
                            </div>
                        </form>
                        <!-- Footer-->
                        <footer class="footer footer-alt">
                            <p class="text-muted">
                                Si no tienes un cuenta
                                <Link
                                    :href="route('register')"
                                    class="text-muted ms-1"
                                ><b>Registrate aqui</b></Link
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
    <!-- page-wrapper end-->
</template>
