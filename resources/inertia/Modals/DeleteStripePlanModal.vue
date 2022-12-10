<template>
    <div
        id="deleteStripePlanModal"
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
                <div v-if="stripePlan" class="modal-body text-center p-5">
                    <div class="fs-5 line-height-normal mb-4">
                        Дали сте сигурни дека сакате да го избришете планот
                    </div>
                    <div class="fw-bold fs-4 line-height-normal mb-4">
                        {{ stripePlan.name }} ?
                    </div>
                    <div
                        class="d-flex flex-row align-items-center justify-content-center"
                    >
                        <button
                            data-bs-dismiss="modal"
                            aria-label="Close"
                            class="btn btn-primary border-radius-12px me-3"
                        >
                            <i class="fa fa-ban me-2"></i>Откажи
                        </button>
                        <button
                            :disabled="deleting"
                            class="btn btn-danger border-radius-12px"
                            @click="remove"
                        >
                            <i class="fa fa-trash me-2"></i>Избриши
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Modal } from "bootstrap";

export default {
    name: "DeleteStripePlanModal",
    data() {
        return {
            modal: null,
            deleting: false,
            stripePlan: null,
        };
    },
    mounted() {
        this.modal = Modal.getOrCreateInstance(this.$refs.modal);
        this.$refs.modal.addEventListener("show.bs.modal", (event) => {
            const button = event.relatedTarget;
            this.stripePlan = JSON.parse(button.getAttribute(`data-bs-stripe-plan`));
        });
    },
    methods: {
        remove() {
            this.$inertia.delete(
                this.$route("super.stripe-plans.destroy", this.stripePlan.id),
                {
                    onBefore: () => {
                        this.deleting = true;
                    },
                    onFinish: () => {
                        this.deleting = false;
                        this.modal.hide();
                    },
                }
            );
        },
    },
};
</script>

<style scoped></style>
