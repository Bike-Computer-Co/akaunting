<template>
    <div class="container">
        <h4 class="mb-3">
            Вработен: {{ employee.first_name }} {{ employee.last_name }}
        </h4>
        <div class="table-responsive mb-5">
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
                        Име:
                    </th>
                    <td>
                        {{ employee.first_name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Презиме:
                    </th>
                    <td>
                        {{ employee.last_name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Матичен број:
                    </th>
                    <td>
                        {{ employee.personal_number }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Датум на раѓање:
                    </th>
                    <td>
                        {{ employee.birth_date }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Трансакциска сметка:
                    </th>
                    <td>
                        {{ employee.bank_account }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Адреса:
                    </th>
                    <td>
                        {{ employee.address }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Тел. број:
                    </th>
                    <td>
                        {{ employee.phone }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Е-пошта:
                    </th>
                    <td>
                        {{ employee.email }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Нето Плата:
                    </th>
                    <td>
                        {{ employee.salary }} ден.
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <h5>
            Историја на пријавување/одјавување
        </h5>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th>Тип</th>
                    <th>Датум на пријавување/одјавување</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="history in employee.employment_histories">
                    <td>
                        {{ history.type === SIGN_UP ? 'Пријавување' : 'Одјавување' }}
                    </td>
                    <td>
                        {{ history.employment_history_date }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import DefaultLayout from "../../Layouts/DefaultLayout";

export default {
    name: "Show",
    layout: DefaultLayout,
    props: {
        employee: {
            type: Object,
            default: null
        }
    },
    data() {
        return {
            SIGN_UP: 0,
            SIGN_OUT: 1
        }
    }
}
</script>

<style scoped>

</style>
