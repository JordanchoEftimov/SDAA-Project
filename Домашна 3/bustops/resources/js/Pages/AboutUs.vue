<template>
    <div class="pt-2 pb-5 pt-md-5 px-lg-5">
        <div class="row mb-3">
            <div class="col col-12 col-lg-6 mt-5 order-1 order-lg-0">
                <div class="display-2 amatic-sc-font mb-3 mt-lg-5">
                    {{ __('Кои сме ние?') }}
                </div>
                <div class="fs-4 d-none d-lg-block">
                    {{ __('Ние сме група од млади студенти кои') }}<br/>
                    {{ __('сакаат да Ви овозможат полесно,') }}<br/>
                    {{ __('поедноставно и побрзо организирање') }}<br/>
                    {{ __('на превоз со автобусите на ЈСП низ') }}<br/>
                    {{ __('град Скопје.') }}
                </div>
                <div class="fs-6 d-lg-none">
                    {{ __('Ние сме група од млади студенти кои') }}<br/>
                    {{ __('сакаат да Ви овозможат полесно,') }}<br/>
                    {{ __('поедноставно и побрзо организирање') }}<br/>
                    {{ __('на превоз со автобусите на ЈСП низ') }}<br/>
                    {{ __('град Скопје.') }}
                </div>
            </div>
            <div class="col col-12 col-lg-6 order-0 order-lg-1">
                <div class="display-2 amatic-sc-font mb-3 text-end">
                    {{ __('Нешто повеќе за Bustops') }}
                </div>
                <div class="text-end fs-4 d-none d-lg-block">
                    {{ __('Намената на нашата апликација е да им') }}<br/>
                    {{ __('овозможи на корисниците побрзо') }}<br/>
                    {{ __('пребарување на сите постојки со цел полесно') }}<br/>
                    {{ __('користење на ЈСП услугите.') }}
                </div>
                <div class="text-end fs-6 d-lg-none">
                    {{ __('Намената на нашата апликација е да им') }}<br/>
                    {{ __('овозможи на корисниците побрзо') }}<br/>
                    {{ __('пребарување на сите постојки со цел полесно') }}<br/>
                    {{ __('користење на ЈСП услугите.') }}
                </div>
            </div>
        </div>
        <div class="d-flex flex-row flex-nowrap align-items-center">
            <div v-for="(member, i) in members" :key="i" class="p-md-2">
                <img class="img-fluid mb-1" :src="'/images/avatars/' + member.avatar" alt="Avatar"/>
                <div class="fs-6 text-center line-height-normal">{{ __(member.name) }}</div>
            </div>
        </div>
    </div>
</template>

<script>
import DefaultLayout from "../Layout/DefaultLayout";

export default {
    name: "AboutUs",
    layout: DefaultLayout,
    data() {
        return {
            members: [
                {
                    avatar: 'natali.png',
                    name: 'Натали Варга'
                },
                {
                    avatar: 'nevena.png',
                    name: 'Невена Кимова'
                },
                {
                    avatar: 'jocka.png',
                    name: 'Јорданчо Ефтимов'
                },
                {
                    avatar: 'ivana.png',
                    name: 'Ивана Георгиева'
                },
                {
                    avatar: 'martina.png',
                    name: 'Мартина Арсеска'
                },
            ]
        }
    }
}
</script>

<style scoped>

</style>
