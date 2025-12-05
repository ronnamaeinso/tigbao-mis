<x-auth-layout title="Certificate of Indigency">


    <section class="container mt-4">
        {{-- request --}}
        <a href="{{route('request.certificate-of-indigency.create')}}" class="btn btn-sm bg-primary-color">
            <x-icon type="plus" />
            Request
        </a>

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
                            <th class="primary-color">No.</th>
                            <th class="primary-color">Date Request</th>
                            <th class="primary-color">Status</th>
                        </thead>
                        <tbody>
                            {{-- loop myrequest --}}
                            @forelse ($myrequests as $item)
                            <tr class="align-middle">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->created_at->format('F j, Y')}}</td>
                                <td>
                                    {!! $item->status == 1 ? '<small
                                        class="px-3 py-1 text-white bg-primary rounded-pill text-nowrap">Submitted -
                                        Pending</small>' : ''!!}
                                    {!! $item->status == 2 ? '<small
                                        class="px-3 py-1 text-white bg-success rounded-pill text-nowrap">Approved - Processing' : ''!!}
                                    {!! $item->status == 3 ? '<small
                                        class="px-3 py-1 text-white bg-danger rounded-pill text-nowrap">Rejected -
                                        '.$item->reject_comment.'</small>' : ''!!}
                                    {!! $item->status == 4 ? '<small
                                        class="px-3 py-1 text-white bg-success rounded-pill text-nowrap">Ready - Pick it up in Brgy.         hall</small>' : ''!!}
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
                    <small class="fw-bold text-secondary text-nowrap">CURRENT PAGE - {{$myrequests->currentPage()}} | TOTAL PAGE -
                        {{$myrequests->lastPage()}}</small>
                    {{$myrequests->links()}}
                </div>
            </div>
        </div>
    </section>
</x-auth-layout>
