<template>
    <div>
        <slot name="header">

        </slot>
        <div :class="status">
            <slot>

            </slot>
        </div>

        <a href="#" @click="toggleCollapse">{{toggleBtnContent}}</a>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                collapsed: true
            }
        },

        methods: {
            toggleCollapse() {
                this.collapsed = !this.collapsed;
            }
        },

        computed: {
            toggleBtnContent() {
                return (this.collapsed ? '+ Show More' : '- Show Less');
            },

            status() {
                return (this.collapsed ? 'collapsed' : 'visible');
            }
        }
    }
</script>

<style>
    .collapsed {
        height: 10rem;
        position: relative;
        display: block;
        overflow: hidden;
    }

    .visible {
        height: auto;
    }

    .preview .collapse {

    }

</style>