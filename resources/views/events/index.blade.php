<x-guest-layout>
    <div class="">
        <div class="w-1/2 m-auto">
            <x-title></x-title>
            @foreach ($events as $event)
                <x-event :event="$event"></x-event>
            @endforeach
        </div>
    </div>
</x-guest-layout>