<script>
import { ref } from "vue";
import FormRegisterUpdate from "@/Pages/User/FormRegisterUpdate.vue";
export default {
    name: "RegistrarUpdate",
    props: ["isRegister", "isEdit", "user"],
    components: {
        ref,
        FormRegisterUpdate,
    },
    data() {
        return {
            title: "",
        };
    },
    unted() {
        if (this.isRegister) {
            console.log("registrar datos");
        }
        if (this.isEdit) {
            console.log("actualizar datos");
        }
    },
};
</script>

<template>
    <div
        class="offcanvas offcanvas-start w-50"
        data-bs-scroll="true"
        data-bs-backdrop="true"
        tabindex="-1"
        id="offcanvasScrolling"
        aria-labelledby="offcanvasScrollingLabel"
    >
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">
                <div class="container-fluid">
                    {{ title.toUpperCase() }}
                </div>
            </h5>
            <button
                type="button"
                class="btn-close text-reset"
                data-bs-dismiss="offcanvas"
                aria-label="Close"
            ></button>
        </div>
        <div class="offcanvas-body">
            <hr />
            <div class="container-fluid">
                <FormRegisterUpdate :isRegister="isRegister" :isEdit="isEdit" />
            </div>
        </div>
    </div>
    <!-- Signup modal content -->
    <!-- <div
        id="signup-modal"
        class="modal fade"
        tabindex="-1"
        role="dialog"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center mt-2 mb-4">
                        <a :href="'/'" class="text-success">
                            <span
                                ><img
                                    src="assets/images/logo-dark.png"
                                    alt=""
                                    height="18"
                            /></span>
                        </a>
                    </div>
                    <FormRegisterUpdate />
                </div>
            </div>
        </div>
    </div> -->
    <!-- /.modal -->
</template>
