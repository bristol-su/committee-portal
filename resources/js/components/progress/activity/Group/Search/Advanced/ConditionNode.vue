<template>
    <div>
        <b-row>
            <b-col lg="4" md="3" sm="2" xs="1"></b-col>
            <b-col lg="4" md="6" sm="8" xs="10">
                <b-row>
                    <b-col>
                        <b-form-select :options="filterOptions" :value="condition.filter" @input="updateFilter($event)"></b-form-select>
                    </b-col>
                    <b-col>
                        <b-input :placeholder="valueText" type="text" :value="condition.filterValue" @input="updateFilterValue($event)"
                                 v-show="condition.filter !== null"></b-input>
                    </b-col>
                </b-row>
            </b-col>
            <b-col lg="4" md="3" sm="2" xs="1"></b-col>
        </b-row>
    </div>
</template>

<script>
    export default {
        name: "ConditionNode",

        props: {
            condition: {
                required: true,
                type: Object
            }
        },

        data() {
            return {
                filters: [
                    {
                        key: 'stepIsComplete',
                        text: 'Step is Complete',
                        valueText: 'Step Name',
                        handler: function (progress, value) {
                            if(value === '') {
                                return true;
                            }
                            return progress.module_instances
                                .filter(moduleInstance => moduleInstance.name.toUpperCase().indexOf(value.toUpperCase()) !== -1 && moduleInstance.evaluation.complete === true)
                                .length > 0;
                        }
                    }, {
                        key: 'stepIsIncomplete',
                        text: 'Step is Incomplete',
                        valueText: 'Step Name',
                        handler: function (progress, value) {
                            if(value === '') {
                                return true;
                            }
                            return progress.module_instances
                                .filter(moduleInstance => moduleInstance.name.toUpperCase().indexOf(value.toUpperCase()) !== -1 && moduleInstance.evaluation.complete === false)
                                .length > 0;
                        },
                    }, {
                        key: 'stepIsMandatory',
                        text: 'Step is Mandatory',
                        valueText: 'Step Name',
                        handler: function (progress, value) {
                            if(value === '') {
                                return true;
                            }
                            return progress.module_instances
                                .filter(moduleInstance => moduleInstance.name.toUpperCase().indexOf(value.toUpperCase()) !== -1 && moduleInstance.evaluation.mandatory === true)
                                .length > 0;
                        },
                    }, {
                        key: 'stepIsOptional',
                        text: 'Step is Optional',
                        valueText: 'Step Name',
                        handler: function (progress, value) {
                            if(value === '') {
                                return true;
                            }
                            return progress.module_instances
                                .filter(moduleInstance => moduleInstance.name.toUpperCase().indexOf(value.toUpperCase()) !== -1 && moduleInstance.evaluation.mandatory === false)
                                .length > 0;
                        },
                    }, {
                        key: 'groupNameIs',
                        text: 'Group name is exactly',
                        valueText: 'Group Name',
                        handler: function (progress, value) {
                            if(value === '') {
                                return true;
                            }
                            return progress.participant.name.toUpperCase() === value.toUpperCase();
                        }
                    }, {
                        key: 'groupNameContains',
                        text: 'Group name contains the characters',
                        valueText: 'Characters',
                        handler: function (progress, value) {
                            if(value === '') {
                                return true;
                            }
                            return progress.participant.name.toUpperCase().indexOf(value.toUpperCase()) !== -1;
                        }
                    }, {
                        key: 'groupNameDoesNotContain',
                        text: 'Group name does not contain the characters',
                        valueText: 'Characters',
                        handler: function (progress, value) {
                            if(value === '') {
                                return true;
                            }
                            return progress.participant.name.toUpperCase().indexOf(value.toUpperCase()) === -1;
                        }
                    }, {
                        key: 'statusIs',
                        text: 'The status of the activity is',
                        valueText: 'Status',
                        handler: function (progress, value) {
                            if(value === '') {
                                return true;
                            }
                            let incompleted = progress.module_instances.filter(moduleInstance => moduleInstance.evaluation.complete === false).length;
                            let completed = progress.module_instances.filter(moduleInstance => moduleInstance.evaluation.complete === true).length;
                            if (incompleted === 0 && completed > 0) {
                                status = 'Finished';
                            } else if (incompleted === 0 && completed === 0) {
                                status = 'N/A';
                            } else if (incompleted > 0 && completed === 0) {
                                status = 'Not started';
                            } else if (incompleted > 0 && completed > 0) {
                                status = 'In progress';
                            } else {
                                status = 'N/A';
                            }
                            return status.toUpperCase().indexOf(value.toUpperCase()) !== -1;
                        }
                    }, {
                        key: 'progressIsBelow',
                        text: 'The progress percentage is equal to or below',
                        valueText: 'Percentage',
                        handler: function (progress, value) {
                            if(value === '') {
                                return true;
                            }
                            let incompleted = progress.module_instances.filter(moduleInstance => moduleInstance.evaluation.complete === false).length;
                            let completed = progress.module_instances.filter(moduleInstance => moduleInstance.evaluation.complete === true).length;
                            if (incompleted + completed === 0) {
                                return true;
                            }
                            let percentage = Math.round((completed / (incompleted + completed)) * 100);
                            return percentage <= parseInt(value);
                        }
                    }, {
                        key: 'progressIsAbove',
                        text: 'The progress percentage is equal to or above',
                        valueText: 'Percentage',
                        handler: function (progress, value) {
                            if(value === '') {
                                return true;
                            }
                            let incompleted = progress.module_instances.filter(moduleInstance => moduleInstance.evaluation.complete === false).length;
                            let completed = progress.module_instances.filter(moduleInstance => moduleInstance.evaluation.complete === true).length;
                            if (incompleted + completed === 0) {
                                return true;
                            }
                            let percentage = Math.round((completed / (incompleted + completed)) * 100);
                            return percentage >= parseInt(value);
                        }
                    }
                ]
            }
        },


        methods: {
            evaluate(progress) {
                let filter = this.filters.find(filter => filter.key === this.condition.filter);
                if (filter === undefined) {
                    return true;
                }
                return filter.handler(progress, this.condition.filterValue);
            },

            updateFilter(val) {
                this.$emit('input', {
                    filter: val,
                    filterValue: this.condition.filterValue
                });
            },
            updateFilterValue(val) {
                this.$emit('input', {
                    filter: this.condition.filter,
                    filterValue: val
                });
            },


            calculateComplete(progressInstance) {
                return progressInstance.module_instances.filter(moduleInstance => moduleInstance.evaluation.complete === true);
            },

            calculateIncomplete(progressInstance) {
                return progressInstance.module_instances.filter(moduleInstance => moduleInstance.evaluation.complete === false);
            },

            calculatePercentage(progressInstance) {
                let incompleted = this.calculateIncomplete(progressInstance).length;
                let completed = this.calculateComplete(progressInstance).length;
                if (incompleted + completed === 0) {
                    return 'N/A';
                }
                return Math.round((completed / (incompleted + completed)) * 100);
            },
        },

        computed: {
            filterOptions() {
                return this.filters.map(filter => {
                    return {value: filter.key, text: filter.text}
                });
            },
            valueText() {
                let filter = this.filters.find(filter => filter.key === this.condition.filter);
                if (filter === undefined) {
                    return '';
                }
                return filter.valueText;
            }
        }
    }
</script>

<style scoped>

</style>
