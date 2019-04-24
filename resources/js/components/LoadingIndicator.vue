<template>
    <div class="vld-parent">
        <loading :active.sync="loading"
                 :is-full-page="fullPage"></loading>
    </div>
</template>

<script>
    // Import component
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';

    export default {
        components: {
            Loading
        },

        computed: {
            loading() {
                return window.loading.loading;
            },

            fullPage() {
                return window.loading.fullPage;
            }
        }
    }
</script>

<style scoped>

</style>