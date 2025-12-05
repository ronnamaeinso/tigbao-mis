<x-auth-layout title="Citizens">
    {{-- citizens --}}
    <section class="container p-4">
        <x-card>
            {{-- card header --}}
            <x-slot name="cardheader">
                <div class="d-flex align-items-center gap-2">
                    <x-icon type="users primary-color" />
                    <h5 class="m-0 primary-color">Citizens</h5>
                </div>
            </x-slot>

            {{-- card body --}}
            <x-table table-class="table-sm table-hover table-stripped" :ths="['Action', 'Name', 'Date Registered']">
                @forelse ($citizens as $item)
                <tr class="align-middle ">
                    {{-- see citizen profile --}}
                    <td class="primary-color">
                        <a href="{{route('staff.citizen.show', ['citizen' => urlencode(Illuminate\Support\Facades\Crypt::encrypt($item->id))])}}"
                            class="w-100 primary-color text-nowrap text-decoration-none">
                            <x-icon type="eye" />
                            Citizen Profile
                        </a>
                    </td>
                    <td class="primary-color">{{$item->name}}</td>
                    <td class="primary-color">{{$item->created_at->format('F j, Y')}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-secondary">No Data</td>
                </tr>
                @endforelse
            </x-table>
        </x-card>
    </section>
</x-auth-layout>