<template>
    <div style="display: flex;">
    <div class="progress" style="width: 100%;">
        <div
            class="progress-bar bg-success"
            role="progressbar"
            :style="{width: percentage+'%'}"
            :aria-valuenow="complete"
            :aria-valuemin="0"
            :aria-valuemax="mandatoryTotal">
                {{module}}: {{complete}} / {{mandatoryTotal}} ({{percentage}}%)
            </div>
    </div>
    <div><i class="fa fa-refresh" @click="$emit('refresh')"></i></div>
    </div>
</template>

<script>
    export default {
        name: "ProgressBar.vue",

        props: {
            groups: {
                required: true,
                type: Array
            },
            module: {
                required: true,
                type: String
            }
        },

        computed: {
            percentage() {
                return Math.round((this.complete / this.mandatoryTotal ) * 100);
            },

            complete() {
                return this.groups.filter(group => group.completed).length;
            },

            mandatoryTotal() {
                return this.groups.filter(group => group.mandatory).length;
            },

            total() {
                return this.groups.length;
            }
        }
    }
</script>

<style scoped>
    .progress-bar {
        color: black;
    }
</style>
