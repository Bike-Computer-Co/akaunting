<template>
    <div class="container">
        <h4 class="mb-4">Креирај нов корисник</h4>
        <form @submit.prevent="submit">
            <div class="my-lg-2 px-0">
                <label for="name" class="p-0 m-1 fw-medium">
                    Име и презиме
                </label>
                <input
                    id="name"
                    v-model="form.name"
                    data-bs-toggle="tooltip"
                    title="please fill out this field"
                    name="name"
                    :class="{ 'is-invalid': form.errors.name }"
                    type="text"
                    class="form-control border border-1 border-info rounded-2 mb-2"
                />
                <div
                    class="invalid-feedback"
                    v-html="form.errors.name"
                />
            </div>
            <div class="my-lg-2 px-0">
                <label for="email" class="p-0 m-1 fw-medium">
                    Е-пошта
                </label>
                <input
                    id="email"
                    v-model="form.email"
                    data-bs-toggle="tooltip"
                    title="please fill out this field"
                    :class="{ 'is-invalid': form.errors.email }"
                    name="email"
                    type="email"
                    class="form-control border border-1 border-info rounded-2 mb-2"
                />
                <div
                    class="invalid-feedback"
                    v-html="form.errors.email"
                />
            </div>
            <div class="my-lg-2 px-0">
                <label for="password" class="p-0 m-1 fw-medium">
                    Лозинка
                </label>
                <input
                    id="password"
                    v-model="form.password"
                    data-bs-toggle="tooltip"
                    title="please fill out this field"
                    :class="{ 'is-invalid': form.errors.password }"
                    name="password"
                    type="password"
                    class="form-control border border-1 border-info rounded-2 mb-3"
                />
                <div
                    class="invalid-feedback"
                    v-html="form.errors.password"
                />
            </div>
            <div class="my-lg-2 px-0">
                <label for="company_name" class="p-0 m-1 fw-medium">
                    Име на компанија
                </label>
                <input
                    id="company_name"
                    v-model="form.company_name"
                    data-bs-toggle="tooltip"
                    title="please fill out this field"
                    name="company_name"
                    :class="{ 'is-invalid': form.errors.company_name }"
                    type="text"
                    class="form-control border border-1 border-info rounded-2 mb-2"
                />
                <div
                    class="invalid-feedback"
                    v-html="form.errors.company_name"
                />
            </div>
            <div class="my-lg-2 px-0">
                <label class="p-0 m-1 fw-medium">
                    Држава
                </label>
                <select
                    id="country"
                    v-model="form.country"
                    name="country"
                    class="form-select border border-1 border-info rounded-2 mb-2"
                >
                    <option v-for="item in countries" :key="item.id" :value="item.id">
                        {{ item.name }}
                    </option>
                </select>
            </div>
            <div class="text-center">
                <button
                    type="submit"
                    class="ui button btn-send btn btn-primary text-white px-4 my-4 my-lg-5 fs-5"
                    :disabled="form.processing"
                >
                    <div v-if="form.processing" class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div> Креирај корисник
                </button>
            </div>
        </form>
        <Head>
            <title head-key="title">Креирање на корисник | Digitalhub Admin</title>
        </Head>
    </div>
</template>

<script>
import DefaultLayout from "../../Layouts/DefaultLayout";
import { Head } from "@inertiajs/inertia-vue";

export default {
    name: "Create",
    components: {Head},
    layout: DefaultLayout,
    props: {
        countries: {
            type: Array,
            default: null
        }
    },
    data() {
        return {
            form: this.$inertia.form({
                name: "",
                email: "",
                password: "",
                company_name: "",
                locale: 'mk-MK',
                currency: "MKD",
                country: "MK",
            })
        }
    },
    methods: {
        submit() {
            this.form.post(this.$route('super.users.store'))
        }
    }
}
</script>

<style scoped>

</style>
