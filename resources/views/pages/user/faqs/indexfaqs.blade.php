{{-- resources/views/pages/user/faqs/index.blade.php --}}
<x-guest-layout title="FAQs">
    <x-slot name="header">
        <x-header-guest />
    </x-slot>

    <section class="py-5">
        <div class="container">
            <h1 class="primary-color fw-bold mb-4">Frequently Asked Questions</h1>
            <p class="lead mb-5">Find answers to common questions about Barangay Tigbao services.</p>
            
            {{-- Include the FAQ component --}}
            @include('components.faqs')
        </div>
    </section>
</x-guest-layout>