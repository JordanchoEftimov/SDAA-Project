<template>
    <div class="pt-2 pb-5 px-lg-5">
        <div class="text-end fs-1 amatic-sc-font d-lg-none mb-5">
            {{ __('Доколку имате било каков проблем') }},<br/>
            {{ __('Ве молиме пријавете!') }}
        </div>
        <div class="row">
            <div class="col col-12 col-md-7 col-lg-6">
                <div class="display-2 amatic-sc-font text-center mb-2 d-none d-lg-block">
                    {{ __('Пријави проблем') }}
                </div>
                <div class="display-6 text-center mb-2 d-lg-none">
                    {{ __('Пријави проблем') }}
                </div>
                <form @submit.prevent="submit" class="border-radius-10px bg-white p-3 p-md-4">
                    <div class="mb-4 form-floating">
                        <input id="name" :class="{'is-invalid': form.errors.name}" v-model="form.name"
                               class="form-control form-control-lg" type="text" placeholder="Име">
                        <label for="name">{{ __('Име') }}</label>
                        <div class="invalid-feedback">{{ form.errors.name }}</div>
                    </div>
                    <div class="mb-4 form-floating">
                        <input id="surname" :class="{'is-invalid': form.errors.surname}" v-model="form.surname"
                               class="form-control form-control-lg" type="text"
                               placeholder="Презиме">
                        <label for="surname">{{ __('Презиме') }}</label>
                        <div class="invalid-feedback">{{ form.errors.surname }}</div>
                    </div>
                    <div class="mb-4 form-floating">
                        <input id="email" :class="{'is-invalid': form.errors.email}" v-model="form.email"
                               class="form-control form-control-lg" type="text"
                               placeholder="Е-маил">
                        <label for="email">{{ __('Е-маил') }}</label>
                        <div class="invalid-feedback">{{ form.errors.email }}</div>
                    </div>
                    <div class="mb-4 form-floating">
                        <textarea id="description" :class="{'is-invalid': form.errors.description}"
                                  v-model="form.description"
                                  class="form-control"
                                  placeholder="Опис на проблемот"></textarea>
                        <label for="description">{{ __('Опис на проблемот') }}</label>
                        <div class="invalid-feedback">{{ form.errors.description }}</div>
                    </div>

                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <div v-if="successful" class="text-success fs-5 line-height-normal text-end mb-4">
                                {{ __('Успешно го пријавивте проблемот!') }}
                            </div>
                        </div>
                        <button type="submit" class="btn btn-lg px-3 btn-danger border-radius-10px">
                            {{ __('Испрати') }}
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
    layout: DefaultLayout,
    data() {
        return {
            form: this.$inertia.form({
                name: '',
                surname: '',
                email: '',
                description: ''
            }),
            successful: false
        }
    },
    methods: {
        submit() {
            this.form.post(this.$route('report.store'), {
                onSuccess: () => {
                    this.form.reset();
                    this.successful = true
                    setTimeout(() => this.successful = false, 4000);
                }
            });
        }
    }
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
