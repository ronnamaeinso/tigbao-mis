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

        .hero {
            background: linear-gradient(135deg, rgba(var(--primary-color-rgb, 13, 110, 253), 0.1) 0%, rgba(var(--primary-color-rgb, 13, 110, 253), 0.05) 100%);
            padding: 5rem 0;
            margin-bottom: 3rem;
            border-bottom: 1px solid rgba(var(--primary-color-rgb, 13, 110, 253), 0.1);
        }

        .hero h1 {
            font-size: 3.5rem;
            background: linear-gradient(45deg, var(--primary-color), #0d6efd);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .hero p {
            font-size: 1.25rem;
            max-width: 600px;
            margin: 0 auto;
            color: #495057;
        }

        .section-title {
            position: relative;
            padding-bottom: 1rem;
            margin-bottom: 2.5rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), #0d6efd);
            border-radius: 2px;
        }

        .history-text {
            line-height: 1.8;
            font-size: 1.1rem;
            color: #444;
        }

        .vision-mission-card {
            border: none;
            border-radius: 15px;
            background: white;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .vision-mission-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        }

        .vision-mission-card h3 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid rgba(var(--primary-color-rgb, 13, 110, 253), 0.1);
        }

        .official-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            background: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            height: 100%;
        }

        .official-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.15);
        }

        .official-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-bottom: 3px solid var(--primary-color);
        }

        .official-card .card-body {
            padding: 1.5rem;
        }

        .official-card .card-title {
            color: #2c3e50;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .official-card .text-muted {
            color: #6c757d !important;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        /* Updated: Tourist spots images not cropped */
        .tourist-carousel-img {
            width: 100%;
            max-height: 500px;
            object-fit: contain;
            background-color: #f8f9fa;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 50px;
            height: 50px;
            background: rgba(255,255,255,0.9);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.9;
        }

        .bg-section-light {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 20px;
        }

        /* Carousel Styles for both tourist and accomplishments */
        #touristCarousel .carousel-control-prev,
        #accomplishmentCarousel .carousel-control-prev {
            left: 10px;
        }

        #touristCarousel .carousel-control-next,
        #accomplishmentCarousel .carousel-control-next {
            right: 10px;
        }

        #touristCarousel .carousel-control-prev,
        #touristCarousel .carousel-control-next,
        #accomplishmentCarousel .carousel-control-prev,
        #accomplishmentCarousel .carousel-control-next {
            width: 50px;
            height: 50px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.8;
            transition: all 0.3s ease;
            border: 2px solid var(--primary-color);
        }

        #touristCarousel .carousel-control-prev:hover,
        #touristCarousel .carousel-control-next:hover,
        #accomplishmentCarousel .carousel-control-prev:hover,
        #accomplishmentCarousel .carousel-control-next:hover {
            opacity: 1;
            background-color: var(--primary-color);
        }

        #touristCarousel .carousel-control-prev:hover .carousel-control-prev-icon,
        #touristCarousel .carousel-control-next:hover .carousel-control-next-icon,
        #accomplishmentCarousel .carousel-control-prev:hover .carousel-control-prev-icon,
        #accomplishmentCarousel .carousel-control-next:hover .carousel-control-next-icon {
            filter: invert(1);
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: invert(0.5);
            width: 25px;
            height: 25px;
        }

        /* SMALL BLUE DOT INDICATORS - For tourist spots */
#touristCarousel .carousel-indicators {
    bottom: 15px;
    margin: 0;
}

#touristCarousel .carousel-indicators [data-bs-target] {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color:rgba(255, 255, 255, 0.3); /* Gray for inactive */
    opacity: 0.5;
    border: none;
    margin: 0 4px;
    padding: 0;
    transition: all 0.3s ease;
}

#touristCarousel .carousel-indicators .active {
    background-color: var(--primary-color); /* BLUE */
    opacity: 1;
    width: 10px;
    height: 10px;
}

/* Accomplishments indicators styling - BLUE */
#accomplishmentCarousel .carousel-indicators {
    position: static;
    margin-top: 20px;
}

#accomplishmentCarousel .carousel-indicators [data-bs-target] {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: var(--primary-color); /* BLUE */
    opacity: 0.5;
    border: none;
    margin: 0 5px;
    transition: all 0.3s ease;
}

#accomplishmentCarousel .carousel-indicators .active {
    background-color: var(--primary-color); /* BLUE */
    opacity: 1;
    width: 12px;
    height: 12px;
}

/* Adjust for mobile */
@media (max-width: 768px) {
    #touristCarousel .carousel-indicators [data-bs-target] {
        width: 6px;
        height: 6px;
        margin: 0 3px;
        background-color: var(--primary-color); /* BLUE */
    }

    #touristCarousel .carousel-indicators .active {
        background-color: var(--primary-color); /* BLUE */
        width: 8px;
        height: 8px;
    }
}

        /* Accomplishments indicators styling */
        #accomplishmentCarousel .carousel-indicators {
            position: static;
            margin-top: 20px;
        }

        #accomplishmentCarousel .carousel-indicators [data-bs-target] {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #ccc;
            border: none;
            margin: 0 5px;
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        #accomplishmentCarousel .carousel-indicators .active {
            background-color: var(--primary-color);
            opacity: 1;
            width: 12px;
            height: 12px;
        }

        /* Ensure images display properly */
        .tourist-carousel-img {
            max-width: 100%;
            max-height: 500px;
            object-fit: contain;
        }

        @media (max-width: 768px) {
            .hero {
                padding: 3rem 0;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            #touristCarousel .carousel-control-prev,
            #touristCarousel .carousel-control-next,
            #accomplishmentCarousel .carousel-control-prev,
            #accomplishmentCarousel .carousel-control-next {
                width: 40px;
                height: 40px;
            }

            #touristCarousel .carousel-control-prev,
            #accomplishmentCarousel .carousel-control-prev {
                left: 5px;
            }

            #touristCarousel .carousel-control-next,
            #accomplishmentCarousel .carousel-control-next {
                right: 5px;
            }

            .tourist-carousel-img {
                max-height: 300px;
            }

            .d-flex[style*="min-height: 500px"] {
                min-height: 300px !important;
            }

            /* Smaller dots on mobile */
            #touristCarousel .carousel-indicators [data-bs-target] {
                width: 6px;
                height: 6px;
                margin: 0 3px;
            }

            #touristCarousel .carousel-indicators .active {
                width: 8px;
                height: 8px;
            }
        }

        @media (max-width: 576px) {
            .tourist-carousel-img {
                max-height: 250px;
            }
        }
    </style>

    {{-- HERO SECTION --}}
    <section class="hero text-center">
        <div class="container">
            <h1 class="display-4 fw-bold primary-color">BARANGAY TIGBAO MIS</h1>
            <p class="lead primary-color">Public Information and Records Management System</p>
            <p class="mt-3" style="color: #6c757d; max-width: 800px; margin: 1rem auto;">
                Providing efficient, transparent, and citizen-centered services for the community of Barangay Tigbao
            </p>
        </div>
    </section>

    <section class="container mt-4">

        {{-- Historical Background --}}
        <section id="history" class="py-5">
            <div class="container">
                <h2 class="text-center mb-4 primary-color section-title">Historical Background</h2>
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="history-text bg-white p-4 p-md-5 rounded-4 shadow-sm">
                            <p class="mb-4" style="text-indent: 2.5rem;">
                                Barangay Tigbao got its name from a grass locally known as "bugang". Before its creation, the whole
                                area was covered with grass and big trees of various species. The land was suitable for cultivation,
                                inhabited by wild animals.
                            </p>
                            <p class="mb-4" style="text-indent: 2.5rem;">
                                Long ago, merchants from the neighboring Province of Bohol came to trade with illiterate folks
                                residing along the shore. Upon arrival, residents met them with hospitality and inquired about the place
                                they were visiting.
                            </p>
                            <p class="mb-4" style="text-indent: 2.5rem;">
                                Unfortunately, no one among the residents could tell the name of the place. They only knew Punta and
                                Looc, both sitios inhabited, but no precise name for the whole area. So, the merchant wondered why
                                there was no name. He investigated with his own mind, looked around the surroundings and found out that
                                the whole area was covered with "bugang" grass.
                            </p>
                            <p class="mb-4" style="text-indent: 2.5rem;">
                                Then he said to them, "Your place deserves to be called Tigbao," derived from the grass that covered
                                the area, because in some other Provinces of the Visayas I've visited, "bugang" is called Tigbao.
                            </p>
                            <p class="mb-4" style="text-indent: 2.5rem;">
                                From then on, there was a massive flow of settlers from the Province of Bohol, occupying idle land and
                                cultivating it. Destruction of the environment started by clearing the area and indiscriminate cutting of
                                big trees had begun.
                            </p>
                            <p class="mb-0" style="text-indent: 2.5rem;">
                                Development of the Barangay gradually grew with the construction of chapels, schools, houses, and barangay
                                roads, and the population multiplied rapidly.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Vision & Mission --}}
        <section id="vision" class="py-5">
            <div class="container">
                <h2 class="text-center mb-4 primary-color section-title">Our Vision & Mission</h2>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="vision-mission-card p-4 p-lg-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="rounded-circle bg-primary-color d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; margin-right: 1rem;">
                                    <i class="fas fa-eye text-white" style="font-size: 1.5rem;"></i>
                                </div>
                                <h3 class="mb-0">Vision</h3>
                            </div>
                            <p class="mb-0" style="color: #444; line-height: 1.8;">
                                Leading Agri-Tourism through Organic Farming in Libagon, with God-Loving, Self-reliant,
                                Educated, Healthy, Hospitable, Politically empowered and Disaster Resilient Society,
                                United with Pride and Dignity; Living in Rich Natural Resources, Balanced Ecology and
                                Climate change responsive environment, Having Self-Sufficient, Progressive and
                                Sustainable Economy, propelled by Service and Development Oriented, pro-people,
                                Transparent and Open Minded Leaders.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="vision-mission-card p-4 p-lg-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="rounded-circle bg-primary-color d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; margin-right: 1rem;">
                                    <i class="fas fa-bullseye text-white" style="font-size: 1.5rem;"></i>
                                </div>
                                <h3 class="mb-0">Mission</h3>
                            </div>
                            <p class="mb-0" style="color: #444; line-height: 1.8;">
                                Our mission and goals in the Development of our Barangay are to continue to support
                                basic services aimed at a better quality way of living for our constituents. To initiate
                                and implement proper solid waste management, beautification, and cleanliness of
                                the community. We shall also focus on the preservation and Maintenance of peace and order
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
                <h2 class="text-center mb-4 primary-color section-title">Tourist Spots</h2>
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div id="touristCarousel" class="carousel slide shadow-lg rounded-4 position-relative" data-bs-ride="carousel">
                            <div class="carousel-inner rounded-4 bg-light overflow-hidden">
                                <div class="carousel-item active">
                                    <div class="d-flex align-items-center justify-content-center" style="min-height: 500px;">
                                        <img src="{{ asset('images/Picture1.jpg') }}" class="img-fluid"
                                            alt="Tourist Spot 1" style="max-height: 500px; object-fit: contain;" />
                                    </div>
                                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded-bottom">
                                        <h5>Sunset Boulevard</h5>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="d-flex align-items-center justify-content-center" style="min-height: 500px;">
                                        <img src="{{ asset('images/Picture2.jpg') }}" class="img-fluid"
                                            alt="Tourist Spot 2" style="max-height: 500px; object-fit: contain;" />
                                    </div>
                                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded-bottom">
                                        <h5>Sunset Boulevard</h5>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="d-flex align-items-center justify-content-center" style="min-height: 500px;">
                                        <img src="{{ asset('images/Picture3.jpg') }}" class="img-fluid"
                                            alt="Tourist Spot 3" style="max-height: 500px; object-fit: contain;" />
                                    </div>
                                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded-bottom">
                                        <h5>Sunset Boulevard</h5>
                                    </div>
                                </div>
                            </div>

                            {{-- Carousel Controls --}}
                            <button class="carousel-control-prev" type="button" data-bs-target="#touristCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#touristCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>

                            {{-- SMALL DOT INDICATORS --}}
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#touristCarousel" data-bs-slide-to="0"
                                        class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#touristCarousel" data-bs-slide-to="1"
                                        aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#touristCarousel" data-bs-slide-to="2"
                                        aria-label="Slide 3"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Barangay Officials --}}
        <section id="officials" class="py-5 bg-section-light">
            <div class="container">
                <h2 class="mb-4 text-center primary-color section-title">Barangay Officials</h2>
                <p class="text-center text-muted mb-5" style="max-width: 700px; margin: 0 auto;">
                    Meet the dedicated officials serving Barangay Tigbao with commitment and integrity
                </p>

                <div class="row g-4">
                    <!-- Official cards remain the same as before -->
                    <!-- 1 -->
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="official-card">
                            <img src="{{ asset('images/1.png') }}" class="official-img" alt="Official" />
                            <div class="card-body text-center">
                                <h5 class="card-title mb-2">Hon. Emilito T. Ranque</h5>
                                <p class="text-muted small mb-0">Committee on Infrastructure & Water Works System</p>
                            </div>
                        </div>
                    </div>

                    <!-- 2 -->
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="official-card">
                            <img src="{{ asset('images/2.png') }}" class="official-img" alt="Official" />
                            <div class="card-body text-center">
                                <h5 class="card-title mb-2">Hon. Gregorio L. Selpa</h5>
                                <p class="text-muted small mb-0">Committee on BDRRM</p>
                            </div>
                        </div>
                    </div>

                    <!-- 3 -->
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="official-card">
                            <img src="{{ asset('images/3.png') }}" class="official-img" alt="Official" />
                            <div class="card-body text-center">
                                <h5 class="card-title mb-2">Hon. Celestina C. Rubio</h5>
                                <p class="text-muted small mb-0">Barangay Chairman</p>
                            </div>
                        </div>
                    </div>

                    <!-- 4 -->
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="official-card">
                            <img src="{{ asset('images/4.png') }}" class="official-img" alt="Official" />
                            <div class="card-body text-center">
                                <h5 class="card-title mb-2">Hon. Levi S. Ranque</h5>
                                <p class="text-muted small mb-0">Committee on Agriculture</p>
                            </div>
                        </div>
                    </div>

                    <!-- 5 -->
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="official-card">
                            <img src="{{ asset('images/5.png') }}" class="official-img" alt="Official" />
                            <div class="card-body text-center">
                                <h5 class="card-title mb-2">Hon. Lorna C. Basagan</h5>
                                <p class="text-muted small mb-0">Committee on Health, Education & Social Services</p>
                            </div>
                        </div>
                    </div>

                    <!-- 6 -->
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="official-card">
                            <img src="{{ asset('images/6.png') }}" class="official-img" alt="Official" />
                            <div class="card-body text-center">
                                <h5 class="card-title mb-2">Lenie S. Ellacer</h5>
                                <p class="text-muted small mb-0">Secretary</p>
                            </div>
                        </div>
                    </div>

                    <!-- 7 -->
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="official-card">
                            <img src="{{ asset('images/7.png') }}" class="official-img" alt="Official" />
                            <div class="card-body text-center">
                                <h5 class="card-title mb-2">Hon. Lougie Y. Respecia</h5>
                                <p class="text-muted small mb-0">SK Chairperson – Committee on Youth & Sports</p>
                            </div>
                        </div>
                    </div>

                    <!-- 8 -->
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="official-card">
                            <img src="{{ asset('images/8.png') }}" class="official-img" alt="Official" />
                            <div class="card-body text-center">
                                <h5 class="card-title mb-2">Hon. Mark Anthony Yamson</h5>
                                <p class="text-muted small mb-0">Committee on Women & Family (VAWC & BCPC), Environment & Solid Waste Mgmt</p>
                            </div>
                        </div>
                    </div>

                    <!-- 9 -->
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="official-card">
                            <img src="{{ asset('images/9.png') }}" class="official-img" alt="Official" />
                            <div class="card-body text-center">
                                <h5 class="card-title mb-2">Hon. Victor A. Acdal</h5>
                                <p class="text-muted small mb-0">Committee on Peace & Order & BADAC</p>
                            </div>
                        </div>
                    </div>

                    <!-- 10 -->
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="official-card">
                            <img src="{{ asset('images/10.png') }}" class="official-img" alt="Official" />
                            <div class="card-body text-center">
                                <h5 class="card-title mb-2">Hon. Gil L. Montañez</h5>
                                <p class="text-muted small mb-0">Committee on Appropriation</p>
                            </div>
                        </div>
                    </div>

                    <!-- 11 -->
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="official-card">
                            <img src="{{ asset('images/11.png') }}" class="official-img" alt="Official" />
                            <div class="card-body text-center">
                                <h5 class="card-title mb-2">Leonila S. Escabillas</h5>
                                <p class="text-muted small mb-0">Treasurer</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Accomplishments Gallery --}}
        <section id="accomplishments" class="py-5">
            <div class="container">
                <h2 class="text-center mb-4 primary-color section-title">Gallery of Accomplishments</h2>
                <p class="text-center text-muted mb-5" style="max-width: 700px; margin: 0 auto;">
                    Showcasing the achievements and progress of Barangay Tigbao
                </p>

                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div id="accomplishmentCarousel" class="carousel slide shadow-lg rounded-4 position-relative" data-bs-ride="carousel">
                            <div class="carousel-inner rounded-4 bg-light overflow-hidden">
                                @php
                                    $accomplishments = [
                                        ['acom1.jpg', 'Accomplishment 1'],
                                        ['acom2.jpg', 'Accomplishment 2'],
                                        ['acom3.jpg', 'Accomplishment 3'],
                                        ['acom4.jpg', 'Accomplishment 4'],
                                        ['acom5.jpg', 'Accomplishment 5'],
                                        ['acom6.jpg', 'Accomplishment 6'],
                                        ['acom7.jpg', 'Accomplishment 7'],
                                        ['acom8.jpg', 'Accomplishment 8'],
                                        ['acom9.jpg', 'Accomplishment 9']
                                    ];
                                @endphp

                                @foreach($accomplishments as $index => $accomplishment)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <div class="d-flex align-items-center justify-content-center" style="min-height: 500px;">
                                        <img src="{{ asset('images/' . $accomplishment[0]) }}"
                                             class="img-fluid"
                                             alt="{{ $accomplishment[1] }}"
                                             style="max-height: 500px; object-fit: contain;" />
                                    </div>
                                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded-bottom">
                                        <h5>{{ $accomplishment[1] }}</h5>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#accomplishmentCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#accomplishmentCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>

                            {{-- Carousel Indicators --}}
                            <div class="carousel-indicators">
                                @foreach($accomplishments as $index => $accomplishment)
                                <button type="button" data-bs-target="#accomplishmentCarousel"
                                        data-bs-slide-to="{{ $index }}"
                                        class="{{ $index == 0 ? 'active' : '' }}"
                                        aria-label="Slide {{ $index + 1 }}"></button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </section>

    {{-- Add Font Awesome for icons --}}
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <script>
        // Optional: Add hover effects for carousel
        document.addEventListener('DOMContentLoaded', function() {
            const carousels = document.querySelectorAll('.carousel');
            carousels.forEach(carousel => {
                carousel.addEventListener('mouseenter', function() {
                    this.querySelector('.carousel-control-prev').style.opacity = '1';
                    this.querySelector('.carousel-control-next').style.opacity = '1';
                });
                carousel.addEventListener('mouseleave', function() {
                    this.querySelector('.carousel-control-prev').style.opacity = '0.9';
                    this.querySelector('.carousel-control-next').style.opacity = '0.9';
                });
            });
        });
    </script>

</x-guest-layout>
