<x-auth-layout title="Make Announcements">
    <section class="container mt-sm-4 p-4 p-sm-0">
        <div class="card shadow-lg rounded-0">
            <div class="card-header">
                <h5 class="m-0">
                    <x-icon type="bullhorn" />
                    Create Announcement
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('announcements.store') }}" method="POST">
                    @csrf

                    {{-- title --}}
                    <div class="mb-4">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                            placeholder="Announcement Title" value="{{ old('title') }}">
                        @error('title')
                            <small class="text-danger fw-medium">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- description --}}
                    <div class="mb-4">
                        <label for="description">Description</label>
                        <textarea type="text" name="description" id="description" class="form-control"
                            placeholder="Announcement Description">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger fw-medium">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- btn --}}
                    <div class="d-flex align-items-center justify-content-end gap-2">
                        <button class="btn btn-sm btn-success bg-primary-color text-white" type="submit">
                            <x-icon type="check" />
                            Submit
                        </button>
                        <a href="{{ route('announcements.index') }}" class="btn btn-sm bg-primary-color text-white">
                            <x-icon type="arrow-left" />
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-auth-layout>
