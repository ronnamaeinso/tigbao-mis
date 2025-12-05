<x-auth-layout title="Requests List - Certificate of Indigency">

    <section class="container mt-4">

        {{-- list of request --}}
        <div class="card mt-3 bg-white shadow-lg">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <x-icon type="file primary-color" />
                    <h5 class="m-0 primary-color">Request List - Certificate of Indigency</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead class="text-nowrap">
                            <th class="primary-color">Action</th>
                            <th class="primary-color">Date Request</th>
                            <th class="primary-color">Status</th>
                        </thead>
                        <tbody>
                            {{-- loop myrequest --}}
                            @forelse ($data as $item)
                                <tr class="align-middle">
                                    <td>
                                        @if ($item->status == 1)
                                            <button class="btn btn-sm bg-primary-color approve"
                                                data-id="{{ $item->encrypted_id }}">
                                                <x-icon type="check" />
                                                Approve
                                            </button>

                                            <button class="btn btn-sm bg-primary-color reject"
                                                data-id="{{ $item->encrypted_id }}">
                                                <x-icon type="x" />
                                                Reject
                                            </button>
                                        @endif

                                        @if ($item->status == 2)
                                            <a href="/generate-cert-indigency/{{ $item->encrypted_id }}"
                                                class="btn btn-sm bg-primary-color" data-id="{{ $item->encrypted_id }}"
                                                target="_blank">
                                                <x-icon type="gear" />
                                                Generate
                                            </a>

                                            <button class="btn btn-sm bg-primary-color issue"
                                                data-id="{{ $item->encrypted_id }}">
                                                <x-icon type="check" />
                                                Issue
                                            </button>
                                        @endif

                                        @if ($item->status == 4)
                                            <a href="/generate-cert-indigency/{{ $item->encrypted_id }}" class="btn btn-sm bg-primary-color"
                                                data-id="{{ $item->encrypted_id }}">
                                                <x-icon type="eye" />
                                                View
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('F j, Y') }}</td>
                                    <td>
                                        {!! $item->status == 1
                                            ? '<small class="px-3 py-1 text-white bg-primary rounded-pill text-nowrap">Submitted - Pending</small>'
                                            : '' !!}
                                        {!! $item->status == 2
                                            ? '<small class="px-3 py-1 text-white bg-success rounded-pill text-nowrap">Approved - Processing'
                                            : '' !!}
                                        {!! $item->status == 3
                                            ? '<small class="px-3 py-1 text-white bg-danger rounded-pill text-nowrap">Rejected - ' .
                                                $item->reject_comment .
                                                '</small>'
                                            : '' !!}
                                        {!! $item->status == 4
                                            ? '<small class="px-3 py-1 text-white bg-success rounded-pill text-nowrap">Ready - Pick it up in Brgy.         hall</small>'
                                            : '' !!}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">
                                        <small class="text-center text-secondary">No Data</small>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between align-items-center gap-2">
                    <small class="fw-bold text-secondary text-nowrap">CURRENT PAGE - {{ $data->currentPage() }} | TOTAL
                        PAGE -
                        {{ $data->lastPage() }}</small>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </section>

    {{-- modal reject comments --}}
    <div class="modal fade" id="modal-reject-comment">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="m-0">
                        <x-icon type="comment" />
                        Reject Comment
                    </h5>
                </div>
                <div class="modal-body">
                    <form action="" id="form-comment">
                        <textarea name="comment" class="form-control" placeholder="Your Comments in here" required></textarea>
                        <div class="d-flex align-items-center justify-content-end mt-4 gap-2">
                            <button class="btn btn-sm bg-primary-color" type="button" data-bs-dismiss="modal">
                                <x-icon type="x" />
                                Cancel
                            </button>
                            <button class="btn btn-sm bg-primary-color" type="submit">
                                <x-icon type="check" />
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            eventDelegation();
        });

        const eventDelegation = () => {
            document.addEventListener('click', function(e) {
                e.stopImmediatePropagation();
                // approve
                const approve_btn = e.target.closest('.approve');
                if (approve_btn) {
                    const id = approve_btn.dataset.id;

                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, Approve it!"
                    }).then(async (result) => {
                        if (result.isConfirmed) {

                            try {
                                const response = await axios.put(
                                    `/approve-cert-indigency/${encodeURIComponent(id)}`, {
                                        headers: {
                                            'X-CSRF-TOKEN': window.token,
                                            'Accept': 'application/json'
                                        }
                                    });

                                Swal.fire({
                                    title: "Success!",
                                    text: "Successfully Approved Request",
                                    icon: "success"
                                }).then(() => {
                                    window.location.reload();
                                });
                            } catch (error) {
                                Swal.fire({
                                    title: "Server Error!",
                                    text: "Something went wrong.",
                                    icon: "error"
                                });
                            }
                        }
                    });
                }
                // issue
                const issue_btn = e.target.closest('.issue');
                if (issue_btn) {
                    const id = issue_btn.dataset.id;

                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, Issue it!"
                    }).then(async (result) => {
                        if (result.isConfirmed) {

                            try {
                                const response = await axios.put(
                                    `/issue-cert-indigency/${encodeURIComponent(id)}`, {
                                        headers: {
                                            'X-CSRF-TOKEN': window.token,
                                            'Accept': 'application/json'
                                        }
                                    });

                                Swal.fire({
                                    title: "Success!",
                                    text: "Successfully Issued Request",
                                    icon: "success"
                                }).then(() => {
                                    window.location.reload();
                                });
                            } catch (error) {
                                Swal.fire({
                                    title: "Server Error!",
                                    text: "Something went wrong.",
                                    icon: "error"
                                });
                            }
                        }
                    });
                }

                // reject
                const reject_btn = e.target.closest('.reject');
                if (reject_btn) {
                    const id = reject_btn.dataset.id;

                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, Reject it!"
                    }).then((result) => {
                        if (result.isConfirmed) {

                            const modal = new bootstrap.Modal(document.getElementById(
                                'modal-reject-comment'));

                            modal.show();

                            document.getElementById('form-comment').addEventListener('submit',
                                async function(e) {
                                    e.preventDefault();

                                    const formData = new FormData(e.target);

                                    try {
                                        const response = await axios.put(
                                            `/reject-cert-indigency/${encodeURIComponent(id)}`,
                                            formData, {
                                                headers: {
                                                    'X-CSRF-TOKEN': window.token,
                                                    'Accept': 'application/json'
                                                }
                                            });

                                        Swal.fire({
                                            title: "Success!",
                                            text: "Successfully Reject Request",
                                            icon: "success"
                                        }).then(() => {
                                            window.location.reload();
                                        });

                                    } catch (error) {
                                        Swal.fire({
                                            title: "Server Error!",
                                            text: "Something went wrong.",
                                            icon: "error"
                                        });
                                    }

                                });

                        }
                    });

                }
            });
        }
    </script>
</x-auth-layout>
