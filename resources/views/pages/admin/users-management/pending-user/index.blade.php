<x-auth-layout title="User Management">

    <section class="container p-3">
        <x-card>
            {{-- card header --}}
            <x-slot name="cardheader">
                <div class="d-flex align-items-center gap-2">
                    <x-icon type="users primary-color" />
                    <h5 class="card-title m-0 primary-color">Pending Users</h5>
                </div>
            </x-slot>
            {{-- card body --}}
            <x-table :ths="['No.', 'Name', 'Email', 'ID Type', 'ID Picture', 'Date Register', 'Action']"
                table-id="table-user-list" table-class="table-sm table-hover text-nowrap">
                {{-- loop users --}}
                @forelse ($users as $user)
                <tr class="align-middle">
                    <td class="primary-color">{{$loop->iteration}}</td>
                    <td class="primary-color">{{$user->name}}</td>
                    <td class="primary-color">{{$user->email}}</td>
                    <td class="primary-color">
                        {{$user->id_type == 0 ? 'Other' : ''}}
                        {{$user->id_type == 1 ? 'National ID' : ''}}
                    </td>
                    <td class="primary-color">
                        <a href="/view-file?path={{urlencode($user->id_picture)}}&type={{urlencode('live')}}"
                            class="text-decoration-none primary-color" target="_blank">
                            <x-icon type="eye" />
                            <x-icon type="id-card" />
                        </a>
                    </td>
                    <td class="primary-color">{{$user->created_at->format('F j, Y')}}</td>
                    <td class="primary-color" style="width: 90px;">
                        <div class="d-flex align-items-center gap-2">
                            <x-icon type="check primary-color verify cursor-pointer"
                                data-id="{{Illuminate\Support\Facades\Crypt::encrypt($user->id)}}" />
                            <x-icon type="xmark primary-color reject cursor-pointer"
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
                {{$users->links()}}
            </div>
            <div class="d-flex justify-content-between mt-2">
                <span class="primary-color">Current Page {{$users->currentPage()}}</span>
                <span class="primary-color">Total Page {{$users->lastPage()}}</span>
            </div>
        </x-card>
    </section>

    {{-- script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            // verify account
            verifyAccount();

            // reject account registration request
            rejectRequest();
        });

        // verify account
        function verifyAccount(){
            const verify_button = document.querySelectorAll('.verify');

            // loop button
            verify_button.forEach(item => {

                // add event listener for click
                item.addEventListener('click', function(e){
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
                        confirmButtonText: "Yes, Verify it!"
                    }).then( async (result) => {
                        if (result.isConfirmed) {

                            try {
                                const url = `/verify-account/${encodeURIComponent(id)}`;
                                const response = await fetch(url, {
                                    method: 'PUT',
                                    headers: {
                                        'X-CSRF-TOKEN' : token
                                    }
                                });

                                if(!response.ok){
                                    throw new Error("");
                                }

                                Swal.fire({
                                    title: "Success!",
                                    text: "Successfully Verified Account!",
                                    icon: "success"
                                }).then(()=>{
                                    window.location.reload();
                                });

                            } catch (error) {
                                Swal.fire({
                                    title : 'Error',
                                    icon : 'error',
                                    text : 'Something Went Wrong, Pls Contact Developer',
                                });
                                console.error(error.message);
                            }

                        }
                    });
                });
            });
        }

        // reject user account registration request
        function rejectRequest(){
            const reject_btn = document.querySelectorAll('.reject');

            // loop all btn
            reject_btn.forEach(item => {

                // get id
                const id = item.dataset.id;

                // add event click
                item.addEventListener('click', async function(e) {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, Reject it!"
                    }).then( async (result) => {
                        if (result.isConfirmed) {
                            try {
                                /**
                                 * url
                                 * put request
                                 */
                                const url = `/reject-account-verification-request/${id}`;
                                const response = await fetch(url, {
                                    method: 'PUT',
                                    headers: {
                                        'X-CSRF-TOKEN' : token
                                    }
                                });

                                // if response was not ok
                                if(!response.ok){
                                    throw new Error("");
                                }

                                // if success show success alert
                                Swal.fire({
                                    title: 'Success',
                                    icon: 'success',
                                    text: 'Successfully Reject Request',
                                }).then(()=>{
                                    window.location.reload();
                                });
                            } catch (error) {
                                /**
                                 * log error
                                 * show error alert
                                 */
                                Swal.fire({
                                    title : 'Error',
                                    icon : 'error',
                                    text : 'Something Went Wrong, Pls Contact Developer',
                                });
                                console.error(error.message);
                            }

                        }
                    });
                });
            });
        }
    </script>
</x-auth-layout>
