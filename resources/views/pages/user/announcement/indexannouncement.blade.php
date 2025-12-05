{{-- views/pages/user/announcement/indexannouncement.blade.php --}}
<x-guest-layout title="Announcements">

    {{-- custom styles --}}
    <style>
        /* ... keep all your existing CSS styles ... */
    </style>

    {{-- header --}}
    <x-slot name="header">
        <x-header-guest />
    </x-slot>

    {{-- main content --}}
    <div class="announcements-page">
        {{-- Hero Section --}}
        <section class="announcements-hero">
            <div class="container hero-content">
                <div class="text-center">
                    <h1>Barangay Announcements</h1>
                    <p>Stay informed about the latest news, events, and important updates from Barangay Tigbao</p>
                </div>
            </div>
        </section>

        {{-- Announcements Content --}}
        <section class="container py-4">
            {{-- Search Bar --}}
            <div class="search-box">
                <form method="GET" action="{{ route('announcements') }}" class="d-flex gap-2">
                    <input type="text" class="form-control search-input" 
                           placeholder="Search announcements..." 
                           name="search"
                           value="{{ request('search') }}">
                    <button type="submit" class="btn search-btn">
                        <i class="fas fa-search me-1"></i> Search
                    </button>
                </form>
            </div>

            {{-- Filter Buttons --}}
            <div class="filter-buttons">
                <button class="filter-btn {{ !request('category') ? 'active' : '' }}" 
                        onclick="window.location='{{ route('announcements') }}'">All Announcements</button>
                <button class="filter-btn {{ request('category') == 'news' ? 'active' : '' }}" 
                        onclick="window.location='{{ route('announcements', ['category' => 'news']) }}'">News</button>
                <button class="filter-btn {{ request('category') == 'events' ? 'active' : '' }}" 
                        onclick="window.location='{{ route('announcements', ['category' => 'events']) }}'">Events</button>
                <button class="filter-btn {{ request('category') == 'public-service' ? 'active' : '' }}" 
                        onclick="window.location='{{ route('announcements', ['category' => 'public-service']) }}'">Public Service</button>
                <button class="filter-btn {{ request('category') == 'health' ? 'active' : '' }}" 
                        onclick="window.location='{{ route('announcements', ['category' => 'health']) }}'">Health & Safety</button>
                <button class="filter-btn {{ request('category') == 'infrastructure' ? 'active' : '' }}" 
                        onclick="window.location='{{ route('announcements', ['category' => 'infrastructure']) }}'">Infrastructure</button>
            </div>

            {{-- Announcements List --}}
            <div class="announcements-container">
                @if($announcements->count() > 0)
                    @foreach($announcements as $announcement)
                        <x-announcement :announcement="$announcement" />
                    @endforeach
                @else
                    {{-- No announcements message --}}
                    <div class="no-announcements">
                        <i class="fas fa-bullhorn"></i>
                        <h3 class="mb-3" style="color: var(--primary-color);">No Announcements Yet</h3>
                        <p class="text-muted">Check back later for the latest updates from Barangay Tigbao</p>
                    </div>
                @endif
            </div>

            {{-- Pagination --}}
            @if($announcements->count() > 0)
            <div class="pagination-container">
                {{ $announcements->links() }}
            </div>
            @endif
        </section>
    </div>

    {{-- JavaScript --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.querySelector('.search-input');
            const searchForm = document.querySelector('form');
            
            searchForm.addEventListener('submit', function(e) {
                if (!searchInput.value.trim()) {
                    e.preventDefault();
                    return;
                }
            });
            
            // Auto submit when filter buttons are clicked (already handled by onclick)
        });
    </script>

</x-guest-layout>