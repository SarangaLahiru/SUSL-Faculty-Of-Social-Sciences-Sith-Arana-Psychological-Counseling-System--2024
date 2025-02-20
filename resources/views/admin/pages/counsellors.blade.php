@extends('admin.dashboard')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h1 class="fw-bold">Counsellors</h1>
        <a href="/download-analysis-pdf" class="btn btn-outline-primary d-flex align-items-center">
            <i class="fas fa-plus-circle me-2"></i> Generate Report
        </a>
        <a href="{{ route('counsellorsShow.create') }}" class="btn btn-outline-primary d-flex align-items-center">
            <i class="fas fa-plus-circle me-2"></i> Add New
        </a>


    </div>

    <div class="list-group shadow-sm ">
        @foreach($counsellors as $counsellor)
            <div class="list-group-item d-flex justify-content-between align-items-center py-3 ">
                <div class="d-flex align-items-center" style="font-size: 18px;">
                    <img src="{{ asset('storage/' . $counsellor->profile_image)}}" alt="Avatar" class="rounded-circle me-3" width="70" height="70">
                    <span class="fw-semibold m-2">{{ $counsellor->title }}</span>
                    <span class="fw-semibold m-2"> {{ $counsellor->full_name_with_rate }}</span>
                    <span class="fw-semibold m-2"> {{ $counsellor->mobile_no }}</span>
                </div>
                <div class="d-flex">
                    <a href="{{ route('admin.counsellor.changeTimeSlots', $counsellor->counsellor_id) }}" class="btn btn-outline-info btn-sm me-2">
                        <i class="fas fa-clock"></i> Change Time Slots
                    </a>
                    <a href="{{ route('counsellorsShow.edit', $counsellor->counsellor_id) }}" class="btn btn-outline-secondary btn-sm me-2">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('counsellorsShow.destroy', $counsellor->counsellor_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this counsellor?');">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    /* Adjust the list-group for counsellors */
    .list-group-item {
        border-radius: 10px;
        background-color: #f5f3f0;
        transition: box-shadow 0.3s;

    }

    .list-group-item:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Style for add button */
    .btn-outline-primary {
        color: white;
        border-color: #6f42c1;
        background-color: #622864;
    }

    .btn-outline-primary:hover {
        background-color: #6f42c1;
        color: #fff;
    }

    /* Button icons */
    .btn i {
        font-size: 16px;
    }

    /* Avatar image for counsellors */
    .list-group-item img {
        object-fit: cover;
    }
</style>
@endsection
