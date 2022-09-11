<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Event
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form action="{{ route('videos.store') }}" method="post">
                        @csrf

                        <div>
                            <x-label for="event">Choose a event:</x-label>
                            <select name="event" id="event" class="form-control" required>
                                <option value="">Choose One...</option>
                                @foreach ($events as $event)
                                <option value="{{$event->id}}"
                                    {{ old('event') == $event->id ? 'selected' : ''}}>{{$event->title}}: {{$event->location}}</option>
                                @endforeach
                            </select>
                        </div>
                        @for ($i = 0; $i < 10; $i++)
                            <div>
                                <x-label for="youtube_id" :value="__('Youtube ID:')" />
                                <x-input type="youtube_id" name="youtube[]" id="youtube_id" :value="old('youtube_id')"/>
                            </div>
                        @endfor
                        <x-button class="mt-2"> {{ __('Create') }} </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>