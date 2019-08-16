<template>
    <div style="text-align: left;">
        <b-form @submit.prevent="onSubmit">
            <b-form-group
                description="A name for the module"
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
                description="A description for the module"
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

        </b-form>
    </div>
</template>

<script>
    import Slug from "./Slug";

    export default {
        name: "ModuleInformation",
        components: {Slug},
        data() {
            return {
                name: '',
                description: '',
                slug: '',
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

        },


    }
</script>

<style scoped>

</style>
