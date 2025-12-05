<x-auth-layout title="KP Form No.9 (Summons) ">
    <div class="container mt-4 p-0">
        <x-card class="mx-4 m-sm-0">
            <x-slot name="cardheader">
                <div class="flex justify-between flex-wrap">
                    <div class="d-flex align-items-center gap-2">
                        <x-icon type="file primary-color"/>
                        <div class="h5 card-title m-0 primary-color">KP Form No. Summon Requests</div>
                    </div>
                    {{-- search --}}
                    <form action="" class="d-flex gap-2">
                        <input type="search" name="search" id="search" class="form-control">
                        <button type="submit">
                            <x-icon type="search"/>
                        </button>
                    </form>
                </div>
            </x-slot>

            {{-- card content --}}
            <x-table table-class="table-sm table-hover table-border-0" :ths="['Action', 'Kaso', 'Status', 'Date Requested']">
                @forelse ($data as $item)
                    <tr class="text-nowrap align-middle">
                        <td style="width: 1%;">
                            <div class="d-inline-flex gap-2">

                                {{-- if status submitted --}}
                                @if ($item->status == 1)
                                    <a href="{{route('summons.show', ['summon' => urlencode($item->encrypted_id)])}}" class="btn btn-sm bg-primary-color">
                                        <x-icon type="eye"/>
                                        View Request
                                    </a>
                                @endif

                                {{-- if status is approved --}}
                                @if ($item->status == 2)
                                    <a href="{{route('summons.generate', ['id' => urlencode($item->encrypted_id)])}}" class="btn btn-sm bg-primary-color" target="_blank">
                                        <x-icon type="gear"/>
                                        Generate Summon
                                    </a>
                                @endif

                                {{-- if status is generated --}}
                                @if ($item->status == 4)
                                    <a href="{{route('summons.view', ['id' => urlencode($item->encrypted_id)])}}" class="btn btn-sm bg-primary-color" target="_blank">
                                        <x-icon type="eye"/>
                                        View Summon
                                    </a>
                                    <a href="" class="btn btn-sm bg-primary-color issue-link" data-id="{{$item->encrypted_id}}">
                                        <x-icon type="arrow-right"/>
                                        Issue Summon
                                    </a>
                                @endif

                                {{-- if status is issued  --}}
                                @if ($item->status == 5)
                                    <a href="{{route('summons.view', ['id' => urlencode($item->encrypted_id)])}}" class="btn btn-sm bg-primary-color" target="_blank">
                                        <x-icon type="eye"/>
                                        View Summon
                                    </a>
                                @endif

                            </div>
                        </td>

                        <td>{{$item->kaso_sa_brgy_isip}}</td>

                        <td>
                            {{-- if status submitted --}}
                            @if ($item->status == 1)
                                <small class="px-3 py-1 text-white bg-primary rounded-pill text-nowrap">
                                    Submitted
                                </small>
                            @endif

                            {{-- if status is approved --}}
                            @if ($item->status == 2)
                                <small class="px-3 py-1 text-white bg-success rounded-pill text-nowrap">
                                    Approved - Processing
                                </small>
                            @endif

                            {{-- if status is generated --}}
                            @if ($item->status == 4)
                                <small class="px-3 py-1 text-white bg-info rounded-pill text-nowrap">
                                    Generated - Ready for Issuance
                                </small>
                            @endif-

                            {{-- if status is issued  --}}
                            @if ($item->status == 5)
                                <small class="px-3 py-1 text-white bg-success rounded-pill text-nowrap">
                                    Issued - Ready for pick up
                                </small>
                            @endif
                        </td>

                        <td style="width: 1%;">
                            {{-- if submitted show date created --}}
                            @if ($item->status == 1)
                                {{$item->created_at->format('F j, Y')}}
                            @elseif ($item->status == 4)
                                {{$item->generated_at->format('F j, Y')}}
                            @else
                            {{-- else date updated --}}
                                {{$item->updated_at->format('F j, Y')}}
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-secondary fw-medium">--No Data--</td>
                    </tr>
                @endforelse
            </x-table>

            {{-- pagination --}}
            <div class="d-flex align-items-center justify-content-sm-between flex-wrap justify-content-center">

                {{-- current and total page --}}
                <div class="">
                    <span class="primary-color fw-medium">Current Page {{$data->currentPage()}} | Total Page {{$data->lastPage()}}</span>
                </div>

                {{-- pages --}}
                <div class="d-inline-flex gap-2">

                    @if ($data->lastPage() != 1)
                        {{-- prev --}}
                        <a href="" class="btn btn-sm bg-primary-color rounded-0 {{$data->currentPage() == 1 ? 'disabled' : ''}}">
                            < Prev
                        </a>

                        {{-- loop pages --}}
                        <div class="d-inline-flex align-items-center min-w-[20px] overflow-x-auto">
                            @foreach ($data->links()->elements[0] as $page_link)
                                <a href="{{$page_link}}" class="btn btn-sm rounded-0" style="border: 1px solid var(--primary-color);">{{$loop->iteration}}</a>
                            @endforeach

                        </div>

                        {{-- next --}}
                        <a href="" class="btn btn-sm bg-primary-color rounded-0 {{$data->currentPage() == $data->lastPage() ? 'disabled' : ''}}">
                            Next >
                        </a>
                    @endif

                </div>
            </div>

        </x-card>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            // init issue summon
            issueSummon();
        });

        /**
         * Issue a summon to ready for pick up
         *
         * Get Issue link classes, add event click, get id,
         * display confirmation if confirm perform put request
         * if the request was a success then reload page.
         *
         * @returns void
         */
        const issueSummon = ()=>{
            const issue_link = document.querySelectorAll('.issue-link');

            issue_link.forEach(item => {
                item.addEventListener('click', async function(e) {
                    e.preventDefault();
                    e.stopImmediatePropagation();

                    const id = e.currentTarget.dataset.id;

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
                                const url = `/summons/${encodeURIComponent(id)}/issue`;
                                const response = await fetch(url, {
                                    method: 'PUT',
                                    headers: {
                                        'X-CSRF-TOKEN' : window.token,
                                        'Accept': 'application/json'
                                    }
                                });

                                if(!response.ok) throw new Error("Server Error");

                                Swal.fire({
                                    title: 'Successful',
                                    icon: 'success',
                                    text: 'Successfully issued summon.'
                                }).then(()=>{
                                    window.location.reload();
                                });

                            } catch (error) {
                                console.error(error);
                                Swal.fire({
                                    title: 'Server Error',
                                    icon: 'error',
                                    text: 'Something went wrong, Pls Contact developer'
                                });
                            }
                        }
                    });

                });
            });
        }
    </script>
</x-auth-layout>
