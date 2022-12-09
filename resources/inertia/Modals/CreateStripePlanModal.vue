<template>
    <div
        id="createStripePlanModal"
        ref="modal"
        class="modal fade"
        tabindex="-1"
        aria-hidden="true"
        @click.prevent
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div
                    class="position-absolute end-0 mt-2 me-2"
                    style="z-index: 100"
                >
                    <div
                        data-bs-dismiss="modal"
                        aria-label="Close"
                        class="cursor-pointer"
                    >
                        <i class="fa fa-times fa-2x text-black"></i>
                    </div>
                </div>
                <div class="modal-body text-center p-5">
                    <div class="fs-5 line-height-normal mb-4">
                        Креирајте нов Stripe план
                    </div>
                    <div class="form-floating mb-3">
                        <input v-model="form.name" type="text" class="form-control" id="name"
                               placeholder="Name" :class="{'is-invalid' : form.errors.name}">
                        <label for="name">Име</label>
                        <div class="invalid-feedback">{{ form.errors.name }}</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input v-model="form.stripe_id" type="text" class="form-control" id="stripe_id"
                               placeholder="Stripe ID" :class="{'is-invalid' : form.errors.stripe_id}">
                        <label for="stripe_id">Stripe ID</label>
                        <div class="invalid-feedback">{{ form.errors.stripe_id }}</div>
                    </div>
                    <div
                        class="d-flex flex-row gap-3 align-items-center justify-content-center"
                    >
                        <button
                            data-bs-dismiss="modal"
                            aria-label="Close"
                            class="btn btn-primary"
                        >
                            <i class="fa fa-close me-2"></i>Откажи
                        </button>
                        <button
                            :disabled="form.processing"
                            class="btn btn-success"
                            @click="submit"
                        >
                            <i class="fa fa-pencil me-2"></i>Зачувај
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {Modal} from "bootstrap";

export default {
    name: "CreateStripePlanModal",
    data() {
        return {
            modal: null,
            form: this.$inertia.form({
                name: "",
                stripe_id: "",
            })
        };
    },
    mounted() {
        this.modal = Modal.getOrCreateInstance(this.$refs.modal);
    },
    methods: {
        submit() {
            this.form.post(this.$route('super.stripe-plans.store'), {
                onSuccess: () => {
                    this.form.reset();
                    this.modal.hide();
                }
            })
        },
    },
};
</script>

<style scoped></style>
