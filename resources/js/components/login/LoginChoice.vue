<template>
    <div>
        <b-button size="lg" :variant="variant" @click="toggle">{{title}}</b-button>
    </div>
</template>

<script>
    export default {
        name: "LoginChoice",

        props: {
            resource: {
                type: Object,
                required: true
            },
            type: {
                type: String,
                required: true
            },
            currentId: {
                required: false
            },
            currentType: {
                required: false,
                type: String
            }
        },

        methods: {
            toggle() {
                if(this.selected) {
                    this.$emit('input', null, null);
                } else {
                    this.$emit('input', this.type, this.resource.id)
                }
            }
        },

        computed: {
            title() {
                if(this.type === 'user') {
                    return 'Your user account';
                } else if(this.type === 'group') {
                    return 'Membership to ' + this.resource.name;
                } else if(this.type ===  'role') {
                    return 'Position of ' + this.resource.position.name + ' of ' + this.resource.group.name;
                }
            },
            selected() {
                return this.currentId === this.resource.id && this.currentType === this.type;
            },
            variant() {
                if(this.selected) {
                    return 'info';
                }
                return 'outline-secondary';
            }
        }
    }
</script>

<style scoped>

</style>
