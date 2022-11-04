<script>
import { ref, computed, watch } from "vue";
import global from "@/Globales/global.vue";
export default {
    props: {
        modelValue: {
            type: String,
        },
        label: {
            type: String,
        },
    },
    components: {
        ref,
        computed,
        watch,
        global,
    },
    data() {
        return {
            input: ref(null),
            isPassword: true,
            isCorrect: false,
            isValidate: false,
        };
    },
    watch: {
        modelValue(newInput) {
            if (newInput.length >= 8) {
                this.isCorrect = true;
                this.isValidate = true;
            } else {
                this.isValidate = true;
                this.isCorrect = false;
            }
        },
    },
    methods: {
        change() {
            this.isPassword = !this.isPassword;
        },
    },
};
</script>
<template>
    <div
        v-bind:class="[
            isCorrect && isValidate ? 'text-success check' : '',
            !isCorrect && isValidate ? 'text-danger uncheck' : '',
        ]"
        class="form-group form-control mb-3 border-gray focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
    >
        <span
            v-bind:class="[
                isCorrect && isValidate ? 'text-success check' : '',
                !isCorrect && isValidate ? 'text-danger uncheck' : '',
            ]"
            >{{ label }}</span
        >
        <div
            v-bind:class="[
                isCorrect && isValidate ? 'text-success check' : '',
                !isCorrect && isValidate ? 'text-danger uncheck' : '',
            ]"
            class="input-group"
        >
            <div class="text-center">
                <i
                    v-if="isPassword"
                    class="mdi mdi-eye"
                    @click="change"
                    style="font-size: 25px !important"
                ></i>
                <i
                    v-else
                    class="mdi mdi-eye-circle-outline"
                    @click="change"
                    style="font-size: 25px !important"
                ></i>
            </div>
            <input
                ref="input"
                :value="modelValue"
                :type="isPassword ? 'password' : 'text'"
                @input="$emit('update:modelValue', $event.target.value)"
                style="border: none"
                class="form-control"
                v-bind:class="[
                    isCorrect && isValidate ? 'text-success check' : '',
                    !isCorrect && isValidate ? 'text-danger uncheck' : '',
                ]"
            />
        </div>
    </div>
</template>
