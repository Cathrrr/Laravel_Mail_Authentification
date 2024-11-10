<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($movies->isEmpty())
                <div class="flex items-center justify-center h-48">
                    <h3 class="text-2xl font-semibold text-black">Movie List</h3>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($movies as $movie)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col">

                            <img src="{{ asset('storage/' . $movie->image_path) }}" alt="{{ $movie->name }}"
                                class="w-full h-48 object-cover">

                            <div class="p-4 flex-grow">
                                <h3 class="text-lg font-semibold text-blacks-800">{{ $movie->name }}</h3>
                                <p class="text-[11px] text-gray-600">Release Year: {{ $movie->release_year }}</p>
                                <p class="text-[14px] mt-3 text-black-600">{{ $movie->description }}</p>
                            </div>

                            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-4 py-2 text-white bg-red-500 hover:bg-red-600">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
