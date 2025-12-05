<x-auth-layout title="Attestation Certificate Requests">
    {{-- citizens --}}
    <section class="container p-4">
        <x-card>
            {{-- card header --}}
            <x-slot name="cardheader">
                <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2">

                    <div class="d-flex align-items-center gap-2">
                        <x-icon type="certificate primary-color" />
                        <h5 class="m-0 primary-color">List of Request - Attestation Certificates</h5>
                    </div>

                    {{-- form search name of the requestor --}}
                    <x-form class="d-flex align-items-center justify-content-end gap-1 flex-wrap"
                        style="max-width: 250px;">
                        <x-input type="search" name="search" placeholder="Search Name" />
                        <x-button type="submit" id="search-btn" class="btn btn-sm btn-info">
                            <x-icon type="search primary-color" />
                        </x-button>
                    </x-form>
                </div>
            </x-slot>

            {{-- card body --}}
            <x-table table-class="table-sm table-hover table-stripped"
                :ths="['Action', 'Request By', 'Work', 'Monthly Earning', 'Date Requested']">
                @forelse ($attestation_certificate_requests as $item)
                <tr class="align-middle">
                    <td style="width: 160px;">
                        <div class="d-flex align-items-center gap-1" style="width: fit-content;">
                            {{-- if submitted --}}
                            @if ($item->status == 1)
                                <a href=""
                                    class="text-decoration-none bg-primary-color text-white px-3 py-1 rounded w-50 text-nowrap approve"
                                    data-id="{{$item->encrypted_id}}">
                                    <x-icon type="check text-white" />
                                    <small>Approve</small>
                                </a>

                                <a href=""
                                    class="text-decoration-none bg-primary-color text-white px-3 py-1 rounded w-50 text-nowrap reject"
                                    data-id="{{$item->encrypted_id}}">
                                    <x-icon type="x text-white" />
                                    <small>Reject</small>
                                </a>
                            {{-- if approved --}}
                            @elseif ($item->status == 2)
                                <a href="{{route('staff.attestation-certificate-requests.generate-certificate', ['id' => urlencode($item->encrypted_id)])}}"
                                    class="text-decoration-none bg-primary-color text-white px-3 py-1 rounded text-nowrap"
                                    target="_blank">
                                    <x-icon type="gear text-white" />
                                    <small>Generate Certificate</small>
                                </a>
                                <a href=""
                                    class="text-decoration-none bg-primary-color text-white px-3 py-1 rounded text-nowrap issue-btn"
                                    data-id="{{$item->encrypted_id}}">
                                    <x-icon type="certificate text-white" />
                                    <small>Issue Certificate</small>
                                </a>
                            @elseif ($item->status == 4)
                                <a href="{{route('staff.attestation-certificate-requests.generate-certificate', ['id' => urlencode($item->encrypted_id)])}}"
                                    class="text-decoration-none bg-primary-color text-white px-3 py-1 rounded text-nowrap"
                                    target="_blank">
                                    <x-icon type="eye text-white" />
                                    <small>View Certificate</small>
                                </a>
                            @endif
                        </div>
                    </td>
                    <td>
                        {{$item->name}}
                    </td>
                    <td>
                        {{$item->work}}
                    </td>
                    <td>
                        {{ 'PhP '.(string)number_format($item->monthly_earning)}}
                    </td>
                    <td>
                        {{$item->created_at->format('F j, Y')}}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-secondary">
                        <small>No Data</small>
                    </td>
                </tr>
                @endforelse
            </x-table>
            {{-- pagination --}}
            <div class="d-flex justify-content-between align-items-center">
                <small class="fw-bold text-secondary">CURRENT PAGE -
                    {{$attestation_certificate_requests->currentPage()}} | TOTAL PAGE -
                    {{$attestation_certificate_requests->lastPage()}}</small>
                {{$attestation_certificate_requests->links()}}
            </div>
        </x-card>
    </section>

    {{-- modal comment --}}
    <div class="modal" tabindex="-1" id="modal-reject-comment" aria-hidden="true"
        aria-labelledby="#modal-reject-comment-title">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex align-items-center gap-2">
                        <x-icon type="comment primary-color" />
                        <h5 id="modal-reject-comment-title" class="m-0 primary-color">Reject Comment</h5>
                    </div>
                </div>
                <div class="modal-body">
                    {{-- form comment --}}
                    <x-form class="d-grid gap-3 p-3" id="form-reject-comment">
                        {{-- input --}}
                        <div class="">
                            <div class="d-flex align-items-center gap-2">
                                <x-icon type="comment primary-color" />
                                <label for="">Comment</label>
                            </div>
                            <textarea name="reject_comment" id="reject-comment" class="form-control"
                                style="min-height: 200px;" placeholder="Reason of rejection" required></textarea>
                        </div>

                        <div class="d-flex justify-content-end align-items-center gap-2">
                            {{-- btns --}}
                            <x-button type="submit" id="reject-comment-submit-btn" class="btn-sm bg-primary-color">
                                <x-icon type="check" />
                                submit
                            </x-button>
                            <x-button class="btn-sm bg-primary-color" data-bs-dismiss="modal">
                                <x-icon type="x" />
                                cancel
                            </x-button>
                        </div>
                    </x-form>
                </div>
            </div>
        </div>
    </div>

    {{-- script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            // approve request init
            approvedRequest();

            // reject request init
            rejectRequest();

            // issue cert
            issueCertificate();
        });

        // approve
        function approvedRequest(){
            // get btns
            const approve_btn = document.querySelectorAll('.approve');

            // add event to all btn
            approve_btn.forEach(item => {
                item.addEventListener('click', function(e){
                    e.preventDefault();
                    e.stopImmediatePropagation();

                    // get id
                    const id = e.currentTarget.dataset.id;

                    // confirmation
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, Approve it!"
                    }).then(async(result) => {
                        // if confirmed
                        if (result.isConfirmed) {

                            try {
                                /**
                                 * url
                                 * put request
                                 */
                                const url = `/staff/attestation-certificate-requests/${id}/approve`;
                                const response = await fetch(url, {
                                    method : 'PUT',
                                    headers: {
                                        'X-CSRF-TOKEN' : token
                                    }
                                });

                                // if not ok throw new Error
                                if(!response.ok){
                                    throw new Error("Server Error");
                                }

                                // if ok show success alert then reload
                                Swal.fire({
                                    title: "Approved!",
                                    text: "Request has been approved.",
                                    icon: "success"
                                }).then(()=>{
                                    window.location.reload();
                                });

                            } catch (error) {
                                /**
                                 * log error
                                 * show error alert
                                 */
                                console.error(error.message);
                                Swal.fire({
                                    title: 'Error',
                                    icon: 'error',
                                    text: 'Something Went Wrong, Pls Contact Developer'
                                });
                            }

                        }
                    });
                });
            });
        }
        // approve
        function rejectRequest(){
            // get btns
            const reject_btn = document.querySelectorAll('.reject');

            // add event to all btn
            reject_btn.forEach(item => {
                item.addEventListener('click', function(e){
                    e.preventDefault();
                    e.stopImmediatePropagation();

                    // get id
                    const id = e.currentTarget.dataset.id;
                    const modal = new bootstrap.Modal(document.getElementById('modal-reject-comment'));

                    // confirmation
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, Reject it!"
                    }).then(async(result) => {

                        // if confirmed
                        if (result.isConfirmed) {

                            modal.show(); // show reject comment modal

                            submitRejectComment(id); // submit reject comment form init
                        }

                    });
                });
            });
        }

        // submit reject comment
        function submitRejectComment(id){
            const form = document.getElementById('form-reject-comment');
            const submit_reject_btn = document.getElementById('reject-comment-submit-btn');
            const reject_comment = document.getElementById('reject-comment');


            form.addEventListener('submit', async function(e){
                e.preventDefault();
                e.stopImmediatePropagation();

                // disabled submit reject btn
                submit_reject_btn.disabled = true;

                try {
                    /**
                     * url
                     * put request
                     */
                    const url = `/staff/attestation-certificate-requests/${id}/reject`;
                    const response = await fetch(url, {
                        method : 'PUT',
                        headers: {
                            'X-CSRF-TOKEN' : token,
                            'Content-Type' : 'application/json'
                        },
                        body: JSON.stringify({
                            reject_comment : reject_comment.value
                        })
                    });

                    // if not ok throw new Error
                    if(!response.ok){
                        throw new Error("Server Error");
                    }

                    // if ok show success alert then reload
                    Swal.fire({
                        title: "Rejected!",
                        text: "Request has been rejected.",
                        icon: "success"
                    }).then(()=>{
                        submit_reject_btn.disabled = false;
                        window.location.reload();
                    });

                } catch (error) {
                    /**
                     * log error
                     * show error alert
                     */
                    submit_reject_btn.disabled = false;
                    console.error(error.message);
                    Swal.fire({
                        title: 'Error',
                        icon: 'error',
                        text: 'Something Went Wrong, Pls Contact Developer'
                    });
                }
            });
        }

        // issue cert
        function issueCertificate(){
            const issue_btns = document.querySelectorAll('.issue-btn');

            issue_btns.forEach(item => {
                item.addEventListener('click', function(e){
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
                        confirmButtonText: "Yes, Issue it!"
                    }).then(async(result) => {
                        // if confirmed
                        if (result.isConfirmed) {

                            try {
                                /**
                                 * url
                                 * put request
                                 */
                                const url = `/staff/attestation-certificate-requests/${id}/issue-certificate`;
                                const response = await fetch(url, {
                                    method : 'PUT',
                                    headers: {
                                        'X-CSRF-TOKEN' : token
                                    }
                                });

                                // if not ok throw new Error
                                if(!response.ok){
                                    throw new Error("Server Error");
                                }

                                // if ok show success alert then reload
                                Swal.fire({
                                    title: "Issued!",
                                    text: "Successfully Issued Certificate.",
                                    icon: "success"
                                }).then(()=>{
                                    window.location.reload();
                                });

                            } catch (error) {
                                /**
                                 * log error
                                 * show error alert
                                 */
                                console.error(error.message);
                                Swal.fire({
                                    title: 'Error',
                                    icon: 'error',
                                    text: 'Something Went Wrong, Pls Contact Developer'
                                });
                            }

                        }
                    });
                });
            });
        }
    </script>
</x-auth-layout>
