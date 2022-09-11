<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Videos') }}
        </h2>
        <a href="{{ route('videos.create') }}">Create Video</a>
    </x-slot>
    <div class="w-1/2 m-auto mt-2">
        <x-video :video="$video"></x-video>
    </div>
</x-app-layout>