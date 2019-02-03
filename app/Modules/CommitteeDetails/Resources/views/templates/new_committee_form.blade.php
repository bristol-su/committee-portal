@php $triggerID = 'new-committee-member'; @endphp
@component('components.modal-form')

    @slot('header')
        Add New Committee Member
    @endslot

    @slot('body')

        <style>
            fieldset.scheduler-border {
                border: 2px groove #ddd !important;
                padding: 0 1.4em 1.4em 1.4em !important;
                margin: 0 0 1.5em 0 !important;
                -webkit-box-shadow: 0px 0px 0px 0px #000;
                box-shadow: 0px 0px 0px 0px #000;
            }

            legend.scheduler-border {
                font-size: 1.2em !important;
                font-weight: bold !important;
                text-align: left !important;
                width: auto;
                padding: 0 10px;
                border-bottom: none;
            }
        </style>
        <form id="edit-user-form" class="form-horizontal" method="POST" action="{{url('committeedetails/add')}}">
            <div class="card text-white bg-dark mb-0">


                <div class="card-header" style="background-color: #343a40">
                    <h4 class="m-0">Add a new committee member for your society. Anyone you add must have an account on our <a href="https://www.bristolsu.org.uk">website!</a></h4>
                </div>


                <div class="card-body">

                    <!-- Position -->
                    <div class="form-group">
                        <label class="col-form-label" for="modal-input-position">Position</label>
                        <div><small>Select the position of the new member</small></div>
                        <input type="text" name="modal-input-position" class="form-control" id="modal-input-position" required="">
                    </div>

                    <!-- UnionCloud Account -->
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">UnionCloud Account</legend>
                        <small>Search for an account by Student ID or Email</small>
                        <!-- UnionCloud ID -->
                        <div class="form-group">
                            <label class="col-form-label" for="modal-input-name">Student ID</label>
                            <input type="text" name="modal-input-name" class="form-control" id="modal-input-name" required="" autofocus="">
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label class="col-form-label" for="modal-input-description">Email</label>
                            <input type="text" name="modal-input-description" class="form-control" id="modal-input-description" required="">
                        </div>
                    </fieldset>

                    <button class="btn btn-info">Add Committee Member</button>

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
                console.log('populating');
                var el = $(".edit-item-{{$triggerID}}-trigger-clicked"); // See how its usefull right here?
                var row = el.closest(".data-row");

                // get the data
                var id = el.data('item-id');
                var name = row.children(".name").text();
                var description = row.children(".description").text();

                console.log(id, name, description);

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