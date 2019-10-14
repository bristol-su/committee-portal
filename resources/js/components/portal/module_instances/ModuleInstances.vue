<template>
    <div>
        <div v-for="moduleInstance in event.module_instances">
            <a :href="url(event, moduleInstance)">
                <b-button variant="primary">
                    {{moduleInstance.name}}
                    <small>{{evaluationObject(moduleInstance.id)}}</small>
                </b-button>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ModuleInstances",
        props: {
            event: {
                required: true,
                type: Object,
            },
            admin: {
                required: true,
                type: Boolean
            },
            evaluation: {
                required: false,
                default() {
                    []
                }
            }
        },
        methods: {
            evaluationObject(id) {
                return (this.evaluation[id] !== undefined
                    ? this.evaluation[id]
                    : {
                        active: false,
                        visible: false,
                        mandatory: false,
                        complete: false
                    });
            },

            url(event, moduleInstance) {
                return (this.admin?'/a/':'/p/')
                    + event.slug
                    + '/'
                    + moduleInstance.slug;
            }
        }
    }
</script>

<style scoped>

</style>
