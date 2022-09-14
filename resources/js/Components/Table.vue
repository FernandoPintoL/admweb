<script>
import { ref } from "vue";
import globalView from "@/Globales/globalView.vue";
export default {
    name: "Table",
    props: ["list"],
    components: {
        ref,
        globalView,
    },
    mounted() {},
    beforeCreate() {},
};
</script>
<template>
    <div id="buttons-table-preview">
        <table class="table dt-responsive nowrap w-100" id="tables">
            <thead class="table-light">
                <tr>
                    <th v-for="(value, index) in list[0]" :key="value">
                        {{ index.toUpperCase() }}
                    </th>
                    <th style="width: 85px">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="value in list" :key="value.id">
                    <td v-for="(val, index, key) in value" :key="key">
                        <p v-if="index == 'profile_photo_url'">
                            <img
                                :src="val"
                                alt="contact-img"
                                title="contact-img"
                                class="rounded me-3"
                                height="48"
                            />
                        </p>
                        <p v-else>
                            {{ val }}
                        </p>
                    </td>
                    <td>Acciones</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
