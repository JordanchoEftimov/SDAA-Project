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
                    <SearchBar/>
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
import SearchBar from "../Components/SearchBar";

export default {
    name: "Homepage",
    components: {SearchBar},
    layout: DefaultLayout,
    props: {
        bus_stops_count: Number
    },
}
</script>
