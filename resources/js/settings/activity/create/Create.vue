<template>
    <div style="text-align: left;">
        <b-form @submit.prevent="onSubmit">
            <b-form-group
                description="A name for the activity"
                id="name-group"
                label="Name:"
                label-for="name"
            >
                <b-form-input
                    id="name"
                    required
                    type="text"
                    v-model="name"
                ></b-form-input>
            </b-form-group>


            <b-form-group
                description="A description for the activity"
                id="description-group"
                label="Description:"
                label-for="description"
            >
                <b-form-input
                    id="description"
                    required
                    type="text"
                    v-model="description"
                ></b-form-input>
            </b-form-group>

            <slug v-model="slug"></slug>

            <b-form-group
                label="What kind of activity is this?"
                description="What kind of activity is this?"
            >
                <b-form-radio v-model="type" name="type" value="open">Cannot be completed</b-form-radio>
                <b-form-radio v-model="type" name="type" value="completable">Can be completed once</b-form-radio>
                <b-form-radio v-model="type" name="type" value="multi-completable">Can be completed multiple times</b-form-radio>
            </b-form-group>

            <b-form-group
                label="Which type of resource is this activity for?"
                description="Do groups of people need to complete this activity together, or do individuals complete it for themselves?"
                >
                <b-form-radio v-model="activity_for" name="activity-for" value="user">User</b-form-radio>
                <b-form-radio v-model="activity_for" name="activity-for" value="group">Group</b-form-radio>
                <b-form-radio v-model="activity_for" name="activity-for" value="role">Role</b-form-radio>
            </b-form-group>

            <b-form-group label="Who is this activity for?">
                <logic-select v-model="for_logic" :activity-for="activity_for">

                </logic-select>
            </b-form-group>

            <b-form-group label="Who are the administrators of this activity?">
                <logic-select v-model="admin_logic">

                </logic-select>
            </b-form-group>

            <active-range
                @startDateUpdated="start_date = $event"
                @endDateUpdated="end_date = $event"
            >

            </active-range>


            <b-button type="submit" :disabled="loading" variant="primary">Create</b-button>
        </b-form>
    </div>
</template>

<script>
    import ActiveRange from "./ActiveRange";
    import LogicSelect from "./LogicSelect";
    import Slug from "./Slug";
    export default {
        name: "Create",
        components: {Slug, LogicSelect, ActiveRange},
        data() {
            return {
                name: '',
                description: '',
                slug: '',
                type: 'open',
                activity_for: 'user',
                for_logic: null,
                admin_logic: null,
                start_date: null,
                end_date: null,
                loading: false
            }
        },

        watch: {
            name(newVal, oldVal) {
                if(this.slugify(oldVal) === this.slug) {
                    this.slug = this.slugify(newVal);
                }
            }
        },

        methods: {
            slugify(string) {
                const a = 'àáäâãåăæąçćčđďèéěėëêęğǵḧìíïîįłḿǹńňñòóöôœøṕŕřßşśšșťțùúüûǘůűūųẃẍÿýźžż·/_,:;'
                const b = 'aaaaaaaaacccddeeeeeeegghiiiiilmnnnnooooooprrsssssttuuuuuuuuuwxyyzzz------'
                const p = new RegExp(a.split('').join('|'), 'g')

                return string.toString().toLowerCase()
                    .replace(/\s+/g, '-') // Replace spaces with -
                    .replace(p, c => b.charAt(a.indexOf(c))) // Replace special characters
                    .replace(/&/g, '-and-') // Replace & with 'and'
                    .replace(/[^\w\-]+/g, '') // Remove all non-word characters
                    .replace(/\-\-+/g, '-') // Replace multiple - with single -
                    .replace(/^-+/, '') // Trim - from start of text
                    .replace(/-+$/, '') // Trim - from end of text
            },

            onSubmit() {
                this.loading = true;
                this.$api.activity().create({
                    name: this.name,
                    description: this.description,
                    slug: this.slug,
                    type: this.type,
                    activity_for: this.activity_for,
                    for_logic: this.for_logic,
                    admin_logic: this.admin_logic,
                    start_date: this.start_date,
                    end_date: this.end_date
                })
                    .then(response => {
                        this.$notify.success('Activity Created');
                        window.setTimeout(function() {
                            window.location.href = '/activity/' + response.data.id;
                        }, 3000);
                    })
                    .catch(error => this.$notify.alert('Could not create activity: ' + error.message))
                    .then(() => this.loading = false)
            }
        },


    }
</script>

<style scoped>

</style>
