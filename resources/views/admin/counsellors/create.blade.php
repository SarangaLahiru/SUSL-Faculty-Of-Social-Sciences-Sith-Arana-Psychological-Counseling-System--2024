@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1>Add Counsellor</h1>
    <form action="{{ route('admin.counsellors.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="full_name_with_rate">Full Name with Rate</label>
            <input type="text" class="form-control" name="full_name_with_rate" required>
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
            <select class="form-control" name="gender" required>
                <option value="female">Female</option>
                <option value="male">Male</option>
            </select>
        </div>
        <div class="form-group">
            <label for="mobile_no">Mobile No</label>
            <input type="text" class="form-control" name="mobile_no" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" required>
        </div>
        <div class="form-group">
            <label for="intro">Intro</label>
            <textarea class="form-control" name="intro" required></textarea>
        </div>
        <div class="form-group">
            <label for="bio">Bio</label>
            <textarea class="form-control" name="bio" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Counsellor</button>
    </form>
</div>
@endsection
