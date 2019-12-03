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
                            return true;
                        }
                    }, {
                        key: 'stepIsIncomplete',
                        text: 'Step is Incomplete',
                        valueText: 'Step Name',
                        handler: function (progress, value) {
                            return false;
                        },
                    }, {
                        key: 'stepIsMandatory',
                        text: 'Step is Mandatory',
                        valueText: 'Step Name',
                        handler: function (progress, value) {
                            return false;
                        },
                    }, {
                        key: 'stepIsOptional',
                        text: 'Step is Optional',
                        valueText: 'Step Name',
                        handler: function (progress, value) {
                            return false;
                        },
                    }, {
                        key: 'groupNameIs',
                        text: 'Group name is exactly',
                        valueText: 'Group Name',
                        handler: function (progress, value) {
                            return false;
                        }
                    }, {
                        key: 'groupNameContains',
                        text: 'Group name contains the characters',
                        valueText: 'Characters',
                        handler: function (progress, value) {
                            return false;
                        }
                    }, {
                        key: 'groupNameDoesNotContain',
                        text: 'Group name does not contain the characters',
                        valueText: 'Characters',
                        handler: function (progress, value) {
                            return false;
                        }
                    }, {
                        key: 'statusIsFinished',
                        text: 'The status of the activity is',
                        valueText: 'Status',
                        handler: function (progress, value) {
                            return false;
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
            }

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
