<template>
    <form @submit.prevent="submit" class="form-floating mb-3 position-relative">
        <input v-model="search.query" type="text" class="form-control" id="search"
               placeholder=".">
        <label for="search">{{ __('Пребарајте постојка') }}...</label>
        <button type="submit" id="search-button"
                class="btn btn-danger position-absolute top-50 fw-bold px-3 translate-middle-y">
            {{ __('Пребарај') }}
        </button>
    </form>
</template>

<script>
export default {
    name: "SearchBar",
    props: {
        query: String
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
            }).get(this.$route('bus_stops.index'), {preserveScroll: true})
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
