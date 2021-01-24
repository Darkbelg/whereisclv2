<div class="bg-gray-100 p-2 lg:p-10 mb-2 shadow-sm rounded-lg">
    <div class="text-4xl leading-6 font-medium text-gray-900 lg:flex lg:justify-between">
        <h1>{{ $event->title }}</h1>
        <p class="text-sm text-right lg:left text-gray-700">@datetime($event->date)</p>
    </div>
    <p class="text-gray-700 mt-1"><span class="w-1/2 lg:w-0">Location:</span> {{ $event->location }}</p>

    @if ($event->videos)
    <div class="mt-2 flex flex-col sm:flex-row flex-wrap">
        @foreach ($event->videos as $video)
        <div class="flex flex-col sm:w-1/3 rounded-lg hover:bg-white">
            <div class="m-3">
            <a target="_blank" href="https://www.youtube.com/watch?v={{ $video->id }}">
                <div>
                    @foreach ($video->thumbnails as $thumbnail)
                    @if($thumbnail->size == "high")
                    <x-thumbnail :thumbnail=$thumbnail></x-thumbnail>
                    @endif
                    @endforeach
                </div>
                <div class="pl-2 justify-between">
                    <div>
                        <div class="text-lg leading-6 font-medium flex justify-between">
                            <h1>{{ $video->title }}</h1>
                        </div>
                    </div>
                    <div class="text-sm text-gray-700">
                        <p>{{ number_format($video->views,0,","," ") }} Views</p>
                    </div>
                </div>
            </a>
        </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
