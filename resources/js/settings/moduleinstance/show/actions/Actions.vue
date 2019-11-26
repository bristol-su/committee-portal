<template>
    <div>
        <b-row>
            <b-col>
                <b-card v-for="action in actions" :key="action.id" :title="action.name" :sub-title="action.description">
                    <b-card-text>
                        History coming soon
                    </b-card-text>

                    <a href="#" class="card-link"></a>
                </b-card>
            </b-col>
        </b-row>

        <b-row>
            <b-col style="text-align: right; padding-right: 10px;">
                <a :href="'/activity/' + moduleInstance.activity.id + '/module-instance/' + moduleInstance.id + '/action/create'">
                    <b-button variant="secondary">Add an Action</b-button>
                </a>
            </b-col>
        </b-row>

    </div>
</template>

<script>
    export default {
        name: "Actions",

        props: {
            moduleInstance: {
                required: true,
                type: Object,
            }
        },

        data() {
            return {}
        },

        methods: {},

        computed: {
            actions() {
                return this.moduleInstance.action_instances;
            }
        }
    }
</script>

<style scoped>

</style>
