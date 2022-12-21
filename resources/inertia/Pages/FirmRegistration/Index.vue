<template>
    <div>
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h4>Регистрации на фирми</h4>
            <Link
                :href="$route('super.firm-registrations.create')"
                class="btn btn-primary px-3"
            >Додади нова
            </Link>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Име на основач</th>
                    <th>Име на фирма</th>
                    <th>Датум на апликација</th>
                    <th>Акции</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="firm in firmRegistrations.data" :key="firm.id">
                    <td>
                        {{ firm.id }}
                    </td>
                    <td>
                        {{ firm.founder_name }}
                    </td>
                    <td>
                        {{ firm.firm_name }}
                    </td>
                    <td>
                        {{ firm.created_at }}
                    </td>
                    <td>
                        <Link
                            :href="$route('super.firm-registrations.show', firm.id)"
                            class="btn btn-sm btn-primary px-3 me-1"
                        >
                            <i class="fa fa-eye"></i> Види
                        </Link>
                        <Link
                            :href="$route('super.firm-registrations.edit', firm.id)"
                            class="btn btn-sm btn-success px-3 me-1"
                        >
                            <i class="fa fa-pencil"></i> Измени
                        </Link>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <Pagination :links="firmRegistrations.links" />
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
        firmRegistrations: {
            type: Object,
            default: null,
        },
    }
};
</script>
<style scoped></style>
