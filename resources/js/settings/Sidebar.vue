<template>
    <sidebar-menu :collapsed="collapsed"
                  :menu="menu"
                  @collapse="onCollapse"
                  :theme="theme">
        <div slot="header">
            <div style="width: 100%; text-align: right;">
                <i :class="icons" :style="{color: headerColor}" @click="collapsed = !collapsed"></i>
            </div>
        </div>
        <div slot="footer">footer</div>

    </sidebar-menu>
</template>

<script>
    import {SidebarMenu} from 'vue-sidebar-menu'

    export default {
        name: "Sidebar",
        components: {
            SidebarMenu
        },
        data() {
            return {
                collapsed: true,
                theme: 'dark-theme',
                menu: [
                    {
                        header: true,
                        title: 'Settings'
                    },
                    {
                        href: '/settings',
                        title: 'Settings',
                        icon: 'fa fa-home',
                    },
                    {
                        header: true,
                        title: 'Activities'
                    },
                    {
                        href: '/activity',
                        title: 'All Activities',
                        icon: 'fa fa-align-justify',
                    },
                    {
                        href: '/activity/create',
                        title: 'Create Activity',
                        icon: 'fa fa-plus',
                    },
                    {
                        header: true,
                        title: 'Logic'
                    },
                    {
                        href: '/logic',
                        title: 'All Logic',
                        icon: 'fa fa-users',
                    },
                    {
                        href: '/logic/create',
                        title: 'Create Logic',
                        icon: 'fa fa-plus',
                    },
                    {
                        header: true,
                        title: 'Permissions'
                    },
                    {
                        href: '/site-permission',
                        title: 'Site Permissions',
                        icon: 'fa fa-lock',
                    },
                    {
                        header: true,
                        title: 'Connections'
                    },
                    {
                        href: '/connector',
                        title: 'Connectors',
                        icon: 'fa fa-plug',
                    },
                ]
            }
        },

        methods: {
            onCollapse(collapsed) {
                this.collapsed = collapsed;
            }
        },

        computed: {
            icons() {
                let icon = (this.collapsed?'arrow-circle-right':'arrow-circle-left');
                return 'fa fa-' + icon + ' hamburger';
            },
            headerColor() {
                if(this.theme === 'dark-theme') {
                    return 'white';
                } else if(this.theme === 'white-theme') {
                    return 'black';
                }
                return '';
            }
        }
    }
</script>

<style scoped>
    .v-sidebar-menu {
        position: relative;
    }

    .hamburger {
        padding: 5px;
        font-size: 35px;
    }
</style>
