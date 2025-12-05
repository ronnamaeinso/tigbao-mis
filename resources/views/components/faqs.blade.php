{{-- Add this after the Request statistics section in your user dashboard --}}
<h4 class="primary-color mt-4">
    <x-icon type="question-circle"/>
    Frequently Asked Questions (FAQ)
</h4>

<div class="card mt-2 border-0 shadow-sm">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-9">
                <h5 class="primary-color mb-2">Find Answers to Common Questions</h5>
                <p class="text-muted mb-0">
                    Learn about barangay services, document requirements, processing times, and more.
                </p>
            </div>
            <div class="col-md-3 text-end">
                <a href="{{ route('user.faqs') }}" class="btn bg-primary-color text-white">
                    <x-icon type="external-link" class="me-2"/>
                    View All FAQs
                </a>
            </div>
        </div>
    </div>
</div>