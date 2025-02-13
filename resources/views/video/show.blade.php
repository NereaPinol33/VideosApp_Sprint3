<x-videos-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Viewing video {{$video->id}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-4">
                    <iframe class="w-full h-64 sm:h-96" src="{{$embedUrl}}" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="mb-4">
                    <h3 class="text-2xl font-semibold">{{$video->title}}</h3>
                    <p class="text-gray-600">{{$video->description}}</p>
                </div>
                <div class="text-gray-500 text-sm">
                    {{$video->created_at->diffForHumans()}}
                </div>
            </div>
        </div>
    </div>
</x-videos-app-layout>