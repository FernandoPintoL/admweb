<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
export default {
  components: { Head, Link },
  props: ["user"],
  data() {
    return {
      canLogin: false,
      canRegister: false,
    };
  },
};
// defineProps({
//     canLogin: Boolean,
//     canRegister: Boolean,
//     laravelVersion: String,
//     phpVersion: String,
// });
</script>

<template>
  <Head title="BIENVENIDO" />

  <div>
    <!--<div v-if="canLogin" class="">
            <Link v-if="$page.props.user" :href="route('dashboard')" class="">
                Dashboard
            </Link>

            <template v-else>
                <Link :href="route('login')" class="">
                    Log in
                </Link>

                <Link v-if="canRegister" :href="route('register')" class="">
                    Register
                </Link>
            </template>
        </div>-->
    HOLA AQUI ESTAMOS
  </div>
</template>
