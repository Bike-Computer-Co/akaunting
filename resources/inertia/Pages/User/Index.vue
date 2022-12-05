<template>
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <h4 class="mb-4">
                Корисници
            </h4>
            <Link :href="$route('super.users.create')" class="btn btn-primary px-3 py-1">
                Креирај нов
            </Link>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Име</th>
                    <th scope="col">Презиме</th>
                    <th scope="col">Креиран на</th>
                    <th scope="col">Последен пат логиран</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="user in users.data" :key="user.id">
                    <th scope="row">{{ user.id }}</th>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.created_at | moment('ll') }}</td>
                    <td>{{ user.last_logged_in_at | moment('ll') }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <Pagination :links="users.links"/>
        <Head>
            <title head-key="title">Корисници | Digitalhub Admin</title>
        </Head>
    </div>
</template>

<script>
import DefaultLayout from "../../Layouts/DefaultLayout";
import { Head } from "@inertiajs/inertia-vue";
import Pagination from "../../Components/Pagination";

export default {
    name: "Index",
    components: {Pagination, Head},
    layout: DefaultLayout,
    props: {
        users: {
            type: Object,
            default: null
        }
    }
}
</script>

<style scoped>

</style>
