<x-auth-layout title="Certificate of Residency">
    <section class="container mx-auto m-0 p-0">

        <a href="{{ route('certificate-of-good-moral.request.create') }}" class="btn btn-sm bg-primary-color mb-3">
            <x-icon type="plus" />
            Request
        </a>

        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="m-0 primary-color">
                        <x-icon type="file" />
                        My Request List - Certificate of Good Moral
                    </h5>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th class="primary-color">
                                    <x-icon type="hashtag" />
                                    No.
                                </th>
                                <th class="primary-color">
                                    <x-icon type="circle" />
                                    Track Status
                                </th>
                                <th>
                                    <div class="dropdown">
                                        <span data-bs-toggle="dropdown" style="cursor: pointer">
                                            Status
                                            <x-icon type="caret-down" />
                                        </span>

                                        <ul class="dropdown-menu">
                                            <li class="dropdown-item">
                                                <a href="{{ route('certificate-of-good-moral.request.index') }}"
                                                    class="nav-link text-info">
                                                    <x-icon type="layer-group" />
                                                    all
                                                </a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="{{ route('certificate-of-good-moral.request.index', ['status' => urlencode(1)]) }}"
                                                    class="nav-link text-secondary">
                                                    <x-icon type="hourglass" />
                                                    Pending
                                                </a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="{{ route('certificate-of-good-moral.request.index', ['status' => urlencode(2)]) }}"
                                                    class="nav-link text-success">
                                                    <x-icon type="check" />
                                                    Approved
                                                </a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="{{ route('certificate-of-good-moral.request.index', ['status' => urlencode(3)]) }}"
                                                    class="nav-link text-danger">
                                                    <x-icon type="x" />
                                                    Rejected
                                                </a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="{{ route('certificate-of-good-moral.request.index', ['status' => urlencode(4)]) }}"
                                                    class="nav-link text-primary">
                                                    <x-icon type="gear" />
                                                    Generated
                                                </a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="{{ route('certificate-of-good-moral.request.index', ['status' => urlencode(5)]) }}"
                                                    class="nav-link text-primary">
                                                    <x-icon type="money-bill-wave" />
                                                    Paid
                                                </a>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="{{ route('certificate-of-good-moral.request.index', ['status' => urlencode(6)]) }}"
                                                    class="nav-link text-success">
                                                    <x-icon type="file" />
                                                    Ready to claim
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </th>
                                <th class="primary-color">
                                    <x-icon type="calendar-days" />
                                    Date Requested
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($myRequests as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('track.status', ['id' => urlencode($item->encrypted_id), 'type' => urlencode('good-moral-cert')]) }}"
                                            class="nav-link primary-color fw-medium">
                                            <x-icon type="eye" />
                                            Track Status
                                        </a>
                                    </td>
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
                                    <td>
                                        {{ $item->created_at->format('M. j, Y | h:i a') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center fw-medium text-secondary">--NO DATA--</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- pagination --}}
                <div class="d-flex align-items-center justify-content-between">
                    <span class="text-nowrap fw-medium">Current Page {{ $myRequests->currentPage() }} | Total Page
                        {{ $myRequests->lastPage() }}</span>
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ $myRequests->previousPageUrl() }}"
                            class="btn btn-sm bg-primary-color {{ $myRequests->currentPage() == 1 ? 'disabled' : '' }}">
                            < Prev</a>
                                <a href="{{ $myRequests->nextPageUrl() }}"
                                    class="btn btn-sm bg-primary-color {{ $myRequests->currentPage() == $myRequests->lastPage() ? 'disabled' : '' }}">Next
                                    ></a>
                    </div>
                </div>
            </div>
        </div>

    </section>

</x-auth-layout>
