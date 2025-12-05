<x-app-layout>
    {{-- title --}}
    <x-slot name="title">{{$title}}</x-slot>

    {{-- header --}}
    <x-slot name="header">
        <x-header-auth/>
    </x-slot>

    {{-- main --}}
    <x-slot name="authlayout">
        {{$slot}}
</x-slot>

</x-app-layout>