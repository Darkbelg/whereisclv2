<x-guest-layout>
    @foreach ($events as $event)
        <x-event :event="$event"></x-event>
    @endforeach
</x-guest-layout>