<x-guest-layout title="Home">

    {{-- header --}}
    <x-slot name="header">
        <x-header-guest />
    </x-slot>

    <style>
        .carousel-control-next-icon,
        .carousel-control-prev-icon {
            filter: invert(80%) brightness(80%);
        }
    </style>

    {{-- HERO SECTION --}}
    <section class="hero text-center">
        <div class="container">
            <h1 class="display-4 fw-bold primary-color">TIGBAO MIS</h1>
            <p class="lead primary-color">Providing efficient, transparent, and citizen-centered services</p>
        </div>
    </section>

    <section class="container mt-4">

        {{-- Historical Background --}}
        <section id="history" class="py-5">
            <div class="container">
                <h2 class="text-center mb-4 primary-color">Historical Background</h2>
                <p class="fs-5 text-justify" style="text-indent: 1in;">
                    Barangay Tigbao got its name from a grass locally known as “bugang”. Before the creation, the whole
                    area was covered with grass and big trees of different species. Land was suitable for cultivation,
                    inhabited by wild animals.
                </p>
                <p class="fs-5 text-justify" style="text-indent: 1in;">
                    Long time ago, merchant from the neighboring Province of Bohol came to trade with illiterate folks
                    residing along the shore. Upon arrival, residents met them, with hospitality. Then inquire the place
                    they are visiting.
                </p>
                <p class="fs-5 text-justify" style="text-indent: 1in;">
                    Unfortunately, no one among the resident could tell the name of the place. They only knew Punta and
                    Looc, both setio’s inhabited, but no precise name of the whole place. So, the merchant wonders why
                    there’s no name. He investigated with his own mind, look around the surroundings and found out that
                    the whole area was covered with “bugang” grass.
                </p>
                <p class="fs-5 text-justify" style="text-indent: 1in;">
                    Then said to them, that your place deserved to be called Tigbao, derived from the grass that covered
                    the area, because in some other Provinces of the Visayas I’ve visited, “bugang” is called Tigbao.
                </p>
                <p class="fs-5 text-justify" style="text-indent: 1in;">
                    From thence, there was massive flow of settlers from the Province of Bohol, occupying idle land and
                    cultivate. Destruction of the environment started by clearing the area and indiscriminate cutting of
                    big trees had begun.
                </p>
                <p class="fs-5 text-justify" style="text-indent: 1in;">
                    Development of the Barangay, gradually grown up by constructing chapel, school, house and Barangay
                    road, so with the Population multiplied rapidly.
                </p>
            </div>
        </section>

        {{-- Vision & Mission --}}
        <section id="vision" class="py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="p-4 shadow rounded h-100">
                            <h3 class="primary-color">Vision</h3>
                            <p>
                                Leading Agri-Tourism through Organic Farming in Libagon, with God-Loving, Self-reliant,
                                Educated, Healthy, Hospitable, Politically empowered and Disaster Resilient Society,
                                United with Pride and Dignity; Living in Rich Natural Resources, Balance Ecology and
                                Climate change responsive environment, Having Self-Sufficient, Progressive and
                                Sustainable Economy, propelled by Service and Development Oriented, pro-people,
                                Transparent and Open Minded Leaders.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-4 shadow rounded h-100">
                            <h3 class="primary-color">Mission</h3>
                            <p>
                                Our mission and goals in the Development of our Barangay, is to continue to support
                                basic services aimed to better quality way of living to our constituents. To initiate
                                and implement towards proper solid waste management, beautification and cleanliness of
                                the community. We shall also focus the preservation and Maintenance of peace and order
                                for better development of our community.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Tourist Spots Carousel --}}
        <section id="tourism" class="py-5">
            <div class="container">
                <h2 class="text-center mb-4 primary-color">Tourist Spots</h2>
                <div id="touristCarousel" class="carousel slide shadow" data-bs-ride="carousel">
                    <div class="carousel-inner mx-auto" style="max-width: 500px">
                        <div class="carousel-item active">
                            <img src="{{ asset('images/Picture1.jpg') }}" class="d-block w-100 carousel-img"
                                alt="Tourist Spot 1" />

                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/Picture2.jpg') }}" class="d-block w-100 carousel-img"
                                alt="Tourist Spot 2" />
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/Picture3.jpg') }}" class="d-block w-100 carousel-img"
                                alt="Tourist Spot 2" />
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#touristCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#touristCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </section>

        {{-- Barangay Officials --}}
        <section id="officials" class="py-5 bg-light">
            <div class="container">
                <h2 class="mb-4 text-center primary-color">Barangay Officials</h2>

                <div class="row g-4">

                    <!-- 1 -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card shadow-sm">
                            <img src="{{ asset('images/1.png') }}" class="official-img" alt="Official" style="aspect-ratio: 1">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-1">Hon. Emilito T. Ranque</h5>
                                <p class="text-muted small">Committee on Infrastructure & Water Works System</p>
                            </div>
                        </div>
                    </div>

                    <!-- 2 -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card shadow-sm">
                            <img src="{{ asset('images/2.png') }}" class="official-img" alt="Official" style="aspect-ratio: 1">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-1">Hon. Gregorio L. Selpa</h5>
                                <p class="text-muted small">Committee on BDRRM</p>
                            </div>
                        </div>
                    </div>

                    <!-- 3 -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card shadow-sm">
                            <img src="{{ asset('images/3.png') }}" class="official-img" alt="Official" style="aspect-ratio: 1">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-1">Hon. Celestina C. Rubio</h5>
                                <p class="text-muted small">Barangay Chairman</p>
                            </div>
                        </div>
                    </div>

                    <!-- 4 -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card shadow-sm">
                            <img src="{{ asset('images/4.png') }}" class="official-img" alt="Official" style="aspect-ratio: 1">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-1">Hon. Levi S. Ranque</h5>
                                <p class="text-muted small">Committee on Agriculture</p>
                            </div>
                        </div>
                    </div>

                    <!-- 5 -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card shadow-sm">
                            <img src="{{ asset('images/5.png') }}" class="official-img" alt="Official" style="aspect-ratio: 1">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-1">Hon. Lorna C. Basagan</h5>
                                <p class="text-muted small">Committee on Health, Education & Social Services</p>
                            </div>
                        </div>
                    </div>

                    <!-- 6 -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card shadow-sm">
                            <img src="{{ asset('images/6.png') }}" class="official-img" alt="Official" style="aspect-ratio: 1">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-1">Lenie S. Ellacer</h5>
                                <p class="text-muted small">Secretary</p>
                            </div>
                        </div>
                    </div>

                    <!-- 7 -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card shadow-sm">
                            <img src="{{ asset('images/7.png') }}" class="official-img" alt="Official" style="aspect-ratio: 1">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-1">Hon. Lougie Y. Respecia</h5>
                                <p class="text-muted small">SK Chairperson – Committee on Youth & Sports</p>
                            </div>
                        </div>
                    </div>

                    <!-- 8 -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card shadow-sm">
                            <img src="{{ asset('images/8.png') }}" class="official-img" alt="Official" style="aspect-ratio: 1">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-1">Hon. Mark Anthony Yamson</h5>
                                <p class="text-muted small">Committee on Women & Family (VAWC & BCPC), Environment &
                                    Solid Waste Mgmt</p>
                            </div>
                        </div>
                    </div>

                    <!-- 9 -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card shadow-sm">
                            <img src="{{ asset('images/9.png') }}" class="official-img" alt="Official" style="aspect-ratio: 1">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-1">Hon. Victor A. Acdal</h5>
                                <p class="text-muted small">Committee on Peace & Order & BADAC</p>
                            </div>
                        </div>
                    </div>

                    <!-- 10 -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card shadow-sm">
                            <img src="{{ asset('images/10.png') }}" class="official-img" alt="Official" style="aspect-ratio: 1">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-1">Hon. Gil L. Montañez</h5>
                                <p class="text-muted small">Committee on Appropriation</p>
                            </div>
                        </div>
                    </div>

                    <!-- 11 -->
                    <div class="col-md-3 col-sm-6">
                        <div class="card shadow-sm">
                            <img src="{{ asset('images/11.png') }}" class="official-img" alt="Official" style="aspect-ratio: 1">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-1">Leonila S. Escabillas</h5>
                                <p class="text-muted small">Treasurer</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        {{-- Accomplishments + Image Carousel --}}
        <section id="accomplishments" class="py-5">
            <div class="container">
                <h4 class="text-center mb-3 primary-color">Gallery of Accomplishments</h4>

                <div id="accomplishmentCarousel" class="carousel slide shadow" data-bs-ride="carousel">
                    <div class="carousel-inner mx-auto" style="max-width: 500px;">

                        <div class="carousel-item active">
                            <img src="{{ asset('images/acom1.jpg') }}" class="carousel-img" alt="Accomplishment 1"
                                style="aspect-ratio: 1; object-fit: cover;" />
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('images/acom2.jpg') }}" class="carousel-img" alt="Accomplishment 2"
                                style="aspect-ratio: 1; object-fit: cover;" />
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('images/acom3.jpg') }}" class="carousel-img" alt="Accomplishment 3"
                                style="aspect-ratio: 1; object-fit: cover;" />
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('images/acom4.jpg') }}" class="carousel-img" alt="Accomplishment 4"
                                style="aspect-ratio: 1; object-fit: cover;" />
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('images/acom5.jpg') }}" class="carousel-img" alt="Accomplishment 5"
                                style="aspect-ratio: 1; object-fit: cover;" />
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('images/acom6.jpg') }}" class="carousel-img" alt="Accomplishment 6"
                                style="aspect-ratio: 1; object-fit: cover;" />
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('images/acom7.jpg') }}" class="carousel-img" alt="Accomplishment 7"
                                style="aspect-ratio: 1; object-fit: cover;" />
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('images/acom8.jpg') }}" class="carousel-img" alt="Accomplishment 8"
                                style="aspect-ratio: 1; object-fit: cover;" />
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('images/acom9.jpg') }}" class="carousel-img" alt="Accomplishment 9"
                                style="aspect-ratio: 1; object-fit: cover;" />
                        </div>

                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#accomplishmentCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#accomplishmentCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>

            </div>
        </section>

        {{-- FAQ --}}
        {{-- <section id="faqs" class="py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-4">Frequently Asked Questions</h2>
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq1">
                                How do I request a Barangay Clearance?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Visit the Barangay Hall and proceed to the Secretary’s office. Bring a valid ID and pay
                                the required fee.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq2">
                                What documents are required for a residency certificate?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                A valid ID with your barangay address and a filled-out request form.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
    </section>

</x-guest-layout>
