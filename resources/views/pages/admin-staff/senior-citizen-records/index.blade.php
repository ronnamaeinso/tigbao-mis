<x-auth-layout title="Senior Citizen Records">
    <div class="container mx-auto p-0 m-0">

        <a href="{{ route('senior-citizen.records.create') }}" class="btn btn-sm bg-primary-color mb-3">
            <x-icon type="user-plus" />
            add citizen
        </a>
        <a href="{{ route('senior-citizen.archive') }}" class="btn btn-sm bg-primary-color mb-3">
            <x-icon type="folder-open" />
            Deceased Archive
        </a>

        <div class="card shadow-lg rounded-0">
            <div class="card-header">
                <div class="d-flex align-items-center flex-wrap justify-content-between">
                    <h5 class="m-0 primary-color">
                        <x-icon type="users" />
                        Senior Citizen Records
                    </h5>
                    <form action="{{ route('senior-citizen.records.index') }}" class="d-flex align-items-center gap-2">
                        <input type="search" name="search" id="search" class="form-control">
                        <button class="btn btn-sm" type="submit">
                            <x-icon type="search" />
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th class="primary-color">Action</th>
                                <th class="primary-color">Name</th>
                                <th class="primary-color">Age</th>
                                <th class="primary-color">Birth Date</th>
                                <th class="primary-color">Date Register</th>
                            </tr>
                        </thead>
                        <tbody class="text-nowrap">
                            @forelse ($data as $item)
                                <tr>
                                    <td class="primary-color">
                                        <button class="btn btn-sm bg-primary-color delete"
                                            data-id="{{ $item->did }}">
                                            <x-icon type="trash" />
                                            Delete
                                        </button>
                                        <a href="{{ route('senior-citizen.records.edit', ['record' => urlencode($item->did)]) }}"
                                            class="btn btn-sm bg-primary-color">
                                            <x-icon type="pencil" />
                                            Edit
                                        </a>
                                        <button class="btn btn-sm bg-primary-color decease"
                                            data-id="{{ $item->did }}">
                                            <x-icon type="x" />
                                            Set as Decease
                                        </button>
                                    </td>
                                    <td class="primary-color">{{ $item->name }}</td>
                                    <td class="primary-color">{{ Carbon\Carbon::parse($item->bdate)->age }}</td>
                                    <td class="primary-color">{{ Carbon\Carbon::parse($item->bdate)->format('F j, Y') }}
                                    </td>
                                    <td class="primary-color">{{ $item->created_at->format('F j, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-secondary">--No Data--</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if (!empty($data))
                <div class="card-footer">
                    <div class="d-flex align-items-center gap-2 justify-content-sm-between justify-content-center">
                        <span class="fw-medium primary-color">Current Page {{ $data->currentPage() }} | Total Page
                            {{ $data->lastPage() }}</span>
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ $data->previousPageUrl() }}" class="btn btn-sm bg-primary-color rounded-0">
                                < Prev </a>
                                    <a href="{{ $data->nextPageUrl() }}" class="btn btn-sm bg-primary-color rounded-0">
                                        Next >
                                    </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('click', function(e) {
                const delete_btn = e.target.closest('.delete');
                const decease_btn = e.target.closest('.decease');

                if (delete_btn) {
                    const id = delete_btn.dataset.id;

                    window.Swal.fire({
                        title: 'Are you sure',
                        icon: 'warning',
                        text: 'You wont be able to revert it!',
                        showCancelButton: true,
                        confirmButtonColor: 'blue',
                        cancelButtonColor: 'red',
                        confirmButtonText: 'Yes, Delete it'
                    }).then(async (res) => {
                        if (res.isConfirmed) {
                            try {
                                await axios.delete(
                                    `/senior-citizen/records/${encodeURIComponent(id)}`, {
                                        headers: {
                                            'X-CSRF-TOKEN': window.token,
                                            'Accept': 'application/json'
                                        }
                                    });
                                Swal.fire({
                                    title: 'Success',
                                    icon: 'success',
                                    text: 'Successfully deleted senior citizen'
                                }).then(() => {
                                    window.location.reload();
                                });
                            } catch (error) {
                                console.error(error);
                                Swal.fire({
                                    title: 'Server Error',
                                    icon: 'error',
                                    text: 'Something Went Wrong'
                                });
                            }
                        }
                    });
                }

                if (decease_btn) {
                    const id = decease_btn.dataset.id;

                    window.Swal.fire({
                        title: 'Are you sure',
                        icon: 'warning',
                        text: 'You wont be able to revert it!',
                        showCancelButton: true,
                        confirmButtonColor: 'blue',
                        cancelButtonColor: 'red',
                        confirmButtonText: 'Yes, do it'
                    }).then(async (res) => {
                        if (res.isConfirmed) {
                            try {
                                await axios.put(
                                    `/senior-citizen/decease/${encodeURIComponent(id)}`, {
                                        headers: {
                                            'X-CSRF-TOKEN': window.token,
                                            'Accept': 'application/json'
                                        }
                                    });
                                Swal.fire({
                                    title: 'Success',
                                    icon: 'success',
                                    text: 'Successfully set decease senior citizen'
                                }).then(() => {
                                    window.location.reload();
                                });
                            } catch (error) {
                                console.error(error);
                                Swal.fire({
                                    title: 'Server Error',
                                    icon: 'error',
                                    text: 'Something Went Wrong'
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>
</x-auth-layout>
