<template>
    <div>
        <div v-if="modules.length > 0">
            <button class="module-button-admin" @click="showStats = !showStats">Toggle Statistics</button>
            <progress-bar
                    v-for="module in modules"
                    v-if="showStats && hasMandatoryGroups(module)"
                    :key="module.alias"
                    :groups="module.groups"
                    :module="module.name"
                    class="progress-bar-admin">

            </progress-bar>
        </div>
        <div v-else>
            Loading group completion data...
        </div>
    </div>
</template>

<script>

    import ProgressBar from './ProgressBar';

    export default {
        name: "ProgressLayout",

        components: {
            ProgressBar
        },

        data() {
            return {
                modules: [],
                showStats: false
            }
        },

        created() {
            this.loadStats(true);
        },

        methods: {
            loadStats(loop) {
                this.$http.get('/admin/stats')
                    .then(response => this.modules = response.data)
                    .catch(error => {
                        if(loop) {
                            this.loadStats(loop);
                        } else {
                            this.$notify.alert('Could not load group statistics: '+error.message)
                        }
                    });
            },

            hasMandatoryGroups(module) {
                return module.groups.filter(group => group.mandatory).length > 0;
            }
        }
    }
</script>

<style scoped>

    .progress-bar-admin {
        margin: 2px;
    }

</style>