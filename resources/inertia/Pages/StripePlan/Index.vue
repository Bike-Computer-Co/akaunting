<template>
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <h4 class="mb-4">
                Stripe планови
            </h4>
            <button data-bs-toggle="modal" data-bs-target="#createStripePlanModal" class="btn btn-primary px-3 py-1">
                Креирај нов
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Име</th>
                    <th scope="col">Број на компании</th>
                    <th scope="col">Креиран на</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="plan in stripePlans.data" :key="plan.id">
                    <th scope="row">{{ plan.id }}</th>
                    <td>{{ plan.name }}</td>
                    <td>{{ plan.companies_count }}</td>
                    <td>{{ plan.created_at | moment('ll') }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <Pagination :links="stripePlans.links"/>
        <CreateStripePlanModal/>
        <Head>
            <title head-key="title">Stripe планови | Digitalhub Admin</title>
        </Head>
    </div>
</template>

<script>
import Pagination from "../../Components/Pagination";
import DefaultLayout from "../../Layouts/DefaultLayout";
import CreateStripePlanModal from "../../Modals/CreateStripePlanModal";

export default {
    name: "Index",
    components: {CreateStripePlanModal, Pagination},
    layout: DefaultLayout,
    props: {
        stripePlans: {
            type: Object,
            default: null
        }
    }
}
</script>

<style scoped>

</style>
