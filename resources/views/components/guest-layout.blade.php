<x-app-layout>
    {{-- title --}}
    <x-slot name="title">{{$title}}</x-slot>

    <x-slot name="header">
        <x-header-guest />
    </x-slot>

    {{-- main --}}
    <x-slot name="guestlayout">
        {{$slot}}
    </x-slot>

</x-app-layout>
