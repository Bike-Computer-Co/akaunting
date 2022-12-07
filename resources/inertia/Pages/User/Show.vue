<template>
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4>
                Корисник: {{ user.name }}
            </h4>
            <Link class="btn btn-primary" :href="$route('super.users.index')">
                Назад
            </Link>
        </div>
        <div class="row">
            <div class="col col-12 col-md-6">
                <h5>
                    Основни информации
                </h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>
                                Лабела
                            </th>
                            <th>
                                Вредност
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>
                                Име и презиме:
                            </th>
                            <td>
                                {{ user.name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Е-пошта:
                            </th>
                            <td>
                                {{ user.email }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Последен пат се најавил:
                            </th>
                            <td v-if="user.last_logged_in_at">
                                {{ user.last_logged_in_at | moment('ll') }}
                            </td>
                            <td v-else>
                                Никогаш
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div v-for="company in user.companies" :key="company.id" class="col col-12 col-md-6">
                <h5>Информации за компании на овој корисник</h5>
                <div class="table-responsive mb-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <h6 class="text-nowrap">
                            Компанија: {{ company.settings.find(a => a.key === 'company.name').value }}
                        </h6>
                        <button data-bs-toggle="modal" data-bs-target="#editCompanyModal"
                                :data-bs-company="JSON.stringify(company)" class="btn btn-primary btn-sm">
                            Измени
                        </button>
                    </div>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>
                                Лабела
                            </th>
                            <th>
                                Вредност
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>
                                Име на компанија:
                            </th>
                            <td>
                                {{ company.settings.find(a => a.key === 'company.name').value }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Држава на компанија:
                            </th>
                            <td>
                                {{ company.settings.find(a => a.key === 'company.country').value }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Е-пошта на компанија:
                            </th>
                            <td>
                                {{ company.settings.find(a => a.key === 'company.email').value }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Валута на компанија:
                            </th>
                            <td>
                                {{ company.settings.find(a => a.key === 'default.currency').value }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Цена за сметководител:
                            </th>
                            <td>
                                {{ company.accountant_price }} &euro;
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Цена за адвокат:
                            </th>
                            <td>
                                {{ company.lawyer_price }} &euro;
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Коментар од администратор:
                            </th>
                            <td>
                                {{ company.comment ? company.comment : 'Сеуште нема' }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <EditCompanyModal/>
    </div>
</template>

<script>
import DefaultLayout from "../../Layouts/DefaultLayout";
import EditCompanyModal from "../../Modals/EditCompanyModal";

export default {
    name: "Show",
    components: {EditCompanyModal},
    layout: DefaultLayout,
    props: {
        user: {
            type: Object,
            default: null
        }
    }
}
</script>

<style scoped>

</style>
