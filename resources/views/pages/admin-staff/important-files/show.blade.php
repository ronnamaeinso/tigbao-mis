<x-auth-layout title="Important Files - View Folder">
    <div class="container mx-auto p-4 p-sm-0 m-0 mt-4">
        <div class="card shadow-lg">
            <div class="card-header d-flex algin-items-center justify-content-between">
                <h5 class="m-0 primary-color w-fit">
                    <x-icon type="folder" />
                    {{ $folder->name }}
                </h5>
                <a href="{{ route('important-files.index') }}" class="btn btn-sm bg-primary-color">
                    <x-icon type="arrow-left" />
                    Back
                </a>
            </div>
            <div class="card-body overflow-auto {{ $files->count() == 0 ? 'vh-100' : '' }}" id="drop-file-wrapper">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                    @if (Auth::user()->role == 1)
                        {{-- form upload files --}}
                        <form action="" method="POST" id="form-file-uploads">
                            @csrf
                            <input type="hidden" name="folder-id" value="{{ $id }}">

                            <label for="upload-files" class="d-block w-fit btn fw-medium bg-primary-color"
                                id="label-upload-files">
                                <x-icon type="file" />
                                Upload file/s
                            </label>

                            <input type="file" name="upload-files[]" id="upload-files" class="hidden" multiple>
                        </form>
                    @endif

                    {{-- form search --}}
                    <form action="" class="d-flex align-item-center">
                        <input type="search" name="search" id="search" class="form-control">
                        <button class="btn btn-sm" type="submit">
                            <x-icon type="search" />
                        </button>
                    </form>
                </div>

                {{-- list of files --}}
                <div class="table-responsive mt-4">
                    <table class="table table table-hover">
                        <thead>
                            <tr>
                                <th class="primary-color fw-medium">File name</th>
                                <th class="primary-color fw-medium">Date uploaded</th>
                                <th class="primary-color fw-medium"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($files as $item)
                                <tr>
                                    <td>{{ $item->file_name }}</td>
                                    <td>{{ $item->created_at->format('F j, Y | h:i A') }}</td>
                                    <td class="text-center cursor-pointer">
                                        {{-- dropown --}}
                                        <div class="dropdown">

                                            <x-icon type="ellipsis-v w-100" data-bs-toggle="dropdown" />

                                            <ul class="dropdown-menu">
                                                @if (Auth::user()->role == 1)
                                                    <li class="dropdown-item p-0">
                                                        <span class="text-danger fw-medium d-block w-100 p-2 delete-btn"
                                                            data-id="{{ $item->encrypted_id }}">
                                                            <x-icon type="trash" />
                                                            Delete file
                                                        </span>
                                                    </li>
                                                @endif
                                                <li class="dropdown-item p-0">
                                                    <a href="{{route('important-files.upload-files.download', ['id' => urlencode($item->encrypted_id)])}}"
                                                        class="text-info fw-medium d-block w-100 p-2" target="_blank">
                                                        <x-icon type="download" />
                                                        Download file
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-sm text-secondary text-center fw-medium">--NO DATA--
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- pagination --}}
                    <div class="d-flex gap-2 align-items-center justify-content-between flex">
                        <span class="fw-medium primary-color">Current Page {{ $files->currentPage() }} | Total Page
                            {{ $files->lastPage() }}</span>
                        {{ $files->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (Auth::user()->role == 1)
                uploadFiles();
                deleteFile();
            @endif
        });

        @if (Auth::user()->role == 1)
            let isUploading = false;

            /**
             * upload files
             */
            const uploadFiles = () => {
                const form = document.getElementById('form-file-uploads');
                const input_files = document.getElementById('upload-files');
                const label = document.getElementById('label-upload-files');

                input_files.addEventListener('change', async function(e) {
                    const files = e.target.files;

                    if (files.length != 0) {
                        try {

                            if (isUploading == true) return;

                            isUploading = true;

                            label.innerHTML = `<i class="fa-solid fa-spinner fa-spin"></i> Processing...`;

                            const formData = new FormData(form);

                            const response = await axios.post(`/important-files/upload-files`, formData, {
                                headers: {
                                    'Accept': 'application/json'
                                }
                            });

                            label.innerHTML = `<i class="fa-solid fa-file"></i> Upload file/s`;

                            isUploading = false;

                            window.Swal.fire({
                                title: 'Success',
                                icon: 'success',
                                text: 'Successfully Uploaded files'
                            }).then(() => {
                                window.location.reload();
                            });


                        } catch (error) {

                            label.innerHTML = `<i class="fa-solid fa-file"></i> Upload file/s`;

                            isUploading = false;

                            if (error.status == 422) {

                                window.Swal.fire({
                                    title: 'Warning',
                                    icon: 'warning',
                                    text: error.response.data.message
                                });

                                return;
                            }

                            window.Swal.fire({
                                title: 'Server Error',
                                icon: 'error',
                                text: 'Pls Contact Developer'
                            });

                            return;
                        }
                    }
                });
            }

            /**
             * delete file
             */
            const deleteFile = () => {
                document.addEventListener('click', function(e) {
                    const delete_btn = e.target.closest('.delete-btn');

                    if (delete_btn) {
                        const id = e.target.dataset.id;

                        Swal.fire({
                            title: "Are you sure?",
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete it!"
                        }).then(async (result) => {
                            if (result.isConfirmed) {
                                try {
                                    const response = await axios.delete(
                                        `/important-files/upload-files/${encodeURIComponent(id)}`, {
                                            headers: {
                                                'X-CSRF-TOKEN': window.token,
                                                'Accept': 'application/json'
                                            }
                                        });

                                    window.Swal.fire({
                                        title: 'Success',
                                        icon: 'success',
                                        text: 'Successfully Delete File'
                                    }).then(() => {
                                        window.location.reload();
                                    });

                                } catch (error) {
                                    window.Swal.fire({
                                        title: 'Server Error',
                                        icon: 'error',
                                        text: 'Pls Contact Developer'
                                    });

                                    return;
                                }
                            }
                        });
                    }
                });
            };
        @endif
    </script>
</x-auth-layout>
