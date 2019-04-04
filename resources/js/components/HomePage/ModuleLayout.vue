<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <module-header
                        v-for="header in headers"
                        :modules="headerModules(header)"
                        :header="header">

                </module-header>
            </div>
        </div>
    </div>
</template>

<script>
    import ModuleHeader from './ModuleHeader';

    export default {
        name: 'ModuleLayout',

        props: {
            modules: {
                required: true,
                type: Array
            },
            order: {
                required: true,
                type: Array
            }
        },

        components: {
            ModuleHeader,
        },

        methods: {
            headerModules(header) {
                return this.modules.filter(module => module.header.index === header.index);
            }
        },

        computed: {
            headers() {
                let headers = [...new Set(this.modules.map(module => module.header.index))];

                // Filter to only unique headers
                const modules = this.modules.filter(module => {
                    let index = headers.indexOf(module.header.index);
                    if(index !== -1) {
                        headers[index] = '';
                        return true;
                    }
                    return false;
                });

                return modules.map(module => module.header).sort((a, b) => {
                    if(this.order.indexOf(a) > this.order.indexOf(b)) {
                        return -1;
                    }
                    return 1;
                });
            }
        },
    }
</script>

<style scoped>

</style>