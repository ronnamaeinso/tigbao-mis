<x-auth-layout title="Notifications">
    <div class="container my-3">
        <h4 class="mb-3 fw-semibold">Notifications</h4>

        <div class="list-group">
            <a href="" class="btn btn-sm bg-primary-color text-white w-fit {{ empty(auth()->user()->unreadNotifications) == 0 ? 'disabled' : '' }}">
                <x-icon type="layer-group text-white"/>
                Read All
            </a>
            @forelse (auth()->user()->notifications as $notification)
                <a href="/mark-read-all"
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-start
                   {{ is_null($notification->read_at) ? 'bg-light' : '' }}">

                    <div class="ms-2 me-auto">
                        <div class="fw-semibold">
                            {{ $notification->data['title'] ?? 'New Notification' }}
                        </div>

                        <small class="text-muted">
                            {{ $notification->data['message'] ?? 'You have a new update.' }}
                        </small>
                    </div>

                    <!-- Unread Indicator -->
                    @if (is_null($notification->read_at))
                        <span class="badge bg-primary rounded-pill">New</span>
                    @endif
                </a>
            @empty
                <div class="alert alert-info mt-3">
                    No notifications available.
                </div>
            @endforelse

        </div>
    </div>
</x-auth-layout>
