<x-auth-layout title="Senior Citizen Records">
    <div class="container mx-auto p-0 m-0">

        <a href="{{ route('senior-citizen.records.create') }}" class="btn btn-sm bg-primary-color mb-3">
<<<<<<< HEAD
            <x-icon type="user-plus" />
            add citizen
        </a>
        <a href="{{ route('senior-citizen.archive') }}" class="btn btn-sm bg-primary-color mb-3">
            <x-icon type="folder-open" />
            Deceased Archive
=======
            <x-icon type="user-plus" /> add citizen
        </a>
        <a href="{{ route('senior-citizen.archive') }}" class="btn btn-sm bg-primary-color mb-3">
            <x-icon type="folder-open" /> Deceased Archive
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
        </a>

        <div class="card shadow-lg rounded-0">
            <div class="card-header">
                <div class="d-flex align-items-center flex-wrap justify-content-between">
                    <h5 class="m-0 primary-color">
<<<<<<< HEAD
                        <x-icon type="users" />
                        Senior Citizen Records
                    </h5>
                    <form action="{{ route('senior-citizen.records.index') }}" class="d-flex align-items-center gap-2">
                        <input type="search" name="search" id="search" class="form-control">
=======
                        <x-icon type="users" /> Senior Citizen Records
                    </h5>
                    <form action="{{ route('senior-citizen.records.index') }}" class="d-flex align-items-center gap-2">
                        <input type="search" name="search" id="search" class="form-control" value="{{ request('search') }}">
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
                        <button class="btn btn-sm" type="submit">
                            <x-icon type="search" />
                        </button>
                    </form>
                </div>
            </div>
<<<<<<< HEAD
=======

>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th class="primary-color">Action</th>
                                <th class="primary-color">Name</th>
<<<<<<< HEAD
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
=======
                                <th class="primary-color">Gender</th>
                                <th class="primary-color">Age</th>
                                <th class="primary-color">Birth Date</th>
                                <th class="primary-color">Date Registered</th>
                            </tr>
                        </thead>
                        <tbody class="text-nowrap">
                            @forelse($data as $item)
                                <tr>
                                    <td class="primary-color">
                                        <button class="btn btn-sm bg-primary-color delete" data-id="{{ $item->did }}">
                                            <x-icon type="trash" /> Delete
                                        </button>
                                        <a href="{{ route('senior-citizen.records.edit', ['record' => urlencode($item->did)]) }}"
                                           class="btn btn-sm bg-primary-color">
                                            <x-icon type="pencil" /> Edit
                                        </a>
                                        <button class="btn btn-sm bg-primary-color decease" data-id="{{ $item->did }}">
                                            <x-icon type="x" /> Set as Decease
                                        </button>
                                    </td>
                                    <td class="primary-color">
                                        {{ $item->first_name }} {{ $item->middle_name }} {{ $item->last_name }}
                                    </td>
                                    <td class="primary-color">{{ $item->gender }}</td>
                                    <td class="primary-color">{{ \Carbon\Carbon::parse($item->bdate)->age }}</td>
                                    <td class="primary-color">{{ \Carbon\Carbon::parse($item->bdate)->format('F j, Y') }}</td>
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
                                    <td class="primary-color">{{ $item->created_at->format('F j, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
<<<<<<< HEAD
                                    <td colspan="5" class="text-center text-secondary">--No Data--</td>
=======
                                    <td colspan="6" class="text-center text-secondary">--No Data--</td>
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
<<<<<<< HEAD
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
=======

            @if ($data->count())
                <div class="card-footer">
                    <div class="d-flex align-items-center gap-2 justify-content-sm-between justify-content-center">
                        <span class="fw-medium primary-color">
                            Current Page {{ $data->currentPage() }} | Total Page {{ $data->lastPage() }}
                        </span>
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ $data->previousPageUrl() }}" class="btn btn-sm bg-primary-color rounded-0">&lt; Prev</a>
                            <a href="{{ $data->nextPageUrl() }}" class="btn btn-sm bg-primary-color rounded-0">Next &gt;</a>
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

<<<<<<< HEAD
    {{-- script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('click', function(e) {
=======
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.addEventListener('click', function (e) {
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
                const delete_btn = e.target.closest('.delete');
                const decease_btn = e.target.closest('.decease');

                if (delete_btn) {
                    const id = delete_btn.dataset.id;

<<<<<<< HEAD
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
=======
                    Swal.fire({
                        title: 'Are you sure?',
                        icon: 'warning',
                        text: 'You won\'t be able to revert this!',
                        showCancelButton: true,
                        confirmButtonColor: 'blue',
                        cancelButtonColor: 'red',
                        confirmButtonText: 'Yes, delete it'
                    }).then(async (res) => {
                        if (res.isConfirmed) {
                            try {
                                await axios.delete(`/senior-citizen/records/${encodeURIComponent(id)}`, {
                                    headers: {
                                        'X-CSRF-TOKEN': window.token,
                                        'Accept': 'application/json'
                                    }
                                });

                                Swal.fire('Success', 'Successfully deleted senior citizen', 'success')
                                    .then(() => window.location.reload());
                            } catch (error) {
                                console.error(error);
                                Swal.fire('Server Error', 'Something went wrong.', 'error');
>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
                            }
                        }
                    });
                }

                if (decease_btn) {
<<<<<<< HEAD
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
=======
    const id = decease_btn.dataset.id;

    Swal.fire({
        title: 'Set as Deceased',
        html: `
            <label>Date of Death</label>
            <input type="date" id="date_deceased" class="swal2-input">

            <label class="mt-2">Death Certificate</label>
            <input type="file" id="death_certificate" class="swal2-file" accept=".pdf,.jpg,.jpeg,.png">
        `,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Save',
        preConfirm: () => {
            const date = document.getElementById('date_deceased').value;
            const file = document.getElementById('death_certificate').files[0];

            if (!date) {
                Swal.showValidationMessage('Date of death is required');
            }

            if (!file) {
                Swal.showValidationMessage('Death certificate is required');
            }

            return { date, file };
        }
    }).then(async (result) => {
        if (!result.value) return;

        let formData = new FormData();
        formData.append("date_deceased", result.value.date);
        formData.append("death_certificate", result.value.file);

        try {
            await axios.post(
                `/senior-citizen/decease/${encodeURIComponent(id)}`,
                formData,
                {
                    headers: {
                        "X-CSRF-TOKEN": window.token,
                        "Content-Type": "multipart/form-data"
                    }
                }
            );

            Swal.fire("Success", "Citizen moved to deceased archive.", "success")
                .then(() => window.location.reload());

        } catch (error) {
            Swal.fire("Error", "Something went wrong.", "error");
        }
    });
}

>>>>>>> 5db0eec706031899e3d50656e7a59c5722229571
            });
        });
    </script>
</x-auth-layout>
