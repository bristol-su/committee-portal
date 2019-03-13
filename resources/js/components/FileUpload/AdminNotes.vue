<template>
    <div>

        <!-- Notes Box -->
        <div class="detailBox">
            <div class="titleBox">
                <label>Notes on '{{file.title}}'</label>
                <button @click="$emit('close')" aria-hidden="true" class="close" type="button">&times;</button>
            </div>

            <div class="actionBox">
                <div v-if="sortedNotes.length === 0">
                    No notes have been posted yet!
                </div>
                <ul class="noteList">
                    <li v-for="note in sortedNotes" v-if="sortedNotes.length > 0">
                        <div class="noteerImage">
                            <img src="/images/avatar.png"/>
                        </div>
                        <div class="noteText">
                            <span class="noterName">{{ note.user | username }}</span> <span
                                class="date sub-text">{{ note.created_at | timeToHuman}}</span>
                            <p>{{note.note}}</p>

                        </div>
                    </li>
                    <li v-else>
                        No notes...
                    </li>

                </ul>
                <form @submit.prevent="postNote" class="form-inline" role="form">
                    <div class="form-group">
                        <input class="form-control" placeholder="Leave a note..." type="text" v-model="note"/>
                        <small><span @keyup="this.submitErrors.clear('note')" v-show="this.submitErrors.has('note')">{{this.submitErrors.get('note')}}</span>
                        </small>

                    </div>
                    <div class="form-group">
                        <button class="btn btn-default">Add</button>
                    </div>
                </form>

                <div v-if="templates.length > 0">
                    <hr/>
                    Templates:
                        <select class="form-control" style="width: 50%" @change="loadTemplate" v-model="selectedTemplate">
                            <option value="selecttemplate">Select a template...</option>
                            <option v-for="(template, index) in templates" :value="index">{{template.name}}</option>
                        </select>
                </div>

            </div>
        </div>


    </div>

</template>

<script>
    import Errors from "../../utilities/Errors";
    import moment from 'moment';


    export default {

        props: {
            module: {
                required: true,
                default: '',
                type: String
            },

            file: {
                required: true,
                default: function () {
                    return {}
                },
                type: Object
            },

        },

        data() {
            return {
                submitErrors: new Errors(),
                note: '',
                templates: [],
                selectedTemplate: 'selecttemplate'
            }
        },

        methods: {
            postNote() {
                this.$http.post('/admin/' + this.module + '/post-note/' + this.file.id, {
                    note: this.note
                })
                    .then(response => {
                        this.$emit('updatedfile', response.data);
                        this.note = '';
                    })
                    .catch(error => {
                        this.submitErrors.record(error);
                        this.$notify.alert('Sorry, something went wrong.');
                    });
            },

            loadTemplate(event) {
                if(this.selectedTemplate !== 'selecttemplate') {
                    let template = this.templates[this.selectedTemplate];
                    this.note = template.template;
                }
                this.selectedTemplate = 'selecttemplate';

            }
        },

        filters: {
            timeToHuman(time) {
                return moment(time).fromNow();
            },

            username(user) {
                return user.forename + ' ' + user.surname;
            },

        },

        computed: {
            sortedNotes() {
                return this.file.notes.sort(function (a, b) {
                    let asort = moment(a.created_at).unix();
                    let bsort = moment(b.created_at).unix();
                    return (asort - bsort);
                });
            }
        },

        created() {
            this.$http.get('/admin/' + this.module + '/retrieve-note-templates')
                .then(response => this.templates = response.data)
                .catch(error => this.$notify.alert('Sorry, something went wrong retrieving note templates'))
        }

    }
</script>

<style>

    .detailBox {
        border: 1px solid #bbb;
    }

    .titleBox {
        background-color: #fdfdfd;
        padding: 10px;
    }

    .titleBox label {
        color: #444;
        margin: 0;
        display: inline-block;
    }

    .noteBox .form-group:first-child, .actionBox .form-group:first-child {
        width: 80%;
    }

    .noteBox .form-group:nth-child(2), .actionBox .form-group:nth-child(2) {
        width: 18%;
    }

    .actionBox .form-group * {
        width: 100%;
    }

    .noteList {
        padding: 0;
        list-style: none;
        max-height: 200px;
        overflow: auto;
    }

    .noteList li {
        margin: 0;
        margin-top: 10px;
    }

    .noteList li > div {
        display: table-cell;
    }

    .noteerImage {
        width: 30px;
        margin-right: 5px;
        height: 100%;
        float: left;
    }

    .noteerImage.owner {
        float: right;
    }

    .noteerImage img {
        width: 100%;
        border-radius: 50%;
    }

    .noteText p {
        margin: 0;
    }

    .sub-text {
        color: #aaa;
        font-family: verdana;
        font-size: 11px;
    }

    .actionBox {
        border-top: 1px dotted #bbb;
        padding: 10px;
    }

    .noterName {

    }

</style>