<template>
    <div>
        <ul class="nav nav-tabs" role="tablist">
            <li @click="active = tab.id" class="nav-item" v-for="tab in content">
                <a :aria-controls="tab.id" :aria-selected="isActive(tab)"
                   :class="{active: isActive(tab), disabled: tab.disabled}"
                   :href="'#' + tab.id" :id="tab.id + '-tab'" class="nav-link" data-toggle="tab"
                   role="tab">{{tab.name}}</a>
            </li>
        </ul>
        <div class="tab-content" v-for="tab in content">
            <div :aria-labelledby="tab.id + '-tab'" :class="{active: isActive(tab)}" :id="tab.id"
                 class="tab-pane fade show"
                 role="tabpanel">
                <slot :name="tab.id">

                </slot>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Tabs",

        props: {
            content: {
                required: true,
                type: Array
            },
            default: {
                required: true,
                type: String
            }
        },

        data() {
            return {
                active: ''
            }
        },

        created() {
            this.active = this.default;
        },

        methods: {
            isActive(tab) {
                return this.active === tab.id;
            }
        }
    }
</script>

<style scoped>

</style>