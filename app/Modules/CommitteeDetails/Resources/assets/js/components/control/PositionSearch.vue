<template>
    <div>
        <v-select
                :loading="loading"
                :options="filteredOptions"
                label="name"
                v-model="selectedOption"
        >
        </v-select>

        <small><span v-show="errorVisible">No positions found.</span></small>

    </div>
</template>

<script>

    import vSelect from 'vue-select';

    export default {

        components: {
            'v-select': vSelect
        },

        props: {
            initialPositionId: {
                default: null
            },
            takenPositions: {
                required: true,
                type: Array
            }
        },

        data() {
            return {
                options: [],
                errorVisible: false,
                selectedOption: null,
                loading: false
            }
        },

        watch: {
            selectedOption: function (val) {
                this.$emit('studentSelected', val);
            }
        },

        mounted() {
            this.loading = true;
            axios.get('control-database/api/positions')
                .then(response => {
                    this.options = response.data;
                    this.errorVisible = false;
                    this.loading = false;
                    if (this.initialPositionId !== null) {
                        this.selectedOption = response.data.filter(position => position.id === this.initialPositionId)[0]
                    }
                })
                .catch(error => {
                    console.log(error);
                    this.errorVisible = true;
                    this.loading = false;
                });
        },

        computed: {
            filteredOptions() {
                return this.options.filter(option => this.shouldPositionBeSelectable(option.id));
            }
        },

        methods: {
            shouldPositionBeSelectable(id) {
                return this.isPositionAllowed(id) &&
                    (this.isPositionAllowedMultipleCommitteeMembers(id)?true:!this.isPositionTaken(id))
            },
            isPositionAllowed(id) {
                // Should be in the allowed position array
                return committeePortal.group_settings.allowed_positions.indexOf(id) !== -1;

            },
            isPositionAllowedMultipleCommitteeMembers(id) {
                // Shouldn't be in the single committee member array
                return committeePortal.group_settings.position_only_has_single_committee_member.indexOf(id) === -1;
            },
            isPositionTaken(id) {
                // Does at least one person hold this position?
                return this.takenPositions.indexOf(id) !== -1;
            }
        }
    }

</script>