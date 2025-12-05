<x-auth-layout title="Citizens">
    {{-- citizens --}}
    <section class="container m-0 p-0 mx-auto mt-4 px-4 px-md-0">
        {{-- announcements --}}
        <h4 class="primary-color">
            <x-icon type="bullhorn"/>
            Announcements
        </h4>
        <div class="row row-gap-4 mb-4">
            @foreach ($announcements as $item)
                <div class="col-lg-4">
                    <div class="card rounded-0 bg-white h-100" style="box-shadow: -5px 5px var(--primary-color);">
                        <div class="card-body">
                            <h5 class="primary-color">{{ $item->title }}</h5>
                            <small class="fw-medium primary-color">{{$item->created_at->format('M j, Y @ h:i:s a')}}</small>
                            <hr>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia illo id nisi deserunt pariatur soluta porro repudiandae reprehenderit nesciunt laudantium vitae neque ratione fugiat distinctio, enim repellendus commodi ab eaque?
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- announcement pagination --}}
        <div class="d-flex justify-content-end align-items-center gap-2">
            <a href="/dashboard" class="btn btn-sm bg-primary-color fw-medium">
                <x-icon type="arrow-up"/>
                Hide
            </a>
            <a href="/dashboard?limit={{ urlencode((int) $limit + 3) }}" class="btn btn-sm bg-primary-color fw-medium">
                <x-icon type="arrow-right"/>
                See more...
            </a>
        </div>

        <h4 class="primary-color">
            <x-icon type="file"/>
            Request
        </h4>
        {{-- statistic --}}
        <div class="row row-gap-4">
            <div class="col-md-4">
                <div class="d-grid gap-1 bg-white shadow-lg h-100 p-3 rounded primary-color">
                    <span class="fw-medium">
                        <x-icon type="file"/>
                        Total Request
                    </span>
                    <h1 class="text-end">{{$total_requests}}</h1>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-grid gap-1 bg-white shadow-lg h-100 p-3 rounded primary-color">
                    <span class="fw-medium">
                        <x-icon type="file"/>
                        Total Requested Attestation Cert.
                    </span>
                    <h1 class="text-end">{{$total_attestation_cert_requests}}</h1>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-grid gap-1 bg-white shadow-lg h-100 p-3 rounded primary-color">
                    <span class="fw-medium">
                        <x-icon type="file"/>
                        Total Requested Summons.
                    </span>
                    <h1 class="text-end">{{$total_summons}}</h1>
                </div>
            </div>
        </div>
    </section>
</x-auth-layout>
