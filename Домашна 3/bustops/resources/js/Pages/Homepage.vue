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
                    {{ __('Можете да пребарувате помеѓу') }} {{ bus_stops_count }} {{ __('достапни постојки') }}.
                </div>
                <div class="pe-lg-5">
                    <form @submit.prevent="submit" class="form-floating mb-3 position-relative">
                        <input v-model="search.query" type="text" class="form-control" id="search"
                               placeholder=".">
                        <label for="search">{{ __('Пребарајте постојка') }}...</label>
                        <button type="submit" id="search-button"
                                class="btn btn-danger position-absolute top-50 fw-bold px-3 translate-middle-y">
                            {{ __('Пребарај') }}
                        </button>
                    </form>
                </div>
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

export default {
    name: "Homepage",
    layout: DefaultLayout,
    props: {
        bus_stops_count: Number
    },
    data() {
        return {
            search: this.$inertia.form({
                query: this.query,
            }),
        }
    },
    methods: {
        submit() {
            this.search.transform(a => {
                const data = {...a}
                Object.keys(data).forEach(b => {
                    if (!data[b]) delete data[b]
                })
                return data
            }).get(this.$route('bus_stops.index'), {preserveScroll: false})
        },
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
