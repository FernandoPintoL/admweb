<script>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";

export default {
  components: {
    Head,
    useForm,
    JetCheckbox,
    JetLabel,
    JetInput,
    JetButton,
    JetValidationErrors,
  },
  props: ["canResetPassword", "status"],
  data() {
    return {
      form: {
        nick: "",
        password: "",
        remember: "",
      },
      userLogin: {},
      hasErrors: false,
      errors: [],
      recuerdame: false,
      inputTypePassword: true,
      isValidateNick: false,
      isValidatePassword: false,
      nickIsCorrect: true,
      passwordIsCorrect: true,
      messagesNick: [],
      messagesPassword: [],
    };
  },
  mounted(e) {
    // console.log(e);
    // var loader = window.document.getElementsByClassName("loader-wrapper");
    // console.log(loader);
    /* window.$(".loader-wrapper").fadeOut("slow", function (e) {
      $(this).remove();
    }); */
  },
  methods: {
    async login() {
      if (this.nickIsCorrect && this.passwordIsCorrect) {
        this.form.remember = this.recuerdame ? "on" : "";
        this.form.nick = this.userLogin.nick;
        await axios
          .post(route("login"), this.form)
          .then((response) => {
            console.log(response.data);
            window.location = route("login");
          })
          .catch((error) => {
            if (error.response) {
              this.hasErrors = true;
              console.log(error.response.data.errors);
              this.errors = error.response.data.errors;
            }
          });
      }
    },
    changeTypePassword() {
      this.inputTypePassword = !this.inputTypePassword;
    },
    async nickCorrect() {
      //evaluando campo vacio y longitud
      if (this.form.nick.length >= 5) {
        //evaluando existencia del nick
        //if ((await this.existeNick()) == 0 || (await this.existeEmail()) == 0) {
        if ((await this.existeNickEmail()) == null) {
          if (!this.seEncuentraMsg(this.messagesNick, 3)) {
            this.messagesNick.push({
              id: 3,
              message: "Este nick no se encuentran en nuestros registros",
            });
          }
          this.nickIsCorrect = false;
          this.isValidateNick = true;
        } else {
          this.isValidateNick = true;
          this.nickIsCorrect = true;
          this.eleminarMsg(this.messagesNick, 3);
        }
      } else {
        if (!this.seEncuentraMsg(this.messagesNick, 1)) {
          this.messagesNick.push(this.msgsErrorForm[0]);
        }
        if (!this.seEncuentraMsg(this.messagesNick, 2)) {
          this.messagesNick.push({
            id: 2,
            message: "El campo debe ser mayor a 5 caracteres",
          });
        }
        this.nickIsCorrect = false;
        this.isValidateNick = true;
      }
    },
    passwordCorrect() {
      //evaluando campo vacio y longitud
      if (this.form.password.length >= 8) {
        this.passwordIsCorrect = true;
        this.isValidatePassword = true;
        this.eleminarMsg(this.messagesPassword, 1);
        this.eleminarMsg(this.messagesPassword, 2);
      } else {
        if (!this.seEncuentraMsg(this.messagesPassword, 1)) {
          this.messagesPassword.push(this.msgsErrorForm[0]);
        }
        if (!this.seEncuentraMsg(this.messagesPassword, 2)) {
          this.messagesPassword.push({
            id: 2,
            message: "El campo debe ser mayor a 8 caracteres",
          });
        }
        this.passwordIsCorrect = false;
        this.isValidatePassword = true;
      }
    },
    async existeNickEmail() {
      var existe = await axios
        .post("/api/getuser", { query: this.form.nick })
        .then((response) => {
          //return response.data["cantidad"];
          console.log(response.data["user"]);
          existe = response.data["user"];
          if (existe != null) {
            this.userLogin = response.data["user"];
          } else {
            this.userLogin = {};
          }
          return existe;
        })
        .catch((error) => {
          if (error.response) {
            this.hasErrors = true;
            console.log(error.response.data.errors);
            this.errors = error.response.data.errors;
          }
        });
      return existe;
    },
    async existeNick() {
      var existe = await axios
        .post("/api/existenick", { nick: this.form.nick })
        .then((response) => {
          //return response.data["cantidad"];
          existe = response.data["cantidad"];
          return existe;
        })
        .catch((error) => {
          if (error.response) {
            this.hasErrors = true;
            console.log(error.response.data.errors);
            this.errors = error.response.data.errors;
          }
        });
      return existe;
    },

    async existeEmail() {
      console.log("entrando");
      var existe = await axios
        .post("/api/existeemail", { email: this.form.nick })
        .then((response) => {
          console.log(response.data["cantidad"]);
          existe = response.data["cantidad"];
          return existe;
        })
        .catch((error) => {
          if (error.response) {
            this.hasErrors = true;
            console.log(error.response.data.errors);
            this.errors = error.response.data.errors;
          }
        });
      return existe;
    },
    seEncuentraMsg(array, id) {
      var result = array.some((element, index) => {
        return element.id == id;
      });
      return result;
    },
    eleminarMsg(array, id) {
      var result = array.filter((element, index) => {
        return element.id !== id;
      });
      return result;
    },
  },
};

// defineProps({
//   canResetPassword: Boolean,
//   status: String,
// });

// const form = useForm({
//   email: "",
//   password: "",
//   remember: false,
// });

// const submit = () => {
//   form
//     .transform((data) => ({
//       ...data,
//       remember: form.remember ? "on" : "",
//     }))
//     .post(route("login"), {
//       onFinish: () => form.reset("password"),
//     });
// };
</script>
<style>
.check {
  border-color: green !important;
}
.uncheck {
  border-color: red !important;
}
</style>
<template>
  <Head title="Acceder" />
  <section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-5">
          <img
            class="bg-img-cover bg-center"
            src="assets/images/login/3.jpg"
            alt="looginpage"
            style="width: 100%; height: 100%"
          />
        </div>

        <div class="col-xl-7 p-0">
          <div class="login-card">
            <form class="theme-form login-form" method="POST" @submit.prevent="login">
              <h4>Acceder</h4>
              <h6>¡Bienvenido de nuevo! Ingrese a su cuenta.</h6>
              <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
              </div>
              <div class="alert alert-danger p-1 mt-2" role="alert" v-if="hasErrors">
                <div>Whoops! Algo salio mal.</div>

                <ul class="p-1">
                  <li v-for="(error, key) in errors" :key="key">
                    {{ key }} : {{ error }}
                  </li>
                </ul>
              </div>
              <div class="form-group">
                <label>User (Nick)</label>
                <div class="input-group">
                  <div class="input-group-text">
                    <div class="icon">
                      <i class="fa-duotone fa-hashtag"></i>
                    </div>
                  </div>
                  <input
                    v-model="form.nick"
                    @change="nickCorrect"
                    v-bind:class="[
                      isValidateNick && nickIsCorrect ? 'check' : '',
                      isValidateNick && !nickIsCorrect ? 'uncheck' : '',
                    ]"
                    class="form-control"
                    type="text"
                    required
                  />
                  <span v-if="isValidateNick && nickIsCorrect" class="input-group-text">
                    <i class="fa-solid fa-check"></i>
                  </span>
                  <span v-if="isValidateNick && !nickIsCorrect" class="input-group-text">
                    <i class="fa-solid fa-circle-info"></i>
                  </span>
                </div>
                <div
                  v-if="!nickIsCorrect"
                  class="alert alert-danger p-1 mt-2"
                  role="alert"
                >
                  <div v-for="msg in messagesNick" :key="msg.id">{{ msg.message }}</div>
                </div>
              </div>
              <div class="form-group">
                <label>Password</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <div class="icon">
                      <i class="icofont-lock"></i>
                    </div>
                  </span>
                  <input
                    v-model="form.password"
                    @change="passwordCorrect"
                    v-bind:class="[
                      isValidatePassword && passwordIsCorrect ? 'check' : '',
                      isValidatePassword && !passwordIsCorrect ? 'uncheck' : '',
                    ]"
                    :type="inputTypePassword ? 'password' : 'text'"
                    class="form-control"
                    name="password"
                    required
                  />
                  <button
                    class="input-group-text"
                    type="button"
                    @click="changeTypePassword"
                  >
                    <div v-if="inputTypePassword">
                      <i class="fa-solid fa-eye"></i>
                    </div>
                    <div v-else>
                      <i class="fa-solid fa-eye-low-vision"></i>
                    </div>
                  </button>
                  <span
                    v-if="isValidatePassword && passwordIsCorrect"
                    class="input-group-text"
                  >
                    <i class="fa-solid fa-check"></i>
                  </span>
                  <span
                    v-if="isValidatePassword && !passwordIsCorrect"
                    class="input-group-text"
                  >
                    <i class="fa-solid fa-circle-info"></i>
                  </span>
                </div>
                <div
                  v-if="!passwordIsCorrect"
                  class="alert alert-danger p-1 mt-2"
                  role="alert"
                >
                  <div v-for="msg in messagesPasswordRepeat" :key="msg.id">
                    {{ msg.message }}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="checkbox">
                  <JetCheckbox
                    id="remember"
                    v-model:checked="recuerdame"
                    name="remember"
                  />
                  <label class="text-muted" for="remember">Recuerda tu password</label>
                </div>
                <a class="link" :href="route('password.request')"
                  >Olvidaste tu password?</a
                >
              </div>
              <div class="form-group">
                <button
                  class="btn btn-primary btn-block"
                  type="submit"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                >
                  Acceder
                </button>
              </div>
              <!-- <div class="login-social-title">
                <h5>Sign in with</h5>
              </div> -->
              <!-- <div class="form-group">
                <ul class="login-social">
                  <li>
                    <a href="../../login.html" target="_blank">
                      <i data-feather="circle"></i>
                    </a>
                  </li>
                  <li>
                    <a href="../../login.html" target="_blank"
                      ><i data-feather="twitter"></i
                    ></a>
                  </li>
                  <li>
                    <a href="../../login.html" target="_blank"
                      ><i data-feather="facebook"></i
                    ></a>
                  </li>
                  <li>
                    <a href="https://www.instagram.com/login" target="_blank"
                      ><i data-feather="instagram"> </i
                    ></a>
                  </li>
                </ul>
              </div> -->
              <p>
                No tienes una cuenta?<a class="ms-2" :href="route('register')"
                  >Crea tu cuenta</a
                >
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- page-wrapper end-->
  <!-- <JetAuthenticationCard>
    <JetValidationErrors class="mb-4" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>
    <form @submit.prevent="submit">
      <div>
        <JetLabel for="email" value="Email" />
        <JetInput
          id="email"
          v-model="form.email"
          type="email"
          class="mt-1 block w-full"
          required
          autofocus
        />
      </div>

      <div class="mt-4">
        <JetLabel for="password" value="Password" />
        <JetInput
          id="password"
          v-model="form.password"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="current-password"
        />
      </div>

      <div class="block mt-4">
        <label class="flex items-center">
          <JetCheckbox v-model:checked="form.remember" name="remember" />
          <span class="ml-2 text-sm text-gray-600">Remember me</span>
        </label>
      </div>

      <div class="flex items-center justify-end mt-4">
        <Link
          v-if="canResetPassword"
          :href="route('password.request')"
          class="underline text-sm text-gray-600 hover:text-gray-900"
        >
          Forgot your password?
        </Link>

        <JetButton
          class="ml-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Acceder
        </JetButton>
      </div>
    </form>
  </JetAuthenticationCard> -->
</template>
