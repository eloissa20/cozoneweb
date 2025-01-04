@extends('coworker_side.side')

@section('content')

<div class="form-section">
    <h2>MEETING ROOMS</h2>

    <form id="section8" action="{{ route('saveMeetings', $id) }}" method="POST">
        @csrf
        <!-- MEETINGS Section -->
        <div class="meeting-section">
            <table class="table" id="table">
                <tr>
                    <th>Number of People</th>
                    <th>Price</th>
                    <th>Hours</th>
                    <th>Actions</th>
                </tr>
                <tr>
                    <td><input type="text" class="form-control" name="inputs[{{ $index ?? 0 }}][num_people]" placeholder="1 hour - 2 hours" /></td>
                    <td><input type="text" class="form-control" name="inputs[{{ $index ?? 0 }}][price]" placeholder="PHP" /></td>
                    <td><input type="text" class="form-control" name="inputs[{{ $index ?? 0 }}][hours]" placeholder="1 - 2" /></td>
                    <td>
                        <button type="button" class="btn btn-outline-secondary" id="add-meeting"><i class="bi bi-plus-lg"></i></button>
                    </td>
                </tr>
            </table>
        </div>

        <button type="button" class="btn btn-outline-secondary" onclick="window.location.href='{{ route('myCoworkingSpace') }}'">Back</button>
        <button type="submit" class="btn btn-dark">Save</button>
    </form>

    <hr class="separator-line" />

    <div class="meeting-section-view mt-3">
        <table class="table" id="table">
            <tr>
                <th>Number of People</th>
                <th>Price</th>
                <th>Hours</th>
                <th>Actions</th>
            </tr>
            @foreach($meetingFields as $index => $meetingField)
                <tr data-id="{{ $meetingField->id }}" class="meeting-row">
                    <td><input type="text" class="form-control" name="inputs[{{ $index }}][num_people]" value="{{ old('inputs.' . $index . '.num_people', $meetingField->num_people) }}" placeholder="1 hour - 2 hours" disabled /></td>
                    <td><input type="text" class="form-control" name="inputs[{{ $index }}][price]" value="{{ old('inputs.' . $index . '.price', $meetingField->price) }}" placeholder="PHP" disabled/></td>
                    <td><input type="text" class="form-control" name="inputs[{{ $index }}][hours]" value="{{ old('inputs.' . $index . '.hours', $meetingField->hours) }}" placeholder="1 - 2" disabled/></td>
                    <td>
                        <button type="button" class="btn btn-outline-secondary edit-meeting" data-id="{{ $meetingField->id }}"><i class="bi bi-pencil"></i> Edit</button>
                        <button type="button" class="btn btn-outline-secondary delete-meeting" data-id="{{ $meetingField->id }}"><i class="bi bi-trash"></i> Delete</button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>

<script>
    var i = 0;

    // Add new meeting field row
    $('#add-meeting').click(function(){
        ++i;
        $('#table').append(
            `<tr data-id="new-${i}">
                <td>
                    <input type="text" class="form-control form-control" name="inputs[new-${i}][num_people]" placeholder="1 hour - 2 hours"/>
                </td>
                <td>
                    <input type="text" class="form-control form-control" name="inputs[new-${i}][price]" placeholder="PHP"/>
                </td>
                <td>
                    <input type="text" class="form-control form-control" name="inputs[new-${i}][hours]" placeholder="1 - 2"/>
                </td>
                <td>
                    <button type="button" class="btn btn-outline-danger remove"><i class="bi bi-dash-lg"></i></button>
                </td>
            </tr>`
        );
    });

    // Remove Input Row (for new rows only)
    $(document).on('click', '.remove', function(){
        $(this).closest('tr').remove();
    });

    // Delete meeting Row (for existing rows in the DB)
    $(document).on('click', '.delete-meeting', function(){
        var meetingId = $(this).data('id');
        var row = $(this).closest('tr');

        if (meetingId !== 'new') {
            $.ajax({
                url: "{{ route('deleteMeeting', ['id' => $id]) }}",
                method: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}",
                    meeting_id: meetingId
                },
                success: function(response) {
                    if (response.status === 'success') {
                        row.remove();
                    } else {
                        alert('Error removing meeting');
                    }
                },
                error: function() {
                    alert('Error removing meeting');
                }
            });
        } else {
            row.remove();
        }
    });

    // Edit functionality
    $(document).on('click', '.edit-meeting', function(){
        var row = $(this).closest('tr');
        var inputs = row.find('input');

        inputs.prop('disabled', false);
        $(this).html('<i class="bi bi-save"></i> Save');
        $(this).removeClass('edit-meeting').addClass('save-meeting');
    });

    // Save changes after editing
    $(document).on('click', '.save-meeting', function () {
        var row = $(this).closest('tr');
        var inputs = row.find('input');
        var meetingId = row.data('id');
        var button = $(this);

        $.ajax({
            url: "{{ route('editMeeting', ['id' => $id]) }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                meeting_id: meetingId,
                num_people: inputs.eq(0).val(),
                price: inputs.eq(1).val(),
                hours: inputs.eq(2).val(),
            },
            success: function (response) {
                if (response.status === 'success') {
                    inputs.prop('disabled', true);
                    button.html('<i class="bi bi-pencil"></i> Edit');
                    button.removeClass('save-meeting').addClass('edit-meeting');
                } else {
                    alert('Error saving changes');
                }
            },
            error: function () {
                alert('Error saving changes');
            }
        });
    });

</script>


@endsection
