<template>
    <div class="pt-2 pb-5 px-lg-5">
        <div class="text-end fs-1 amatic-sc-font d-lg-none mb-5">
            Доколку имате било каков проблем,<br/>
            Ве молиме пријавете!
        </div>
        <div class="row">
            <div class="col col-12 col-md-7 col-lg-6">
                <div class="display-2 amatic-sc-font text-center mb-2 d-none d-lg-block">
                    Пријави проблем
                </div>
                <div class="display-6 text-center mb-2 d-lg-none">
                    Пријави проблем
                </div>
                <form class="border-radius-10px bg-white p-3 p-md-4">
                    <input class="form-control form-control-lg mb-4" type="text" placeholder="Име">
                    <input class="form-control form-control-lg mb-4" type="text" placeholder="Презиме">
                    <input class="form-control form-control-lg mb-4" type="text" placeholder="Е-маил">
                    <textarea class="form-control mb-4" placeholder="Опис на проблемот"></textarea>
                    <div class="text-end">
                        <button class="btn btn-lg px-3 btn-danger border-radius-10px">
                            Испрати
                        </button>
                    </div>
                </form>
            </div>
            <div class="col col-md-5 col-lg-6 d-none d-md-block text-center">
                <img src="/images/report-image.png" alt="Image of a man" height="700"/>
            </div>
        </div>
    </div>
</template>

<script>
import DefaultLayout from "../Layout/DefaultLayout";

export default {
    name: "ReportProblem",
    layout: DefaultLayout
}
</script>

<style scoped>
.border-radius-10px {
    border-radius: 10px;
}

textarea {
    min-height: 200px;
    max-height: 200px;
}

input, textarea {
    background: #c7c4c4;
}

textarea::-webkit-input-placeholder {
    font-size: 24px;
    line-height: 1;
}
</style>
