<template>
    <div class="container">
        <h4 class="mb-4">
            Вработени
        </h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Име</th>
                    <th scope="col">Презиме</th>
                    <th scope="col">Вработен во</th>
                    <th scope="col">Последна измена на</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="employee in employees.data" :key="employee.id">
                    <th scope="row">{{ employee.id }}</th>
                    <td>{{ employee.first_name }}</td>
                    <td>{{ employee.last_name }}</td>
                    <td>{{ employee.company.settings.find(a => a.key === 'company.name').value }}</td>
                    <td>{{ employee.updated_at }}</td>
                    <td>
                        <Link class="btn btn-sm btn-primary" :href="$route('super.employees.show', employee)">
                            Види вработен
                        </Link>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <Pagination :links="employees.links"/>
        <Head>
            <title head-key="title">Вработени | Digitalhub Admin</title>
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
        employees: {
            type: Object,
            default: null
        }
    }
}
</script>

<style scoped>

</style>
