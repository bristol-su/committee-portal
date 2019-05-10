<template>
    <div>
        <v-data-table
            :headers="headers"
            :items="items">
            <template v-slot:items="group">
                <td>{{ group.group.name }}</td>
                <td class="text-xs-right">{{percentage(group)}}</td>
                <td class="text-xs-right">{{ group.fat }}</td>
                <td class="text-xs-right">{{ group.carbs }}</td>
                <td class="text-xs-right">{{ group.protein }}</td>
                <td class="text-xs-right">{{ group.iron }}</td>
            </template>
        </v-data-table>
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

</template>

<script>
    export default {
        name: "ProgressBar.vue",

        props: {
            modules: {
                required: true,
                type: String
            }
        },

        methods: {
            groupHasCompletedReaffiliation(group) {

            },

            groupHasCompletedModule(group) {

            },

            percentage(group) {

            }
        },

        computed: {
            // This function will return an array of {completed: bool, mandatory: bool} to determine completion rates
            completionData() {
                let data = {};
                this.modules.forEach(module => {
                    module.groups.forEach(group => {
                        if (data[group.group.id] === undefined) {
                            data[group.group.id] = [];
                        }
                        data[group.group.id].push({
                            completed: group.completed,
                            mandatory: group.mandatory
                        });
                    });
                });
                return data;
            },

            completedReaffiliation() {
                return Object.values(this.completionData).filter(group => {
                    return group.filter(module => {
                        return module.mandatory === false || module.completed === true;
                    }).length === group.length;
                }).length;
            },

            totalReaffiliating() {
                return Object.values(this.completionData).length;
            },

            percentage() {
                return Math.round((this.completedReaffiliation / this.totalReaffiliating) * 100);
            }
        }
    }
</script>

<style scoped>
    .progress-bar {
        color: black;
    }
</style>