<script setup>
import {onMounted} from "vue";
import globalView from "@/Globales/globalView";
const cargarTable = () => globalView.createtable("#tables");
onMounted(() => {
    cargarTable();
});
</script>
<template>
    <div id="buttons-table-preview">
        <table class="table dt-responsive nowrap w-100" id="tables">
            <slot/>
        </table>
    </div>
</template>
