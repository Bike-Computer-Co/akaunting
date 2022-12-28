<template>
    <div
        id="employmentAnnouncementSentModal"
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
                        Дали сте сигурни дека имате пуштено оглас за вработување за овој вработен?
                    </div>
                    <div
                        class="d-flex flex-row gap-3 align-items-center justify-content-center"
                    >
                        <button
                            data-bs-dismiss="modal"
                            aria-label="Close"
                            class="btn btn-primary"
                        >
                            <i class="fa fa-close me-2"></i>НЕ
                        </button>
                        <button
                            class="btn btn-success"
                            @click="submit"
                        >
                            <i class="fa fa-check me-2"></i>ДА
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
    name: "EmploymentAnnouncementSentModal",
    data() {
        return {
            modal: null,
            employmentHistory: null
        };
    },
    props: {
        employee: {
            type: Object,
            default: null
        }
    },
    mounted() {
        this.modal = Modal.getOrCreateInstance(this.$refs.modal);
        this.$refs.modal.addEventListener("show.bs.modal", (event) => {
            const button = event.relatedTarget;
            this.employmentHistory = JSON.parse(button.getAttribute(`data-bs-employment-history`));
        });
    },
    methods: {
        submit() {
            this.$inertia.post(this.$route('super.employees.sent_employment_announcement', [this.employee, this.employmentHistory]), {}, {
                onSuccess: () => {
                    this.modal.hide();
                }
            });
        },
    },
};
</script>

<style scoped></style>
