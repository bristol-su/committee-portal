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

.module-button-inactive {
  color:#000;
  background: #d1d1d1;
  border-color: #d1d1d1;
}

.module-button-inactive:hover {
  color:#000;
  background: #d1d1d1;
  border-color: #d1d1d1;
}

.module-button-responsible {
  color: #ff2353;
  background-color: #fff;
  border-color: #ff2353;
}

.module-button-responsible:hover {
  color:#fff;
  background-color:#ff2353;
  -webkit-transition: ease-in-out 0.5s;
}

module-button-completed {
  color:#46a05a;
  background: #fff;
  border-color: #46a05a;
}

module-button-completed:hover {
  color:#fff;
  background:#46a05a;
  -webkit-transition: ease-in-out 0.5s;
}

</style>
