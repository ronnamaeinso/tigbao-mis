<x-auth-layout title="Senior Citizen Records - Archive">
    <div class="container mx-auto p-0 m-0">

        <div class="card shadow-lg rounded-0">
            <div class="card-header">
                <div class="d-flex align-items-center flex-wrap justify-content-between">
                    <h5 class="m-0 primary-color">
                        <x-icon type="users" />
                        Senior Citizen Records - Deceased
                    </h5>
                    <form action="{{ route('senior-citizen.archive') }}" class="d-flex align-items-center gap-2">
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
                                <th class="primary-color">Name</th>
                                <th class="primary-color">Age</th>
                                <th class="primary-color">Birth Date</th>
                                <th class="primary-color">Date Deceased</th>
                            </tr>
                        </thead>
                        <tbody class="text-nowrap">
                            @forelse ($data as $item)
                                <tr>
                                    <td class="primary-color">{{ $item->name }}</td>
                                    <td class="primary-color">{{ Carbon\Carbon::parse($item->bdate)->age }}</td>
                                    <td class="primary-color">{{ Carbon\Carbon::parse($item->bdate)->format('F j, Y') }}
                                    </td>
                                    <td class="primary-color">
                                        {{ intval(\Carbon\Carbon::parse($item->bdate)->diffInRealYears(\Carbon\Carbon::parse($item->updated_at))) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-secondary">--No Data--</td>
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

</x-auth-layout>
