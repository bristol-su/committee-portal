<template>
    <div>
        <div @click="toggleDate" class="clickable">
            <span v-if="fullDate">
                {{date | date_format}}
            </span>
            <span v-else>
                {{date | timeToHuman}}
            </span>
        </div>
    </div>
</template>

<script>

    import moment from 'moment';

    export default {

        props: {
            date: {
                required: true
            },
        },

        data() {
            return {
                fullDate: false,
            }
        },

        methods: {
            toggleDate() {
                this.fullDate = !this.fullDate
            },
        },

        filters: {
            timeToHuman(time) {
                return moment(time).fromNow();
            },

            date_format(time) {
                return moment(time).format('lll');
            },
        }
    }
</script>

<style>
    .clickable {
        cursor: pointer;
    }
</style>