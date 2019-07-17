<template>
    <div>
        <b-list-group>
            Participant:
            <a v-for="event in participant"
               :key="event.id + 'participant'"
                :href="'/' + event.slug">
                    <b-list-group-item
                        :active="isSelected(event, false)">
                        {{event.name}}
                    </b-list-group-item>
            </a>
        </b-list-group>

        <b-list-group>
            Administrator:
            <a v-for="event in administrator"
               :key="event.id + 'administrator'"
               :href="'/admin/' + event.slug">
                <b-list-group-item
                    :active="isSelected(event, true)">
                {{event.name}}
                </b-list-group-item>
            </a>
        </b-list-group>
    </div>
</template>

<script>
    export default {
        name: "PortalSidebar",

        props: {
            participant: {
                required: true,
                type: Array
            },
            administrator: {
                required: true,
                type: Array
            },
            currentEvent: {
                required: true,
                type: Object,
            },
            admin: {
                required: true,
                type: Boolean
            }
        },

        methods: {
            isSelected(event, admin) {
                return event.id === this.currentEvent.id && admin === this.admin;
            }
        }
    }
</script>

<style scoped>

</style>