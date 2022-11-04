<script setup>
import { ref, watch } from "vue";
var props = defineProps({
    modelValue: {
        type: String,
    },
    isCorrect: {
        type: Boolean,
        default: false,
    },
    isValidate: {
        type: Boolean,
        default: false,
    },
});
const input = ref("");
defineEmits(["update:modelValue"]);
/* watch(
    () => props.modelValue,
    (newModelValue) => {
        if (newModelValue.length < 8) {
            props.isCorrect = false;
            props.isValidate = true;
        } else {
            props.isCorrect = true;
            props.isValidate = true;
        }
    }
); */
</script>
<template>
    <input
        ref="input"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        class="form-control"
        :class="[
            props.isCorrect && props.isValidate ? 'text-success' : '',
            !props.isCorrect && props.isValidate ? 'text-danger' : '',
        ]"
        style="border: none !important"
    />
</template>
