<script setup>
import {computed, onMounted} from "vue";
import FormRegisterUpdate from "@/Pages/User/FormRegisterUpdate.vue";
import Offcanvas from "@/Components/Offcanvas.vue";
import FormChangePassword from "@/Pages/User/FormChangePassword.vue";
import FormProfile from "@/Pages/User/FormProfile.vue";

var props = defineProps({
  isRegister: {
    type: Boolean,
    default: false,
  },
  isEdit: {
    type: Boolean,
    default: false,
  },
  userData: {
    type: Object,
    default: {},
  },
  isView: {
    type: Boolean,
    default: false,
  },
});

let titulo = computed(() =>
    props.isRegister
        ? "Registro de Usuario"
        : `Editar Usuario : ${props.userData.id}`
);


onMounted(() => {

});

</script>
<template>
  <Offcanvas>
    <template #header>
      <h5 class="text-muted">{{ titulo }}</h5>
      <div v-if="props.isEdit" class="account-user-avatar">
        <img :src="props.userData.profile_photo_url" :alt="props.userData.name"
             class="img-fluid avatar-sm"/>
      </div>
      <span v-if="props.isEdit" class="text-muted">Nombre: {{ props.userData.name.toUpperCase() }}</span>
      <br v-if="props.isEdit">
      <span v-if="props.isEdit" class="text-muted">Nick: {{ props.userData.nick }}</span>
    </template>
    <template #body>
      <FormRegisterUpdate
          v-bind:isRegister="props.isRegister"
          v-bind:isEdit="props.isEdit"
          v-bind:isPageRegister="false"
          v-bind:userData="props.userData"
      />
    </template>
  </Offcanvas>
</template>
