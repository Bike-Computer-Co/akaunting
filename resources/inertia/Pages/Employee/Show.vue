<template>
    <div class="container">
        <h4 class="mb-3">
            Вработен: {{ employee.first_name }} {{ employee.last_name }}
        </h4>
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
    }
}
</script>

<style scoped>

</style>
