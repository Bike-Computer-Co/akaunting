<template>
    <div>
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h4>Апликации за ваучер</h4>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Име</th>
                    <th>Е-пошта</th>
                    <th>Телефон</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="applicant in giftCodeApplicants.data" :key="applicant.id">
                    <td>
                        {{ applicant.id }}
                    </td>
                    <td>
                        {{ applicant.name_surname }}
                    </td>
                    <td>
                        {{ applicant.email }}
                    </td>
                    <td>
                        {{ applicant.phone_number }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <Pagination :links="giftCodeApplicants.links"/>
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
        giftCodeApplicants: {
            type: Object,
            default: null,
        },
    }
};
</script>
<style scoped></style>
