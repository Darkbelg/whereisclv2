<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events') }}
        </h2>
        <a href="{{ route('events.create') }}">Create Event</a>
    </x-slot>
    <div class="w-1/2 m-auto mt-2">
        <x-event :event="$event"></x-event>
    </div>
</x-app-layout>