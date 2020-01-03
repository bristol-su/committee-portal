<template>
    <div>
        <div v-show="searchType === 'basic'">
            <basic ref="basic" @refresh="$emit('refresh')" :activity="activity">
                <template v-slot:fields>
                    <slot name="basic"></slot>
                </template>
            </basic>
        </div>
        <div v-show="searchType === 'advanced'">
            <advanced ref="advanced" @refresh="$emit('refresh')"/>
        </div>
        <b-row>
            <b-col style="text-align: right">
                <b-checkbox @input="setSearchType">Advanced Search?</b-checkbox>
            </b-col>
        </b-row>
    </div>
</template>

<script>
    import Basic from './Basic';
    import Advanced from './Advanced';
    export default {
        name: "Search",
        components: {Advanced, Basic},
        props: {
            activity: {
                required: true,
                type: Object
            },
            basicFunctions: {
                required: false,
                type: Array,
                default() {
                    return [];
                }
            },
            basicFilter: {
                required: false,
                type: Object,
                default() {}
            }
        },

        data() {
            return {
                searchType: 'basic'
            }
        },

        methods: {
            setSearchType(type) {
                if(type) {
                    this.searchType = 'advanced';
                } else {
                    this.searchType = 'basic';
                }
                this.$emit('refresh');
            },

            filterResult(progress) {
                if(this.searchType === 'basic') {
                    return this.$refs.basic.filterStatus(progress) && this.$refs.basic.filterComplete(progress) &&
                        this.$refs.basic.filterIncomplete(progress) && this.$refs.basic.filterLowerPercentage(progress) &&
                        this.$refs.basic.filterUpperPercentage(progress) && this.$refs.basic.filterMandatory(progress) &&
                        this.$refs.basic.filterOptional(progress) && this.evaluateAdditionalBasicFields(progress);
                } else if(this.searchType === 'advanced') {
                    return this.$refs.advanced.evaluate(progress);
                }
                return true;
            },

            evaluateAdditionalBasicFields(progress) {
                if(this.basicFunctions.length === 0) {
                    return true;
                }
                for (let func of this.basicFunctions) {
                    if(func(progress, this.basicFilter) === false) {
                        return false;
                    }
                }
                return true;
            }
        },

        computed: {}
    }
</script>

<style scoped>

</style>
