<script setup>
import {ref, computed, watch, onMounted} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import InputGralVue from "@/Components/InputGral.vue";
import ControlGroup from "@/Components/ControlGroup.vue";
import global from "@/Globales/global.vue";

let props = defineProps({
    isRegister: {type: Boolean},
    isEdit: {type: Boolean},
    isPageRegister: {type: Boolean},
    userData: {type: Object},
});

let name = ref("");
let nick = ref("");
let email = ref("");
let password = ref("");
let password_confirmation = ref("");

let form = useForm({
    name: "",
    nick: "",
    email: "",
    password: "",
    password_confirmation: "",
    terms: false,
});

let nameIsCorrect = ref(false);
let nickIsCorrect = ref(false);
let emailIsCorrect = ref(false);
let passwordIsCorrect = ref(false);
let passwordRepeatIsCorrect = ref(false);

let nameIsValidate = ref(false);
let nickIsValidate = ref(false);
let emailIsValidate = ref(false);
let passwordIsValidate = ref(false);
let passwordRepeatIsValidate = ref(false);

let iconName = ref("mdi mdi-account-check-outline");
let iconNick = ref("mdi mdi-account-circle-outline");
let iconEmail = ref("mdi mdi-at");
let iconPassword = ref("mdi mdi-account-key-outline");
let iconPasswordRepeat = ref("mdi mdi-account-key-outline");

let helpName = ref("");
let helpNick = ref("");
let helpEmail = ref("");
let helpPassword = ref("");
let helpPasswordRepeat = ref("");

//type password
let inputTypePassword = ref(true);
let icon = ref("mdi mdi-eye-outline");

let inputTypePasswordRepeat = ref(true);
let iconRepeat = ref("mdi mdi-eye-outline");

// observador nombre
watch(
    () => form.name,
    (newName) => {
        nameIsValidate.value = true;
        if (newName.length >= 6) {
            iconName.value = 'mdi mdi-account-check-outline';
            helpName.value = '';
            nameIsCorrect.value = true;
        } else if(newName.length >= 1 && newName.length <= 5){
            iconName.value = 'mdi mdi-account-alert-outline';
            helpName.value = 'Este Campo es requerido mas de 6 caracteres'
            nameIsCorrect.value = false;
        } else {
            nameIsCorrect.value = false;
            nameIsValidate.value = false;
            helpName.value = "";
            iconName.value = "mdi mdi-account-check-outline";
        }
    }
)
// observador nick
watch(
    () => form.nick,
    async (newNick) => {
        nickIsValidate.value = true;
        helpNick.value = "";
        if (newNick.length >= 6) {
            let response = await global.postQuery('api/existe/nick', {'query': newNick});
            if (response.status === 200) {
                let isExistente = response.data['cantidad'];
                if (isExistente > 0 && props.isRegister) { //formulario registro - existe nick
                    iconNick.value = 'mdi mdi-account-cancel-outline';
                    helpNick.value = `${newNick} esta siendo utilizado`;
                    nickIsCorrect.value = false;
                } else if (isExistente > 0 && props.isEdit) { //formulario edit - existe nick
                    nickIsCorrect.value = newNick === props.userData.nick;
                    helpNick.value = newNick === props.userData.nick ? `${newNick} lo estas utilizando` : `${newNick} se encuentra registrado`;
                    iconNick.value = 'mdi mdi-account-alert-outline';
                } else { // evaluar el tipo de formulario - nick no existe
                    iconNick.value = 'mdi mdi-account-circle-outline';
                    helpNick.value = `${newNick} puede ser utilizado`;
                    nickIsCorrect.value = true;
                }
            } else {
                global.messageNotify(`Error : ${response.status}`, `Error: ${response.statusText} - ${newNick}`, 'error');
                iconNick.value = 'mdi mdi-account-cancel-outline';
                helpNick.value = 'Error de Network';
                nickIsCorrect.value = false;
            }
        } else if(newNick.length >= 1 && newNick.length <= 5 ){
            iconNick.value = 'mdi mdi-account-cancel-outline';
            helpNick.value = 'Este campo es requerido mas de 6 caracteres';
            nickIsCorrect.value = false;
        } else{
            iconNick.value = 'mdi mdi-account-circle-outline';
            helpNick.value = '';
            nickIsCorrect.value = false;
            nickIsValidate.value = false;
        }
    }
)
//observador email
watch(
    () => form.email,
    async (newEmail) => {
        emailIsValidate.value = true;
        helpEmail.value = "";
        if (newEmail.length >= 6) {
            let response = await global.postQuery('api/existe/email', {'query': newEmail});
            if (response.status === 200) {
                let isExistente = response.data['cantidad'];
                if (isExistente > 0 && props.isRegister) {
                    iconEmail.value = 'mdi mdi-email-alert-outline';
                    helpEmail.value = `${newEmail} ya se encuentra registrado`;
                    emailIsCorrect.value = false;
                } else if(isExistente > 0 && props.isEdit){
                    emailIsCorrect.value = newEmail === props.userData.email;
                    helpEmail.value = newEmail === props.userData.email ? `${newEmail} lo estas utilizando` : `${newEmail} se encuentra registrado`;
                    iconEmail.value = 'mdi mdi-email-alert-outline';
                } else {
                    iconEmail.value = 'mdi mdi-at';
                    helpEmail.value = `${newEmail} puede ser utilizado`;
                    emailIsCorrect.value = true;
                }
            } else {
                global.messageNotify(`Error : ${response.status}`, `Error: ${response.statusText} - ${newEmail}`, 'error');
                helpEmail.value = 'Error de Network';
                iconEmail.value = 'mdi mdi-email-alert-outline';
                emailIsCorrect.value = false;
            }
        } else if(newEmail.length >= 1 && newEmail.length <=5){
            iconEmail.value = 'mdi mdi-email-alert-outline';
            helpEmail.value = "Este campo require mas de 6 caracteres";
            emailIsCorrect.value = false;
        } else {
            iconEmail.value = 'mdi mdi-at';
            helpEmail.value = "";
            emailIsCorrect.value = false;
            emailIsValidate.value = false;
        }
    }
)

watch(
    () => form.password,
    (newPassword) => {
        passwordIsValidate.value = true;
        if (newPassword.length >= 6) {
            helpPassword.value = "";
            iconPassword.value = "mdi mdi-account-key-outline";
            passwordIsCorrect.value = true;
        } else if(newPassword.length >= 1 && newPassword.length <=5){
            helpPassword.value = "Este campo debe ser mayor a 6 caracteres";
            iconPassword.value = "mdi mdi-account-key";
            passwordIsCorrect.value = false;
        } else {
            helpPassword.value = "";
            iconPassword.value = "mdi mdi-account-key";
            passwordIsCorrect.value = false;
            passwordIsValidate.value = false;
        }
    }
)

watch(
    () => form.password_confirmation,
    (newPasswordRepeat) => {
        passwordRepeatIsValidate.value = true;
        if (newPasswordRepeat.length >= 6) {
            if (newPasswordRepeat === form.password) {
                iconPasswordRepeat.value = 'mdi mdi-account-key-outline';
                helpPasswordRepeat.value = '';
                passwordRepeatIsCorrect.value = true;
            } else {
                iconPasswordRepeat.value = 'mdi mdi-account-key';
                helpPasswordRepeat.value = `Este campo no coincide con el campo anterior`;
                passwordRepeatIsCorrect.value = false;
            }
        } else if(newPasswordRepeat.length >= 1 && newPasswordRepeat.length <= 5){
            iconPasswordRepeat.value = 'mdi mdi-account-key';
            helpPasswordRepeat.value = 'Este campo requiere mas de 6 caracteres';
            passwordRepeatIsCorrect.value = false;
        }else{
            iconPasswordRepeat.value = 'mdi mdi-account-key-outline';
            helpPasswordRepeat.value = '';
            passwordRepeatIsCorrect.value = false;
            passwordRepeatIsValidate.value = false;
        }
    }
)

const clean = () => {
    nameIsCorrect.value = false;
    nickIsCorrect.value = false;
    emailIsCorrect.value = false;
    passwordIsCorrect.value = false;
    passwordRepeatIsCorrect.value = false;

    nameIsValidate.value = false;
    nickIsValidate.value = false;
    emailIsValidate.value = false;
    passwordIsValidate.value = false;
    passwordRepeatIsValidate.value = false;

    helpName.value = "";
    helpNick.value = "";
    helpEmail.value = "";
    helpPassword.value = "";
    helpPasswordRepeat.value = "";
}
const submit = async () => {
    if(props.isPageRegister){
        form.post(route('register'), {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
    }else{
        if(props.isRegister){
            form.post(route('user.store'), {
                onSuccess : (e) => {
                    form.reset();
                    clean();
                    global.messageNotify('Success', 'Registro completo', 'success');
                },
                onError : (e) =>{
                    console.log("onError:",e);
                    global.messageNotify('Error', 'Sucedio algun error al registrar', 'success');
                }
            });
        }else{
            // let response = await global.postQuery(route());
            form.put(route('user.update', props.userData.id), {
                onSuccess : (e) => {
                    console.log("Success:",e);
                    global.messageNotify('Success', 'Registro completo', 'success');
                },
                onError : (e) =>{
                    console.log("onError:",e);
                    global.messageNotify('Error', 'Sucedio algun error al registrar', 'success');
                },
            });
        }
    }

};

let accion = computed(function () {
    form.reset();
    clean();
    if (props.isEdit) {
        form.name = props.userData.name;
        form.nick = props.userData.nick;
        form.email = props.userData.email;
    }
    return props.isRegister
        ? "Registro de Usuario"
        : `Editar Usuario : ${props.userData.name}`;
});

const changeTypePassword = () => {
    inputTypePassword.value = !inputTypePassword.value;
    icon.value = inputTypePassword.value ? 'mdi mdi-eye-outline' : 'mdi mdi-eye-off-outline'
};

const changeTypePasswordRepeat = () => {
    inputTypePasswordRepeat.value = !inputTypePasswordRepeat.value;
    iconRepeat.value = inputTypePasswordRepeat.value ? 'mdi mdi-eye-outline' : 'mdi mdi-eye-off-outline'
};

</script>
<template>
    <div>
        <form @submit.prevent="submit">
            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                {{ form.progress.percentage }}%
            </progress>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <!--form name-->
                    <ControlGroup
                        class="mb-3"
                        :isCorrect="nameIsCorrect"
                        :isValidate="nameIsValidate"
                        :label="'Nombre Completo'"
                        :icon="iconName"
                        :help="form.errors.name ? form.errors.name : helpName"
                    >
                        <InputGralVue
                            ref="name"
                            name="name"
                            v-model="form.name"
                            :isCorrect="nameIsCorrect"
                            :isValidate="nameIsValidate"
                            required
                        />
                    </ControlGroup>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <!--form nick-->
                    <ControlGroup
                        class="mb-3"
                        :isCorrect="nickIsCorrect"
                        :isValidate="nickIsValidate"
                        :label="'Nick'"
                        :help="form.errors.nick ? form.errors.nick : helpNick"
                        :icon="iconNick"
                    >
                        <InputGralVue
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
                    <!--form email-->
                    <ControlGroup
                        class="mb-3"
                        :isCorrect="emailIsCorrect"
                        :isValidate="emailIsValidate"
                        :label="'Email'"
                        :icon="iconEmail"
                        :help="form.errors.email ? form.errors.email : helpEmail"
                    >
                        <InputGralVue
                            ref="email"
                            name="email"
                            type="email"
                            v-model="form.email"
                            :isCorrect="emailIsCorrect"
                            :isValidate="emailIsValidate"
                            required
                        />
                    </ControlGroup>
                </div>
                <div v-show="props.isRegister">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <ControlGroup
                            class="mb-3"
                            :isCorrect="passwordIsCorrect"
                            :isValidate="passwordIsValidate"
                            :label="'Password'"
                            :icon="iconPassword"
                            :help="form.errors.password ? form.errors.password : helpPassword"
                        >
                            <InputGralVue
                                ref="password"
                                name="password"
                                :type="inputTypePassword ? 'password' : 'text'"
                                v-model="form.password"
                                :isCorrect="passwordIsCorrect"
                                :isValidate="passwordIsValidate"
                            />
                            <i v-bind:class="icon" @click="changeTypePassword" style="font-size: 25px !important;"></i>
                        </ControlGroup>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <ControlGroup
                            class="mb-3"
                            :isCorrect="passwordRepeatIsCorrect"
                            :isValidate="passwordRepeatIsValidate"
                            :label="'Repetir Password'"
                            :icon="iconPasswordRepeat"
                            :help="form.errors.password_confirmation ? form.errors.password_confirmation : helpPasswordRepeat"
                        >
                            <InputGralVue
                                ref="passwordRepeat"
                                name="passwordRepeat"
                                :type="inputTypePasswordRepeat ? 'password' : 'text'"
                                v-model="form.password_confirmation"
                                :isCorrect="passwordRepeatIsCorrect"
                                :isValidate="passwordRepeatIsValidate"
                            />
                            <i v-bind:class="iconRepeat" @click="changeTypePasswordRepeat"
                               style="font-size: 25px !important;"></i>
                        </ControlGroup>
                    </div>
                </div>
            </div>
            <div class="d-grid mb-3 text-center">
                <button
                    class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded"
                    type="submit"
                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                >
                    <i class="mdi mdi-account-circle"></i>
                    {{ accion }}
                </button>
            </div>
        </form>
    </div>
</template>
