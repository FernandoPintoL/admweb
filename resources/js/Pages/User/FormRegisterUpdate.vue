<script setup>
import {ref, computed, watch} from "vue";
import {useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";
import InputGralVue from "@/Components/InputGral.vue";
import InputPassword from "@/Components/InputPassword.vue";
import ControlGroup from "@/Components/ControlGroup.vue";
import InputError from "@/Jetstream/InputError.vue";
import global from "@/Globales/global.vue";

var props = defineProps({
    isRegister: {type: Boolean},
    isEdit: {type: Boolean},
    isPageRegister: {type: Boolean},
    userData: {type: Object},
});

const name = ref("");
const nick = ref("");
const email = ref("");
const password = ref("");
const password_confirmation = ref("");

var form = useForm({
    name: "",
    nick: "",
    email: "",
    password: "",
    password_confirmation: "",
    terms: false,
});

var nameIsCorrect = ref(false);
var nickIsCorrect = ref(false);
var emailIsCorrect = ref(false);
var passwordIsCorrect = ref(false);
var passwordRepeatIsCorrect = ref(false);

var nameIsValidate = ref(false);
var nickIsValidate = ref(false);
var emailIsValidate = ref(false);
var passwordIsValidate = ref(false);
var passwordRepeatIsValidate = ref(false);

watch(
    () => form.name,
    (newName) => {
        if (newName.length < 8) {
            nameIsCorrect.value = false;
            nameIsValidate.value = true;
        } else {
            nameIsCorrect.value = true;
            nameIsValidate.value = true;
        }
    }
);
watch(
    () => form.nick,
    (newNick) => {
        if (newNick.length < 6) {
            nickIsCorrect.value = false;
            nickIsValidate.value = true;
        } else {
            nickIsCorrect.value = true;
            nickIsValidate.value = true;
        }
    }
);
watch(
    () => form.email,
    (newEmail) => {
        if (newEmail.length < 6) {
            emailIsValidate.value = true;
            emailIsCorrect.value = false;
        } else {
            emailIsCorrect.value = true;
            emailIsValidate.value = true;
        }
    }
);

const submit = () => {
    form.post(route("user.store"));
};

var accion = computed(function () {
    form.reset();
    if (props.isEdit) {
        form.name = props.userData.name;
        form.nick = props.userData.nick;
        form.email = props.userData.email;
    }
    return props.isRegister
        ? "Registro de Usuario"
        : `Editar Usuario : ${props.userData.name}`;
});
</script>
<template>
    <div>
        <form @submit.prevent="submit">
            <div class="row">
                <div
                    class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <ControlGroup
                        class="mb-3"
                        :class="[
                            nameIsCorrect && nameIsValidate ? 'text-success border-success' : '',
                            !nameIsCorrect && nameIsValidate ? 'text-danger border-danger' : '',
                        ]"
                        :label="'Nombre Completo'"
                        :icon="nameIsCorrect && nameIsValidate ? 'mdi mdi-account-check-outline' : 'mdi mdi-account-alert-outline'"
                    >
                        <InputGralVue
                            id="nameinput"
                            ref="name"
                            name="name"
                            v-model="form.name"
                            :isCorrect="nameIsCorrect"
                            :isValidate="nameIsValidate"
                            required
                        />
                        <InputError class="mt-1" :message="form.errors.name"/>
                    </ControlGroup>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <ControlGroup
                        class="mb-3"
                        ref="nick"
                        :class="[
                           nickIsCorrect && nickIsValidate ? 'text-success border-success' : '',
                           !nickIsCorrect && nickIsValidate ? 'text-danger border-danger' : '',
                        ]"
                        :label="'Nick'"
                        :help="'Campo utilizado para iniciar session'"
                        :icon="nickIsCorrect && nickIsValidate ? 'mdi mdi-account-circle-outline' : 'mdi mdi-account-cancel-outline'"
                    >
                        <InputGralVue
                            id="nickinput"
                            name="nick"
                            v-model="form.nick"
                            :isCorrect="nickIsCorrect"
                            :isValidate="nickIsValidate"
                            required
                        />
                        <InputError class="mt-1" :message="form.errors.nick"/>
                    </ControlGroup>
                </div>
                <ControlGroup
                    class="mb-3"
                    :class="[
                           emailIsCorrect && emailIsValidate ? 'text-success border-success' : '',
                           !emailIsCorrect && emailIsValidate ? 'text-danger border-danger' : '',
                        ]"
                    :label="'Email'"
                    :help="'Campo utilizado para iniciar session'"
                    :icon="emailIsCorrect && emailIsValidate ? 'mdi mdi-email-check-outline' : 'mdi mdi-at'"
                >
                    <InputGralVue
                        id="emailinput"
                        ref="email"
                        name="email"
                        v-model="form.email"
                        :isCorrect="emailIsCorrect"
                        :isValidate="emailIsValidate"
                        required
                    />
                    <InputError class="mt-1" :message="form.errors.email"/>
                </ControlGroup>
                <!-- <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <InputGralVue
                        ref="nick"
                        v-model="form.nick"
                        v-bind:idt="isEdit ? userData.nick : ''"
                        :label="'Nick'"
                        :icon="'mdi mdi-shield-account'"
                        :isConsult="true"
                        :url="'/api/existenickoremail'"
                        v-bind:isEdit="isEdit"
                        required
                    />
                </div> -->
            </div>
            <!-- <InputGralVue
                ref="email"
                v-model="form.email"
                v-bind:idt="isEdit ? userData.email : ''"
                :type="'email'"
                :label="'Email'"
                :icon="'mdi mdi-email-variant'"
                :isConsult="true"
                :url="'/api/existenickoremail'"
                v-bind:isEdit="isEdit"
                required
            />
            <div v-if="isRegister" id="box-password">
                <InputPassword
                    ref="password"
                    v-model="form.password"
                    :label="'Nueva password'"
                    required
                />
                <InputPassword
                    ref="password_confirmation"
                    v-model="form.password_confirmation"
                    :label="'Repita su password'"
                    required
                />
            </div> -->
            <div class="d-grid mb-3 text-center">
                <button
                    :disabled="form.processing"
                    class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded"
                    type="submit"
                >
                    <i class="mdi mdi-account-circle"></i>
                    {{ accion }}
                </button>
            </div>
        </form>
    </div>
</template>
