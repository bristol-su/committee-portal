<template>
    <div class="progress">
        <div class="progress-bar bg-success" role="progressbar" :style="{width: percentage+'%'}" :aria-valuenow="complete" :aria-valuemin="0" :aria-valuemax="mandatoryTotal">{{complete}} / {{mandatoryTotal}} ({{percentage}}%)</div>
    </div>

</template>

<script>
    export default {
        name: "ProgressBar.vue",

        props: {
            modules: {
                required: true,
                type: Array
            }
        },

        methods: {
            forReaffiliation(module) {
                if(module.header.index !== null) {
                    return module.header.index.includes('reaffiliation-') && module.visible ;
                }
                return false;
            }
        },


        computed: {
            percentage() {
                return Math.round((this.complete / this.mandatoryTotal ) * 100);
            },

            relevantModules()
            {
                return this.modules.filter(modules => this.forReaffiliation(modules));
            },

            complete() {
                return this.relevantModules.filter(module => module.complete).length;
            },

            mandatoryTotal() {
                return this.relevantModules.filter(module => module.mandatory).length;
            },

            total() {
                return this.relevantModules.length;
            }
        }
    }
</script>

<style scoped>

</style>