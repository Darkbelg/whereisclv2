<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Event') }}
        </h2>
    </x-slot>

    <div class="w-1/2 m-auto mt-2">
        <div class="p-10 bg-white mb-2 shadow-sm sm:rounded-lg">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form action="/events/{{ $event->id }}" method="post">
                @csrf
                @method('PATCH')

                <div>
                    <x-label for="title" :value="__('Title:')" />
                    <x-input type="text" name="title" id="title" :value="old('title')?:$event->title" required />
                </div>

                <div>
                    <x-label for="location" :value="__('Location name:')" />
                    <x-input type="text" name="location" id="location" :value="old('location')?:$event->location" required/>
                </div>

                <div>
                    <x-label for="date" :value="__('Date:')" />
                    <x-input type="text" name="date" id="date" :value="old('date')?:$event->date" required/>
                </div>

                <div>
                    <x-label for="latitude" :value="__('latitude:')" />
                    <x-input type="text" name="latitude" id="latitude" :value="old('latitude')?:$event->latitude" required/>
                </div>

                <div>
                    <x-label for="longitude" :value="__('longitude:')" />
                    <x-input type="text" name="longitude" id="longitude" :value="old('longitude')?:$event->longitude" required/>
                </div>

                <div class="mt-2">
                    <x-button> {{ __('Update') }} </x-button>
                    <a href="/events">Cancel</a>
                </div>
            </form>
</x-app-layout>