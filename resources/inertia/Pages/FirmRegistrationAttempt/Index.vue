<template>
    <div>
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h4>Обиди за регистрација на фирма</h4>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Име</th>
                    <th>Е-пошта</th>
                    <th>Телефон</th>
                    <th>Датум на обид</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="firm in attempts.data" :key="firm.id">
                    <td>
                        {{ firm.id }}
                    </td>
                    <td>
                        {{ firm.name }}
                    </td>
                    <td>
                        {{ firm.email }}
                    </td>
                    <td>
                        {{ firm.phone }}
                    </td>
                    <td>
                        {{ firm.created_at }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <Pagination :links="attempts.links"/>
    </div>
</template>

<script>
import DefaultLayout from "../../Layouts/DefaultLayout";
import Pagination from "../../Components/Pagination";

export default {
    name: "Index",
    components: {Pagination},
    layout: DefaultLayout,
    props: {
        attempts: {
            type: Object,
            default: null,
        },
    }
};
</script>
<style scoped></style>
