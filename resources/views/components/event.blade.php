<div class="mt-2">
    <a href="events/{{ $event->id }}" class="mt-2">
        <div class="p-10 bg-white mb-2 shadow-sm lg:rounded-lg">
            <div class="text-lg leading-6 font-medium text-gray-900 flex justify-between">
                <h1>{{ $event->title }}</h1>
                <p class="text-sm left">{{ $event->id }}</p>
            </div>
            <p>Date: {{ $event->date }}</p>
            <p>Location: {{ $event->location }}</p>
            <p>Lon,Lat: {{ $event->latitude }},{{ $event->longitude }}</p>
            <div class="flex flex-row space-x-4">
                <form action="/events/{{ $event->id }}/edit" method="get">
                    @csrf
                    <x-button class="bg-blue-700" type="submit">Update</x-button>
                </form>
                <form action="/events/{{ $event->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <x-button class="bg-red-700" type="submit">Delete</x-button>
                </form>
            </div>

            @if ($event->videos)
            <div class="ml-5 mt-2">
                <ul>
                    @foreach ($event->videos as $videos)
                    <li>
                        <a href="videos/{{$videos->id}}">{{$videos->title}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </a>
</div>