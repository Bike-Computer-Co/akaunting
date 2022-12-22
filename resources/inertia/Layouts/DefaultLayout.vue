<template>
    <main class="d-flex w-100">
        <div
            :class="{ 'sidebar-hidden': !sidebar }"
            class="sidebar position-relative"
        >
            <button
                class="text-white btn position-absolute end-0 d-lg-none"
                @click="sidebar = !sidebar"
            >
                <i class="fa fa-times fa-2x"></i>
            </button>
            <div class="d-flex flex-column p-3 bg-dark shadow-sm text-white">
                <Link
                    :href="$route('super.users.index')"
                    class="mb-3 link-dark text-decoration-none text-center"
                >
                    <img
                        class="mb-1"
                        src="/public/img/akaunting-logo-white.svg"
                        alt="Logo"
                        height="50"
                    />
                </Link>
                <hr />
                <ul class="nav nav-pills flex-column mb-auto">
                    <div v-for="item in menuOptions"
                         :key="item.name">
                        <li
                            v-if="item.can"
                            class="nav-item line-height-normal"
                            :class="{ 'd-none': item.hide }"
                        >
                            <Link
                                :href="$route(item.link)"
                                class="nav-link text-white"
                                :class="{ 'bg-primary' : $route().current(item.link) }"
                                aria-current="page"
                            >
                                <i class="fa" :class="item.icon"></i>
                                {{ item.name }}
                            </Link>
                        </li>
                    </div>
                </ul>
            </div>
        </div>
        <div class="main position-relative" :class="{ 'to-right': sidebar }">
            <div
                v-if="sidebar"
                class="main-overlay"
                @click="sidebar = !sidebar"
            ></div>
            <nav class="navbar navbar-dark bg-dark px-2 shadow">
                <div class="container-fluid">
                    <button
                        class="navbar-toggler d-lg-none"
                        :class="{ 'd-none': sidebar }"
                        type="button"
                        @click="sidebar = !sidebar"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <nav class="navbar navbar-dark bg-dark">
                        <span class="navbar-brand mb-0 h1"></span>
                    </nav>
                    <div class="nav navbar-nav navbar-right">
                        <div class="dropdown">
                            <a
                                id="dropdownUser2"
                                href="#"
                                class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle"
                                data-bs-display="static"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                <div
                                    class="rounded-circle me-2 bg-white d-flex align-items-center justify-content-center"
                                    style="width: 2rem; height: 2rem"
                                >
                                    <i class="fa fa-user"></i>
                                </div>
                                <strong class="d-none d-lg-block"></strong>
                            </a>
<!--                            <ul-->
<!--                                class="dropdown-menu dropdown-menu-end text-small shadow border-radius-18px"-->
<!--                                aria-labelledby="dropdownUser2"-->
<!--                            >-->
<!--                                <li class="fs-6">-->
<!--                                    <Link-->
<!--                                        :href="$route('home')"-->
<!--                                        class="dropdown-item"-->
<!--                                    >-->
<!--                                        <i class="fa fa-home me-2"></i>Врати се-->
<!--                                        на Почетна-->
<!--                                    </Link>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <Link-->
<!--                                        method="post"-->
<!--                                        as="button"-->
<!--                                        type="button"-->
<!--                                        :href="$route('logout')"-->
<!--                                        class="dropdown-item"-->
<!--                                    ><i class="fa fa-sign-out me-2"></i-->
<!--                                    >Одјави се-->
<!--                                    </Link>-->
<!--                                </li>-->
<!--                            </ul>-->
                        </div>
                    </div>
                </div>
            </nav>
            <div class="container px-md-5 mt-3 mb-5">
                <slot></slot>
            </div>
        </div>
    </main>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";

export default {
    name: "DefaultLayout",
    props: {
        menu: Object,
        can: Object
    },
    data() {
        return {
            sidebar: false,
            removeEvent: null,
            menuOptions: [
                {
                    name: 'Почетна',
                    icon: 'fa-home',
                    link: 'super.dashboard',
                    can: true
                },
                {
                    name: 'Корисници',
                    icon: 'fa-users',
                    link: 'super.users.index',
                    can: this.can.seeUsers
                },
                {
                    name: 'Компании',
                    icon: 'fa-building',
                    link: 'super.companies.index',
                    can: this.can.seeCompanies
                },
                {
                    name: 'Stripe планови',
                    icon: 'fa-money',
                    link: 'super.stripe-plans.index',
                    can: this.can.seeStripePlans
                },
                {
                    name: 'Вработени',
                    icon: 'fa-users',
                    link: 'super.employees.index',
                    can: this.can.seeEmployees
                },
                {
                    name: 'Регистрации на фирми',
                    icon: 'fa-building',
                    link: 'super.firm-registrations.index',
                    can: this.can.seeFirmRegistrations
                },
                {
                    name: 'Обиди за регистрација на фирма',
                    icon: 'fa-building',
                    link: 'super.firm-registration-attempts.index',
                    can: this.can.seeFirmRegistrationAttempts
                }
            ],
        };
    },
    mounted() {
        this.removeEvent = Inertia.on("start", (event) => {
            this.sidebar = false;
        });
    },
    beforeUnmount() {
        this.removeEvent();
    },
};
</script>

<style scoped>
i {
    width: 1.3rem;
    text-align: center;
}
</style>
