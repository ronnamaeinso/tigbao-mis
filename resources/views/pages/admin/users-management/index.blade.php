<x-auth-layout title="User Management">
    <section class="container p-3">
        <x-card>
            {{-- card header --}}
            <x-slot name="cardheader">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <x-icon type="users primary-color" />
                        <h5 class="card-title m-0 primary-color">Users</h5>
                    </div>

                    {{-- add users --}}
                    <a href="{{route('admin.manage.users.create')}}" class="text-decoration-none primary-color"
                        style="font-size: 0.9rem;">
                        <x-icon type="user-plus primary-color" />
                        Add User
                    </a>
                </div>
            </x-slot>
            {{-- card body --}}
            <x-table :ths="['No.', 'Name', 'Type', 'Email', 'Date Register', 'Action']" table-id="table-user-list"
                table-class="table-sm table-hover">
                @forelse ($users as $user)
                <tr>
                    <td class="primary-color">{{$loop->iteration}}</td>
                    <td class="primary-color">{{$user->name}}</td>
                    <td class="primary-color">
                        {{$user->role == 2 ? 'Staff' : ''}}
                        {{$user->role == 3 ? 'Brgy. Citizen' : ''}}
                    </td>
                    <td class="primary-color">{{$user->email}}</td>
                    <td class="primary-color">{{$user->created_at->format('F j, Y')}}</td>
                    <td class="primary-color" style="width: 90px;">
                        <div class="d-flex align-items-center justify-content-center gap-2">
                            <a
                                href="{{route('admin.manage.users.edit', [ 'id' => urlencode(Illuminate\Support\Facades\Crypt::encrypt($user->id))])}}">
                                <x-icon type="edit primary-color" />
                            </a>
                            <x-icon type="trash primary-color cursor-pointer delete-user-btn"
                                data-id="{{Illuminate\Support\Facades\Crypt::encrypt($user->id)}}" />
                        </div>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="7" class="text-secondary text-center">
                        <small>-- No Data --</small>
                    </td>
                </tr>
                @endforelse

            </x-table>
            {{-- pagination --}}
            <div class="d-flex align-items-center flex-wrap">
            </div>
        </x-card>
    </section>

    {{-- script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            // delete user
            deleteUser();
        });

        // delete user
        function deleteUser(){
            const delete_btns = document.querySelectorAll('.delete-user-btn');

            delete_btns.forEach(item => {
                item.addEventListener('click', async function(e) {
                    e.stopImmediatePropagation();

                    const id = e.currentTarget.dataset.id;

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
                                const url = `/a/manage/users/${encodeURIComponent(id)}`;
                                const response = await fetch(url, {
                                    method : 'DELETE',
                                    headers : {
                                        'X-CSRF-TOKEN': token
                                    }
                                });

                                // if response was not ok then throw new Error
                                if(!response.ok){
                                    throw new Error("");
                                }

                                // if success
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "User has been deleted.",
                                    icon: "success"
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
