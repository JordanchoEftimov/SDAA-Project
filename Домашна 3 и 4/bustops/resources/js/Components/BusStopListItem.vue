<template>
    <div
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
</template>

<script>
export default {
    name: "BusStopListItem",
    props: {
        selectedBusStop: Object,
        bus_stop: Object
    }
}
</script>

<style scoped>

</style>
