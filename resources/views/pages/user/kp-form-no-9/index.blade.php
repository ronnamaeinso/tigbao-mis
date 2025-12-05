<x-auth-layout title="Request Documents - KP Form No. 9 (Summon)">
    <section class="container mt-4">
        {{-- request --}}
        <a href="{{route('request.documents.kp-form-no-9.create')}}" class="btn btn-sm bg-primary-color">
            <x-icon type="plus" />
            Request
        </a>

        {{-- list of request --}}
        <div class="card mt-3 bg-white shadow-lg">
            <div class="card-header">
                <div class="d-flex align-items-center gap-1 justify-content-between flex-wrap row-gap-2">
                    {{-- header --}}
                    <div class="d-flex align-items-center gap-2">
                        <x-icon type="file primary-color" />
                        <h5 class="m-0 primary-color">Request List - KP Form No.9 (Summons)</h5>
                    </div>

                    <form action="" class="flex align-center justify-end gap-2">
                        <input type="search" name="search" id="search" class="form-control">
                        <button type="submit">
                            <x-icon type="search"/>
                        </button>
                    </form>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead class="text-nowrap">
                            <th class="primary-color">Action</th>
                            <th class="primary-color">Mga Gisumbong</th>
                            <th class="primary-color">
                                {{-- dropdown for filtering --}}
                                <div class="dropdown">
                                    <span class="cursor-pointer block" data-bs-toggle="dropdown">Status <x-icon type="caret-down"/></span>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item">
                                            <a href="/request/documents/kp-form-no-9?search={{urlencode(1)}}" class="nav-link fw-bold primary-color py-2">
                                                <x-icon type="list"/>
                                                All
                                            </a>
                                            <a href="/request/documents/kp-form-no-9?search={{urlencode(1)}}" class="nav-link fw-bold primary-color py-2">
                                                <x-icon type="check"/>
                                                Filter by Submitted
                                            </a>
                                            <a href="/request/documents/kp-form-no-9?search={{urlencode(2)}}" class="nav-link fw-bold primary-color py-2">
                                                <x-icon type="check-double"/>
                                                Filter by Approved
                                            </a>
                                            <a href="/request/documents/kp-form-no-9?search={{urlencode(3)}}" class="nav-link fw-bold primary-color py-2">
                                                <x-icon type="x"/>
                                                Filter by Rejected
                                            </a>
                                            <a href="/request/documents/kp-form-no-9?search={{urlencode(4)}}" class="nav-link fw-bold primary-color py-2">
                                                <x-icon type="flag-checkered"/>
                                                Filter by Ready
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </th>
                            <th class="primary-color">Date Request</th>
                        </thead>
                        <tbody>
                            {{-- loop myrequest --}}
                            @forelse ($data as $item)
                                <tr class="align-middle text-nowrap">
                                    <td class="" style="width: 1%;">
                                        <div class="d-flex align-items-center gap-1">
                                            {{-- view request --}}
                                            <a href="{{route('request.documents.kp-form-no-9.show', ['kp_form_no_9' => urlencode($item->encrypted_id)])}}"
                                                class="btn btn-sm bg-primary-color" title="View Details">
                                                <x-icon type="eye" />
                                                <span class="d-none d-md-inline">View</span>
                                            </a>

                                            {{-- if request status is only 1 the user can edit and delete request --}}
                                            @if ($item->status == 1)
                                                {{-- edit request --}}
                                                <a href="{{route('request.documents.kp-form-no-9.edit', ['kp_form_no_9' => urlencode($item->encrypted_id)])}}"
                                                    class="btn btn-sm bg-primary-color" title="Edit Request">
                                                    <x-icon type="pencil" />
                                                    <span class="d-none d-md-inline">Edit</span>

                                                </a>

                                                {{-- delete request --}}
                                                <a href="" class="btn btn-sm bg-primary-color delete-summons-btn"
                                                    title="Delete Request" data-id="{{$item->encrypted_id}}">
                                                    <x-icon type="trash" />
                                                    <span class="d-none d-md-inline">Delete</span>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{$item->mga_gisumbong}}</td>
                                    <td>
                                        {!!
                                            $item->status == 1 ? '<small class="px-3 py-1 text-white bg-primary rounded-pill text-nowrap">
                                                Submitted - Pending
                                            </small>' : ''
                                        !!}
                                        {!!
                                            $item->status == 2 ? '<small class="px-3 py-1 text-white bg-success rounded-pill text-nowrap">
                                                Approved - Processing
                                            </small>' : ''
                                        !!}
                                        {!!
                                            $item->status == 3 ? "<small class='px-3 py-1 text-white bg-danger rounded-pill text-nowrap'>
                                                Rejected - $item->reject_comment
                                            </small>" : ''
                                        !!}
                                        {!!
                                            $item->status == 5 ? '<small class="px-3 py-1 text-white bg-success rounded-pill text-nowrap">
                                                Ready - Pick it up in Brgy. hall
                                            </small>' : ''
                                        !!}

                                    </td>
                                    <td>{{$item->created_at->format('F j, Y')}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-secondary font-medium">--No Data--</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div
                    class="d-flex justify-content-sm-between justify-content-center align-items-center flex-wrap row-gap-2 gap-2 overflow-auto">
                    <small class="fw-bold text-secondary">CURRENT PAGE - {{$data->currentPage()}} | TOTAL PAGE - {{$data->lastPage()}}</small>
                    <div class="d-flex align-items-start gap-2 ">

                        <a href="{{
                            $data->currentPage() != 1 ?
                            $data->links()->elements[0][($data->currentPage() - 1)] :
                            ''
                        }}" class="btn btn-sm bg-primary-color rounded-0 text-nowrap {{$data->currentPage() == 1 ? 'disabled' : ''}}">
                            < Prev
                        </a>

                        <div class="d-flex align-items-center overflow-auto" style="max-width: 100px;">
                            {{-- loop the elements from the links for the uri in each page --}}
                            @foreach ($data->links()->elements[0] as $item)
                                <a href="{{$item}}" class="btn btn-sm rounded-0"
                                style="border: 1px solid var(--primary-color);">{{$loop->iteration}}</a>
                            @endforeach
                        </div>
                        <a href="
                            {{
                            $data->currentPage() != $data->lastPage() ?
                            $data->links()->elements[0][($data->currentPage() + 1)] :
                            ''
                        }}
                        " class="btn btn-sm bg-primary-color rounded-0 text-nowrap {{$data->currentPage() ==  $data->lastPage() ? 'disabled' : ''}}">
                            Next >
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            // init delete request
            deleteRequest();
        });

        /**
         * ths
         */
        const deleteRequest = ()=>{
            const delete_btns = document.querySelectorAll('.delete-summons-btn');

            delete_btns.forEach(btn => {
                btn.addEventListener('click', async function (e) {
                    e.preventDefault();
                    e.stopImmediatePropagation();

                    const id = e.currentTarget.dataset.id;

                    // confirmation
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then( async (result) => {
                        if (result.isConfirmed) {

                            try {
                                // url and delete request
                                const url = `/request/documents/kp-form-no-9/${encodeURIComponent(id)}`;
                                const response = await fetch(url, {
                                    method : 'DELETE',
                                    headers : {
                                        'X-CSRF-TOKEN': token
                                    }
                                });

                                console.log(await response);

                                // if response was not ok then throw new Error
                                if(!response.ok){
                                    throw new Error("");
                                }

                                // if success
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Request has been deleted.",
                                    icon: "success"
                                }).then(()=>{
                                    // window.location.reload();
                                });

                            } catch (error) {
                                console.error(error.message);
                                Swal.fire({
                                    title: 'Error',
                                    icon: 'error',
                                    text: 'Something Went Wrong, Pls Contact Developer!'
                                });
                            }
                        }
                    });
                });
            });
        }
    </script>
</x-auth-layout>
