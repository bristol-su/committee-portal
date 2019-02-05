@php $triggerID = 'new-committee-member'; @endphp
@component('components.modal-form')

    @slot('header')
        Add New Committee Member
    @endslot

    @slot('body')



        <form id="edit-user-form" class="form-horizontal" method="POST" action="{{url('committeedetails/add')}}">
            @csrf
            <div class="card text-black bg-white mb-0">


                <div class="card-header">
                    <h4 class="m-0">Add a new committee member for your society. Anyone you add must have an account on our <a href="https://www.bristolsu.org.uk">website!</a></h4>
                </div>


                <div class="card-body">

                    <!-- Position -->
                    <div class="form-group">
                        <label for="modal-input-position">Position</label>
                        <div><small>Select the position of the new member</small></div>
                        <input type="text" name="modal-input-position" class="form-control" id="modal-input-position" required="">
                    </div>


                    <!-- UnionCloud Account -->
                    <div class="form-group">


                        <!-- UnionCloud Account -->
                        <div class="tab-pane fade show active" id="student" role="tabpanel" aria-labelledby="student-tab">
                            <div id="unioncloud_account_search">

                                <label class="col-form-label" for="modal-input-position">Committee Member</label>
                                <div><small>Search by Email or Student ID</small></div>

                                <!-- UnionCloud ID Holder -->
                                <input type="hidden" name="unioncloud_id" v-model="uid"/>

                                <v-select
                                        label="fullLabel"
                                        :filterable="false"
                                        :options="options"
                                        :get-option-label="getLabel"
                                        @search="onSearch"
                                        {{--@change="updateuid" TODO Get this working--}}
                                >
                                </v-select>
                                <small><span v-show="errorVisible">No users found.</span></small>
                            </div>
                        </div>

                    </div>

                    <script>
                        new Vue({
                            el: "#unioncloud_account_search",
                            data: {
                                options: [],
                                errorVisible: false,
                                uid: 12398923
                            },
                            methods: {
                                onSearch(search, loading) {
                                    loading(true);
                                    this.search(loading, search, this);
                                },
                                search: _.debounce((loading, search, vm) => {
                                    axios.get('{{ url('/committeedetails/unioncloud/user/search') }}',
                                        {
                                            params: {q: search},
                                            accept: 'application/json'
                                        }
                                    ).then(response => {
                                        vm.errorVisible = false;
                                        vm.options = response.data;
                                        loading(false);
                                    }).catch(error => {
                                        vm.errorVisible = true;
                                        vm.options = [];
                                        loading(false);

                                    });
                                }, 1000),
                                getLabel(option) {
                                    return option.name + ' - ' + option.email;
                                },
                                updateuid() {
                                    this.uid = this.mutableValue.uid
                                }
                            }
                        });

                    </script>


                    <button type="button" onclick="$('#edit-user-form').submit();" class="btn btn-info">Add Committee Member</button>

                </div>
            </div>

        </form>
    @endslot

    @slot('triggerID')
        {{$triggerID}}
    @endslot

    @slot('onLoadModal')
        <script type="text/javascript">
            function onLoadModal()
            {
                var el = $(".edit-item-{{$triggerID}}-trigger-clicked");
                var row = el.closest(".data-row");

                // get the data
                var id = el.data('item-id');
                var name = row.children(".name").text();
                var description = row.children(".description").text();


                // fill the data in the input fields
                // $("#modal-input-id").val(id);
                // $("#modal-input-name").val(name);
                // $("#modal-input-description").val(description);
            }
        </script>

    @endslot

    @slot('onHideModal')
        <script type="text/javascript">
            function onHideModal()
            {
                $("#edit-user-form").trigger("reset");
            }
        </script>
    @endslot


@endcomponent