{{-- views/components/announcement.blade.php --}}
@if(isset($announcement) && $announcement)
<div class="announcement-card mb-4">
    <div class="announcement-header d-flex align-items-center mb-3">
        <div class="announcement-icon me-3" style="background: linear-gradient(135deg, var(--primary-color), var(--third-color));">
            <i class="{{ $announcement->icon ?? 'fas fa-bullhorn' }} fa-2x text-white"></i>
        </div>
        <div>
            <h4 class="mb-1 fw-bold" style="color: var(--primary-color);">{{ $announcement->title }}</h4>
            <small class="text-muted">
                <i class="fas fa-calendar me-1"></i> 
                Posted: {{ \Carbon\Carbon::parse($announcement->created_at)->format('F d, Y') }}
                @if($announcement->category)
                <span class="ms-2">
                    <i class="fas fa-tag me-1"></i>
                    <span class="badge bg-primary">{{ $announcement->category }}</span>
                </span>
                @endif
            </small>
        </div>
    </div>
    <div class="announcement-body">
        <p class="mb-0" style="color: #444; line-height: 1.8;">
            {{ Str::limit($announcement->content, 300) }}
        </p>
    </div>
    
    @if($announcement->attachments && count(json_decode($announcement->attachments, true)) > 0)
    <div class="announcement-attachments mt-3">
        <h6 class="mb-2" style="color: var(--primary-color);">
            <i class="fas fa-paperclip me-1"></i> Attachments:
        </h6>
        <div class="d-flex flex-wrap gap-2">
            @foreach(json_decode($announcement->attachments, true) as $attachment)
            <a href="{{ Storage::url($attachment['path']) ?? '#' }}" class="btn btn-sm btn-outline-primary" target="_blank">
                <i class="fas fa-file-{{ $attachment['type'] ?? 'pdf' }} me-1"></i>
                {{ $attachment['name'] ?? 'Document' }}
            </a>
            @endforeach
        </div>
    </div>
    @endif
    
    @if(strlen($announcement->content) > 300)
    <div class="announcement-footer mt-3 text-end">
        <button type="button" class="btn btn-sm btn-primary read-more-btn" data-bs-toggle="modal" data-bs-target="#announcementModal{{ $announcement->id }}">
            Read More <i class="fas fa-arrow-right ms-1"></i>
        </button>
    </div>
    @endif
</div>

{{-- Full Content Modal --}}
@if(strlen($announcement->content) > 300)
<div class="modal fade" id="announcementModal{{ $announcement->id }}" tabindex="-1" aria-labelledby="announcementModalLabel{{ $announcement->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, var(--primary-color), var(--third-color));">
                <h5 class="modal-title text-white" id="announcementModalLabel{{ $announcement->id }}">{{ $announcement->title }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <small class="text-muted">
                        <i class="fas fa-calendar me-1"></i> 
                        Posted: {{ \Carbon\Carbon::parse($announcement->created_at)->format('F d, Y') }}
                        @if($announcement->category)
                        <span class="ms-2">
                            <i class="fas fa-tag me-1"></i>
                            <span class="badge bg-primary">{{ $announcement->category }}</span>
                        </span>
                        @endif
                    </small>
                </div>
                
                <div class="announcement-full-content" style="line-height: 1.8;">
                    {!! nl2br(e($announcement->content)) !!}
                </div>
                
                @if($announcement->attachments && count(json_decode($announcement->attachments, true)) > 0)
                <div class="announcement-attachments mt-4">
                    <h6 class="mb-2" style="color: var(--primary-color);">
                        <i class="fas fa-paperclip me-1"></i> Attachments:
                    </h6>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach(json_decode($announcement->attachments, true) as $attachment)
                        <a href="{{ Storage::url($attachment['path']) ?? '#' }}" class="btn btn-outline-primary" target="_blank">
                            <i class="fas fa-file-{{ $attachment['type'] ?? 'pdf' }} me-1"></i>
                            {{ $attachment['name'] ?? 'Document' }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif

@else
{{-- Fallback for static announcements --}}
<div class="announcement-card mb-4">
    <div class="announcement-header d-flex align-items-center mb-3">
        <div class="announcement-icon me-3" style="background: linear-gradient(135deg, var(--primary-color), var(--third-color));">
            <i class="{{ $icon ?? 'fas fa-bullhorn' }} fa-2x text-white"></i>
        </div>
        <div>
            <h4 class="mb-1 fw-bold" style="color: var(--primary-color);">{{ $title ?? 'Announcement Title' }}</h4>
            <small class="text-muted">
                <i class="fas fa-calendar me-1"></i> 
                Posted: {{ $date ?? date('F d, Y') }}
                @if(isset($category))
                <span class="ms-2">
                    <i class="fas fa-tag me-1"></i>
                    <span class="badge bg-primary">{{ $category }}</span>
                </span>
                @endif
            </small>
        </div>
    </div>
    <div class="announcement-body">
        <p class="mb-0" style="color: #444; line-height: 1.8;">
            {{ $content ?? 'Announcement content goes here...' }}
        </p>
    </div>
</div>
@endif

<style>
    .announcement-card {
        background: white;
        border: none;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border-left: 4px solid var(--primary-color);
    }
    
    .announcement-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }
    
    .announcement-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(var(--primary-color-rgb, 13, 110, 253), 0.2);
    }
    
    .announcement-card .announcement-body {
        padding-left: 72px; /* Align with icon */
    }
    
    @media (max-width: 768px) {
        .announcement-card .announcement-body {
            padding-left: 0;
        }
        
        .announcement-header {
            flex-direction: column;
            align-items: flex-start !important;
        }
        
        .announcement-icon {
            margin-bottom: 1rem;
            margin-right: 0 !important;
        }
    }
</style>