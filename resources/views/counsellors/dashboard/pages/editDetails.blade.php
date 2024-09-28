@extends('counsellors.dashboard.dashboard')

@section('content')
    <h1>Edit Profile</h1>

    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('profile.update', $counsellor->counsellor_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Name Field -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $counsellor->full_name_with_rate) }}" maxlength="255" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $counsellor->email) }}" maxlength="255" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Phone Field -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $counsellor->mobile_no) }}" maxlength="15" required>
                    @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Title Field -->
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $counsellor->title) }}" maxlength="255">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Gender Field -->
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender">
                        <option value="">Select gender</option>
                        <option value="male" {{ old('gender', $counsellor->gender) == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $counsellor->gender) == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="specializations" class="form-label">Specializations</label>
                    <div id="specialization-container">
                        @if(old('specializations', $counsellor->specializations))
                            @foreach (old('specializations', $counsellor->specializations) as $specialization)
                                <div class="input-group mb-2 specialization-row">
                                    <input type="text" class="form-control" name="specializations[]" value="{{ $specialization }}">
                                    <button type="button" class="btn btn-danger remove-specialization">Remove</button>
                                </div>
                            @endforeach
                        @else
                            <div class="input-group mb-2 specialization-row">
                                <input type="text" class="form-control" name="specializations[]" placeholder="Enter specialization">
                                <button type="button" class="btn btn-danger remove-specialization">Remove</button>
                            </div>
                        @endif
                    </div>
                    <button type="button" class="btn btn-secondary" id="add-specialization">Add Specialization</button>
                </div>

                <!-- Bio Field with Word Limit -->
                <div class="mb-3">
                    <label for="bio" class="form-label">Bio</label>
                    <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="3" maxlength="500">{{ old('bio', $counsellor->bio) }}</textarea>
                    <small id="bioHelp" class="form-text text-muted">Max 500 characters.</small>
                    @error('bio')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Languages Field with "Add More" -->
                <div class="mb-3">
                    <label for="languages" class="form-label">Languages</label>
                    <div id="language-fields">
                        @foreach(old('languages', $counsellor->languages ?? ['']) as $language)
                            <div class="input-group mb-2">
                                <input type="text" name="languages[]" class="form-control" value="{{ $language }}" placeholder="Enter language">
                                <button type="button" class="btn btn-danger remove-language">Remove</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" id="add-language" class="btn btn-secondary">Add Language</button>
                </div>

                <!-- Profile Image Upload -->
                <div class="mb-3">
                    <label for="profile_image" class="form-label">Profile Image</label>
                    <input type="file" class="form-control @error('profile_image') is-invalid @enderror" id="profile_image" name="profile_image">
                    @error('profile_image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    @if ($counsellor->profile_image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $counsellor->profile_image) }}" alt="Profile Image" class="img-thumbnail" style="width: 150px;">
                        </div>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('add-language').addEventListener('click', function() {
            var languageFields = document.getElementById('language-fields');
            var newField = `
                <div class="input-group mb-2">
                    <input type="text" name="languages[]" class="form-control" placeholder="Enter language">
                    <button type="button" class="btn btn-danger remove-language">Remove</button>
                </div>`;
            languageFields.insertAdjacentHTML('beforeend', newField);
        });

        document.getElementById('language-fields').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-language')) {
                e.target.closest('.input-group').remove();
            }
        });

        document.getElementById('add-specialization').addEventListener('click', function() {
            let container = document.getElementById('specialization-container');
            let newField = document.createElement('div');
            newField.classList.add('input-group', 'mb-2', 'specialization-row');
            newField.innerHTML = `
                <input type="text" class="form-control" name="specializations[]" placeholder="Enter specialization">
                <button type="button" class="btn btn-danger remove-specialization">Remove</button>
            `;
            container.appendChild(newField);
        });

        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-specialization')) {
                e.target.closest('.specialization-row').remove();
            }
        });

    </script>
@endsection

