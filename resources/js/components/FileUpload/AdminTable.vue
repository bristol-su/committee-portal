<template>
    <div>
        <!--<a :href="'/' + module + '/download-all/' + (currentReaffiliationYear - 1)">-->
            <!--<button class="btn btn-sm btn-info">-->
                <!--Download all approved from {{currentReaffiliationYear - 1 | reaffiliation_year}}-->
            <!--</button>-->
        <!--</a>-->

        <!--<a :href="'/' + module + '/download-all/' + (currentReaffiliationYear)">-->
            <!--<button class="btn btn-sm btn-info">-->
                <!--Download all approved from {{currentReaffiliationYear | reaffiliation_year}}-->
            <!--</button>-->
        <!--</a>-->
        <!--// TODO Make filterable-->
        <table class="table table-striped table-responsive table-condensed table-hover" v-if="files.length > 0">
            <thead>
            <tr>
                <th>Group</th>
                <th>Title</th>
                <th>Filename</th>
                <th>Size</th>
                <th>Year</th>
                <th>Uploaded By</th>
                <th>Uploaded</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody v-for="(file, index) in sortedFiles">

            <tr>
                <td>{{file.group.name}}</td>
                <td>{{file.title}}</td>
                <td>{{file.filename}}</td>
                <td>{{file.size | bytesToHuman}}</td>
                <td>{{file.year | reaffiliation_year}}</td>
                <td>{{file.user | username }}</td>
                <td @click="toggleDate(index)" class="clickable">
                        <span v-if="fullDate.indexOf(index) === -1">
                            {{file.created_at | timeToHuman}}
                        </span>
                    <span v-else>
                            {{file.created_at | date_format}}
                        </span>
                </td>
                <td>
                    <select @change="changeStatus($event, file)" class="form-control" v-model="file.status">
                        <option value="awaiting approval"><i class="fa fa-hourglass"></i>
                            Awaiting
                            Approval
                        </option>
                        <option value="approved"><i class="fa fa-check"></i> Approved
                        </option>
                        <option value="rejected"><i class="fa fa-times"></i> Rejected
                        </option>
                    </select>
                </td>
                <td>
                    <a :href="downloadUrl(file.id)">Download</a>&nbsp;|&nbsp;
                    <!--// TODO Preview File-->
                    <a @click="showNotes(index)" href="#">Notes ({{file.notes.length}})</a>

                    <modal
                            :name="'notes-file-upload-form-' + index"
                            height="auto"
                    >
                        <admin-notes
                                :file="file"
                                :module="module"
                                :notes="file.notes"
                                @close="hideNotes(index)"
                                @updatedfile="retrieveFiles"
                        >
                        </admin-notes>
                    </modal>

                </td>
            </tr>


            </tbody>
        </table>
        <div v-else>
            No files have been uploaded.
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    import AdminNotes from './AdminNotes';
    import Errors from "../../utilities/Errors";

    export default {
        props: {

            module: {
                required: true,
                default: '',
                type: String
            }

        },

        data() {
            return {
                fullDate: [],
                files: [],
                errors: new Errors(),
                currentReaffiliationYear: parseInt(process.env.MIX_REAFFILIATION_YEAR),
            }
        },

        methods: {

            toggleDate(fileIndex) {
                let index = this.fullDate.indexOf(fileIndex);
                if (index === -1) {
                    this.fullDate.push(fileIndex);
                } else {
                    this.fullDate.splice(index, 1)
                }
            },

            downloadUrl(id) {
                return '/admin/' + this.module + '/download-files/' + id;
            },

            showNotes(fileIndex) {
                this.$modal.show('notes-file-upload-form-' + fileIndex);
            },

            hideNotes(fileIndex) {
                this.$modal.hide('notes-file-upload-form-' + fileIndex);
            },

            retrieveFiles() {
                this.$http.get('/admin/' + this.module + '/retrieve-files')
                    .then(response => {
                        this.files = response.data;
                    })
                    .catch(error => {
                        this.$notify.alert('Sorry, something went wrong.');
                        this.errors.record(error);
                    });
            },

            changeStatus(event, file) {
                if(confirm('Are you sure you wish to change the status of '+file.title+' for group '+file.group.name+' to '+event.target.value+'?')) {
                    this.$http.post('/admin/' + this.module + '/change-file-status/' + file.id, {
                        status: event.target.value
                    })
                        .then(response => {
                            this.retrieveFiles();
                            this.$notify.success('Updated status')
                        })
                        .catch(error => {
                            this.$notify.alert('Sorry, something went wrong.');
                            this.$notify.alert('Status not updated')
                        });
                }
            }
        },

        filters: {
            bytesToHuman(bytes) {
                let i = bytes === 0 ? 0 : Math.floor(Math.log(bytes) / Math.log(1024));
                return (bytes / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
            },

            timeToHuman(time) {
                return moment(time).fromNow();
            },

            date_format(time) {
                return moment(time).format('lll');
            },

            reaffiliation_year(year) {
                return year.toString() + '/' + (year + 1).toString().slice(2);
            },

            username(user) {
                return user.forename + ' ' + user.surname;
            },

        },

        computed: {
            sortedFiles() {
                let self = this;
                return this.files.sort(function (a, b) {
                    // Ensure the file is before the non file
                    // TODO Ordering

                    // Order by filename for File or time for uploaded files since they are of the same type
                    let asort = moment(a.created_at).unix();
                    let bsort = moment(b.created_at).unix();
                    return (bsort - asort);
                });
            },
        },

        components: {
            AdminNotes,
        },

        created() {
            this.retrieveFiles()
        }

    }

</script>

<style>
    table {
        margin: auto;
    }

    .clickable {
        cursor: pointer;
    }

</style>