<script>
import { ref, computed } from "vue";
import { Inertia } from "@inertiajs/inertia";
import globalView from "@/Globales/globalView.vue";
import global from "@/Globales/global.vue";
export default {
    name: "FormProfile",
    props: {
        isRegister: {
            type: Boolean,
        },
        isEdit: {
            type: Boolean,
        },
        userData: { type: Object },
    },
    components: {
        ref,
        computed,
        globalView,
        global,
    },
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
                if (this.isPageRegister) {
                    await axios
                        .post(route("register"), this.form)
                        .then((response) => {
                            console.log(response);
                            // window.location = route("login");
                            Inertia.get("/login");
                        })
                        .catch((error) => {
                            if (error.response) {
                                this.hasErrors = true;
                                console.log(error.response.data.errors);
                                this.errors = error.response.data.errors;
                            }
                        });
                } else {
                    global.postQuery("/api/usuario/register", this.form);
                    globalView.recargar(
                        "#laravel-tables",
                        "/api/users/datatables",
                        this.encabezados
                    );
                }
            }
        },
        todoIsCorrecto() {
            return (
                this.nameIsCorrect &&
                this.nickIsCorrect &&
                this.emailIsCorrect &&
                this.passwordIsCorrect &&
                this.passwordRepeatIsCorrect
            );
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
                console.log("formulario edit");
                console.log(this.formEdit);
                if ((await this.existeNick()) > 0) {
                    if (this.formEdit) {
                        console.log("iniciando edit");
                    }
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
                if (this.isRegister && (await this.existeEmail()) > 0) {
                    console.log("evaluando la existencia");
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
        async existeNick() {
            var existe = await axios
                .post("/api/existenick", {
                    nick: this.form.nick,
                })
                .then((response) => {
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
    },
    computed: {
        accion() {
            if (this.isEdit) {
                this.form.name = this.userData.name;
                this.form.nick = this.userData.nick;
                this.form.email = this.userData.email;
                this.form.password = this.userData.password;
                this.form.password_confirmation = this.form.password;
            } else {
                this.form.name = "";
                this.form.nick = "";
                this.form.email = "";
                this.form.password = "";
                this.form.password_confirmation = "";
                this.hasErrors = false;
                this.inputTypePassword = true;
                this.inputTypePasswordRepeat = true;
                this.isValidateName = false;
                this.isValidateNick = false;
                this.isValidateEmail = false;
                this.isValidatePassword = false;
                this.isValidatePasswordRepeat = false;
                this.nameIsCorrect = true;
                this.nickIsCorrect = true;
                this.emailIsCorrect = true;
                this.passwordIsCorrect = true;
                this.passwordRepeatIsCorrect = true;
                this.messagesName = [];
                this.messagesNick = [];
                this.messagesEmail = [];
                this.messagesPassword = [];
                this.messagesPasswordRepeat = [];
                this.msgsErrorForm = [
                    {
                        id: 1,
                        message: "El campo es requerido",
                    },
                    {
                        id: 2,
                        message: "El campo debe ser mayor a 8 caracteres",
                    },
                ];
            }
            return this.isRegister
                ? "Registro de Usuario"
                : `Editar Usuario : ${this.userData.id}`;
        },
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
    <form action="#" method="POST" @submit.prevent="">
        <!-- <div class="row">
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
                                isValidateName && nameIsCorrect ? 'check' : '',
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
                                isValidateNick && nickIsCorrect ? 'check' : '',
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
                            isValidateEmail && emailIsCorrect ? 'check' : '',
                            isValidateEmail && !emailIsCorrect ? 'uncheck' : '',
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
        <div class="d-grid mb-3 text-center">
            <button
                class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded"
                type="submit"
            >
                <i class="mdi mdi-account-circle"></i>
                {{ accion }}
            </button>
        </div> -->
    </form>
</template>
