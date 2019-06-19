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
                    <p>No notes have been posted yet!</p>
                    <p>Notes are the way our staff members will contact you concerning documents. If a document is
                    rejected, a note will be left to explain what needs changing. By using notes, future committee
                    members can see the development of a document and have a history of communication concerning documents.</p>
                    <p>
                        We'll notify the committee member who uploaded the document when a note is posted.
                    </p>
                </div>
                <ul class="noteList">
                    <li v-for="note in sortedNotes" v-if="sortedNotes.length > 0">
                        <div class="noteerImage">
                            <img :src="'document-note-avatar.png' | static"/>
                        </div>
                        <div class="noteText">
                            <span class="noterName">{{ note.user | username }}</span> <span
                                class="date sub-text">{{ note.created_at | timeToHuman}}</span>
                            <p>{{note.note}}</p>

                        </div>
                    </li>
                </ul>
<!--                <form @submit.prevent="postNote" class="form-inline" role="form">-->
<!--                    <div class="form-group">-->
<!--                        <input class="form-control" placeholder="Leave a note..." type="text" v-model="note"/>-->
<!--                        <small><span @keyup="this.submitErrors.clear('note')" v-show="this.submitErrors.has('note')">{{this.submitErrors.get('note')}}</span>-->
<!--                        </small>-->

<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <button class="btn btn-default">Add</button>-->
<!--                    </div>-->
<!--                </form>-->
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
                note: ''
            }
        },

        methods: {
            postNote() {
                this.$http.post('/' + this.module + '/post-note/' + this.file.id, {
                    note: this.note
                })
                    .then(response => {
                        // TODO This causes all files to update, and so shifts the notes down.
                        this.$emit('updatedfile', response.data);
                        this.note = '';
                    })
                    .catch(error => {
                        this.$notify.alert('Sorry, something went wrong.');
                        this.submitErrors.record(error)
                    });
            },

            getNoteCount(id) {
                return this.file.notes.length;
            }
        },

        filters: {
            timeToHuman(time) {
                return moment(time).fromNow();
            },

            username(user) {
                return user.forename + ' ' + user.surname;
            },

            static(filename) {
                return window.serveStaticContent(filename);
            }

        },

        computed: {
            sortedNotes() {
                return this.file.notes.sort(function (a, b) {
                    let asort = moment(a.created_at).unix();
                    let bsort = moment(b.created_at).unix();
                    return (asort - bsort);
                });
            }
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