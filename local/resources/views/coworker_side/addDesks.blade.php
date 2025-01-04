@extends('coworker_side.side')

@section('content')

<div class="form-section">
    <h2>DESKS</h2>

    <form id="section8" action="{{ route('saveDesks', $id) }}" method="POST">
        @csrf
        <!-- DESKS Section -->
        <div class="desk-section">
            <table class="table" id="table">
                <tr>
                    <th>Duration</th>
                    <th>Price</th>
                    {{-- <th>Hours</th> --}}
                    <th>Actions</th>
                </tr>
                <tr>
                    <td><input type="text" class="form-control" name="inputs[{{ $index ?? 0 }}][duration]" placeholder="1 hour - 2 hours" /></td>
                    <td><input type="text" class="form-control" name="inputs[{{ $index ?? 0 }}][price]" placeholder="PHP" /></td>
                    {{-- <td><input type="text" class="form-control" name="inputs[{{ $index ?? 0 }}][hours]" placeholder="1 - 2" /></td> --}}
                    <td>
                        <button type="button" class="btn btn-outline-secondary" id="add-desk"><i class="bi bi-plus-lg"></i></button>
                    </td>
                </tr>
            </table>
        </div>

        <button type="button" class="btn btn-outline-secondary" onclick="window.location.href='{{ route('myCoworkingSpace') }}'">Back</button>
        <button type="submit" class="btn btn-dark">Save</button>
    </form>

    <hr class="separator-line" />

    <div class="desk-section-view mt-3">
        <table class="table" id="table">
            <tr>
                <th>Duration</th>
                <th>Price</th>
                {{-- <th>Hours</th> --}}
                <th>Actions</th>
            </tr>
            @foreach($deskFields as $index => $deskField)
                <tr data-id="{{ $deskField->id }}" class="desk-row">
                    <td><input type="text" class="form-control" name="inputs[{{ $index }}][duration]" value="{{ old('inputs.' . $index . '.duration', $deskField->duration) }}" placeholder="1 hour - 2 hours" disabled /></td>
                    <td><input type="text" class="form-control" name="inputs[{{ $index }}][price]" value="{{ old('inputs.' . $index . '.price', $deskField->price) }}" placeholder="PHP" disabled/></td>
                    {{-- <td><input type="text" class="form-control" name="inputs[{{ $index }}][hours]" value="{{ old('inputs.' . $index . '.hours', $deskField->hours) }}" placeholder="1 - 2" disabled/></td> --}}
                    <td>
                        <button type="button" class="btn btn-outline-secondary edit-desk" data-id="{{ $deskField->id }}"><i class="bi bi-pencil"></i> Edit</button>
                        <button type="button" class="btn btn-outline-secondary delete-desk" data-id="{{ $deskField->id }}"><i class="bi bi-trash"></i> Delete</button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>

<script>
    var i = 0;

    // Add new desk field row
    $('#add-desk').click(function(){
        ++i;
        $('#table').append(
            `<tr data-id="new-${i}">
                <td>
                    <input type="text" class="form-control form-control" name="inputs[new-${i}][duration]" placeholder="1 hour - 2 hours"/>
                </td>
                <td>
                    <input type="text" class="form-control form-control" name="inputs[new-${i}][price]" placeholder="PHP"/>
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

    // Delete Desk Row (for existing rows in the DB)
    $(document).on('click', '.delete-desk', function(){
        var deskId = $(this).data('id');
        var row = $(this).closest('tr');

        if (deskId !== 'new') {
            $.ajax({
                url: "{{ route('deleteDesk', ['id' => $id]) }}",
                method: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}",
                    desk_id: deskId
                },
                success: function(response) {
                    if (response.status === 'success') {
                        row.remove();
                    } else {
                        alert('Error removing desk');
                    }
                },
                error: function() {
                    alert('Error removing desk');
                }
            });
        } else {
            row.remove();
        }
    });

    // Edit functionality
    $(document).on('click', '.edit-desk', function(){
        var row = $(this).closest('tr');
        var inputs = row.find('input');

        inputs.prop('disabled', false);
        $(this).html('<i class="bi bi-save"></i> Save');
        $(this).removeClass('edit-desk').addClass('save-desk');
    });

    $(document).on('click', '.save-desk', function () {
        var row = $(this).closest('tr');
        var inputs = row.find('input');
        var deskId = row.data('id');
        var button = $(this); 

        $.ajax({
            url: "{{ route('editDesk', ['id' => $id]) }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                desk_id: deskId,
                duration: inputs.eq(0).val(),
                price: inputs.eq(1).val(),
                hours: inputs.eq(2).val(),
            },
            success: function (response) {
                if (response.status === 'success') {
                    inputs.prop('disabled', true);
                    button.html('<i class="bi bi-pencil"></i> Edit');
                    button.removeClass('save-desk').addClass('edit-desk');
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