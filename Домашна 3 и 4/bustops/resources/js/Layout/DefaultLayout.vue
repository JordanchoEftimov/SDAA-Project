<template>
    <div class="bg-pink position-relative">
        <div class="position-absolute red-circle"></div>
        <div class="container position-relative">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid d-flex align-items-start pt-3">
                    <Link class="navbar-brand" href="/">
                        <img
                            :class="{'d-none d-lg-inline-block': $page.component === 'Homepage'}"
                            src="/images/logo.png"
                            alt="Logo"/>
                    </Link>
                    <div class="d-flex flex-row align-items-center mb-2 mb-lg-0">
                        <div class="d-lg-none me-3">
                            <LanguageSelector/>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent" ref="collapse"
                         @click="collapse.hide()">
                        <div class="me-auto"></div>
                        <div class="d-flex flex-column flex-lg-row align-items-lg-center">
                            <Link v-for="route in routes" :key="route.name"
                                  :class="{'active': route.component === $page.component}"
                                  :href="route.link"
                                  class="nav-item me-lg-3 px-4 py-1 mb-2 mb-lg-0" as="button"
                                  type="button">{{ __(route.name) }}
                            </Link>
                            <div class="d-none d-lg-block">
                                <LanguageSelector/>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <slot></slot>
        </div>
        <footer class="py-3 py-lg-5 px-2 px-md-5">
            <div class="hr mb-1"></div>
            <div class="d-flex flex-row align-items-center justify-content-between">
                <div class="fs-7">{{ __('Скопје 1000') }}</div>
                <div class="fs-7">{{ __('© 2021 Bustops, сите права се заштитени.') }}</div>
            </div>
        </footer>
    </div>
</template>

<script>
import {Collapse} from "bootstrap";
import LanguageSelector from "../Components/LanguageSelector";

export default {
    name: "DefaultLayout",
    components: {LanguageSelector},
    data() {
        return {
            collapse: null,
            routes: [
                {
                    name: 'Почетна',
                    link: '/',
                    component: 'Homepage'
                },
                {
                    name: 'Постојки',
                    link: this.$route('bus_stops.index'),
                    component: 'BusStops'
                },
                {
                    name: 'За Нас',
                    link: this.$route('about_us'),
                    component: 'AboutUs'
                },
                {
                    name: 'Помош',
                    link: this.$route('report.create'),
                    component: 'ReportProblem'
                },
            ]
        }
    },
    mounted() {
        this.collapse = new Collapse(this.$refs.collapse, {toggle: false});
    }
}
</script>

<style scoped>
.bg-pink {
    background: #FBEFEF;
}

.nav-item {
    border-radius: 17px;
    font-size: 1.5rem;
    opacity: 0.5;
    background: #C4C4C4;
}

.active {
    background: white !important;
    opacity: 0.8 !important;
}

footer {
    background: #C9C9C9;
}

.hr {
    border: 1px solid rgba(0, 0, 0, 0.42);
}

.fs-7 {
    font-size: 0.7rem;
}
</style>
