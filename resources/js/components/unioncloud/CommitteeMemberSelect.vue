<template>
    <div>
        <select aria-describedby="HelpBlock" :required="true" class="custom-select" @input="changedUser" :value="value">
            <option selected>Please select an option</option>
            <option v-for="user in committee_members" :value="user.student_id">
                {{user | fullName}}
            </option>
        </select>
    </div>
</template>

<script>
    export default {
        props: {
            committee_members: {
                required: true,
                type: Array
            },

            value: {}
        },

        data() {
            return {
                selectValue: null
            }
        },
        filters: {
            fullName(user) {
                return user.unioncloud_user.attributes.forename + ' ' + user.unioncloud_user.attributes.surname;
            }
        },

        methods: {
            changedUser(event) {
                this.$emit('input', parseInt(event.target.value));
            }
        }

    }
</script>

<style>

</style>