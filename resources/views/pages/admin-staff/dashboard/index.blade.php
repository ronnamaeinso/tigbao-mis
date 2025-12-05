<x-auth-layout title="User Management">
    <section class="container mt-sm-4 p-4 p-sm-0">
        <div class="row row-gap-4">

            {{-- admin only total users --}}
            @if (Auth::user()->role == 1)
                <div class="col-md-4">
                    <a href="{{ route('admin.manage.users') }}" class="nav-link h-100">
                        <div class="rounded-0 shadow-lg p-4 d-grid gap-3 h-100 bg-white" style="border-top: 5px solid var(--primary-color);">
                            <span class="fw-medium primary-color ">
                                Total Users
                            </span>
                            <div
                                class="fs-1 text-nd primary-color fw-medium d-flex justify-content-between align-items-center">
                                <x-icon type="users" />
                                <span class="fs-1 text-end primary-color fw-medium">{{ $total_users }}</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('admin.manage.users.pending') }}" class="nav-link h-100">
                        <div class="rounded-0 shadow-lg p-4 d-grid gap-3 h-100 bg-white" style="border-top: 5px solid var(--primary-color);">
                            <span class="fw-medium primary-color ">
                                Pending Account Verifications
                            </span>
                            <div
                                class="fs-1 text-nd primary-color fw-medium d-flex justify-content-between align-items-center">
                                <x-icon type="users" />
                                <span class="fs-1 text-end primary-color fw-medium">{{ $total_pending_accounts }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <div class="col-md-4">
                <a href="{{ route('admin.manage.users') }}" class="nav-link h-100">
                    <div class="rounded-0 shadow-lg p-4 d-grid gap-3 h-100 bg-white" style="border-top: 5px solid var(--primary-color);">
                        <span class="fw-medium primary-color ">
                            Total Staffs
                        </span>
                        <div
                            class="fs-1 text-nd primary-color fw-medium d-flex justify-content-between align-items-center">
                            <x-icon type="users" />
                            <span class="fs-1 text-end primary-color fw-medium">{{ $total_staffs }}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('admin.manage.users') }}" class="nav-link h-100">
                    <div class="rounded-0 shadow-lg p-4 d-grid gap-3 h-100 bg-white" style="border-top: 5px solid var(--primary-color);">
                        <span class="fw-medium primary-color ">
                            Total Brgy Citizens
                        </span>
                        <div
                            class="fs-1 text-nd primary-color fw-medium d-flex justify-content-between align-items-center">
                            <x-icon type="users" />
                            <span class="fs-1 text-end primary-color fw-medium">{{ $total_citizens }}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('staff.attestation-certificate-requests.index') }}" class="nav-link h-100">
                    <div class="rounded-0 shadow-lg p-4 d-grid gap-3 h-100 bg-white" style="border-top: 5px solid var(--primary-color);">
                        <span class="fw-medium primary-color ">
                            Certificate of Attestation Requests
                        </span>
                        <div
                            class="fs-1 text-nd primary-color fw-medium d-flex justify-content-between align-items-center">
                            <x-icon type="file-signature" />
                            <span
                                class="fs-1 text-end primary-color fw-medium">{{ $total_pending_attestation_certificate_requests }}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('summons.index') }}" class="nav-link h-100">
                    <div class="rounded-0 shadow-lg p-4 d-grid gap-3 h-100 bg-white" style="border-top: 5px solid var(--primary-color);">
                        <span class="fw-medium primary-color ">
                            KP Form No. 09 Requests
                        </span>
                        <div
                            class="fs-1 text-nd primary-color fw-medium d-flex justify-content-between align-items-center">
                            <x-icon type="scale-balanced" />
                            <span
                                class="fs-1 text-end primary-color fw-medium">{{ $total_pending_summon_requests }}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('request-list.certificate-of-indigency.index') }}" class="nav-link h-100">
                    <div class="rounded-0 shadow-lg p-4 d-grid gap-3 h-100 bg-white" style="border-top: 5px solid var(--primary-color);">
                        <span class="fw-medium primary-color ">
                            Certificate of Indigency
                        </span>
                        <div
                            class="fs-1 text-nd primary-color fw-medium d-flex justify-content-between align-items-center">
                            <x-icon type="hand-holding-heart" />
                            <span
                                class="fs-1 text-end primary-color fw-medium">{{ $total_indigency }}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('certificate-of-residency.request.list.index') }}" class="nav-link h-100">
                    <div class="rounded-0 shadow-lg p-4 d-grid gap-3 h-100 bg-white" style="border-top: 5px solid var(--primary-color);">
                        <span class="fw-medium primary-color ">
                            Certificate of Residency
                        </span>
                        <div
                            class="fs-1 text-nd primary-color fw-medium d-flex justify-content-between align-items-center">
                            <x-icon type="house-user" />
                            <span
                                class="fs-1 text-end primary-color fw-medium">{{ $total_residency_cert }}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('barangay-clearance.building-permit.request.list.index') }}" class="nav-link h-100">
                    <div class="rounded-0 shadow-lg p-4 d-grid gap-3 h-100 bg-white" style="border-top: 5px solid var(--primary-color);">
                        <span class="fw-medium primary-color ">
                            Barangay Clearance - Building Permit
                        </span>
                        <div
                            class="fs-1 text-nd primary-color fw-medium d-flex justify-content-between align-items-center">
                            <x-icon type="building" />
                            <span
                                class="fs-1 text-end primary-color fw-medium">{{ $total_building_clearance }}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('certificate-of-good-moral.request.list.index') }}" class="nav-link h-100">
                    <div class="rounded-0 shadow-lg p-4 d-grid gap-3 h-100 bg-white" style="border-top: 5px solid var(--primary-color);">
                        <span class="fw-medium primary-color ">
                            Certficate of Good Moral
                        </span>
                        <div
                            class="fs-1 text-nd primary-color fw-medium d-flex justify-content-between align-items-center">
                            <x-icon type="certificate" />
                            <span
                                class="fs-1 text-end primary-color fw-medium">{{ $total_good_moral }}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('animaltransportationrequestlist.index') }}" class="nav-link h-100">
                    <div class="rounded-0 shadow-lg p-4 d-grid gap-3 h-100 bg-white" style="border-top: 5px solid var(--primary-color);">
                        <span class="fw-medium primary-color ">
                            Animal Transportation Clearance
                        </span>
                        <div
                            class="fs-1 text-nd primary-color fw-medium d-flex justify-content-between align-items-center">
                            <x-icon type="dog" />
                            <span
                                class="fs-1 text-end primary-color fw-medium">{{ $total_animal }}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('senior-citizen.records.index') }}" class="nav-link h-100">
                    <div class="rounded-0 shadow-lg p-4 d-grid gap-3 h-100 bg-white" style="border-top: 5px solid var(--primary-color);">
                        <span class="fw-medium primary-color ">
                            Senior Citizens
                        </span>
                        <div
                            class="fs-1 text-nd primary-color fw-medium d-flex justify-content-between align-items-center">
                            <x-icon type="users" />
                            <span
                                class="fs-1 text-end primary-color fw-medium">{{ $total_senior }}</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    @if (Auth::user()->role == 1)
        {{-- chart --}}
        <section class="container mx-auto m-0 px-4 px-sm-0">
            <div class="d-flex flex-column bg-white shadow-lg p-4 mt-5 rounded-2 overflow-auto w-100" style="min-width: 200px">
                <h4 class="fw-bold mb-4 d-flex align-items-center gap-2">
                    <x-icon type="chart-line" class="text-primary" />
                    All Request Trends
                </h4>
                <div class="d-flex justify-content-end">
                    <form id="form-filter-chart" class="d-flex align-items-center">
                        <select name="year" id="year" class="form-control">
                            @for ($i = now()->year; $i >= 2010; $i--)
                                <option value="{{ $i }}" {{ $i == now()->year ? 'selected' : '' }}>
                                    {{ $i }}</option>
                            @endfor
                        </select>
                        <button class="btn btn-sm ms-2" type="submit">
                            <x-icon type="filter" />
                            Filter
                        </button>
                    </form>

                </div>
                <canvas id="chart" style="width: 100%; min-width: 500px; height: 100%; min-height: 100vh;"></canvas>
            </div>
        </section>


        <script type="module">
            let myChart; // global chart variable

            document.addEventListener('DOMContentLoaded', function() {
                renderChart(); // initial render

                // filter form submit
                document.getElementById('form-filter-chart').addEventListener('submit', async function(e) {
                    e.preventDefault(); // prevent page reload
                    const year = document.getElementById('year').value;
                    await renderChart(year);
                });
            });

            async function renderChart(year = new Date().getFullYear()) {
                // labels for 12 months
                const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

                // fetch chart data from server
                const response = await axios.get(`/get-chart-data?year=${year}`);
                const attestation_data = response.data.attestation_certificate_request_per_months;
                const summons_data = response.data.summons_per_month;

                const data = {
                    labels: labels,
                    datasets: [{
                            label: 'Attestation Cert.',
                            data: attestation_data,
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        },
                        {
                            label: 'Summons',
                            data: summons_data,
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        }
                    ]
                };

                const config = {
                    type: 'bar',
                    data: data,
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: `Requests Trends - ${year}`
                            }
                        },
                        scales: {
                            x: {
                                stacked: true
                            },
                            y: {
                                stacked: true
                            }
                        }
                    }
                };

                // destroy previous chart if exists
                if (myChart) {
                    myChart.destroy();
                }

                // render chart
                const ctx = document.getElementById('chart').getContext('2d');
                myChart = new Chart(ctx, config);
            }
        </script>

    @endif
</x-auth-layout>
