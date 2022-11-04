<script setup>
defineProps({
    label: {
        type: String,
        default: "Label",
    },
    help: {
        type: String,
        default: "",
    },
    icon: {
        type: String,
        default: "mdi mdi-account-box",
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
</script>
<template>
    <div class="form-group form-control"
         :class="[isCorrect && isValidate ? 'text-success border-success' : '',
                  !isCorrect && isValidate ? 'text-danger border-danger' : '']"
    >
        <label>{{ label }}</label>
        <div class="input-group text-center">
            <i :class="icon" style="font-size: 25px !important;"></i>
            <slot/>
        </div>
        <small>{{ help }}</small>
    </div>
</template>
