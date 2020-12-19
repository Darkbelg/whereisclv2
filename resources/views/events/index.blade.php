<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events') }}
        </h2>
        <a href="/events/create">Create Event</a>
    </x-slot>

        <div class="w-1/2 m-auto">
            @foreach ($events as $event)
                <x-event :event="$event"></x-event>
            @endforeach
        </div>
</x-app-layout>