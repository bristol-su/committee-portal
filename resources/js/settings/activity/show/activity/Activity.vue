<template>
    <div>
        <data-item title="Name">
            {{activity.name}}
        </data-item>
        <data-item title="Description">
            {{activity.description}}
        </data-item>
        <data-item title="Url">
            <a :href="url">{{url}}</a>
        </data-item>
        <data-item title="Active">
            <active :start="activity.start_date" :end="activity.end_date">

            </active>
        </data-item>
    </div>
</template>

<script>
    import DataItem from "../../../../utilities/DataItem";
    import Active from "./Active";
    export default {
        name: "Activity",
        components: {Active, DataItem},
        props: {
            activity: {
                required: true,
                type: Object
            }
        },

        computed: {
            url() {
                return process.env.MIX_APP_URL + '/' + this.activity.slug;
            }
        }
    }
</script>

<style scoped>

</style>
