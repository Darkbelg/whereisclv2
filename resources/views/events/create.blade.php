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

                    <form action="/events" method="post">
                        @csrf

                        <div>
                            <x-label for="title" :value="__('Title:')" />
                            <x-input type="text" name="title" id="title" :value="old('title')" required />
                        </div>

                        <div>
                            <x-label for="location" :value="__('Location name:')" />
                            <x-input type="text" name="location" id="location" :value="old('location')" />
                        </div>

                        <div>
                            <x-label for="date" :value="__('Date:')" />
                            <x-input type="date" name="date" id="date" :value="old('date')" />
                        </div>

                        <div>
                            <x-label for="latitude" :value="__('latitude:')" />
                            <x-input type="text" name="latitude" id="latitude" value="{{ old('latitude') ? old('latitude'):0 }}" />
                        </div>

                        <div>
                            <x-label for="longitude" :value="__('longitude:')" />
                            <x-input type="text" name="longitude" id="longitude" value="{{ old('longitude') ? old('longitude'):0 }}" />
                        </div>

                        <x-button> {{ __('Create') }} </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>