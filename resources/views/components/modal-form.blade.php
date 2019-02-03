{{--Set header, body, triggerID, onLoadModal--}}


<div class="modal fade" id="edit-{{$triggerID}}-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-modal-label">{{ $header }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="attachment-body-content">
                {!! $body !!}
            </div>
            <div class="modal-footer">
                @stack('modal-buttons')
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">

    $(document).ready(function() {

        // Show the popup
        $(document).on('click', "#{{ $triggerID }}", function() {
            $(this).addClass('edit-item-{{ $triggerID}}-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

            var options = {
                'backdrop': 'static'
            };
            $('#edit-{{$triggerID}}-modal').modal(options)
        });

        // Show popup trigger
        $('#edit-{{$triggerID}}-modal').on('show.bs.modal', function() {
            onLoadModal();
        });

        // Hide popup trigger
        $('#edit-{{$triggerID}}-modal').on('hide.bs.modal', function() {
            $('.edit-item-{{ $triggerID}}-trigger-clicked').removeClass('edit-item-{{ $triggerID}}-trigger-clicked')
            onHideModal();
        });
    })

</script>
{!! $onLoadModal !!}
{!! $onHideModal !!}
@endpush