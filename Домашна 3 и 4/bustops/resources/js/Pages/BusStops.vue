<template>
    <div class="pt-2 pb-5 pt-md-5 px-lg-5">
        <div class="row">
            <div class="col col-12 col-lg-6 mb-4 mb-lg-0">
                <div class="text-center d-lg-none amatic-sc-font display-6 mb-5">
                    {{ __('Ги лоцираме сите постојки во Скопје за') }}<br/>
                    {{ __('да може да ја пронајдете најблиската до вас!') }}
                </div>
                <SearchBar :query="query"/>
                <button class="btn btn-danger btn-lg border-radius-12px mb-3 w-100" @click="getLocation">
                    {{ __('ПРИКАЖИ МОЈА ЛОКАЦИЈА') }}
                </button>
                <div class="p-3 bg-white bus-stops d-lg-block shadow-lg"
                     style="height: 35vw; overflow-y: scroll"
                     :class="{'d-none' : !this.query}">
                    <div v-if="!localBusStops.length" class="fs-1 text-danger line-height-normal fw-bold text-center">
                        Не постојат постојки според вашето пребарување!
                    </div>
                    <div v-for="bus_stop in localBusStops"
                         @click="selectedBusStop = bus_stop"
                         :class="{'bg-danger text-white' : !selectedBusStop || selectedBusStop.id !== bus_stop.id,
                         'border border-2 border-danger text-danger': selectedBusStop && selectedBusStop.id === bus_stop.id}"
                         class="bus-stops cursor-pointer d-flex flex-row align-items-start justify-content-between mb-2 p-3 fs-4">
                        <div class="d-flex align-items-start">
                            <div class="fw-bold me-2">
                                {{ bus_stop.number }}
                            </div>
                            <div class="line-height-normal">
                                {{ __(bus_stop.name) }}
                            </div>
                        </div>
                    </div>
                    <button @click="loadMore" v-if="pagination.next_page_url"
                            class="btn btn-lg w-100 btn-outline-danger border-radius-12px">
                        {{ __('Прикажи повеќе') }}
                    </button>
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
import SearchBar from "../Components/SearchBar";
import Map from "../Components/Map";

export default {
    name: "BusStops",
    layout: DefaultLayout,
    props: {
        bus_stops: Object,
        query: String
    },
    components: {
        Map,
        SearchBar,
    },
    data() {
        return {
            loadingMore: false,
            localBusStops: this.bus_stops.data,
            pagination: this.bus_stops,
            selectedBusStop: null,
            userLat: null,
            userLon: null
        }
    },
    methods: {
        // function for loading more bus stops
        async loadMore() {
            this.loadingMore = true;
            try {
                let res;
                // if a query exists, then send the request for loading more bus stops with the included query
                if (this.query) res = await axios.get(this.pagination.next_page_url + '&query=' + this.query)
                // if a query is not present, then load the next page of bus stops without any query
                else res = await axios.get(this.pagination.next_page_url)
                this.localBusStops = [...this.localBusStops, ...res.data.data]; // append the loaded bus stops to the existing array of bus stops
                this.pagination = res.data;
            } catch (err) {
                console.error(err)
            } finally {
                this.loadingMore = false;
            }
        },
        // function that returns the location of the user
        getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(this.showPosition);
            }
        },
        showPosition(position) {
            this.userLat = position.coords.latitude
            this.userLon = position.coords.longitude;
        }
    },
    computed: {
        // compute the latitude and longitude of the selected bus stop if one is selected
        lat_lon() {
            return [(this.selectedBusStop ? Number(this.selectedBusStop.lat) : 41.99479675293),
                (this.selectedBusStop ? Number(this.selectedBusStop.lon) : 21.43000793457)]
        },
        // compute the user location if the user gives permission to the application
        user_lat_lon() {
            return this.userLat && this.userLon ? [this.userLat, this.userLon] : [41.99479675293, 21.43000793457];
        }
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
</style>
