<x-guest-layout>
    <div class="">
        <div class="w-1/2 m-auto">
            <h1 class="text-6xl p-2">#WhereisCL</h1>
            @foreach ($videos as $video)
                <x-video :video="$video"></x-video>
            @endforeach
        </div>
    </div>
</x-guest-layout>