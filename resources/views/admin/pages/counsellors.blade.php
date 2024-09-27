@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1 class="my-4">Counsellors</h1>
    <a href="{{ route('counsellorsShow.create') }}" class="btn btn-primary mb-3">Add New Counsellor</a>
    <div class="row">
        @foreach($counsellors as $counsellor)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $counsellor->full_name_with_rate }}</h5>
                        <p class="card-text">
                            <strong>Title:</strong> {{ $counsellor->title }}<br>
                            <strong>Gender:</strong> {{ ucfirst($counsellor->gender) }}<br>
                            <strong>Mobile No:</strong> {{ $counsellor->mobile_no }}<br>
                            <strong>Email:</strong> {{ $counsellor->email }}<br>
                            <strong>Username:</strong> {{ $counsellor->username }}<br>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{ route('counsellorsShow.edit', $counsellor->counsellor_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('counsellorsShow.destroy', $counsellor->counsellor_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this counsellor?');">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
