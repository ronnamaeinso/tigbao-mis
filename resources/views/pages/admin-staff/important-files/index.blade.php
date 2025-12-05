<x-auth-layout title="Important Files">
    <div class="container mx-auto p-0 m-0 mt-4">
        @if (Auth::user()->role == 1)
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('important-files.create') }}" class="btn bg-primary-color fw-medium">
                <x-icon type="folder-plus" />
                Folder
            </a>
            <form action="" class="d-flex align-items-center">
                @csrf
                <input type="search" name="search" id="search" class="form-control">
                <button class="btn btn-sm">
                    <x-icon type="search"/>
                </button>
            </form>
        </div>
        @endif
        <div class="row row-gap-2 mt-4">
            @foreach ($folders as $item)
                <div class="col-12">
                    <div
                        class="d-flex justify-content-between align-items-center gap-3 text-decoration-none w-100 bg-primary-bgc text-white fw-medium rounded cursor-pointer">
                        <a href="{{route('important-files.show', ['important_file' => urlencode($item->encrypted_id)])}}" class="d-block text-decoration-none nav-link text-white w-100 h-100 p-3">
                            <x-icon type="folder" />
                            {{ $item->name }}
                        </a>
                        @if (Auth::user()->role == 1)
                            <div class="dropdown p-3">
                                <x-icon type="ellipsis-v px-4" data-bs-toggle="dropdown" />
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item">
                                        <a href="{{ route('important-files.edit', ['important_file' => urlencode($item->encrypted_id)]) }}"
                                            class="nav-link text-warning fw-medium w-100">
                                            <x-icon type="pencil" />
                                            Edit
                                        </a>
                                    </li>
                                    <li class="dropdown-item">
                                        <button type="button" class="nav-link text-danger fw-medium w-100 text-start delete-btn"
                                            data-id="{{ $item->encrypted_id }}">
                                            <x-icon type="trash" />
                                            Delete
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        {{-- pagination --}}
        <div class="d-flex align-items-center mt-4 justify-content-between flex-wrap">
            <span class="fw-medium">
                Current Page {{$folders->currentPage()}} | Total Page {{$folders->lastPage()}}
            </span>
            {{$folders->links()}}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (Auth::user()->role == 1)
                deleteFolder();
            @endif
        });

        @if (Auth::user()->role == 1)
            /**
             * this delete a folder
             *
             * event delegation for delete btn and if it was the btn then prompt delete confirmation
             * if confirmed then perform delete request if response is okay show success alert
             * else error alert
             *
             * @return void
             */
            const deleteFolder = () => {
                document.addEventListener('click', (e) => {
                    const button = e.target.closest('.delete-btn');

                    if (!button) return;

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
                                const response = await window.axios.delete(`/important-files/${id}`, {
                                    headers: {
                                        'X-CSRF-TOKEN': window.token,
                                        'Accept': 'application/json'
                                    }
                                });

                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                }).then(()=>{
                                    window.location.reload();
                                });
                            } catch (error) {

                                Swal.fire({
                                    title: "Server Error!",
                                    text: "Pls Contact Developer.",
                                    icon: "error"
                                });
                            }


                        }
                    });
                });
            };
        @endif
    </script>
</x-auth-layout>
