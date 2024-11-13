@extends('coworker_side.side')

@section('content')

<div class="mb-3">
    <h4>Admin : {{ Auth::user()->name }}</h4>
</div>
<div class="row">
    <div class="col-12 col-md-6 d-flex">
        <div class="card flex-fill border-0 illustration">
            <div class="card-body p-0 d-flex flex-fill">
                <div class="row g-0 w-100">
                    <div class="col">
                        <div class="p-3 m-1">
                            <h4>Welcome Back, {{ Auth::user()->name }}</h4>
                            {{-- <p class="mb-0">Admin Dashboard</p> --}}
                        </div>
                    </div>
                    {{-- <div class="col-6 align-self-end text-end">
                        <img src="{{ asset('img/poster.jpg') }}" class="img-fluid illustration-img"
                    alt="">
                </div> --}}
            </div>
        </div>
    </div>
</div>
<div class="col-12 col-md-6 d-flex">
    <div class="card flex-fill border-0">
        <div class="card-body py-4">
            <div class="d-flex align-items-start">
                <div class="flex-grow-1">
                    <h4 class="mb-2">
                        {{ $data['total_users'] }}
                    </h4>
                    <p class="mb-2">
                        Total Users
                    </p>
                    <div class="mb-0">
                        <span class="badge text-success me-2">
                            {{ $data['percentage_change'] > 0 ? '+' : '' }}{{ $data['percentage_change'] }}%
                        </span>
                        <span class="text-muted">
                            Since Last Month
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="card border-0">
    <div class="card-header">
        <h5 class="card-title">Users Table</h5>
        <h6 class="card-subtitle text-muted">List of registered users</h6>
    </div>
    <div class="card-body">
        <table id="users-table" class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['users'] as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#users-table').DataTable();
    });
</script>
@endsection