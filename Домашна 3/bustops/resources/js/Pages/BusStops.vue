<template>
    <div class="pt-2 pb-5 pt-md-5 px-lg-5">
        <div class="row">
            <div class="col col-12 col-lg-6 mb-4 mb-lg-0">
                <div class="text-center d-lg-none amatic-sc-font display-6 mb-5">
                    Ги лоцираме сите постојки во Скопје за<br/>да може да ја пронајдете најблиската до вас!
                </div>
                <form @submit.prevent="submit" class="form-floating mb-3 position-relative">
                    <input v-model="search.query" type="text" class="form-control" id="search"
                           placeholder="Пребарајте постојка...">
                    <label for="search">Пребарајте постојка...</label>
                    <button type="submit" id="search-button"
                            class="btn btn-danger position-absolute top-50 fw-bold px-3 translate-middle-y">
                        Пребарај
                    </button>
                </form>
                <div class="p-3 bg-white bus-stops d-lg-block shadow shadow-lg"
                     style="height: 35vw; overflow-y: scroll"
                     :class="{'d-none' : !this.query}">
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
                                {{ bus_stop.name }}
                            </div>
                        </div>
                    </div>
                    <button @click="loadMore" v-if="pagination.next_page_url"
                            class="btn btn-lg w-100 btn-outline-danger border-radius-12px">
                        Прикажи повеќе
                    </button>
                </div>
            </div>
            <div class="col col-12 col-lg-6">
                <l-map style="height: 580px" :zoom="zoom" :center="lat_lon">
                    <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
                    <l-marker v-if="selectedBusStop" :lat-lng="lat_lon" :icon="icon()">
                        <l-popup v-if="selectedBusStop.number" v-html="selectedBusStop.number">
                            <b></b>
                        </l-popup>
                    </l-marker>
                </l-map>
            </div>
        </div>
    </div>
</template>

<script>
import DefaultLayout from "../Layout/DefaultLayout";
import axios from 'axios';
import {LMap, LTileLayer, LMarker, LPopup} from 'vue2-leaflet';
import {Icon} from 'leaflet';

export default {
    name: "BusStops",
    layout: DefaultLayout,
    props: {
        bus_stops: Object,
        query: String
    },
    components: {
        LMap,
        LTileLayer,
        LMarker,
        LPopup
    },
    data() {
        return {
            loadingMore: false,
            localBusStops: this.bus_stops.data,
            pagination: this.bus_stops,
            search: this.$inertia.form({
                query: this.query,
            }),
            selectedBusStop: null,
            url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            attribution:
                '&copy; <a target="_blank" href="http://osm.org/copyright">OpenStreetMap</a> contributors',
            zoom: 15,
        }
    },
    methods: {
        async loadMore() {
            this.loadingMore = true;
            try {
                let res;
                if (this.query)
                    res = await axios.get(this.pagination.next_page_url + '&query=' + this.query)
                else res = await axios.get(this.pagination.next_page_url)
                this.localBusStops = [...this.localBusStops, ...res.data.data];
                this.pagination = res.data;
            } catch (err) {
                console.error(err)
            } finally {
                this.loadingMore = false;
            }
        },
        submit() {
            this.search.transform(a => {
                const data = {...a}
                Object.keys(data).forEach(b => {
                    if (!data[b]) delete data[b]
                })
                return data
            }).get(this.$route('bus_stops.index'), {preserveScroll: true})
        },
        icon() {
            return new Icon({
                iconUrl: '/images/marker-icon.png',
                shadowUrl: '/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
        }
    },
    computed: {
        lat_lon() {
            return [(this.selectedBusStop ? Number(this.selectedBusStop.lat) : 41.99479675293),
                (this.selectedBusStop ? Number(this.selectedBusStop.lon) : 21.43000793457)]
        }
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

.border-radius-12px {
    border-radius: 12px;
}

.bus-stops {
    border-radius: 18px;
}
</style>
