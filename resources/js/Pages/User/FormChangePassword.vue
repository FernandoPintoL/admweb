<script>
import { ref, computed, watch } from "vue";
import global from "@/Globales/global.vue";
import InputPassword from "@/Components/InputPassword.vue";
export default {
    name: "FormChangePassword",
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
        watch,
        global,
        InputPassword,
    },
    data() {
        return {
            form: {
                passwordactual: "",
                passwordnew: "",
                passwordrepeat: "",
            },
            passwordActual: ref(null),
            passwordNew: ref(null),
            passwordRepeat: ref(null),
            passwordNew: "",
            passwordConfirmation: "",
            statusPasswordActual: "Digita tu contraseña actual",
            statusPasswordNew: "Digita tu nueva contraseña",
            statusPasswordConfirmacion: "Confirma tu nueva contraseña",
            inputTypePasswordActual: true,
            inputTypePasswordNew: true,
            inputTypePasswordRepetir: true,
            isValidatePasswordActual: false,
            isValidatePasswordNew: false,
            isValidatePasswordRepetir: false,
            passwordIsCorrectActual: true,
            passwordIsCorrectNew: true,
            passwordRepetirIsCorrect: true,
            messagesPasswordActual: [],
            messagesPasswordNew: [],
            messagesPasswordRepetir: [],
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
            hasErrors: false,
            habilitado: "check",
            deshabilitado: "uncheck",
        };
    },
    watch: {},
    methods: {
        mostrarValor() {
            console.log(this.form.passwordactual);
            console.log(this.form.passwordnew);
            console.log(this.form.passwordrepeat);
        },
    },
    computed: {
        accion() {
            return this.isRegister
                ? "Registro de Usuario"
                : `Editar Usuario : ${this.userData.id}`;
        },
    },
};
</script>
<template>
    <form action="#" method="POST" @submit.prevent="">
        <InputPassword
            ref="passwordActual"
            v-model="form.passwordactual"
            @change="mostrarValor"
            :label="'Password actual'"
        />
        <InputPassword
            ref="passwordNew"
            v-model="form.passwordnew"
            @change="mostrarValor"
            :label="'Nueva password'"
        />
        <InputPassword
            ref="passwordrepeat"
            v-model="form.passwordrepeat"
            @change="mostrarValor"
            :label="'Repita su password'"
        />

        <div class="d-grid mb-3 text-center">
            <button
                class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded"
                type="submit"
            >
                <i class="mdi mdi-account-circle"></i>
                {{ accion }}
            </button>
        </div>
    </form>
</template>

<!-- <div class="mb-3">
            <div class="form-group">
                <label for="passwordactual">Password</label>
                <div class="input-group">
                    <input
                        id="passwordactual"
                        v-model="passwordActual"
                        class="form-control"
                        v-bind:class="[
                            isValidatePasswordActual && passwordIsCorrectActual
                                ? 'check'
                                : '',
                            isValidatePasswordActual && !passwordIsCorrectActual
                                ? 'uncheck'
                                : '',
                        ]"
                        :type="inputTypePasswordActual ? 'password' : 'text'"
                        name="passwordactual"
                        required
                    />
                    <button
                        class="input-group-text bg-info text-white"
                        type="button"
                        @click="changeTypePasswordActual"
                    >
                        <div v-if="inputTypePasswordActual">
                            <i class="mdi mdi-eye-circle"></i>
                        </div>
                        <div v-else>
                            <i class="mdi mdi-eye-circle-outline"></i>
                        </div>
                    </button>
                </div>
                <span
                    v-bind:class="
                        passwordIsCorrectActual
                            ? 'text-success'
                            : 'text-primary'
                    "
                >
                    {{ statusPasswordActual }}
                </span>
                <div
                    v-if="!passwordIsCorrectActual"
                    class="alert alert-danger p-1 mt-2"
                    role="alert"
                >
                    <div v-for="msg in messagesPasswordActual" :key="msg.id">
                        {{ msg.message }}
                    </div>
                </div>
            </div>
        </div> -->
