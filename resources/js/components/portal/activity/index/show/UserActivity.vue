<template>
    <div>
        <a :href="url">
            <b-button variant="secondary">{{activity.name}}</b-button>
        </a>

    </div>
</template>

<script>
    export default {
        name: "UserActivity",

        props: {
            activity: {
                required: true,
                type: Object
            },
            admin: {
                default: false,
                type: Boolean
            }
        },

        computed: {
            url() {
                return (this.admin?'/a/':'/p/')
                    + this.activity.slug;
            }
        }
    }
</script>

<style scoped>

</style>
