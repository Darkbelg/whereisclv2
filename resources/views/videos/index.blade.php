<x-guest-layout>
    <div class="">
        <div class="w-1/2 m-auto">
            <x-title></x-title>
            @foreach ($videos as $video)
                <x-video :video="$video"></x-video>
            @endforeach
        </div>
    </div>
</x-guest-layout>