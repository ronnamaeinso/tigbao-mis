<x-auth-layout>
    <section class="container-fluid">
        <div class="row row-gap-4">

            {{-- if admin --}}
            @if (Auth::user()->role == 1 || Auth::user()->role == 2)
                <h1 class="primary-color">Requested Documents</h1>

                <div class="col-md-4">
                    <a href="{{ route('staff.attestation-certificate-requests.index') }}" class="nav-link h-100"
                        style="box-shadow: -5px 5px var(--primary-color);">
                        <div class="h-100 rounded shadow p-4 rounded-0 border"
                            style="border-left: 5px solid var(--primary-color);">
                            <span class="primary-color fs-5">
                                <x-icon type="file-signature" />
                                Certification Of Attestations
                            </span>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('summons.index') }}" class="nav-link h-100"
                        style="box-shadow: -5px 5px var(--primary-color);">
                        <div class="h-100 rounded shadow p-4 rounded-0 border"
                            style="border-left: 5px solid var(--primary-color);">
                            <span class="primary-color fs-5">
                                <x-icon type="scale-balanced" />
                                Summons
                            </span>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('request-list.certificate-of-indigency.index') }}" class="nav-link h-100"
                        style="box-shadow: -5px 5px var(--primary-color);">
                        <div class="h-100 rounded shadow p-4 rounded-0 border"
                            style="border-left: 5px solid var(--primary-color);">
                            <span class="primary-color fs-5">
                                <x-icon type="hand-holding-heart" />
                                Certification Of Indigency
                            </span>
                        </div>
                    </a>
                </div>

                {{-- list of request of certificate of residency --}}
                <div class="col-md-4">
                    <a href="{{ route('certificate-of-residency.request.list.index') }}" class="nav-link h-100"
                        style="box-shadow: -5px 5px var(--primary-color);">
                        <div class="h-100 rounded shadow p-4 rounded-0 border"
                            style="border-left: 5px solid var(--primary-color);">
                            <span class="primary-color fs-5">
                                <x-icon type="house-user" />
                                Certification Of Residency
                            </span>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="{{ route('barangay-clearance.building-permit.request.list.index') }}"
                        class="nav-link h-100"
                            style="box-shadow: -5px 5px var(--primary-color);">
                        <div class="h-100 rounded shadow p-4 rounded-0 border"
                            style="border-left: 5px solid var(--primary-color);">
                            <span class="primary-color fs-5">
                                <x-icon type="building" />
                                Barangay Clearance - Building Permit
                            </span>
                        </div>
                    </a>
                </div>

                {{-- certificate of good moral request --}}
                <div class="col-md-4">
                    <a href="{{ route('certificate-of-good-moral.request.list.index') }}" class="nav-link h-100"
                        style="box-shadow: -5px 5px var(--primary-color);">
                        <div class="h-100 rounded shadow p-4 rounded-0 border"
                            style="border-left: 5px solid var(--primary-color);">
                            <span class="primary-color fs-5">
                                <x-icon type="certificate" />
                                Certificate Of Good Moral
                            </span>
                        </div>
                    </a>
                </div>

                {{-- certificate of animal transportation clearance --}}
                <div class="col-md-4">
                    <a href="{{ route('animaltransportationrequestlist.index') }}" class="nav-link h-100"
                        style="box-shadow: -5px 5px var(--primary-color);">
                        <div class="h-100 rounded shadow p-4 rounded-0 border"
                            style="border-left: 5px solid var(--primary-color);">
                            <span class="primary-color fs-5">
                                <x-icon type="dog" />
                                Animal Transportation Clearance
                            </span>
                        </div>
                    </a>
                </div>

            @endif

            {{-- REQUESTABLE DOCUMENTS --}}
            <h1 class="primary-color mt-5">Request Documents</h1>

            {{-- certificate of attestations  --}}
            <div class="col-md-4">
                <a href="{{ route('request.documents.attestation.certificate.index') }}" class="nav-link h-100"
                    style="box-shadow: -5px 5px var(--primary-color);">
                    <div class="h-100 rounded shadow p-4 rounded-0 border"
                        style="border-left: 5px solid var(--primary-color);">
                        <span class="primary-color fs-5">
                            <x-icon type="file-signature" />
                            Certification Of Attestations
                        </span>
                    </div>
                </a>
            </div>

            {{-- summons --}}
            <div class="col-md-4">
                <a href="{{ route('request.documents.kp-form-no-9.index') }}" class="nav-link h-100"
                    style="box-shadow: -5px 5px var(--primary-color);">
                    <div class="h-100 rounded shadow p-4 rounded-0 border"
                        style="border-left: 5px solid var(--primary-color);">
                        <span class="primary-color fs-5">
                            <x-icon type="scale-balanced" />
                            Summons
                        </span>
                    </div>
                </a>
            </div>

            {{-- certificate of indigency --}}
            <div class="col-md-4">
                <a href="{{ route('request.certificate-of-indigency.index') }}" class="nav-link h-100"
                    style="box-shadow: -5px 5px var(--primary-color);">
                    <div class="h-100 rounded shadow p-4 rounded-0 border"
                        style="border-left: 5px solid var(--primary-color);">
                        <span class="primary-color fs-5">
                            <x-icon type="hand-holding-heart" />
                            Certification Of Indigency
                        </span>
                    </div>
                </a>
            </div>

            {{-- certificate of residency request --}}
            <div class="col-md-4">
                <a href="{{ route('certificate-of-residency-request.index') }}" class="nav-link h-100"
                    style="box-shadow: -5px 5px var(--primary-color);">
                    <div class="h-100 rounded shadow p-4 rounded-0 border"
                        style="border-left: 5px solid var(--primary-color);">
                        <span class="primary-color fs-5">
                            <x-icon type="house-user" />
                            Certificate Of Residency
                        </span>
                    </div>
                </a>
            </div>

            {{-- barangay clearance - building permit --}}
            <div class="col-md-4">
                <a href="{{ route('barangay-clearance.building-permit.request.index') }}" class="nav-link h-100"
                    style="box-shadow: -5px 5px var(--primary-color);">
                    <div class="h-100 rounded shadow p-4 rounded-0 border"
                        style="border-left: 5px solid var(--primary-color);">
                        <span class="primary-color fs-5">
                            <x-icon type="building" />
                            Barangay Clearance - Building Permit
                        </span>
                    </div>
                </a>
            </div>

            {{-- certificate of good moral request --}}
            <div class="col-md-4">
                <a href="{{ route('certificate-of-good-moral.request.index') }}" class="nav-link h-100"
                    style="box-shadow: -5px 5px var(--primary-color);">
                    <div class="h-100 rounded shadow p-4 rounded-0 border"
                        style="border-left: 5px solid var(--primary-color);">
                        <span class="primary-color fs-5">
                            <x-icon type="certificate" />
                            Certificate Of Good Moral
                        </span>
                    </div>
                </a>
            </div>

            {{-- certificate of animal transportation clearance --}}
            <div class="col-md-4">
                <a href="{{ route('animal-transportation-clearance.request.index') }}" class="nav-link h-100"
                    style="box-shadow: -5px 5px var(--primary-color);">
                    <div class="h-100 rounded shadow p-4 rounded-0 border"
                        style="border-left: 5px solid var(--primary-color);">
                        <span class="primary-color fs-5">
                            <x-icon type="dog" />
                            Animal Transportation Clearance
                        </span>
                    </div>
                </a>
            </div>

        </div>
    </section>
</x-auth-layout>
