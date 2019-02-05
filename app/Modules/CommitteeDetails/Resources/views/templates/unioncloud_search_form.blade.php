<style>
    .unioncloud_error_message {
        color: red;
    }
</style>

<div id="unioncloud_search_el">
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">UnionCloud Account</legend>
        <small>Search for an account etc</small>


        <!-- UnionCloud ID Holder -->
        <input type="hidden" name="unioncloud_id" v-bind:value="student.uid"/>


        <!-- Tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="student-tab" data-toggle="tab" href="#student" role="tab" aria-controls="student" aria-selected="true">Student</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="non-student-tab" data-toggle="tab" href="#non-student" role="tab" aria-controls="profile" aria-selected="false">Non-Student</a>
            </li>
        </ul>



        <!-- Content -->
        <div class="tab-content" id="unioncloud_search">



            <!-- Student -->
            <div class="tab-pane fade show active" id="student" role="tabpanel" aria-labelledby="student-tab">
                <div class="form-group">
                    <label class="col-form-label" for="modal-student-id">Student ID (e.g. tt15951):</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="modal-student-id" v-model="searches.studentId">
                        <button
                                class="btn btn-secondary"
                                type="button"
                                id="search-by-student-id"
                                style="width:35%;"
                                @click="searchByStudentID"
                        >
                            <i class="fa fa-search"></i> Search
                        </button>
                    </div>
                    <div class="unioncloud_error_message" id="modal-student-id-error" v-text="errors.studentId" v-show="errors.studentId !== ''"></div>
                </div>
            </div>






            <!-- Non Student -->
            <div class="tab-pane fade" id="non-student" role="tabpanel" aria-labelledby="non-student-tab">
                <div class="form-group">
                    <label class="col-form-label" for="modal-student-email">Email</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="modal-student-email" v-model="searches.email">
                        <button
                                class="btn btn-secondary"
                                type="button"
                                id="search-by-email"
                                style="width:35%;"
                                @click="searchByEmail"
                        >
                            <i class="fa fa-search"></i> Search
                        </button>
                    </div>
                    <div class="unioncloud_error_message" id="modal-student-email-error" v-text="errors.email" v-show="errors.email !== ''"></div>
                </div>
            </div>



        </div>


        <!-- Student Select -->
        <select id="student_select" v-model="selectedAccount" v-show="unioncloudResults[0].uid !== null">
            <option v-for="student in unioncloudResults" :value="student" v-text="student.name+' - '+student.email"></option>
        </select>





        <!-- Student Selected -->
        <div>Selected Account: <div id="current-student"></div></div>



    </fieldset>
</div>
@push('scripts')
    <script type="text/javascript">

        let unioncloudSearch = new Vue({
            el: '#unioncloud_search_el',
            data: {
                unioncloudResults: [
                    {
                        'uid': null,
                        'name': null,
                        'email': null
                    }
                ],
                selectedAccount: {
                    id: 0
                },
                errors: {
                    studentId: '',
                    email: ''
                },
                searches: {
                    studentId: '',
                    email: ''
                }
            },
            computed: {

                student() {
                    console.log(this.selectedAccount.id);
                    console.log(this.unioncloudResults);
                    console.log(this.unioncloudResults[0]);
                    return this.unioncloudResults[this.selectedAccount.id];
                }
            },
            methods: {
                searchByStudentID: function() {
                    this.searchForUser({id: this.searches.studentId}, 'studentId');
                },
                searchByEmail: function() {
                    this.searchForUser({email: this.searches.email}, 'email');
                },
                searchForUser: function(data, error_property) {
                    this.errors = {studentId: '', email: ''};

                    axios.get('{{ url('/committeedetails/unioncloud/user/search') }}',
                        {
                            params: data,
                            accept: 'application/json',
                        }
                    )
                        .then(response => {
                            this.unioncloudResults = response.data;
                        })
                        .catch(error => {
                            this.errors[error_property] = 'No users found.';
                            this.unioncloudResults = [{'uid': null, 'name': null, 'email': null}];
                        })
                }
            }
        });

        {{--$(document).ready(function() {--}}
            {{--$('#search-by-student-id').on('click', function() {--}}
                {{--resetUnionCloudForm();--}}
                {{--var student_id = $('#modal-student-id').val();--}}
                {{--var users = searchForUser({id: student_id}, 'student');--}}
            {{--});--}}

            {{--$('#search-by-email').on('click', function() {--}}
                {{--resetUnionCloudForm();--}}
                {{--var student_email = $('#modal-student-email').val();--}}
                {{--var users = searchForUser({email: student_email}, 'nonstudent');--}}
            {{--});--}}

            {{--$('#student_select').on('change', function() {--}}
                {{--console.log(this.val());--}}
            {{--});--}}
        {{--});--}}



        {{--function searchForUser(search, error_id)--}}
        {{--{--}}
            {{--fail_function = getFailFunction(error_id);--}}

            {{--$.ajax({--}}
                {{--url: '{{ url('/committeedetails/unioncloud/user/search') }}',--}}
                {{--type: 'GET',--}}
                {{--data: search--}}
            {{--})--}}
                {{--.done(function(response) {--}}
                    {{--var users = response;--}}
                    {{--populateUsers(users);--}}
                {{--})--}}
                {{--.fail(fail_function);--}}

        {{--}--}}

        {{--function getFailFunction(error_id)--}}
        {{--{--}}
            {{--switch(error_id)--}}
            {{--{--}}
                {{--case 'student':--}}
                    {{--return function(jqXHR, textStatus) {--}}
                        {{--$('#modal-student-id-error').show().text('No students were found with this student ID.');--}}
                    {{--};--}}
                {{--case 'nonstudent':--}}
                    {{--return function(jqXHR, textStatus) {--}}
                        {{--$('#modal-student-email-error').show().text('No users were found with that email.');--}}
                    {{--};--}}
                {{--default:--}}
                    {{--return function(jqXHR, textStatus) {--}}
                        {{--$('#modal-student-email-error').show().text('Sorry, something went wrong.');--}}
                    {{--};--}}
            {{--}--}}
        {{--}--}}

        {{--function populateUsers(users)--}}
        {{--{--}}
            {{--$('#student_select').show();--}}
            {{--var options = [];--}}

            {{--for (var uid1 in users)--}}
            {{--{--}}
                {{--user = {--}}
                    {{--uid: uid1,--}}
                    {{--name: users[uid1].name,--}}
                    {{--email: users[uid1].email--}}
                {{--};--}}
                {{--unioncloudSearch.unioncloudResults.push(user);--}}
            {{--}--}}

            {{--for (var uid in users)--}}
            {{--{--}}
                {{--$('<option>').val(uid).text(users[uid].name+' - '+users[uid].email).appendTo('#student_select');--}}
            {{--}--}}

            {{--$('#current-student').text($('#student_select').text());--}}
        {{--}--}}

        {{--function resetUnionCloudForm()--}}
        {{--{--}}
            {{--$('#unioncloud_id').val(null);--}}
            {{--$('#current-student').empty();--}}
            {{--$('#student_select').hide();--}}
            {{--$('#student_select').empty();--}}
            {{--$('#modal-student-id-error').hide();--}}
            {{--$('#modal-student-email-error').hide();--}}


        {{--}--}}
    </script>
@endpush