<template>
    <div class="container">
        <h4 class="mb-4">
            Компании
        </h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Име</th>
                    <th scope="col">Цена за сметководител</th>
                    <th scope="col">Цена за адвокат</th>
                    <th scope="col">Stripe план</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="company in companies.data" :key="company.id">
                    <th scope="row">{{ company.id }}</th>
                    <td>{{ company.settings.find(a => a.key === 'company.name').value }}</td>
                    <td>{{ company.accountant_price }} &euro;</td>
                    <td>{{ company.lawyer_price }} &euro;</td>
                    <td v-if="company.stripe_plan">{{ company.stripe_plan.name }}</td>
                    <td v-else>Нема моментално</td>
                </tr>
                </tbody>
            </table>
        </div>
        <Pagination :links="companies.links"/>
        <Head>
            <title head-key="title">Компании | Digitalhub Admin</title>
        </Head>
    </div>
</template>

<script>
import Pagination from "../../Components/Pagination";
import {Head} from "@inertiajs/inertia-vue";
import DefaultLayout from "../../Layouts/DefaultLayout";

export default {
    name: "Index",
    components: {Pagination, Head},
    layout: DefaultLayout,
    props: {
        companies: {
            type: Object,
            default: null
        }
    }
}
</script>

<style scoped>

</style>
