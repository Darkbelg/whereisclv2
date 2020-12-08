<a href="videos/{{ $video->id }}">
    <div class="p-10 bg-white mb-2 shadow-sm sm:rounded-lg">
        <div class="text-lg leading-6 font-medium text-gray-900 flex justify-between">
            <h1>{{ $video->title }}</h1>
            <p class="text-sm left">{{ $video->id }}</p>
        </div>
        <p>Description: {{ $video->description }}</p>
        <p>Publishet At: {{ $video->published_at }}</p>
        <p>Comments: {{ $video->comments }}</p>
        <p>Dislikes: {{ $video->dislikes }}</p>
        <p>Likes: {{ $video->likes }}</p>
        <p>Views: {{ $video->views }}</p>

        @foreach ($video->thumbnails as $thumbnail)
            <p class="display-none">{{$thumbnail["size"]}}</p>
            <x-thumbnail :thumbnail=$thumbnail></x-thumbnail>
        @endforeach

        <div class="flex flex-row space-x-4 mt-2">
            <form action="videos/{{ $video->id }}" method="post">
                @csrf
                @method('DELETE')
                <x-button class="bg-red-700" type="submit">Delete</x-button>
            </form>
        </div>
    </div>
</a>
