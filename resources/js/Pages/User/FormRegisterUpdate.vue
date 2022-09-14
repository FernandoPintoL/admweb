<script>
import { isQualifiedTypeIdentifier } from "@babel/types";

export default {
    name: "FormRegisterUpdate",
    props: ["isRegister", "isEdit", "isUserRegister", "user"],
    data() {
        return {
            form: {
                name: "",
                nick: "",
                email: "",
                password: "",
                password_confirmation: "",
                terms: false,
            },
            hasErrors: false,
            inputTypePassword: true,
            inputTypePasswordRepeat: true,
            isValidateName: false,
            isValidateNick: false,
            isValidateEmail: false,
            isValidatePassword: false,
            isValidatePasswordRepeat: false,
            nameIsCorrect: true,
            nickIsCorrect: true,
            emailIsCorrect: true,
            passwordIsCorrect: true,
            passwordRepeatIsCorrect: true,
            messagesName: [],
            messagesNick: [],
            messagesEmail: [],
            messagesPassword: [],
            messagesPasswordRepeat: [],
            msgsErrorForm: [
                {
                    id: 1,
                    message: "El campo es requerido",
                },
                {
                    id: 2,
                    message: "El campo debe ser mayor a 8 caracteres",
                },
            ],
            habilitado: "check",
            deshabilitado: "uncheck",
        };
    },
    methods: {
        async register() {
            if (
                this.nameIsCorrect &&
                this.nickIsCorrect &&
                this.emailIsCorrect &&
                this.passwordIsCorrect &&
                this.passwordRepeatIsCorrect
            ) {
                await axios
                    .post(route("register"), this.form)
                    .then((response) => {
                        console.log(response.data);
                        window.location = route("login");
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
        changeTypePasswordRepeat() {
            this.inputTypePasswordRepeat = !this.inputTypePasswordRepeat;
        },
        nameCorrect() {
            if (this.form.name.length <= 5) {
                if (!this.seEncuentraMsg(this.messagesName, 1)) {
                    this.messagesName.push(this.msgsErrorForm[0]);
                }
                if (!this.seEncuentraMsg(this.messagesName, 2)) {
                    this.messagesName.push({
                        id: 2,
                        message: "El campo debe ser mayor a 9 caracteres",
                    });
                }
                this.nameIsCorrect = false;
                this.isValidateName = true;
                return;
            }
            this.isValidateName = true;
            this.nameIsCorrect = true;
            this.messagesName = [];
        },
        async nickCorrect() {
            //evaluando campo vacio y longitud
            if (this.form.nick.length >= 5) {
                //evaluando existencia del nick
                if ((await this.existeNick()) > 0) {
                    console.log("el nick ya esta usado");
                    if (!this.seEncuentraMsg(this.messagesNick, 3)) {
                        this.messagesNick.push({
                            id: 3,
                            message: "El nick ya esta siendo usado",
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
        async emailCorrect() {
            //evaluando campo vacio y longitud
            if (this.form.email.length >= 5) {
                //evaluando existencia del nick
                if ((await this.existeEmail()) > 0) {
                    console.log("el email ya esta usado");
                    if (!this.seEncuentraMsg(this.messagesEmail, 3)) {
                        this.messagesEmail.push({
                            id: 3,
                            message: "El email ya esta siendo usado",
                        });
                    }
                    this.emailIsCorrect = false;
                    this.isValidateEmail = true;
                } else {
                    this.isValidateEmail = true;
                    this.emailIsCorrect = true;
                    this.eleminarMsg(this.messagesEmail, 3);
                }
            } else {
                if (!this.seEncuentraMsg(this.messagesEmail, 1)) {
                    this.messagesEmail.push(this.msgsErrorForm[0]);
                }
                if (!this.seEncuentraMsg(this.messagesEmail, 2)) {
                    this.messagesEmail.push({
                        id: 2,
                        message: "El campo debe ser mayor a 5 caracteres",
                    });
                }
                this.emailIsCorrect = false;
                this.isValidateEmail = true;
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
        passwordRepeatCorrect() {
            if (this.form.password === this.form.password_confirmation) {
                this.passwordRepeatIsCorrect = true;
                this.isValidatePasswordRepeat = true;
                this.eleminarMsg(this.messagesPasswordRepeat, 1);
                this.eleminarMsg(this.messagesPasswordRepeat, 2);
            } else {
                if (!this.seEncuentraMsg(this.messagesPasswordRepeat, 1)) {
                    this.messagesPasswordRepeat.push(this.msgsErrorForm[0]);
                }
                if (!this.seEncuentraMsg(this.messagesPasswordRepeat, 2)) {
                    this.messagesPasswordRepeat.push({
                        id: 2,
                        message: "Este campo debe ser igual al de arriba",
                    });
                }
                this.passwordRepeatIsCorrect = false;
                this.isValidatePasswordRepeat = true;
            }
        },
        async existeNick() {
            var existe = await axios
                .post("/api/existenick", {
                    nick: this.form.nick,
                })
                .then((response) => {
                    console.log(response.data["cantidad"]);
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
            var existe = await axios
                .post("/api/existeemail", {
                    email: this.form.email,
                })
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
    mounted() {
        console.log(this.user);
    },
};
</script>

<style>
.check {
    border-color: #0acf97 !important;
}

.uncheck {
    border-color: #96374a !important;
}
</style>

<template>
    <div>
        <div class="alert alert-danger p-1 mt-2" role="alert" v-if="hasErrors">
            <div>Whoops! Algo salio mal.</div>

            <ul class="p-1">
                <li v-for="(error, key) in errors" :key="key">
                    {{ key }} : {{ error }}
                </li>
            </ul>
        </div>
        <form action="#" method="POST" @submit.prevent="register">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="name">Nombre Completo</label>
                        <div class="input-group">
                            <span
                                v-if="isValidateName && nameIsCorrect"
                                class="input-group-text bg-success text-white"
                            >
                                <i class="mdi mdi-account-box"></i>
                            </span>
                            <span
                                v-if="isValidateName && !nameIsCorrect"
                                class="input-group-text bg-danger text-white"
                            >
                                <i class="mdi mdi-account-box"></i>
                            </span>
                            <input
                                id="name"
                                name="name"
                                v-model="form.name"
                                @change="nameCorrect"
                                class="form-control"
                                v-bind:class="[
                                    isValidateName && nameIsCorrect
                                        ? 'check'
                                        : '',
                                    isValidateName && !nameIsCorrect
                                        ? 'uncheck'
                                        : '',
                                ]"
                                type="text"
                                required
                                autofocus
                                placeholder="Nombre y Apellido"
                            />
                        </div>
                        <div
                            v-if="!nameIsCorrect"
                            class="alert alert-danger p-1 mt-2"
                            role="alert"
                        >
                            <div v-for="msg in messagesName" :key="msg.id">
                                {{ msg.message }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="nick">Usuario (Nick)</label>
                        <div class="input-group">
                            <span
                                v-if="isValidateNick && nickIsCorrect"
                                class="input-group-text bg-success text-white"
                            >
                                <i class="mdi mdi-account-check-outline"></i>
                            </span>
                            <span
                                v-if="isValidateNick && !nickIsCorrect"
                                class="input-group-text bg-danger text-white"
                            >
                                <i class="mdi mdi-account-alert-outline"></i>
                            </span>
                            <input
                                id="nick"
                                name="nick"
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
                        </div>
                        <div
                            v-if="!nickIsCorrect"
                            class="alert alert-danger p-1 mt-2"
                            role="alert"
                        >
                            <div v-for="msg in messagesNick" :key="msg.id">
                                {{ msg.message }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 mt-2">
                <div class="form-group">
                    <label>Email</label>
                    <div class="input-group">
                        <span
                            v-if="isValidateEmail && emailIsCorrect"
                            class="input-group-text bg-success text-white"
                        >
                            <i class="mdi mdi-email-check-outline"></i>
                        </span>
                        <span
                            v-if="isValidateEmail && !emailIsCorrect"
                            class="input-group-text bg-danger text-white"
                        >
                            <i class="mdi mdi-email-alert-outline"></i>
                        </span>
                        <input
                            id="email"
                            name="email"
                            v-model="form.email"
                            @change="emailCorrect"
                            v-bind:class="[
                                isValidateEmail && emailIsCorrect
                                    ? 'check'
                                    : '',
                                isValidateEmail && !emailIsCorrect
                                    ? 'uncheck'
                                    : '',
                            ]"
                            class="form-control"
                            type="email"
                            required
                            placeholder="test@gmail.com"
                        />
                    </div>
                    <div
                        v-if="!emailIsCorrect"
                        class="alert alert-danger p-1 mt-2"
                        role="alert"
                    >
                        <div v-for="msg in messagesEmail" :key="msg.id">
                            {{ msg.message }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <span
                            v-if="isValidatePassword && passwordIsCorrect"
                            class="input-group-text bg-success text-white"
                        >
                            <i class="mdi mdi-account-key-outline"></i>
                        </span>
                        <span
                            v-if="isValidatePassword && !passwordIsCorrect"
                            class="input-group-text bg-danger text-white"
                        >
                            <svg
                                style="width: 24px; height: 24px; color: white"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    fill="currentColor"
                                    d="M16 22H12V24H6V13.32C3.58 12.17 2 9.72 2 7C2 3.14 5.14 0 9 0C12.86 0 16 3.14 16 7C16 9.72 14.42 12.18 12 13.32V16H16V22M14 18H10V11.94L10.67 11.71C12.66 11 14 9.11 14 7C14 4.24 11.76 2 9 2S4 4.24 4 7C4 9.11 5.34 11 7.33 11.71L8 11.94V22H10V20H14V18M12 7C12 8.66 10.66 10 9 10S6 8.66 6 7 7.34 4 9 4 12 5.34 12 7M9 8C9.55 8 10 7.55 10 7S9.55 6 9 6 8 6.45 8 7 8.45 8 9 8M20 7H22V13H20M20 17H22V15H20"
                                />
                            </svg>
                        </span>
                        <input
                            id="password"
                            v-model="form.password"
                            @change="passwordCorrect"
                            class="form-control"
                            v-bind:class="[
                                isValidatePassword && passwordIsCorrect
                                    ? 'check'
                                    : '',
                                isValidatePassword && !passwordIsCorrect
                                    ? 'uncheck'
                                    : '',
                            ]"
                            :type="inputTypePassword ? 'password' : 'text'"
                            name="password"
                            required
                        />
                        <button
                            class="input-group-text bg-info text-white"
                            type="button"
                            @click="changeTypePassword"
                        >
                            <div v-if="inputTypePassword">
                                <i class="mdi mdi-eye-circle"></i>
                            </div>
                            <div v-else>
                                <i class="mdi mdi-eye-circle-outline"></i>
                            </div>
                        </button>
                    </div>
                    <div
                        v-if="!passwordIsCorrect"
                        class="alert alert-danger p-1 mt-2"
                        role="alert"
                    >
                        <div v-for="msg in messagesPassword" :key="msg.id">
                            {{ msg.message }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <label for="password_confirmation">Repetir Password</label>
                    <div class="input-group">
                        <span
                            v-if="
                                isValidatePasswordRepeat &&
                                passwordRepeatIsCorrect
                            "
                            class="input-group-text bg-success text-white"
                        >
                            <i class="mdi mdi-account-key-outline"></i>
                        </span>
                        <span
                            v-if="
                                isValidatePasswordRepeat &&
                                !passwordRepeatIsCorrect
                            "
                            class="input-group-text bg-danger text-white"
                        >
                            <svg
                                style="width: 24px; height: 24px; color: white"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    fill="currentColor"
                                    d="M16 22H12V24H6V13.32C3.58 12.17 2 9.72 2 7C2 3.14 5.14 0 9 0C12.86 0 16 3.14 16 7C16 9.72 14.42 12.18 12 13.32V16H16V22M14 18H10V11.94L10.67 11.71C12.66 11 14 9.11 14 7C14 4.24 11.76 2 9 2S4 4.24 4 7C4 9.11 5.34 11 7.33 11.71L8 11.94V22H10V20H14V18M12 7C12 8.66 10.66 10 9 10S6 8.66 6 7 7.34 4 9 4 12 5.34 12 7M9 8C9.55 8 10 7.55 10 7S9.55 6 9 6 8 6.45 8 7 8.45 8 9 8M20 7H22V13H20M20 17H22V15H20"
                                />
                            </svg>
                        </span>
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            v-model="form.password_confirmation"
                            v-bind:class="[
                                isValidatePasswordRepeat &&
                                passwordRepeatIsCorrect
                                    ? 'check'
                                    : '',
                                isValidatePasswordRepeat &&
                                !passwordRepeatIsCorrect
                                    ? 'uncheck'
                                    : '',
                            ]"
                            @change="passwordRepeatCorrect"
                            class="form-control"
                            :type="
                                inputTypePasswordRepeat ? 'password' : 'text'
                            "
                            required
                        />
                        <button
                            class="input-group-text bg-info text-white"
                            type="button"
                            @click="changeTypePasswordRepeat"
                        >
                            <div v-if="inputTypePasswordRepeat">
                                <i class="mdi mdi-eye-circle"></i>
                            </div>
                            <div v-else>
                                <i class="mdi mdi-eye-circle-outline"></i>
                            </div>
                        </button>
                    </div>
                    <div
                        v-if="!passwordRepeatIsCorrect"
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
            </div>
            <div class="d-grid mb-3 text-center">
                <button
                    v-if="isRegister"
                    class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded"
                    type="submit"
                >
                    <i class="mdi mdi-account-circle"></i>
                    Registrarse
                </button>
                <button
                    v-if="isEdit"
                    class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded"
                    type="submit"
                >
                    <i class="mdi mdi-account-circle"></i>
                    Editar
                </button>
            </div>
        </form>
    </div>
</template>
