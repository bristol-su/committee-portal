<template>
    <div>
        <div v-for="moduleInstance in event.module_instances">
            <a :href="url(event, moduleInstance)">
                <b-button variant="primary">
                    {{moduleInstance.name}}
                </b-button>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "portal",
        props: {
            event: {
                required: true,
                type: Object,
            },
            admin: {
                required: true,
                type: Boolean
            }
        },
        methods: {
            url(event, moduleInstance) {
                return '/'
                    + event.slug
                    + '/'
                    + moduleInstance.slug
                    + (this.admin?'/admin':'');
            }
        }
    }
</script>

<style scoped>

</style>