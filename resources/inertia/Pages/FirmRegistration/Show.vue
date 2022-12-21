<template>
    <div class="col col-12 mb-3">
        <h5 class="mb-3 fw-bold text-center text-lg-start">
            Автоматски генерирани фајлови за рагистрација
        </h5>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-2 mb-2">
                <a
                    :href="
                        $route(
                            'super.firm-registrations.certified-signature-pdf',
                            firmRegistration
                        )
                    "
                    class="btn btn-success w-100"
                    target="_blank"
                >ЗП Образец</a
                >
            </div>
            <div v-for="index in 4" class="col-12 col-sm-6 col-md-2 mb-2">
                <a
                    :href="
                        $route(
                            `super.firm-registrations.statment-${index}`,
                            firmRegistration
                        )
                    "
                    class="btn btn-success w-100"
                    target="_blank"
                >ДООЕЛ Изјава-{{ index }}</a
                >
            </div>
            <div class="col-12 col-sm-6 col-md-2 mb-2">
                <a
                    :href="
                        $route('super.firm-registrations.decision', firmRegistration)
                    "
                    class="btn btn-success w-100"
                    target="_blank"
                >Одлука</a
                >
            </div>
            <div class="col-12 col-sm-6 col-md-2 mb-2">
                <a
                    :href="
                        $route(
                            'super.firm-registrations.power-of-attorney',
                            firmRegistration
                        )
                    "
                    class="btn btn-success w-100"
                    target="_blank"
                >Полномошно</a
                >
            </div>
        </div>

        <h5 class="mb-3 fw-bold text-center text-lg-start">
            Податоци за регистрацијата на фирмата
        </h5>
        <div class="table-responsive">
            <table class="table table-hover table-striped border border-1">
                <tbody>
                <tr class="text-nowrap">
                    <th class="col col-5 fw-bold">
                        Решение за упис на фирмата:
                    </th>
                    <td class="col col-7 border border-start border-1">
                        <input
                            v-if="!firmRegistration.enrollment_decision"
                            ref="filePicker"
                            type="file"
                            @change="uploadFile($event)"
                        />
                        <div v-else>
                            <a
                                class="btn btn-primary btn-sm"
                                :href="
                                        firmRegistration.enrollment_decision
                                            .full_source
                                    "
                                target="_blank"
                            >
                                <i class="fa fa-eye"></i> Види решение
                            </a>
                        </div>
                    </td>
                </tr>
                <tr class="text-nowrap">
                    <th class="col col-5 fw-bold">Датум на апликација:</th>
                    <td class="col col-7 border border-start border-1">
                        {{ firmRegistration.created_at }}
                    </td>
                </tr>
                <tr class="text-nowrap">
                    <th class="col col-5 fw-bold">Форма на друштво:</th>
                    <td class="col col-7 border border-start border-1">
                        {{
                            firmRegistration.form_of_firm === TP
                                ? "Трговец Поединец"
                                : "Трговско Друштво"
                        }}
                    </td>
                </tr>
                <tr class="text-nowrap">
                    <th class="col col-5 fw-bold">Назив на друштво:</th>
                    <td class="col col-7 border border-start border-1">
                        {{ firmRegistration.firm_name }}
                    </td>
                </tr>
                <tr class="text-nowrap">
                    <th class="col col-5 fw-bold">
                        Име и презиме на основач:
                    </th>
                    <td class="col col-7 border border-start border-1">
                        {{ firmRegistration.founder_name }}
                    </td>
                </tr>
                <tr class="text-nowrap">
                    <th class="col col-5 fw-bold">Адреса на основач:</th>
                    <td class="col col-7 border border-start border-1">
                        {{ firmRegistration.founder_address }}
                    </td>
                </tr>
                <tr class="text-nowrap">
                    <th class="col col-5 fw-bold">ЕМБГ на основач:</th>
                    <td class="col col-7 border border-start border-1">
                        {{ firmRegistration.founder_embg }}
                    </td>
                </tr>
                <tr class="text-nowrap">
                    <th class="col col-5 fw-bold">
                        Бр. на лична карта на основач:
                    </th>
                    <td class="col col-7 border border-start border-1">
                        {{ firmRegistration.founder_id_number }}
                    </td>
                </tr>
                <tr class="text-nowrap">
                    <th class="col col-5 fw-bold">
                        Име и презиме на управител:
                    </th>
                    <td class="col col-7 border border-start border-1">
                        {{ firmRegistration.manager_name }}
                    </td>
                </tr>
                <tr class="text-nowrap">
                    <th class="col col-5 fw-bold">Адреса на управител:</th>
                    <td class="col col-7 border border-start border-1">
                        {{ firmRegistration.manager_address }}
                    </td>
                </tr>
                <tr class="text-nowrap">
                    <th class="col col-5 fw-bold">ЕМБГ на управител:</th>
                    <td class="col col-7 border border-start border-1">
                        {{ firmRegistration.manager_embg }}
                    </td>
                </tr>
                <tr class="text-nowrap">
                    <th class="col col-5 fw-bold">Банка на друштво:</th>
                    <td class="col col-7 border border-start border-1">
                        {{ firmRegistration.bank.name }}
                    </td>
                </tr>
                <tr class="text-nowrap">
                    <th class="col col-5 fw-bold">
                        Седиште на фирмата (општина):
                    </th>
                    <td class="col col-7 border border-start border-1">
                        {{
                            firmRegistration.headquarters_municipality.name
                        }}
                    </td>
                </tr>
                <tr class="text-nowrap">
                    <th class="col col-5 fw-bold">
                        Седиште на фирмата (населба)::
                    </th>
                    <td class="col col-7 border border-start border-1">
                        {{
                            !firmRegistration.headquarters_settlement
                                ? "Нема"
                                : firmRegistration.headquarters_settlement
                                    .name
                        }}
                    </td>
                </tr>
                <tr class="text-nowrap">
                    <th class="col col-5 fw-bold">
                        Адреса на седиште на фирмата:
                    </th>
                    <td class="col col-7 border border-start border-1">
                        {{ firmRegistration.headquarters_address }}
                    </td>
                </tr>
                <tr class="text-nowrap">
                    <th class="col col-5 fw-bold">
                        Седиште на подружница (општина):
                    </th>
                    <td class="col col-7 border border-start border-1">
                        {{ firmRegistration.subsidiary_municipality.name }}
                    </td>
                </tr>
                <tr class="text-nowrap">
                    <th class="col col-5 fw-bold">
                        Подружница на фирмата (населба):
                    </th>
                    <td class="col col-7 border border-start border-1">
                        {{
                            !firmRegistration.subsidiary_settlement
                                ? "Нема"
                                : firmRegistration.subsidiary_settlement
                                    .name
                        }}
                    </td>
                </tr>
                <tr class="text-nowrap">
                    <th class="col col-5 fw-bold">
                        Дејност со која ке се занимава - Шифра
                    </th>
                    <td class="col col-7 border border-start border-1">
                        {{ firmRegistration.occupation_code }}
                    </td>
                </tr>
                <tr class="text-nowrap">
                    <th class="col col-5 fw-bold">Основна главнина</th>
                    <td class="col col-7 border border-start border-1">
                        Ќе внесам
                        <span>{{
                                firmRegistration.stake_type === MONEY
                                    ? "парична"
                                    : "непарична"
                            }}</span>
                        главнина
                        <span>{{
                                firmRegistration.stake_duration === IMMEDIATELY
                                    ? "веднаш"
                                    : "во наредните 12 месеци"
                            }}</span>
                    </td>
                </tr>
                <tr class="text-nowrap">
                    <th class="col col-5 fw-bold">
                        Телефонски број за контакт
                    </th>
                    <td class="col col-7 border border-start border-1">
                        {{ firmRegistration.phone }}
                    </td>
                </tr>
                <tr class="text-nowrap">
                    <th class="col col-5 fw-bold">
                        Е-пошта за централен регистар
                    </th>
                    <td class="col col-7 border border-start border-1">
                        {{ firmRegistration.email }}
                    </td>
                </tr>
                <tr class="text-nowrap">
                    <th class="col col-5 fw-bold">
                        Адреса за достава на печат
                    </th>
                    <td class="col col-7 border border-start border-1">
                        {{ firmRegistration.stamp_address }}
                    </td>
                </tr>
                <tr class="text-nowrap">
                    <th class="col col-5 fw-bold">Тип на печат</th>
                    <td class="col col-7 border border-start border-1">
                        {{
                            firmRegistration.stamp_type === WOODEN
                                ? "Дрвен"
                                : "Автоматски"
                        }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import DefaultLayout from "../../Layouts/DefaultLayout.vue";
import { TP, MONEY, IMMEDIATELY, WOODEN } from "../../constants";

export default {
    name: "Show",
    layout: DefaultLayout,
    props: {
        firmRegistration: {
            type: Object,
            default: null,
        },
    },
    data() {
        return {
            form: this.$inertia.form({
                file: null,
                _method: "PUT"
            }),
            TP, MONEY, IMMEDIATELY, WOODEN
        }
    },
    methods: {
        uploadFile() {
            if (e.target.files[0]) {
                this.form.file = e.target.files[0];
                this.form.post(
                    this.$route(
                        "super.firm-registrations.upload-enrollment-decision",
                        props.firmRegistration.id
                    )
                );
            }
        }
    }
};
</script>


<style scoped></style>
