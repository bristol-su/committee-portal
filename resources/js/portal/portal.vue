<template>
    <div>
        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 style="text-align: center">{{event.name}}</h2>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-3">
                        <b-list-group>
                            <b-list-group-item
                            v-for="loopEvent in events"
                            :key="loopEvent.id"
                            @click="event = loopEvent">
                                {{loopEvent.name}}
                            </b-list-group-item>
                        </b-list-group>
                    </div>
                    <div class="col-md-9">
                        <div v-for="moduleInstance in event.module_instances">
                            <b-button variant="primary">
                                {{moduleInstance.name}}
                            </b-button>
                        </div>
                    </div>
                </div>
                <br/>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "portal",
        props: {
            events: {
                required: true,
                type: Array
            }
        },

        data() {
            return {
                event: null
            }
        },

        created() {
            this.event = this.events[0];
        }
    }
</script>

<style scoped>

</style>