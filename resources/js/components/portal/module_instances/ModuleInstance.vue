<template>
    <a :href="url">
        <b-button variant="primary" class="module-instance" :disabled="inactive" :class="{hidden: hidden, mandatory: mandatory}">
            {{moduleInstance.name}} {{evaluation}}
        </b-button>
    </a>

</template>

<script>
    export default {
        name: "ModuleInstance",

        props: {
            moduleInstance: {
                required: true,
                type: Object
            },
            evaluation: {
                required: true,
                type: Object
            },
            activity: {
                required: true,
                type: Object
            },
            admin: {
                required: true,
                type: Boolean
            }
        },

        computed: {
            url() {
                return (this.admin?'/a/':'/p/')
                    + this.activity.slug
                    + '/'
                    + this.moduleInstance.slug
                    + '/'
                    + this.moduleInstance.alias;
            },
            inactive() {
                return !this.evaluation.active;
            },
            hidden() {
                return !this.evaluation.visible;
            },
            mandatory() {
                return this.evaluation.mandatory;
            }
        }
    }
</script>

<style scoped>
    .module-instance.mandatory {
        background-color: red;
    }

    .module-instance.hidden {
        display: none;
    }
</style>
