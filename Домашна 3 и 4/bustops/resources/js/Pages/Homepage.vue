<template>
    <div class="pt-2 pb-5 pt-md-5 px-lg-5">
        <div class="row">
            <div class="col col-12 col-lg-6 mb-5 mb-lg-0">
                <div class="display-1 amatic-sc-font text-center text-lg-start pt-md-4 mb-5 mb-lg-3">
                    {{ __('Пребарајте постојка') }},<br/>
                    {{ __('бидете на време!') }}
                </div>
                <div class="fs-3 line-height-normal d-none d-lg-block mb-5">
                    {{ __('Ги лоцираме сите постојки во Скопје') }}<br/>
                    {{ __('за да може да ја пронајдете најблиската до вас!') }}<br/><br/>
                    {{ __('Можете да пребарувате помеѓу') }}
                    <span v-if="!loading">{{ bus_stops_count }}</span>
                    <span class="fst-italic" v-else>{{ __('Се вчитува').toLowerCase() }}</span>
                    {{ __('достапни постојки') }}.
                </div>
                <form @submit.prevent="submit" class="pe-lg-5">
                    <div class="form-floating mb-3 position-relative">
                        <input v-model="query" type="text" class="form-control" id="search"
                               placeholder=".">
                        <label for="search">{{ __('Пребарајте постојка') }}...</label>
                        <button type="submit" id="search-button"
                                class="btn btn-danger position-absolute top-50 fw-bold px-3 translate-middle-y">
                            {{ __('Пребарај') }}
                        </button>
                    </div>
                </form>
            </div>
            <div class="col col-12 col-lg-6">
                <div class="text-center d-lg-none homepage-logo">
                    <img src="/images/logo.png" alt="Logo" width="250"/>
                </div>
                <div class="d-none d-lg-block">
                    <img src="/images/bus.png" alt="Bus image" width="700"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import DefaultLayout from "../Layout/DefaultLayout";
import axios from "axios";

export default {
    name: "Homepage",
    layout: DefaultLayout,
    data() {
        return {
            query: '',
            bus_stops_count: 0,
            loading: false
        }
    },
    methods: {
        submit() {
            this.$inertia.get(this.$route('bus_stops.index', {query: this.query}))
        }
    },
    async mounted() {
        this.loading = true
        await axios.get("https://bus-stops-loader.herokuapp.com/api/busStops")
            .then(response => (this.bus_stops_count = response.data.totalItems))
        this.loading = false
    }
}
</script>
<style scoped>
#search {
    border: 1px solid rgba(0, 0, 0, 0.82);
    box-sizing: border-box;
    border-radius: 160px;
}

#search-button {
    border-radius: 10px;
    right: 1rem;
}
</style>
