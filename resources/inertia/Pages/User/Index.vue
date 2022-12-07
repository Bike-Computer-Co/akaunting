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
                    <th scope="col">Име и презиме</th>
                    <th scope="col">Е-пошта</th>
                    <th scope="col">Креиран на</th>
                    <th scope="col">Последен пат логиран</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="user in users.data" :key="user.id">
                    <th scope="row">{{ user.id }}</th>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.created_at | moment('ll') }}</td>
                    <td v-if="user.last_logged_in_at">{{ user.last_logged_in_at | moment('ll') }}</td>
                    <td v-else>Никогаш</td>
                    <td>
                        <Link class="btn btn-sm btn-primary" :href="$route('super.users.show', user)">
                            Види корисник
                        </Link>
                    </td>
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
