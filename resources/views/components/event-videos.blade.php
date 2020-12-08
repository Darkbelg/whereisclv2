<div>
    <div class="p-10 bg-white mb-2 shadow-sm sm:rounded-lg">
        <div class="text-lg leading-6 font-medium text-gray-900 flex justify-between">
            <h1>{{ $event->title }}</h1>
            <p class="text-sm left">@datetime($event->date)</p>
        </div>
        <p>Location: {{ $event->location }}</p>

        @if ($event->videos)
        <div class="mt-2 flex flex-row flex-wrap">
            @foreach ($event->videos as $video)
            <a target="_blank" href="https://www.youtube.com/watch?v={{ $video->id }}" class="flex flex-col pr-2 w-1/3">
                <div>
                    @foreach ($video->thumbnails as $thumbnail)
                    @if($thumbnail->size == "high")
                    <x-thumbnail :thumbnail=$thumbnail></x-thumbnail>
                    @endif
                    @endforeach
                </div>
                <div class="pl-2 flex flex-row justify-between">
                    <div class="w-1/2">
                        <div class="text-lg leading-6 font-medium text-gray-900 flex justify-between">
                            <h1>{{ $video->title }}</h1>
                        </div>
                    </div>
                    <div class="text-right">
                        <p>{{ number_format($video->views,0,","," ") }} Views</p>
                        <p>{{ number_format($video->comments,0,","," ") }} Comments</p>
                        <div class="flex flex-row justify-between">
                            <p class="bg-green-200 px-2">{{ number_format($video->likes,0,","," ") }}</p>
                            <p class="bg-red-200 px-2">{{ number_format($video->dislikes,0,","," ") }}</p>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</div>