<x-auth-layout title="Certificate of Residency - Track Status">
    <section class="container mx-auto m-0 p-0">
        {{-- header --}}
        <span class="m-0 primary-color fs-2">
            <x-icon type="circle"/>
            Track Status
        </span>
        {{-- track status --}}
        <div class="d-flex align-items-start overflow-auto" style="height: 120px;">
            <x-document-progress-tracker :layers="$data"/>
        </div>
        {{-- redirect back --}}
        <div class="d-flex justify-content-end">
            <a href="{{url()->previous()}}" class="btn btn-sm bg-primary-color">
                <x-icon type="arrow-left"/>
                Back
            </a>
        </div>
    </section>
</x-auth-layout>
