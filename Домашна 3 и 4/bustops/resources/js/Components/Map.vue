<template>
    <l-map style="height: 580px" :zoom="zoom" :center="lat_lon">
        <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
        <l-marker v-if="selectedBusStop" :lat-lng="lat_lon" :icon="icon()">
            <l-popup v-if="selectedBusStop.number" v-html="selectedBusStop.number">
                <b></b>
            </l-popup>
        </l-marker>
        <l-marker v-if="userLat && userLon" :lat-lng="user_lat_lon" :icon="icon()">
        </l-marker>
        <l-polyline v-if="selectedBusStop && userLon && userLat" :lat-lngs="[user_lat_lon, lat_lon]"
                    :color="'#DD4141'"></l-polyline>
    </l-map>
</template>

<script>
import {LMap, LMarker, LPopup, LTileLayer} from "vue2-leaflet";
import {Icon} from "leaflet";

export default {
    name: "Map",
    components: {
        LMap,
        LTileLayer,
        LMarker,
        LPopup
    },
    data() {
        return {
            url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            attribution:
                '&copy; <a target="_blank" href="http://osm.org/copyright">OpenStreetMap</a> contributors',
            zoom: 11,
        }
    },
    props: {
        userLat: Number,
        userLon: Number,
        user_lat_lon: Array,
        lat_lon: Array,
        selectedBusStop: Object
    },
    methods: {
        icon() {
            return new Icon({
                iconUrl: '/images/marker-icon.png',
                shadowUrl: '/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
        },
    }
}
</script>

<style scoped>

</style>
