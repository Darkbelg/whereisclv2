<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Videos') }}
        </h2>
        <a href="videos/create">Create Video</a>

    </x-slot>

    <div class="w-1/2 m-auto">
        @foreach ($videos as $video)
        <x-video :video="$video"></x-video>
        @endforeach
    </div>
</x-app-layout>