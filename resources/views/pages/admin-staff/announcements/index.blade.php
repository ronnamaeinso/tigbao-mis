<x-auth-layout title="Announcements">
    <section class="container mt-sm-4 p-4 p-sm-0">

        <div class="card shadow-lg rounded-0">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="m-0 primary-color">
                        <x-icon type="bullhorn" />
                        List of Announcements
                    </h5>
                    {{-- create --}}
                    <a href="{{ route('announcements.create') }}" class="btn btn-sm primary-color fw-medium">
                        <x-icon type="plus" />
                        Make Accouncement
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th class="primary-color">No</th>
                                <th class="primary-color">Action</th>
                                <th class="primary-color">Title</th>
                                <th class="primary-color">Description</th>
                                <th class="primary-color">Date Announced</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td class="primary-color">{{ $loop->iteration }}</td>
                                    <td class="primary-color">
                                        <button class="btn btn-sm bg-primary-color text-white delete-btn"
                                            data-id="{{ $item->encrypted_id }}">
                                            <x-icon type="trash" />
                                            Delete
                                        </button>
                                        <a href="{{ route('announcements.edit', ['announcement' => $item->encrypted_id]) }}"
                                            class="btn btn-sm bg-primary-color">
                                            <x-icon type="pencil" />
                                            Edit
                                        </a>
                                    </td>
                                    <td class="primary-color">{{ $item->title }}</td>
                                    <td class="primary-color">{{ $item->description }}</td>
                                    <td class="primary-color">{{ $item->created_at->format('F j, Y @ h:i:s a') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-secondary text-center">--No Data--</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- pagination --}}
            @if (!empty($data))
                <div class="card-footer">
                    <div class="d-flex align-items-center justify-content-center justify-content-sm-between">
                        <span class="fw-medium primary-color">Current Page {{$data->currentPage()}} | Total Page {{$data->lastPage()}}</span>
                        <div class="d-flex align-items-center gap-1">
                            <a href="{{ $data->previousPageUrl() }}" class="btn btn-sm bg-primary-color text-white">
                                < Prev
                            </a>
                            <a href="{{ $data->nextPageUrl() }}" class="btn btn-sm bg-primary-color text-white">
                                Next >
                            </a>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>
{{-- ronna was here --}}
    {{-- script --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.addEventListener('click', async function(e) {
                // delete announcement
                const delete_btn = e.target.closest('.delete-btn');
                if (delete_btn) {
                    const id = delete_btn.dataset.id;

                    Swal.fire({
                        title: 'Are you sure?',
                        icon: 'warning',
                        text: 'You wont be able to revert it!',
                        showCancelButton: true,
                        confirmButtonColor: 'blue',
                        cancelButtonColor: 'red',
                        confirmButtonText: 'Yes, Delete It'
                    }).then( async (res)=>{
                        if(res.isConfirmed){
                            try {
                                await axios.delete(`/announcements/${encodeURIComponent(id)}`, {
                                    headers: {
                                        'X-CSRF-TOKEN': window.token,
                                        'Accept': 'application/json',
                                    }
                                });

                                Swal.fire({
                                    title: 'Success',
                                    icon: 'success',
                                    text: 'Successfully Deleted Announcement'
                                }).then(()=>{
                                    window.location.reload();
                                });

                            } catch (error) {
                                console.error(error);
                                Swal.fire({
                                    title: 'Server Error',
                                    icon: 'error',
                                    text: 'Something went wrong'
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>
</x-auth-layout>
