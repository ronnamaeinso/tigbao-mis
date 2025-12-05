<x-auth-layout title="Important Files - Edit">
    <div class="container mx-auto p-0 m-0 mt-4" style="max-width: 500px;">
        <div class="card shadow-lg">
            <div class="card-header d-flex algin-items-center justify-content-between">
                <h5 class="m-0 primary-color w-fit">
                    <x-icon type="folder" />
                    Edit Folder
                </h5>
                <a href="{{route('important-files.index')}}" class="btn btn-sm bg-primary-color">
                    <x-icon type="arrow-left" />
                    Backs
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('important-files.update', ['important_file' => urlencode($id)]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- input --}}
                    <div class="input-group mb-3">
                        <label for="folder_name" class="input-group-text primary-color">
                            <x-icon type="folder" />
                        </label>
                        <input type="text" name="folder_name" id="folder_name" class="form-control primary-color"
                            placeholder="Folder Name" value="{{$folder->name}}">
                    </div>
                    @error('folder_name')
                        <small class="text-danger fw-medium">{{ $message }}</small>
                    @enderror

                    {{-- submit btn --}}
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-sm bg-primary-color">
                            <x-icon type="pencil" />
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-auth-layout>
