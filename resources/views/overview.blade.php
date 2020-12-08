<x-guest-layout>
    <div class="w-1/2 m-auto">
        <x-title></x-title>
    </div>
    <div class="w-8/12 m-auto">
        @foreach ($events as $event)
            <x-event-videos :event="$event"></x-event-videos>
        @endforeach
    </div>
</x-guest-layout>