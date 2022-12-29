<template>
    <div class="container">
        <h4 class="mb-3">
            Вработен: {{ employee.first_name }} {{ employee.last_name }}
        </h4>
        <div class="table-responsive mb-5">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th>
                        Лабела
                    </th>
                    <th>
                        Вредност
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>
                        Име:
                    </th>
                    <td>
                        {{ employee.first_name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Презиме:
                    </th>
                    <td>
                        {{ employee.last_name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Матичен број:
                    </th>
                    <td>
                        {{ employee.personal_number }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Датум на раѓање:
                    </th>
                    <td>
                        {{ employee.birth_date }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Трансакциска сметка:
                    </th>
                    <td>
                        {{ employee.bank_account }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Адреса:
                    </th>
                    <td>
                        {{ employee.address }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Тел. број:
                    </th>
                    <td>
                        {{ employee.phone }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Е-пошта:
                    </th>
                    <td>
                        {{ employee.email }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Нето Плата:
                    </th>
                    <td>
                        {{ employee.salary }} ден.
                    </td>
                </tr>
                <tr>
                    <th>
                        Вработен во
                    </th>
                    <td>
                        {{ employee.company.settings.find(a => a.key === 'company.name').value }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <h5>
            Историја на пријавување/одјавување
        </h5>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th>Тип</th>
                    <th>Датум на пријавување/одјавување</th>
                    <th>Испратен оглас за вработување</th>
                    <th>M1M2 образец</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="history in employee.employment_histories">
                    <td>
                        {{ history.type === SIGN_UP ? 'Пријавување' : 'Одјавување' }}
                    </td>
                    <td>
                        {{ history.employment_history_date }}
                    </td>
                    <td>
                        <button data-bs-toggle="modal" data-bs-target="#employmentAnnouncementSentModal"
                                :data-bs-employment-history="JSON.stringify(history)"
                                v-if="!history.employment_announcement_sent && history.type === SIGN_UP"
                                class="btn btn-sm btn-primary">
                            Испратен оглас за вработување
                        </button>
                        <span v-else-if="history.type === SIGN_UP">ДА</span>
                        <span v-else>Овој запис е за одјавување</span>
                    </td>
                    <td>
                        <input
                            v-if="(history.employment_announcement_sent  || history.type === SIGN_OUT) && !history.m1m2"
                            ref="filePicker"
                            type="file"
                            @change="uploadFile($event, history)"
                        />
                        <div v-else-if="history.m1m2">
                            <a
                                class="btn btn-primary btn-sm"
                                :href="history.m1m2.full_source"
                                target="_blank"
                            >
                                <i class="fa fa-eye"></i> Види M1M2
                            </a>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <EmploymentAnnouncementSentModal :employee="employee"/>
    </div>
</template>

<script>
import DefaultLayout from "../../Layouts/DefaultLayout";
import EmploymentAnnouncementSentModal from "../../Modals/EmploymentAnnouncementSentModal";

export default {
    name: "Show",
    components: {EmploymentAnnouncementSentModal},
    layout: DefaultLayout,
    props: {
        employee: {
            type: Object,
            default: null
        }
    },
    data() {
        return {
            SIGN_UP: 0,
            SIGN_OUT: 1,
            form: this.$inertia.form({
                file: null,
                _method: "PUT"
            }),
        }
    },
    methods: {
        uploadFile(e, employmentHistory) {
            if (e.target.files[0]) {
                this.form.file = e.target.files[0];
                this.form.post(this.$route('super.employees.attach_m1m2', [this.employee, employmentHistory]));
            }
        }
    }
}
</script>

<style scoped>

</style>
