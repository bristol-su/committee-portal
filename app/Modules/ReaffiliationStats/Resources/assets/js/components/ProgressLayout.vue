<template>
    <div>


        <div class="row">
            <div class="col-md-12">
                <tabs
                        :content="tabsLayout"
                        default="module">

                    <template v-slot:module>
                        <div v-if="modules.length > 0">

                                <div style="text-align: center;">
                                    Completed Reaffiliation
                                </div>
                                <div style="text-align: center;">
                                    {{completedReaffiliation}} / {{totalReaffiliating}} ({{percentage}}%)
                                </div>


                            <progress-bar
                                    :groups="module.groups"
                                    :key="module.alias"
                                    :module="module.name"
                                    class="progress-bar-admin"
                                    v-for="module in modules"
                                    v-if="hasMandatoryGroups(module) && modules.length > 0">

                            </progress-bar>

                        </div>


                        <div v-else>
                            Module completion statistics are being calculated. If they have not been found in a minute,
                            please refresh the page.
                        </div>
                    </template>

                    <template v-slot:individualreports>
<!--                        <group-progress-->
<!--                        :modules="modules">-->

<!--                        </group-progress>-->
                    </template>
                </tabs>
            </div>
        </div>


    </div>
</template>

<script>

    import ProgressBar from './ProgressBar';
    import GroupProgress from './GroupProgress';
    import Tabs from './../../../../../../../resources/js/components/Tabs';

    export default {
        name: "ProgressLayout",

        components: {
            ProgressBar,
            Tabs
        },

        data() {
            return {
                modules: [],
                tabsLayout: [
                    {
                        id: 'module',
                        name: 'Module Completion',
                        disabled: false
                    },
                    {
                        id: 'individualgroup',
                        name: 'Individual Group Progress',
                        disabled: false
                    },
                ]
            }
        },

        created() {
            this.loadStats();
        },

        methods: {
            loadStats() {
                this.$http.get('/admin/reaffiliation-stats/stats')
                    .then(response => this.modules = response.data)
                    .catch(error => {
                        this.$notify.alert('Could not load group statistics, please reload the page. ' + error.message)
                    });
            },

            hasMandatoryGroups(module) {
                return module.groups.filter(group => group.mandatory).length > 0;
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

    .progress-bar-admin {
        margin: 2px;
    }
</style>








