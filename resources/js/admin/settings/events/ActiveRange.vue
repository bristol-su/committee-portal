<template>

    <b-form-group label="Active Range">
        <b-form-radio name="alwaysActive" v-model="isAlwaysActive" @input="alwaysActive" :value="true">Always Active</b-form-radio>
        <b-form-radio name="alwaysActive" v-model="isAlwaysActive" :value="false">Active between range</b-form-radio>

        <b-card v-show="!isAlwaysActive">
            <b-input-group prepend="Start Date/Time" class="mt-3">
                <b-form-input type="date" name="start_date" v-model="startDate"></b-form-input>
                <b-input-group-append>
                    <b-form-input type="time" name="start_time" v-model="startTime"></b-form-input>
                </b-input-group-append>
            </b-input-group>

            <b-input-group prepend="End Date/Time" class="mt-3">
                <b-form-input type="date" name="end_date" v-model="endDate"></b-form-input>
                <b-input-group-append>
                    <b-form-input type="time" name="end_time" v-model="endTime"></b-form-input>
                </b-input-group-append>
            </b-input-group>

        </b-card>
    </b-form-group>
</template>

<script>
    export default {
        name: "ActiveRange",

        data() {
            return {
                isAlwaysActive: true,
                startDate: null,
                endDate: null,
                startTime: null,
                endTime: null,
            }
        },

        methods: {
            alwaysActive() {
                this.$emit('startDateUpdated', null);
                this.$emit('endDateUpdated', null);
                this.startDate = null;
                this.endDate = null;
            },
        },

        watch: {
            startDate(val) {
                this.$emit('startDateUpdated', val + ' ' + this.startTime);
            },

            endDate(val) {
                this.$emit('startDateUpdated', val + ' ' + this.endTime);
            },

            startTime(val) {
                this.$emit('startDateUpdated', this.startDate + ' ' + val);
            },

            endTime(val) {
                this.$emit('endDateUpdated', this.endDate + ' ' + val);
            },
        }
    }
</script>

<style scoped>

</style>