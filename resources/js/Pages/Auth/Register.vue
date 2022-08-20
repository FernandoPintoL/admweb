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
  components: { Head, Link, JetValidationErrors },
  data() {
    return {
      form: {
        name: "",
        nick: "",
        email: "",
        password: "",
        password_confirmation: "",
        terms: false,
      },
      hasErrors: false,
      inputTypePassword: true,
      inputTypePasswordRepeat: true,
      isValidateName: false,
      isValidateNick: false,
      isValidateEmail: false,
      isValidatePassword: false,
      isValidatePasswordRepeat: false,
      nameIsCorrect: true,
      nickIsCorrect: true,
      emailIsCorrect: true,
      passwordIsCorrect: true,
      passwordRepeatIsCorrect: true,
      messagesName: [],
      messagesNick: [],
      messagesEmail: [],
      messagesPassword: [],
      messagesPasswordRepeat: [],
      msgsErrorForm: [
        {
          id: 1,
          message: "El campo es requerido",
        },
        {
          id: 2,
          message: "El campo debe ser mayor a 8 caracteres",
        },
      ],
      habilitado: "check",
      deshabilitado: "uncheck",
    };
  },
  mounted() {
    window.$(".loader-wrapper").fadeOut("slow", function (e) {
      $(this).remove();
    });
  },
  methods: {
    async register() {
      if (
        this.nameIsCorrect &&
        this.nickIsCorrect &&
        this.emailIsCorrect &&
        this.passwordIsCorrect &&
        this.passwordRepeatIsCorrect
      ) {
        await axios
          .post(route("register"), this.form)
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
    changeTypePasswordRepeat() {
      this.inputTypePasswordRepeat = !this.inputTypePasswordRepeat;
    },
    nameCorrect() {
      if (this.form.name.length <= 5) {
        if (!this.seEncuentraMsg(this.messagesName, 1)) {
          this.messagesName.push(this.msgsErrorForm[0]);
        }
        if (!this.seEncuentraMsg(this.messagesName, 2)) {
          this.messagesName.push({
            id: 2,
            message: "El campo debe ser mayor a 9 caracteres",
          });
        }
        this.nameIsCorrect = false;
        this.isValidateName = true;
        return;
      }
      this.isValidateName = true;
      this.nameIsCorrect = true;
      this.messagesName = [];
    },
    async nickCorrect() {
      //evaluando campo vacio y longitud
      if (this.form.nick.length >= 5) {
        //evaluando existencia del nick
        if ((await this.existeNick()) > 0) {
          console.log("el nick ya esta usado");
          if (!this.seEncuentraMsg(this.messagesNick, 3)) {
            this.messagesNick.push({
              id: 3,
              message: "El nick ya esta siendo usado",
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
    async emailCorrect() {
      //evaluando campo vacio y longitud
      if (this.form.email.length >= 5) {
        //evaluando existencia del nick
        if ((await this.existeEmail()) > 0) {
          console.log("el email ya esta usado");
          if (!this.seEncuentraMsg(this.messagesEmail, 3)) {
            this.messagesEmail.push({
              id: 3,
              message: "El email ya esta siendo usado",
            });
          }
          this.emailIsCorrect = false;
          this.isValidateEmail = true;
        } else {
          this.isValidateEmail = true;
          this.emailIsCorrect = true;
          this.eleminarMsg(this.messagesEmail, 3);
        }
      } else {
        if (!this.seEncuentraMsg(this.messagesEmail, 1)) {
          this.messagesEmail.push(this.msgsErrorForm[0]);
        }
        if (!this.seEncuentraMsg(this.messagesEmail, 2)) {
          this.messagesEmail.push({
            id: 2,
            message: "El campo debe ser mayor a 5 caracteres",
          });
        }
        this.emailIsCorrect = false;
        this.isValidateEmail = true;
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
    passwordRepeatCorrect() {
      if (this.form.password === this.form.password_confirmation) {
        this.passwordRepeatIsCorrect = true;
        this.isValidatePasswordRepeat = true;
        this.eleminarMsg(this.messagesPasswordRepeat, 1);
        this.eleminarMsg(this.messagesPasswordRepeat, 2);
      } else {
        if (!this.seEncuentraMsg(this.messagesPasswordRepeat, 1)) {
          this.messagesPasswordRepeat.push(this.msgsErrorForm[0]);
        }
        if (!this.seEncuentraMsg(this.messagesPasswordRepeat, 2)) {
          this.messagesPasswordRepeat.push({
            id: 2,
            message: "Este campo debe ser igual al de arriba",
          });
        }
        this.passwordRepeatIsCorrect = false;
        this.isValidatePasswordRepeat = true;
      }
    },
    async existeNick() {
      var existe = await axios
        .post("/api/existenick", { nick: this.form.nick })
        .then((response) => {
          console.log(response.data["cantidad"]);
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
      var existe = await axios
        .post("/api/existeemail", { email: this.form.email })
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

// const form = useForm({
//   name: "",
//   email: "",
//   password: "",
//   password_confirmation: "",
//   terms: false,
// });

// const submit = () => {
//   form.post(route("register"), {
//     onFinish: () => form.reset("password", "password_confirmation"),
//   });
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
  <Head title="Registrate" />
  <!-- Loader ends-->
  <!-- page-wrapper Start-->
  <section>
    <div class="container-fluid p-0">
      <div class="row m-0">
        <div class="col-xl-7 p-0" style="height: 90%">
          <img
            class="bg-img-cover bg-center"
            src="assets/images/login/1.jpg"
            alt="looginpage"
            style="width: 100%"
          />
        </div>
        <div class="col-xl-5 p-0" style="height: 90%">
          <div class="login-card" style="width: 100%; height: 90%">
            <form class="theme-form login-form" method="POST" @submit.prevent="register">
              <h4>Crea tu cuenta</h4>
              <h6>Ingresa detalles de tu informacion personal</h6>
              <div class="alert alert-danger p-1 mt-2" role="alert" v-if="hasErrors">
                <div>Whoops! Algo salio mal.</div>

                <ul class="p-1">
                  <li v-for="(error, key) in errors" :key="key">
                    {{ key }} : {{ error }}
                  </li>
                </ul>
              </div>
              <div class="form-group">
                <label>Nombre Completo</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <i class="fa-regular fa-circle-user"></i>
                  </span>
                  <input
                    id="name"
                    name="name"
                    v-model="form.name"
                    @change="nameCorrect"
                    class="form-control"
                    v-bind:class="[
                      isValidateName && nameIsCorrect ? 'check' : '',
                      isValidateName && !nameIsCorrect ? 'uncheck' : '',
                    ]"
                    type="text"
                    required
                    autofocus
                    placeholder="Nombre y Apellido"
                  />
                  <span v-if="isValidateName && nameIsCorrect" class="input-group-text">
                    <i class="fa-solid fa-check"></i>
                  </span>
                  <span v-if="isValidateName && !nameIsCorrect" class="input-group-text">
                    <i class="fa-solid fa-circle-info"></i>
                  </span>
                </div>
                <div
                  v-if="!nameIsCorrect"
                  class="alert alert-danger p-1 mt-2"
                  role="alert"
                >
                  <div v-for="msg in messagesName" :key="msg.id">{{ msg.message }}</div>
                </div>
              </div>
              <div class="form-group">
                <label>Usuario (Nick)</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <i class="fa-duotone fa-hashtag"></i>
                  </span>
                  <input
                    id="nick"
                    name="nick"
                    v-model="form.nick"
                    @change="nickCorrect"
                    v-bind:class="[
                      isValidateNick && nickIsCorrect ? 'check' : '',
                      isValidateNick && !nickIsCorrect ? 'uncheck' : '',
                    ]"
                    class="form-control"
                    type="text"
                    required
                    placeholder="fpl2022"
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
                <label>Email</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <i class="fa-solid fa-envelope"></i>
                  </span>
                  <input
                    id="email"
                    name="email"
                    v-model="form.email"
                    @change="emailCorrect"
                    v-bind:class="[
                      isValidateEmail && emailIsCorrect ? 'check' : '',
                      isValidateEmail && !emailIsCorrect ? 'uncheck' : '',
                    ]"
                    class="form-control"
                    type="email"
                    required
                    placeholder="test@gmail.com"
                  />
                  <span v-if="isValidateEmail && emailIsCorrect" class="input-group-text">
                    <i class="fa-solid fa-check"></i>
                  </span>
                  <span
                    v-if="isValidateEmail && !emailIsCorrect"
                    class="input-group-text"
                  >
                    <i class="fa-solid fa-circle-info"></i>
                  </span>
                </div>
                <div
                  v-if="!emailIsCorrect"
                  class="alert alert-danger p-1 mt-2"
                  role="alert"
                >
                  <div v-for="msg in messagesEmail" :key="msg.id">{{ msg.message }}</div>
                </div>
              </div>
              <div class="form-group">
                <label>Password</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <i class="fa-solid fa-lock"></i>
                  </span>
                  <input
                    id="password"
                    v-model="form.password"
                    @change="passwordCorrect"
                    class="form-control"
                    v-bind:class="[
                      isValidatePassword && passwordIsCorrect ? 'check' : '',
                      isValidatePassword && !passwordIsCorrect ? 'uncheck' : '',
                    ]"
                    :type="inputTypePassword ? 'password' : 'text'"
                    name="password"
                    required
                    placeholder="*********"
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
                  <div v-for="msg in messagesPassword" :key="msg.id">
                    {{ msg.message }}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Repetir Password</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                  <input
                    id="password_confirmation"
                    name="password_confirmation"
                    v-model="form.password_confirmation"
                    v-bind:class="[
                      isValidatePasswordRepeat && passwordRepeatIsCorrect ? 'check' : '',
                      isValidatePasswordRepeat && !passwordRepeatIsCorrect
                        ? 'uncheck'
                        : '',
                    ]"
                    @change="passwordRepeatCorrect"
                    class="form-control"
                    :type="inputTypePasswordRepeat ? 'password' : 'text'"
                    required
                    placeholder="*********"
                  />
                  <button
                    class="input-group-text"
                    type="button"
                    @click="changeTypePasswordRepeat"
                  >
                    <div v-if="inputTypePasswordRepeat">
                      <i class="fa-solid fa-eye"></i>
                    </div>
                    <div v-else>
                      <i class="fa-solid fa-eye-low-vision"></i>
                    </div>
                  </button>
                  <span
                    v-if="isValidatePasswordRepeat && passwordRepeatIsCorrect"
                    class="input-group-text"
                  >
                    <i class="fa-solid fa-check"></i>
                  </span>
                  <span
                    v-if="isValidatePasswordRepeat && !passwordRepeatIsCorrect"
                    class="input-group-text"
                  >
                    <i class="fa-solid fa-circle-info"></i>
                  </span>
                </div>
                <div
                  v-if="!passwordRepeatIsCorrect"
                  class="alert alert-danger p-1 mt-2"
                  role="alert"
                >
                  <div v-for="msg in messagesPasswordRepeat" :key="msg.id">
                    {{ msg.message }}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <button
                  class="btn btn-primary btn-block"
                  type="submit"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                >
                  Crea tu cuenta
                </button>
              </div>
              <!-- <div class="login-social-title">
                <h5>Inicia con</h5>
              </div> -->
              <!-- <div class="form-group">
                <ul class="login-social">
                  <li>
                    <a href="../../login.html" target="_blank"
                      ><i data-feather="linkedin"></i
                    ></a>
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
                Ya tienes una cuenta?<a class="ms-2" :href="route('login')"
                  >Inicia aqui</a
                >
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- <JetAuthenticationCard>
        <template #logo>
            <JetAuthenticationCardLogo />
        </template>

        <JetValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <JetLabel for="name" value="Name" />
                <JetInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="name"
                />
            </div>

            <div class="mt-4">
                <JetLabel for="email" value="Email" />
                <JetInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
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
                    autocomplete="new-password"
                />
            </div>

            <div class="mt-4">
                <JetLabel for="password_confirmation" value="Confirm Password" />
                <JetInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
            </div>

            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                <JetLabel for="terms">
                    <div class="flex items-center">
                        <JetCheckbox id="terms" v-model:checked="form.terms" name="terms" />

                        <div class="ml-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                        </div>
                    </div>
                </JetLabel>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </Link>

                <JetButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </JetButton>
            </div>
        </form>
    </JetAuthenticationCard> -->
</template>
