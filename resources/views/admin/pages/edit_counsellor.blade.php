@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1 class="my-4">Edit Counsellor </h1>

     <form action="{{ route('counsellorsShow.update', $counsellor->counsellor_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="full_name_with_rate">Full Name with Rate</label>
            <input type="text" name="full_name_with_rate" class="form-control" value="{{ $counsellor->full_name_with_rate }}" required>
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $counsellor->title }}" required>
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" class="form-control" required>
                <option value="male" {{ $counsellor->gender === 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $counsellor->gender === 'female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="mobile_no">Mobile No</label>
            <input type="text" name="mobile_no" class="form-control" value="{{ $counsellor->mobile_no }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $counsellor->email }}" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" value="{{ $counsellor->username }}" required>
        </div>
        <div class="form-group">
            <label for="intro">Intro</label>
            <textarea name="intro" class="form-control" required>{{ $counsellor->intro }}</textarea>
        </div>
        <div class="form-group">
            <label for="bio">Bio</label>
            <textarea name="bio" class="form-control" required>{{ $counsellor->bio }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Counsellor</button>
    </form>


</div>
@endsection
