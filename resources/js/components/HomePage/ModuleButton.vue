<template>
    <div class="col-xs-12 col-sm-6 col-md-4" style="padding: 2px;" v-if="visible">
        <a :href="url">
            <button
                    :class="{
                            'module-button-inactive': !active,
                            'module-button-responsible': responsible,
                        }"
                    :disabled="!active"
                    class="btn btn-info module-button"
                    type="button">
                {{title}}
            </button>
        </a>
    </div>


</template>

<script>
    export default {
        name: "ModuleButton",

        props: {
            module: {
                required: true,
                type: Object
            }
        },

        computed: {
            visible() {
                return this.module.visible;
            },

            active() {
                return this.module.active;
            },

            responsible() {
                return this.module.responsible;
            },

            mandatory() {
                return this.module.mandatory;
            },

            url() {
                return this.module.user_url;
            },

            title() {
                return this.module.button_title;
            }
        }
    }
</script>

<style scoped>

</style>