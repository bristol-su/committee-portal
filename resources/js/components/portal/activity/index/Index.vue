<template>
    <div>
        <b-tabs content-class="mt-3">
            <b-tab title="Participant">
                TestP
<!--                <activities-->
<!--                :activities="participantActivities"-->
<!--                :admin="false">-->
<!---->
<!--                </activities>-->
            </b-tab>
            <b-tab title="Administrator" active>
                Test
<!--                <activities-->
<!--                    :activities="adminActivities"-->
<!--                    :admin="true">-->
<!---->
<!--                </activities>-->
            </b-tab>
        </b-tabs>
    </div>
</template>

<script>
    import Activities from './show/Activities';
    export default {
        name: "Index",
        components: {Activities},
        props: {
            adminActivities: {
                type: Object,
                required: true
            },
            participantActivities: {
                type: Object,
                required: true
            }
        },

        data() {
            return {}
        },

        methods: {},

        computed: {}
    }
</script>

<style scoped>

</style>
