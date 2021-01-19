<div class="bg-gray-100 p-2 lg:p-10 mb-2 shadow-sm rounded-lg">
    <div class="text-lg leading-6 font-medium text-gray-900 lg:flex lg:justify-between">
        <h1>{{ $event->title }}</h1>
        <p class="text-sm text-right lg:left">@datetime($event->date)</p>
    </div>
    <p><span class="w-1/2 lg:w-0" >Location:</span> {{ $event->location }}</p>

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
                <div class="pl-2 flex flex-col lg:flex-row justify-between">
                    <div class="sm:w-1/2">
                        <div class="text-lg leading-6 font-medium flex justify-between">
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
        </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
