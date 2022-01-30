<template>
    <div class="pt-2 pb-5 pt-md-5 px-lg-5">
        <div class="row">
            <div class="col col-12 col-lg-6 mb-4 mb-lg-0">
                <div class="text-center d-lg-none amatic-sc-font display-6 mb-5">
                    {{ __('Ги лоцираме сите постојки во Скопје за') }}<br/>
                    {{ __('да може да ја пронајдете најблиската до вас!') }}
                </div>
                <form @submit.prevent="submit" class="form-floating mb-3 position-relative">
                    <input v-model="query" type="text" class="form-control" id="search"
                           placeholder=".">
                    <label for="search">{{ __('Пребарајте постојка') }}...</label>
                    <button type="submit" id="search-button"
                            class="btn btn-danger position-absolute top-50 fw-bold px-3 translate-middle-y">
                        {{ __('Пребарај') }}
                    </button>
                </form>
                <button class="btn btn-danger btn-lg border-radius-12px mb-3 w-100" @click="getLocation">
                    {{ __('ПРИКАЖИ МОЈА ЛОКАЦИЈА') }}
                </button>
                <div class="p-3 bg-white bus-stops d-lg-block shadow-lg"
                     style="height: 35vw; overflow-y: scroll"
                     :class="{'d-none' : !this.query}">
                    <div v-if="!localBusStops.length && !loading"
                         class="fs-1 text-danger line-height-normal fw-bold text-center">
                        Не постојат постојки според вашето пребарување!
                    </div>
                    <div v-else-if="loading" class="d-flex align-items-center justify-content-center">
                        <div class="spinner-border text-danger me-2 fs-4" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="fs-3 text-danger fw-bold">{{ __('Се вчитува') }}...</div>
                    </div>
                    <div v-else>
                        <div v-for="bus_stop in localBusStops"
                             @click="selectedBusStop = bus_stop">
                            <BusStopListItem :selected-bus-stop="selectedBusStop" :bus_stop="bus_stop"/>
                        </div>
                        <button @click="loadMore" v-if="!loading && next_page" :disabled="loadingMore"
                                class="btn btn-lg w-100 btn-outline-danger border-radius-12px d-flex align-items-center justify-content-center">
                            <div v-if="loadingMore" class="spinner-border text-danger me-2" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            {{ __('Прикажи повеќе') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="col col-12 col-lg-6">
                <Map :user-lat="userLat" :user-lon="userLon" :user_lat_lon="user_lat_lon" :lat_lon="lat_lon"
                     :selected-bus-stop="selectedBusStop"/>
            </div>
        </div>
    </div>
</template>

<script>
import DefaultLayout from "../Layout/DefaultLayout";
import axios from 'axios';
import Map from "../Components/Map";
import BusStopListItem from "../Components/BusStopListItem";

export default {
    name: "BusStops",
    layout: DefaultLayout,
    components: {
        BusStopListItem,
        Map,
    },
    data() {
        return {
            loadingMore: false,
            localBusStops: [],
            loading: false,
            selectedBusStop: null,
            userLat: null,
            userLon: null,
            page: 0,
            query: this.getParameterByName('query'),
            next_page: false
        }
    },
    methods: {
        async sendApiCall(query = "", page = 0, loadMore = false) {
            await axios.get("https://bus-stops-loader.herokuapp.com/api/busStops?page=" + page + "&query=" + query)
                .then(response => {
                    this.localBusStops = loadMore ? [...this.localBusStops, ...response.data.busses] : response.data.busses
                    this.next_page = response.data.hasNext
                    this.page = response.data.currentPage
                })
        },
        async loadMore() {
            if (!this.next_page) return;
            this.loadingMore = true
            this.page++
            await this.sendApiCall(this.query, this.page, true)
            this.loadingMore = false
        },
        async submit() {
            this.loading = true
            this.$inertia.get(this.$route('bus_stops.index', {query: this.query}))
            await this.sendApiCall(this.query)
            this.loading = false
        },
        getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(this.showPosition);
            }
        },
        showPosition(position) {
            this.userLat = position.coords.latitude
            this.userLon = position.coords.longitude;
        },
        getParameterByName(name, url = window.location.href) {
            name = name.replace(/[\[\]]/g, '\\$&');
            const regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                results = regex.exec(url);
            if (!results || !results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, ' '));
        }
    },
    computed: {
        lat_lon() {
            return [(this.selectedBusStop ? Number(this.selectedBusStop.lat) : 41.99479675293),
                (this.selectedBusStop ? Number(this.selectedBusStop.lon) : 21.43000793457)]
        },
        user_lat_lon() {
            return this.userLat && this.userLon ? [this.userLat, this.userLon] : [41.99479675293, 21.43000793457];
        }
    },
    async mounted() {
        this.loading = true
        await this.sendApiCall(this.query)
        this.loading = false
    }
}
</script>

<style scoped>
.border-radius-12px {
    border-radius: 12px;
}

.bus-stops {
    border-radius: 18px;
}

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
