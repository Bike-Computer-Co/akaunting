<template>
    <div
        id="editCompanyModal"
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
                <div v-if="company" class="modal-body text-center p-5">
                    <div class="fs-5 line-height-normal mb-4">
                        Внесете цени
                    </div>
                    <select v-model="form.stripe_plan_id" class="form-select form-select-lg mb-3">
                        <option selected :value="null">Изберете Stripe пакет</option>
                        <option v-for="plan in stripePlans" :key="plan.id" :value="plan.id">
                            {{ plan.name }}
                        </option>
                    </select>
                    <div class="form-floating mb-3">
                        <input v-model="form.accountant_price" type="number" class="form-control" id="accountant_price"
                               placeholder="Accountant Price" :class="{'is-invalid' : form.errors.accountant_price}">
                        <label for="accountant_price">Цена за сметководител</label>
                        <div class="invalid-feedback">{{ form.errors.accountant_price }}</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input v-model="form.lawyer_price" type="number" class="form-control" id="lawyer_price"
                               placeholder="Lawyer Price" :class="{'is-invalid' : form.errors.lawyer_price}">
                        <label for="lawyer_price">Цена за адвокат</label>
                        <div class="invalid-feedback">{{ form.errors.lawyer_price }}</div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea v-model="form.comment" class="form-control" placeholder="Comment" id="comment"
                                  style="height: 100px" :class="{'is-invalid' : form.errors.comment}"></textarea>
                        <label for="comment">Коментар</label>
                        <div class="invalid-feedback">{{ form.errors.comment }}</div>
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
    name: "EditCompanyModal",
    props: {
        stripePlans: {
            type: Array,
            default: null
        }
    },
    data() {
        return {
            modal: null,
            company: null,
            form: this.$inertia.form({
                accountant_price: "",
                lawyer_price: "",
                comment: "",
                stripe_plan_id: null,
            })
        };
    },
    mounted() {
        this.modal = Modal.getOrCreateInstance(this.$refs.modal);
        this.$refs.modal.addEventListener("show.bs.modal", (event) => {
            const button = event.relatedTarget;
            this.company = JSON.parse(button.getAttribute(`data-bs-company`));
            this.form.accountant_price = this.company.accountant_price;
            this.form.lawyer_price = this.company.lawyer_price;
            this.form.comment = this.company.comment;
            this.form.stripe_plan_id = this.company.stripe_plan_id;
        });
    },
    methods: {
        submit() {
            this.form.put(this.$route('super.companies.update', this.company), {
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
