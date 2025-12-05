<x-auth-layout title="Requests List - Animal Transporation Clearance Request List">

    <section class="container mt-4">

        {{-- list of request --}}
        <div class="card mt-3 bg-white shadow-lg">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <h5 class="m-0 primary-color">
                            <x-icon type="file primary-color" />
                            Request List - Animal Transporation Clearance Request
                        </h5>
                        <form action="" class="d-flex align-items-center gap-1 justify-content-end">
                            <input type="search" class="form-control" name="search">
                            <button class="btn btn-sm">
                                <x-icon type="search" />
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead class="text-nowrap">
                            <th class="primary-color">Action</th>
                            <th class="primary-color">Requestor Name</th>
                            <th class="primary-color">Date Request</th>
                            <th class="primary-color">
                                <div class="dropdown">
                                    <span data-bs-toggle="dropdown" style="cursor: pointer;">
                                        Status
                                        <x-icon type="caret-down" />
                                    </span>

                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item">
                                            <a href="{{ route('animaltransportationrequestlist.index') }}"
                                                class="nav-link text-info">
                                                <x-icon type="layer-group" />
                                                all
                                            </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="{{ route('animaltransportationrequestlist.index', ['status' => urlencode(1)]) }}"
                                                class="nav-link text-secondary">
                                                <x-icon type="hourglass" />
                                                Pending
                                            </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="{{ route('animaltransportationrequestlist.index', ['status' => urlencode(2)]) }}"
                                                class="nav-link text-success">
                                                <x-icon type="check" />
                                                Approved
                                            </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="{{ route('animaltransportationrequestlist.index', ['status' => urlencode(4)]) }}"
                                                class="nav-link text-primary">
                                                <x-icon type="gear" />
                                                Generated
                                            </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="{{ route('animaltransportationrequestlist.index', ['status' => urlencode(5)]) }}"
                                                class="nav-link text-primary">
                                                <x-icon type="money-bill-wave" />
                                                Paid
                                            </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="{{ route('animaltransportationrequestlist.index', ['status' => urlencode(6)]) }}"
                                                class="nav-link text-success">
                                                <x-icon type="file" />
                                                Ready to claim
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </th>
                        </thead>
                        <tbody class="text-nowrap">
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
                                            <form
                                                action="{{ route('animaltransportationrequestlist.update', ['animaltransportationrequestlist' => urlencode($item->encrypted_id)]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="type" value="generate-certificate">
                                                <button class="btn btn-sm bg-primary-color" type="submit">
                                                    <x-icon type="gear" />
                                                    Generate
                                                </button>
                                            </form>
                                        @endif

                                        @if ($item->status == 4)
                                            <button class="btn btn-sm bg-primary-color set-paid"
                                                data-id="{{ $item->encrypted_id }}" target="_blank">
                                                <x-icon type="money-bill-wave" />
                                                Set as Paid
                                            </button>
                                            <a href="/animal-transportation-clearance/{{ urlencode($item->encrypted_id) }}"
                                                class="btn btn-sm bg-primary-color"
                                                data-id="{{ $item->encrypted_id }}">
                                                <x-icon type="eye" />
                                                View
                                            </a>
                                        @endif

                                        @if ($item->status == 5)
                                            <button class="btn btn-sm bg-primary-color issue"
                                                data-id="{{ $item->encrypted_id }}">
                                                <x-icon type="check" />
                                                Issue
                                            </button>

                                            <a href="/animal-transportation-clearance/{{ urlencode($item->encrypted_id) }}"
                                                data-id="{{ $item->encrypted_id }}">
                                                <x-icon type="eye" />
                                                View
                                            </a>
                                        @endif

                                        @if ($item->status == 6)
                                            <a href="/animal-transportation-clearance/{{ urlencode($item->encrypted_id) }}"
                                                class="btn btn-sm bg-primary-color">
                                                <x-icon type="eye" />
                                                View
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $item->name }}
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
                                            ? '<small class="px-3 py-1 text-white bg-primary rounded-pill text-nowrap">Certificate Generated</small>'
                                            : '' !!}
                                        {!! $item->status == 5
                                            ? '<small class="px-3 py-1 text-white bg-info rounded-pill text-nowrap">Paid - Ready to issue</small>'
                                            : '' !!}
                                        {!! $item->status == 6
                                            ? '<small class="px-3 py-1 text-white bg-success rounded-pill text-nowrap">Ready - Pick it up in Brgy Hall</small>'
                                            : '' !!}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <small class="text-center text-secondary">No Data</small>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($data->lastPage() != 1)
                    <div class="d-flex justify-content-sm-between justify-content-center align-items-center gap-2 flex-wrap">
                        <small class="fw-bold text-secondary text-nowrap">
                            CURRENT PAGE - {{ $data->currentPage() }} | TOTAL PAGE - {{ $data->lastPage() }}
                        </small>
                        <div class="d-flex align-items-scenter gap-2">
                            <a href="{{$data->previousPageUrl()}}" class="btn btn-sm bg-primary-color fw-medium {{$data->currentPage() == 1 ? 'disabled': ''}}"> < Prev</a>
                            <a href="{{$data->nextPageUrl()}}" class="btn btn-sm bg-primary-color fw-medium {{$data->currentPage() == $data->lastPage() ? 'disabled': ''}}">Next ></a>
                        </div>
                    </div>
                @endif
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
                        <input type="hidden" name="type" value="reject-request">
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

    {{-- script --}}
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
                                    `/animaltransportationrequestlist/${encodeURIComponent(id)}`, {
                                        type: 'approve-request'
                                    }, {
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
                                    `/animaltransportationrequestlist/${encodeURIComponent(id)}`, {
                                        type: 'issue-request'
                                    }, {
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
                                async function(ev) {
                                    ev.preventDefault();
                                    ev.stopImmediatePropagation();

                                    const formData = new FormData(document.getElementById(
                                        'form-comment'));
                                    const jsonData = Object.fromEntries(formData.entries());

                                    try {
                                        const response = await axios.put(
                                            `/animaltransportationrequestlist/${encodeURIComponent(id)}`,
                                            jsonData, {
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

                // set paid
                const set_paid = e.target.closest('.set-paid');
                if (set_paid) {
                    const id = set_paid.dataset.id;

                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, Set Paid it!"
                    }).then(async (result) => {
                        if (result.isConfirmed) {

                            try {
                                const response = await axios.put(
                                    `/animaltransportationrequestlist/${encodeURIComponent(id)}`, {
                                        type: 'set-paid'
                                    }, {
                                        headers: {
                                            'X-CSRF-TOKEN': window.token,
                                            'Accept': 'application/json',
                                            'Content-Type': 'application/json'
                                        }
                                    });

                                Swal.fire({
                                    title: "Success!",
                                    text: "Successfully Set Paid Request",
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
            });
        }
    </script>
</x-auth-layout>
