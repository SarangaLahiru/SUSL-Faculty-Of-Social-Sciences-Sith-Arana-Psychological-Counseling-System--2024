@extends('admin.dashboard')

@section('content')

<div class="container mt-5">
    <h1 class="text-center mb-4" style="color: #622864;">Feedback Management</h1>

    <div class="table-responsive">
        <table class="table table-hover shadow-sm">
            <thead class="table-header text-white" style="background-color: #622864;">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($feedbacks as $feedback)
                <tr>
                    <td>{{ $feedback->name ?? 'Anonymous' }}</td>
                    <td>{{ $feedback->email ?? 'Not Provided' }}</td>
                    <td style="cursor: pointer; color: #622864;" data-toggle="modal" data-target="#messageModal{{ $feedback->id }}">
                        {{ Str::limit($feedback->message, 30) }}
                    </td>
                    <td>
                        <span class="badge {{ $feedback->is_published ? 'badge-success' : 'badge-secondary' }}">
                            {{ $feedback->is_published ? 'Published' : 'Unpublished' }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('feedback.update', $feedback->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn {{ $feedback->is_published ? 'btn-outline-danger' : 'btn-outline-success' }}">
                                {{ $feedback->is_published ? 'Unpublish' : 'Publish' }}
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Modal for full message -->
                <div class="modal fade" id="messageModal{{ $feedback->id }}" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel{{ $feedback->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="messageModalLabel{{ $feedback->id }}">Message from {{ $feedback->name ?? 'Anonymous' }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>{{ $feedback->message }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    .table-header {
        background-color: #622864;
    }

    .btn-outline-danger {
        color: #d9534f;
        border-color: #d9534f;
    }

    .btn-outline-success {
        color: #5cb85c;
        border-color: #5cb85c;
    }

    .btn-outline-danger:hover, .btn-outline-success:hover {
        color: #fff;
    }

    /* Style badges */
    .badge-success {
        background-color: #5cb85c;
    }
    .badge-secondary {
        background-color: #6c757d;
    }

    /* Responsive table */
    .table-responsive {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
