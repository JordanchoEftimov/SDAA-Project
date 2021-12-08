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
                <div class="p-3 bg-white bus-stops d-none d-lg-block"
                     style="height: 35vw; overflow-y: scroll">
                    <div v-for="bus_stop in localBusStops"
                         class="bus-stops bg-danger text-white d-flex flex-row align-items-start justify-content-between mb-2 p-3 fs-4">
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
                <iframe width="100%" height="520" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                        src="https://www.openstreetmap.org/export/embed.html?bbox=21.459109783172607%2C42.00011784898377%2C21.46361589431763%2C42.00317145931405&amp;layer=mapnik"
                        style="border: 1px solid black"></iframe>
            </div>
        </div>
    </div>
</template>

<script>
import DefaultLayout from "../Layout/DefaultLayout";
import axios from 'axios';

export default {
    name: "BusStops",
    layout: DefaultLayout,
    props: {
        bus_stops: Object,
        query: String
    },
    data() {
        return {
            loadingMore: false,
            localBusStops: this.bus_stops.data,
            pagination: this.bus_stops,
            search: this.$inertia.form({
                query: this.query,
            }),
        }
    },
    methods: {
        async loadMore() {
            this.loadingMore = true;
            try {
                const res = await axios.get(this.pagination.next_page_url + '&query=' + this.query)
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
    },
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
