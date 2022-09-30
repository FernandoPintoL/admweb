<script>
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Head,
        Link,
        Inertia,
    },
    props: ["canResetPassword", "status"],
    data() {
        return {
            form: {
                nick: "",
                password: "",
                remember: "",
            },
            userLogin: {},
            hasErrors: false,
            errors: [],
            recuerdame: false,
            inputTypePassword: true,
            isValidateNick: false,
            isValidatePassword: false,
            nickIsCorrect: true,
            passwordIsCorrect: true,
            messagesNick: [],
            messagesPassword: [],
        };
    },
    methods: {
        async login() {
            if (this.nickIsCorrect && this.passwordIsCorrect) {
                this.form.remember = this.recuerdame ? "on" : "";
                this.form.nick = this.userLogin.nick;
                await axios
                    .post(route("login"), this.form)
                    .then((response) => {
                        console.log(response.data);
                        // window.location = route("login");
                        Inertia.get("login");
                    })
                    .catch((error) => {
                        if (error.response) {
                            this.hasErrors = true;
                            console.log(error.response.data.errors);
                            this.errors = error.response.data.errors;
                        }
                    });
            }
        },
        changeTypePassword() {
            this.inputTypePassword = !this.inputTypePassword;
        },
        async nickCorrect() {
            //evaluando campo vacio y longitud
            if (this.form.nick.length >= 5) {
                //evaluando existencia del nick
                //if ((await this.existeNick()) == 0 || (await this.existeEmail()) == 0) {
                if ((await this.existeNickEmail()) == null) {
                    if (!this.seEncuentraMsg(this.messagesNick, 3)) {
                        this.messagesNick.push({
                            id: 3,
                            message:
                                "Este nick no se encuentran en nuestros registros",
                        });
                    }
                    this.nickIsCorrect = false;
                    this.isValidateNick = true;
                } else {
                    this.isValidateNick = true;
                    this.nickIsCorrect = true;
                    this.eleminarMsg(this.messagesNick, 3);
                }
            } else {
                if (!this.seEncuentraMsg(this.messagesNick, 1)) {
                    this.messagesNick.push(this.msgsErrorForm[0]);
                }
                if (!this.seEncuentraMsg(this.messagesNick, 2)) {
                    this.messagesNick.push({
                        id: 2,
                        message: "El campo debe ser mayor a 5 caracteres",
                    });
                }
                this.nickIsCorrect = false;
                this.isValidateNick = true;
            }
        },
        passwordCorrect() {
            //evaluando campo vacio y longitud
            if (this.form.password.length >= 8) {
                this.passwordIsCorrect = true;
                this.isValidatePassword = true;
                this.eleminarMsg(this.messagesPassword, 1);
                this.eleminarMsg(this.messagesPassword, 2);
            } else {
                if (!this.seEncuentraMsg(this.messagesPassword, 1)) {
                    this.messagesPassword.push(this.msgsErrorForm[0]);
                }
                if (!this.seEncuentraMsg(this.messagesPassword, 2)) {
                    this.messagesPassword.push({
                        id: 2,
                        message: "El campo debe ser mayor a 8 caracteres",
                    });
                }
                this.passwordIsCorrect = false;
                this.isValidatePassword = true;
            }
        },
        async existeNickEmail() {
            var existe = await axios
                .post("/api/getuser", { query: this.form.nick })
                .then((response) => {
                    //return response.data["cantidad"];
                    console.log(response.data["user"]);
                    existe = response.data["user"];
                    if (existe != null) {
                        this.userLogin = response.data["user"];
                    } else {
                        this.userLogin = {};
                    }
                    return existe;
                })
                .catch((error) => {
                    if (error.response) {
                        this.hasErrors = true;
                        console.log(error.response.data.errors);
                        this.errors = error.response.data.errors;
                    }
                });
            return existe;
        },
        async existeNick() {
            var existe = await axios
                .post("/api/existenick", { nick: this.form.nick })
                .then((response) => {
                    //return response.data["cantidad"];
                    existe = response.data["cantidad"];
                    return existe;
                })
                .catch((error) => {
                    if (error.response) {
                        this.hasErrors = true;
                        console.log(error.response.data.errors);
                        this.errors = error.response.data.errors;
                    }
                });
            return existe;
        },
        async existeEmail() {
            console.log("entrando");
            var existe = await axios
                .post("/api/existeemail", { email: this.form.nick })
                .then((response) => {
                    console.log(response.data["cantidad"]);
                    existe = response.data["cantidad"];
                    return existe;
                })
                .catch((error) => {
                    if (error.response) {
                        this.hasErrors = true;
                        console.log(error.response.data.errors);
                        this.errors = error.response.data.errors;
                    }
                });
            return existe;
        },
        seEncuentraMsg(array, id) {
            var result = array.some((element, index) => {
                return element.id == id;
            });
            return result;
        },
        eleminarMsg(array, id) {
            var result = array.filter((element, index) => {
                return element.id !== id;
            });
            return result;
        },
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
    <Head title="Acceder" />
    <section
        class="authentication-bg pb-0"
        data-layout-config='{"darkMode":false}'
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
                        <h4 class="mt-0">Accede!</h4>
                        <p class="text-muted mb-4">
                            Ingresa tu nick y password para acceder al
                            portal!...
                        </p>
                        <div
                            v-if="status"
                            class="mb-4 font-medium text-sm text-success"
                        >
                            {{ status }}
                        </div>
                        <div
                            class="alert alert-danger p-1 mt-2"
                            role="alert"
                            v-if="hasErrors"
                        >
                            <div>Whoops! Algo salio mal.</div>

                            <ul class="p-1">
                                <li v-for="(error, key) in errors" :key="key">
                                    {{ key }} : {{ error }}
                                </li>
                            </ul>
                        </div>
                        <form method="POST" @submit.prevent="login">
                            <div class="mb-3">
                                <label for="nick">User (Nick)</label>
                                <div class="input-group">
                                    <!-- <div class="input-group-text"> -->
                                    <span
                                        v-if="isValidateNick && nickIsCorrect"
                                        class="input-group-text bg-success"
                                    >
                                        <svg
                                            style="
                                                width: 24px;
                                                height: 24px;
                                                color: white;
                                            "
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                fill="currentColor"
                                                d="M21.1,12.5L22.5,13.91L15.97,20.5L12.5,17L13.9,15.59L15.97,17.67L21.1,12.5M11,4A4,4 0 0,1 15,8A4,4 0 0,1 11,12A4,4 0 0,1 7,8A4,4 0 0,1 11,4M11,6A2,2 0 0,0 9,8A2,2 0 0,0 11,10A2,2 0 0,0 13,8A2,2 0 0,0 11,6M11,13C11.68,13 12.5,13.09 13.41,13.26L11.74,14.93L11,14.9C8.03,14.9 4.9,16.36 4.9,17V18.1H11.1L13,20H3V17C3,14.34 8.33,13 11,13Z"
                                            />
                                        </svg>
                                    </span>
                                    <span
                                        v-if="isValidateNick && !nickIsCorrect"
                                        class="input-group-text bg-danger"
                                    >
                                        <svg
                                            style="
                                                width: 24px;
                                                height: 24px;
                                                color: white;
                                            "
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                fill="currentColor"
                                                d="M10 4A4 4 0 0 1 14 8A4 4 0 0 1 10 12A4 4 0 0 1 6 8A4 4 0 0 1 10 4M10 14C14.42 14 18 15.79 18 18V20H2V18C2 15.79 5.58 14 10 14M20 12V7H22V13H20M20 17V15H22V17H20Z"
                                            />
                                        </svg>
                                    </span>
                                    <!-- </div> -->
                                    <input
                                        v-model="form.nick"
                                        @change="nickCorrect"
                                        v-bind:class="[
                                            isValidateNick && nickIsCorrect
                                                ? 'check'
                                                : '',
                                            isValidateNick && !nickIsCorrect
                                                ? 'uncheck'
                                                : '',
                                        ]"
                                        class="form-control"
                                        type="text"
                                        required
                                        name="nick"
                                        id="nick"
                                    />
                                </div>
                                <div
                                    v-if="!nickIsCorrect"
                                    class="alert alert-danger p-1 mt-2"
                                    role="alert"
                                >
                                    <div
                                        v-for="msg in messagesNick"
                                        :key="msg.id"
                                    >
                                        {{ msg.message }}
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <span
                                        v-if="
                                            isValidatePassword &&
                                            passwordIsCorrect
                                        "
                                        class="input-group-text bg-success"
                                    >
                                        <svg
                                            style="
                                                width: 24px;
                                                height: 24px;
                                                color: white;
                                            "
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                fill="currentColor"
                                                d="M5.8 10C5.4 8.8 4.3 8 3 8C1.3 8 0 9.3 0 11S1.3 14 3 14C4.3 14 5.4 13.2 5.8 12H7V14H9V12H11V10H5.8M3 12C2.4 12 2 11.6 2 11S2.4 10 3 10 4 10.4 4 11 3.6 12 3 12M16 4C13.8 4 12 5.8 12 8S13.8 12 16 12 20 10.2 20 8 18.2 4 16 4M16 10.1C14.8 10.1 13.9 9.2 13.9 8C13.9 6.8 14.8 5.9 16 5.9C17.2 5.9 18.1 6.8 18.1 8S17.2 10.1 16 10.1M16 13C13.3 13 8 14.3 8 17V20H24V17C24 14.3 18.7 13 16 13M22.1 18.1H9.9V17C9.9 16.4 13 14.9 16 14.9C19 14.9 22.1 16.4 22.1 17V18.1Z"
                                            />
                                        </svg>
                                    </span>
                                    <span
                                        v-if="
                                            isValidatePassword &&
                                            !passwordIsCorrect
                                        "
                                        class="input-group-text bg-danger"
                                    >
                                        <svg
                                            style="
                                                width: 24px;
                                                height: 24px;
                                                color: white;
                                            "
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                fill="currentColor"
                                                d="M16 22H12V24H6V13.32C3.58 12.17 2 9.72 2 7C2 3.14 5.14 0 9 0C12.86 0 16 3.14 16 7C16 9.72 14.42 12.18 12 13.32V16H16V22M14 18H10V11.94L10.67 11.71C12.66 11 14 9.11 14 7C14 4.24 11.76 2 9 2S4 4.24 4 7C4 9.11 5.34 11 7.33 11.71L8 11.94V22H10V20H14V18M12 7C12 8.66 10.66 10 9 10S6 8.66 6 7 7.34 4 9 4 12 5.34 12 7M9 8C9.55 8 10 7.55 10 7S9.55 6 9 6 8 6.45 8 7 8.45 8 9 8M20 7H22V13H20M20 17H22V15H20"
                                            />
                                        </svg>
                                    </span>
                                    <input
                                        v-model="form.password"
                                        @change="passwordCorrect"
                                        v-bind:class="[
                                            isValidatePassword &&
                                            passwordIsCorrect
                                                ? 'check'
                                                : '',
                                            isValidatePassword &&
                                            !passwordIsCorrect
                                                ? 'uncheck'
                                                : '',
                                        ]"
                                        :type="
                                            inputTypePassword
                                                ? 'password'
                                                : 'text'
                                        "
                                        class="form-control"
                                        name="password"
                                        id="password"
                                        required
                                    />
                                    <button
                                        class="input-group-text bg-info"
                                        type="button"
                                        @click="changeTypePassword"
                                    >
                                        <div v-if="inputTypePassword">
                                            <svg
                                                style="
                                                    width: 24px;
                                                    height: 24px;
                                                    color: white;
                                                "
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    fill="currentColor"
                                                    d="M23.5,17L18.5,22L15,18.5L16.5,17L18.5,19L22,15.5L23.5,17M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9M12,17C12.5,17 12.97,16.93 13.42,16.79C13.15,17.5 13,18.22 13,19V19.45L12,19.5C7,19.5 2.73,16.39 1,12C2.73,7.61 7,4.5 12,4.5C17,4.5 21.27,7.61 23,12C22.75,12.64 22.44,13.26 22.08,13.85C21.18,13.31 20.12,13 19,13C18.22,13 17.5,13.15 16.79,13.42C16.93,12.97 17,12.5 17,12A5,5 0 0,0 12,7A5,5 0 0,0 7,12A5,5 0 0,0 12,17Z"
                                                />
                                            </svg>
                                        </div>
                                        <div v-else>
                                            <svg
                                                style="
                                                    width: 24px;
                                                    height: 24px;
                                                    color: white;
                                                "
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    fill="currentColor"
                                                    d="M22.54 16.88L20.41 19L22.54 21.12L21.12 22.54L19 20.41L16.88 22.54L15.47 21.12L17.59 19L15.47 16.88L16.88 15.47L19 17.59L21.12 15.47L22.54 16.88M12 9C10.34 9 9 10.34 9 12S10.34 15 12 15 15 13.66 15 12 13.66 9 12 9M12 17C9.24 17 7 14.76 7 12S9.24 7 12 7 17 9.24 17 12C17 12.5 16.9 13 16.77 13.43C17.46 13.16 18.21 13 19 13C20.12 13 21.17 13.32 22.07 13.85C22.43 13.27 22.74 12.65 23 12C21.27 7.61 17 4.5 12 4.5S2.73 7.61 1 12C2.73 16.39 7 19.5 12 19.5C12.35 19.5 12.69 19.5 13.03 19.45C13 19.3 13 19.15 13 19C13 18.21 13.16 17.46 13.43 16.77C13 16.9 12.5 17 12 17Z"
                                                />
                                            </svg>
                                        </div>
                                    </button>
                                </div>
                                <div
                                    v-if="!passwordIsCorrect"
                                    class="alert alert-danger p-1 mt-2"
                                    role="alert"
                                >
                                    <div
                                        v-for="msg in messagesPasswordRepeat"
                                        :key="msg.id"
                                    >
                                        {{ msg.message }}
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="checkbox">
                                    <JetCheckbox
                                        id="remember"
                                        v-model:checked="recuerdame"
                                        name="remember"
                                    />
                                    <label class="text-muted" for="remember"
                                        >Recuerda tu password</label
                                    >
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
        <!-- end auth-fluid-->
        <!-- <div class="container-fluid">
            <div class="row">
                <div class="col-xl-5">
                    <img
                        class="bg-img-cover bg-center"
                        src="assets/images/login/3.jpg"
                        alt="looginpage"
                        style="width: 100%; height: 100%"
                    />
                </div>

                <div class="col-xl-7 p-0">
                    <div class="login-card">
                        <form
                            class="theme-form login-form"
                            method="POST"
                            @submit.prevent="login"
                        >
                            <h4>Acceder</h4>
                            <h6>¡Bienvenido de nuevo! Ingrese a su cuenta.</h6>
                            <div
                                v-if="status"
                                class="mb-4 font-medium text-sm text-green-600"
                            >
                                {{ status }}
                            </div>
                            <div
                                class="alert alert-danger p-1 mt-2"
                                role="alert"
                                v-if="hasErrors"
                            >
                                <div>Whoops! Algo salio mal.</div>

                                <ul class="p-1">
                                    <li
                                        v-for="(error, key) in errors"
                                        :key="key"
                                    >
                                        {{ key }} : {{ error }}
                                    </li>
                                </ul>
                            </div>
                            <div class="form-group">
                                <label>User (Nick)</label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <div class="icon">
                                            <i
                                                class="fa-duotone fa-hashtag"
                                            ></i>
                                        </div>
                                    </div>
                                    <input
                                        v-model="form.nick"
                                        @change="nickCorrect"
                                        v-bind:class="[
                                            isValidateNick && nickIsCorrect
                                                ? 'check'
                                                : '',
                                            isValidateNick && !nickIsCorrect
                                                ? 'uncheck'
                                                : '',
                                        ]"
                                        class="form-control"
                                        type="text"
                                        required
                                    />
                                    <span
                                        v-if="isValidateNick && nickIsCorrect"
                                        class="input-group-text"
                                    >
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <span
                                        v-if="isValidateNick && !nickIsCorrect"
                                        class="input-group-text"
                                    >
                                        <i class="fa-solid fa-circle-info"></i>
                                    </span>
                                </div>
                                <div
                                    v-if="!nickIsCorrect"
                                    class="alert alert-danger p-1 mt-2"
                                    role="alert"
                                >
                                    <div
                                        v-for="msg in messagesNick"
                                        :key="msg.id"
                                    >
                                        {{ msg.message }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <div class="icon">
                                            <i class="icofont-lock"></i>
                                        </div>
                                    </span>
                                    <input
                                        v-model="form.password"
                                        @change="passwordCorrect"
                                        v-bind:class="[
                                            isValidatePassword &&
                                            passwordIsCorrect
                                                ? 'check'
                                                : '',
                                            isValidatePassword &&
                                            //!passwordIsCorrect
                                                ? 'uncheck'
                                                : '',
                                        ]"
                                        :type="
                                            inputTypePassword
                                                ? 'password'
                                                : 'text'
                                        "
                                        class="form-control"
                                        name="password"
                                        required
                                    />
                                    <button
                                        class="input-group-text"
                                        type="button"
                                        @click="changeTypePassword"
                                    >
                                        <div v-if="inputTypePassword">
                                            <i class="fa-solid fa-eye"></i>
                                        </div>
                                        <div v-else>
                                            <i
                                                class="fa-solid fa-eye-low-vision"
                                            ></i>
                                        </div>
                                    </button>
                                    <span
                                        v-if="
                                            isValidatePassword &&
                                            passwordIsCorrect
                                        "
                                        class="input-group-text"
                                    >
                                        <i class="fa-solid fa-check"></i>
                                    </span>
                                    <span
                                        v-if="
                                            isValidatePassword &&
                                            //!passwordIsCorrect
                                        "
                                        class="input-group-text"
                                    >
                                        <i class="fa-solid fa-circle-info"></i>
                                    </span>
                                </div>
                                <div
                                    v-if="!passwordIsCorrect"
                                    class="alert alert-danger p-1 mt-2"
                                    role="alert"
                                >
                                    <div
                                        v-for="msg in messagesPasswordRepeat"
                                        :key="msg.id"
                                    >
                                        {{ msg.message }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <JetCheckbox
                                        id="remember"
                                        v-model:checked="recuerdame"
                                        name="remember"
                                    />
                                    <label class="text-muted" for="remember"
                                        >Recuerda tu password</label
                                    >
                                </div>
                                <a
                                    class="link"
                                    :href="route('password.request')"
                                    >Olvidaste tu password?</a
                                >
                            </div>
                            <div class="form-group">
                                <button
                                    class="btn btn-primary btn-block"
                                    type="submit"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Acceder
                                </button>
                            </div>
                            <div class="login-social-title">
                <h5>Sign in with</h5>
              </div> -->
        <!-- <div class="form-group">
                <ul class="login-social">
                  <li>
                    <a href="../../login.html" target="_blank">
                      <i data-feather="circle"></i>
                    </a>
                  </li>
                  <li>
                    <a href="../../login.html" target="_blank"
                      ><i data-feather="twitter"></i
                    ></a>
                  </li>
                  <li>
                    <a href="../../login.html" target="_blank"
                      ><i data-feather="facebook"></i
                    ></a>
                  </li>
                  <li>
                    <a href="https://www.instagram.com/login" target="_blank"
                      ><i data-feather="instagram"> </i
                    ></a>
                  </li>
                </ul>
              </div>
                            <p>
                                No tienes una cuenta?<a
                                    class="ms-2"
                                    :href="route('register')"
                                    >Crea tu cuenta</a
                                >
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->
    </section>
    <!-- page-wrapper end-->
</template>
