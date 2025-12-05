<x-auth-layout title="Senior Citizen Records - Archive">
    <div class="container mx-auto p-0 m-0">
        <div class="card shadow-lg rounded-0">

            <div class="card-header">
                <div class="d-flex align-items-center flex-wrap justify-content-between">
                    <h5 class="m-0 primary-color">
                        <x-icon type="users" /> Senior Citizen Records - Deceased
                    </h5>

                    <form action="{{ route('senior-citizen.archive') }}"
                          class="d-flex align-items-center gap-2">
                        <input type="search" name="search" id="search"
                               class="form-control" value="{{ request('search') }}">
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
                                <th class="primary-color">Name</th>
                                <th class="primary-color">Gender</th>
                                <th class="primary-color">Age at Death</th>
                                <th class="primary-color">Birth Date</th>
                                <th class="primary-color">Date Deceased</th>
                                <th class="primary-color">Death Certificate</th>
                            </tr>
                        </thead>

                        <tbody class="text-nowrap">
                            @forelse($data as $item)
                                <tr>
                                    <!-- Name -->
                                    <td class="primary-color">
                                        {{ $item->first_name }}
                                        {{ $item->middle_name }}
                                        {{ $item->last_name }}
                                    </td>

                                    <!-- Gender -->
                                    <td class="primary-color">{{ $item->gender }}</td>

                                    <!-- Age at Death (Whole Number) -->
                                    <td class="primary-color text-center">
                                        @if($item->bdate && $item->date_deceased)
                                            {{ intval(
                                                \Carbon\Carbon::parse($item->bdate)
                                                    ->diffInYears(\Carbon\Carbon::parse($item->date_deceased))
                                            ) }}
                                        @else
                                            <span class="text-secondary">N/A</span>
                                        @endif
                                    </td>

                                    <!-- Birth Date -->
                                    <td class="primary-color">
                                        {{ \Carbon\Carbon::parse($item->bdate)->format('F j, Y') }}
                                    </td>

                                    <!-- Date Deceased -->
                                    <td class="primary-color">
                                        @if ($item->date_deceased)
                                            {{ \Carbon\Carbon::parse($item->date_deceased)->format('F j, Y') }}
                                        @else
                                            <span class="text-secondary">No date</span>
                                        @endif
                                    </td>

                                    <!-- Death Certificate -->
                                    <td class="primary-color">
                                        @if ($item->death_certificate)
                                            <a href="{{ asset('storage/' . $item->death_certificate) }}"
                                               target="_blank"
                                               class="text-primary fw-medium">
                                                View Certificate
                                            </a>
                                        @else
                                            <span class="text-secondary">No certificate</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-secondary">--No Data--</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($data->count())
                <div class="card-footer">
                    <div class="d-flex align-items-center gap-2 justify-content-sm-between justify-content-center">
                        <span class="fw-medium primary-color">
                            Current Page {{ $data->currentPage() }} | Total Page {{ $data->lastPage() }}
                        </span>
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ $data->previousPageUrl() }}"
                               class="btn btn-sm bg-primary-color rounded-0">&lt; Prev</a>

                            <a href="{{ $data->nextPageUrl() }}"
                               class="btn btn-sm bg-primary-color rounded-0">Next &gt;</a>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-auth-layout>
