<template>
    <div>
        <h3 class="text-center">Креирај регистрација на фирма</h3>
        <form class="row" @submit.prevent="submit">
            <div class="col col-12 col-md-6">
                <div class="mb-3">
                    <div>Форма на друштво:</div>
                    <div class="form-check">
                        <input
                            id="tp"
                            v-model="form.form_of_firm"
                            :class="{ 'is-invalid': form.errors.form_of_firm }"
                            class="form-check-input"
                            type="radio"
                            name="form_of_firm"
                            :value="TP"
                        />
                        <label class="form-check-label" for="tp">
                            Трговец Поединец (ТП)
                        </label>
                        <div class="invalid-feedback">
                            {{ form.errors.form_of_firm }}
                        </div>
                    </div>
                    <div class="form-check">
                        <input
                            id="doo"
                            v-model="form.form_of_firm"
                            :class="{ 'is-invalid': form.errors.form_of_firm }"
                            class="form-check-input"
                            type="radio"
                            name="form_of_firm"
                            :value="DOO"
                        />
                        <label class="form-check-label" for="doo">
                            Трговско Друштво (ДОО/ДООЕЛ)
                        </label>
                        <div class="invalid-feedback">
                            {{ form.errors.form_of_firm }}
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label"
                    >Тел. број за контакт</label
                    >
                    <input
                        id="phone"
                        v-model="form.phone"
                        :class="{ 'is-invalid': form.errors.phone }"
                        type="tel"
                        class="form-control"
                    />
                    <div class="invalid-feedback">
                        {{ form.errors.phone }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Е-пошта</label>
                    <input
                        id="email"
                        v-model="form.email"
                        :class="{ 'is-invalid': form.errors.email }"
                        type="email"
                        class="form-control"
                    />
                    <div class="invalid-feedback">
                        {{ form.errors.email }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="firm_name" class="form-label"
                    >Назив на друштвото</label
                    >
                    <input
                        id="firm_name"
                        v-model="form.firm_name"
                        :class="{ 'is-invalid': form.errors.firm_name }"
                        type="text"
                        class="form-control"
                    />
                    <div class="invalid-feedback">{{ form.errors.firm_name }}</div>
                </div>
                <hr />
                <div class="mb-3">
                    <label for="founder_name" class="form-label"
                    >Име и презине на основач</label
                    >
                    <input
                        id="founder_name"
                        v-model="form.founder_name"
                        :class="{ 'is-invalid': form.errors.founder_name }"
                        type="text"
                        class="form-control"
                    />
                    <div class="invalid-feedback">
                        {{ form.errors.founder_name }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="founder_address" class="form-label"
                    >Адреса на основач</label
                    >
                    <input
                        id="founder_address"
                        v-model="form.founder_address"
                        :class="{ 'is-invalid': form.errors.founder_address }"
                        type="text"
                        class="form-control"
                    />
                    <div class="invalid-feedback">
                        {{ form.errors.founder_address }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="founder_embg" class="form-label"
                    >ЕМБГ на основач</label
                    >
                    <input
                        id="founder_embg"
                        v-model="form.founder_embg"
                        :class="{ 'is-invalid': form.errors.founder_embg }"
                        type="text"
                        class="form-control"
                    />
                    <div class="invalid-feedback">
                        {{ form.errors.founder_embg }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="founder_embg" class="form-label"
                    >Бр. на лична карта</label
                    >
                    <input
                        id="founder_id_number"
                        v-model="form.founder_id_number"
                        :class="{ 'is-invalid': form.errors.founder_id_number }"
                        type="text"
                        class="form-control"
                    />
                    <div class="invalid-feedback">
                        {{ form.errors.founder_id_number }}
                    </div>
                </div>
                <hr />
                <div class="mb-3">
                    <label for="manager_name" class="form-label"
                    >Име и презине на управител</label
                    >
                    <input
                        id="manager_name"
                        v-model="form.manager_name"
                        :class="{ 'is-invalid': form.errors.manager_name }"
                        type="text"
                        class="form-control"
                    />
                    <div class="invalid-feedback">
                        {{ form.errors.manager_name }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="manager_address" class="form-label"
                    >Адреса на управител</label
                    >
                    <input
                        id="manager_address"
                        v-model="form.manager_address"
                        :class="{ 'is-invalid': form.errors.manager_address }"
                        type="text"
                        class="form-control"
                    />
                    <div class="invalid-feedback">
                        {{ form.errors.manager_address }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="manager_embg" class="form-label"
                    >ЕМБГ на управител</label
                    >
                    <input
                        id="manager_embg"
                        v-model="form.manager_embg"
                        :class="{ 'is-invalid': form.errors.manager_embg }"
                        type="text"
                        class="form-control"
                    />
                    <div class="invalid-feedback">
                        {{ form.errors.manager_embg }}
                    </div>
                </div>
                <hr />
            </div>
            <div class="col col-12 col-md-6">
                <div class="mb-3">
                    <label for="stamp_address" class="form-label"
                    >Адреса за испраќање на печат</label
                    >
                    <input
                        id="stamp_address"
                        v-model="form.stamp_address"
                        :class="{ 'is-invalid': form.errors.stamp_address }"
                        type="text"
                        class="form-control"
                    />
                    <div class="invalid-feedback">
                        {{ form.errors.stamp_address }}
                    </div>
                </div>
                <div class="mb-3">
                    <div>Тип на печат:</div>
                    <div class="form-check">
                        <input
                            id="wooden"
                            v-model="form.stamp_type"
                            :class="{ 'is-invalid': form.errors.stamp_type }"
                            class="form-check-input"
                            type="radio"
                            name="stamp_type"
                            :value="WOODEN"
                        />
                        <label class="form-check-label" for="wooden"> Дрвен </label>
                        <div class="invalid-feedback">
                            {{ form.errors.stamp_type }}
                        </div>
                    </div>
                    <div class="form-check">
                        <input
                            id="automatic"
                            v-model="form.stamp_type"
                            :class="{ 'is-invalid': form.errors.stamp_type }"
                            class="form-check-input"
                            type="radio"
                            name="stamp_type"
                            :value="AUTOMATIC"
                        />
                        <label class="form-check-label" for="automatic">
                            Автоматкси
                        </label>
                        <div class="invalid-feedback">
                            {{ form.errors.stamp_type }}
                        </div>
                    </div>
                </div>
                <hr />
                <div class="mb-3">
                    <label>Банка на друштво:</label>
                    <select
                        id="bank_id"
                        v-model="form.bank_id"
                        :class="{ 'is-invalid': form.errors.bank_id }"
                        class="form-select"
                    >
                        <option
                            v-for="bank in banks"
                            :key="bank.id"
                            :value="bank.id"
                        >
                            {{ bank.name }}
                        </option>
                    </select>
                    <div class="invalid-feedback">{{ form.errors.bank_id }}</div>
                </div>
                <hr />
                <div class="mb-3">
                    <label>Седиште на фирмата (општина):</label>
                    <select
                        id="headquarters_municipality_id"
                        v-model="form.headquarters_municipality_id"
                        :class="{
                        'is-invalid': form.errors.headquarters_municipality_id,
                    }"
                        class="form-select"
                    >
                        <option
                            v-for="municipality in municipalities"
                            :key="municipality.id"
                            :value="municipality.id"
                        >
                            {{ municipality.name }}
                        </option>
                    </select>
                    <div class="invalid-feedback">
                        {{ form.errors.headquarters_municipality_id }}
                    </div>
                </div>
                <div
                    v-if="
                    municipalities.find(
                        (a) => a.id === form.headquarters_municipality_id
                    ) &&
                    municipalities.find(
                        (a) => a.id === form.headquarters_municipality_id
                    ).settlements.length
                "
                    class="mb-3"
                >
                    <label>Седиште на фирмата (населба):</label>
                    <select
                        id="headquarters_municipality_id"
                        v-model="form.headquarters_settlement_id"
                        :class="{
                        'is-invalid': form.errors.headquarters_settlement_id,
                    }"
                        class="form-select"
                    >
                        <option
                            v-for="settlement in municipalities.find(
                            (a) => a.id === form.headquarters_municipality_id
                        ).settlements"
                            :key="settlement.id"
                            :value="settlement.id"
                        >
                            {{ settlement.name }}
                        </option>
                    </select>
                    <div class="invalid-feedback">
                        {{ form.errors.headquarters_settlement_id }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="headquarters_address" class="form-label"
                    >Адреса на седиште на фирмата</label
                    >
                    <input
                        id="headquarters_address"
                        v-model="form.headquarters_address"
                        :class="{ 'is-invalid': form.errors.headquarters_address }"
                        type="text"
                        class="form-control"
                    />
                    <div class="invalid-feedback">
                        {{ form.errors.headquarters_address }}
                    </div>
                </div>
                <hr />
                <div class="mb-3">
                    <label>Седиште на подружница (општина):</label>
                    <select
                        id="subsidiary_municipality_id"
                        v-model="form.subsidiary_municipality_id"
                        :class="{
                        'is-invalid': form.errors.subsidiary_municipality_id,
                    }"
                        class="form-select"
                    >
                        <option
                            v-for="municipality in municipalities"
                            :key="municipality.id"
                            :value="municipality.id"
                        >
                            {{ municipality.name }}
                        </option>
                    </select>
                    <div class="invalid-feedback">
                        {{ form.errors.subsidiary_municipality_id }}
                    </div>
                </div>
                <div
                    v-if="
                    municipalities.find(
                        (a) => a.id === form.subsidiary_municipality_id
                    ) &&
                    municipalities.find(
                        (a) => a.id === form.subsidiary_municipality_id
                    ).settlements.length
                "
                    class="mb-3"
                >
                    <label>Подружница на фирмата (населба):</label>
                    <select
                        id="subsidiary_settlement_id"
                        v-model="form.subsidiary_settlement_id"
                        :class="{
                        'is-invalid': form.errors.subsidiary_settlement_id,
                    }"
                        class="form-select"
                    >
                        <option
                            v-for="settlement in municipalities.find(
                            (a) => a.id === form.subsidiary_municipality_id
                        ).settlements"
                            :key="settlement.id"
                            :value="settlement.id"
                        >
                            {{ settlement.name }}
                        </option>
                    </select>
                    <div class="invalid-feedback">
                        {{ form.errors.subsidiary_settlement_id }}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="subsidiary_address" class="form-label"
                    >Адреса на подружница на фирмата</label
                    >
                    <input
                        id="subsidiary_address"
                        v-model="form.subsidiary_address"
                        :class="{ 'is-invalid': form.errors.subsidiary_address }"
                        type="text"
                        class="form-control"
                    />
                    <div class="invalid-feedback">
                        {{ form.errors.subsidiary_address }}
                    </div>
                </div>
                <hr />
                <div class="mb-3">
                    <label for="occupation_code" class="form-label"
                    >Дејност со која ке се занимава - Шифра</label
                    >
                    <input
                        id="occupation_code"
                        v-model="form.occupation_code"
                        :class="{ 'is-invalid': form.errors.occupation_code }"
                        type="text"
                        class="form-control"
                    />
                    <div class="invalid-feedback">
                        {{ form.errors.occupation_code }}
                    </div>
                </div>
                <hr />
                <div class="mb-3">
                    <div>Основна главнина</div>
                    <div class="form-check">
                        <input
                            id="immediately"
                            v-model="form.stake_duration"
                            :class="{ 'is-invalid': form.errors.stake_duration }"
                            class="form-check-input"
                            type="radio"
                            name="stake_duration"
                            :value="IMMEDIATELY"
                        />
                        <label class="form-check-label" for="immediately">
                            Ќе внесам главнина веднаш
                        </label>
                        <div class="invalid-feedback">
                            {{ form.errors.stake_duration }}
                        </div>
                    </div>
                    <div class="form-check mb-2">
                        <input
                            id="next_12_months"
                            v-model="form.stake_duration"
                            :class="{ 'is-invalid': form.errors.stake_duration }"
                            class="form-check-input"
                            type="radio"
                            name="stake_duration"
                            :value="NEXT_12_MONTHS"
                        />
                        <label class="form-check-label" for="next_12_months">
                            Ќе внесам главнина во наредните 12 месеци
                        </label>
                        <div class="invalid-feedback">
                            {{ form.errors.stake_duration }}
                        </div>
                    </div>
                    <div class="form-check">
                        <input
                            id="money"
                            v-model="form.stake_type"
                            :class="{ 'is-invalid': form.errors.stake_type }"
                            class="form-check-input"
                            type="radio"
                            name="stake_type"
                            :value="MONEY"
                        />
                        <label class="form-check-label" for="money">
                            Влогот ќе биде паричен
                        </label>
                        <div class="invalid-feedback">
                            {{ form.errors.stake_type }}
                        </div>
                    </div>
                    <div class="form-check">
                        <input
                            id="no_money"
                            v-model="form.stake_type"
                            :class="{ 'is-invalid': form.errors.stake_type }"
                            class="form-check-input"
                            type="radio"
                            name="stake_type"
                            :value="NO_MONEY"
                        />
                        <label class="form-check-label" for="no_money">
                            Влогот ќе биде непаричен
                        </label>
                        <div class="invalid-feedback">
                            {{ form.errors.stake_type }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary px-3">Креирај</button>
            </div>
        </form>
    </div>
</template>

<script>
import DefaultLayout from "../../Layouts/DefaultLayout";
import {
    DOO,
    TP,
    IMMEDIATELY,
    NEXT_12_MONTHS,
    MONEY,
    NO_MONEY,
    WOODEN,
    AUTOMATIC,
} from "../../constants"

export default {
    name: "Create",
    layout: DefaultLayout,
    props: {
        banks: {
            type: Array,
            default: null,
        },
        municipalities: {
            type: Array,
            default: null,
        },
    },
    data() {
        return {
            form: this.$inertia.form({
                form_of_firm: null,
                firm_name: "",
                founder_name: "",
                founder_address: "",
                founder_embg: "",
                founder_id_number: "",
                manager_name: "",
                manager_address: "",
                manager_embg: "",
                headquarters_address: "",
                headquarters_municipality_id: null,
                headquarters_settlement_id: null,
                subsidiary_address: "",
                subsidiary_municipality_id: null,
                subsidiary_settlement_id: null,
                occupation_code: "",
                stake_duration: null,
                stake_type: null,
                bank_id: null,
                phone: "",
                email: "",
                stamp_address: "",
                stamp_type: null,
            }),
            DOO,
            TP,
            IMMEDIATELY,
            NEXT_12_MONTHS,
            MONEY,
            NO_MONEY,
            WOODEN,
            AUTOMATIC,
        }
    },
    methods: {
        submit() {
            this.form.post(this.$route("super.firm-registrations.store"), {
                onSuccess: () => {
                    form.reset();
                },
            });
        }
    }
};
</script>

<style scoped></style>
