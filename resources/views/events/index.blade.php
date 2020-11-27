<div>
    @foreach ($events as $event)
        <div>
            <h1>{{ $event->title }}<span>{{ $event->id }}</span></h1>
            <p>{{ $event->date }}</p>
            <p>{{ $event->location }}</p>
            <p>{{ $event->latitude }},{{ $event->longitude }}</p>
        </div>
    @endforeach
</div>