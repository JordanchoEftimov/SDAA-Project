<template>
    <div class="ml-4">
        <Link :href="$route('language', [selectable_locale])">
            <MacedonianFlag v-if="selectable_locale === 'mk'" style="width: 3rem !important;"/>
            <USAFlag v-else style="width: 3rem !important;"/>
        </Link>
    </div>
</template>

<script>
import MacedonianFlag from "./MacedonianFlag";
import USAFlag from "./USAFlag";

export default {
    name: "LanguageSelector",
    components: {USAFlag, MacedonianFlag},
    computed: {
        selectable_locale() {
            return this.$page.props.locale === 'mk' ? 'en' : 'mk'
        }
    },
}
</script>

<style scoped>
</style>
