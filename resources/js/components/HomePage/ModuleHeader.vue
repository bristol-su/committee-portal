<template>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <b>{{header.header}}</b>
            </h5>
            <h6 class="card-subtitle my-2 text-muted">{{header.subtitle}}</h6>

            <div class="row">
                <module-button
                        :key="module.alias"
                        :module="module"
                        v-for="module in modules">
                </module-button>
            </div>
        </div>
    </div>
</template>

<script>
    import ModuleButton from './ModuleButton';

    export default {
        components: {
            ModuleButton
        },

        props: {
            header: {
                required: true,
                type: Object
            },

            modules: {
                required: true,
                type: Array
            }
        }
    }
</script>

<style scoped>

</style>