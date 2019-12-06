<template>
    <div class="col-xs-12 col-sm-6 col-md-4" style="padding: 2px;" v-if="!hidden">
        <a :href="url">
            <b-button :class="{mandatory: mandatory, inactive: inactive, complete: complete}"
                      :disabled="inactive"
                      class="module-button"
                      variant="primary">
                {{moduleInstance.name}}
            </b-button>
        </a>
    </div>

</template>

<script>
    export default {
        name: "ModuleInstance",

        props: {
            moduleInstance: {
                required: true,
                type: Object
            },
            evaluation: {
                required: true,
                type: Object
            },
            activity: {
                required: true,
                type: Object
            },
            admin: {
                required: true,
                type: Boolean
            }
        },

        computed: {
            url() {
                return (this.admin ? '/a/' : '/p/')
                    + this.activity.slug
                    + '/'
                    + this.moduleInstance.slug
                    + '/'
                    + this.moduleInstance.alias;
            },
            inactive() {
                return !this.evaluation.active;
            },
            hidden() {
                return !this.evaluation.visible;
            },
            mandatory() {
                return this.evaluation.mandatory;
            },
            complete() {
                if (this.evaluation.hasOwnProperty("complete")) {
                    return this.evaluation.complete;
                }
                return false;
            }
        }
    }
</script>

<style scoped>

    .module-button {
        height: 60px;
        width: 80%;
        background-color: #fff;
        color: #2452A1;
        border-color: #2452A1;
        border-radius: 15px;
        border-width: 1px;
        margin-top: 5px;
    }

    .module-button:hover {
        background-color: #2452a1;
        color: #fff;
        -webkit-transition: ease-in-out 0.5s;
    }

    .module-button.mandatory {
        color: #ff2353;
        background-color: #fff;
        border-color: #ff2353;
    }

    .module-button.mandatory:hover {
        color: #fff;
        background-color: #ff2353;
        -webkit-transition: ease-in-out 0.5s;
    }

    .module-button.inactive {
        color: #000;
        background: #d1d1d1;
        border-color: #d1d1d1;
    }

    .module-button.inactive:hover {
        color: #000;
        background: #d1d1d1;
        border-color: #d1d1d1;
    }


    .module-button.complete {
        color: #46a05a;
        background: #fff;
        border-color: #46a05a;
    }

    .module-button.complete:hover {
        color: #fff;
        background: #46a05a;
        -webkit-transition: ease-in-out 0.5s;
    }
</style>
