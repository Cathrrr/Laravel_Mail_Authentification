<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Centered See All Movies Button -->
            <div class="flex justify-center mb-6">
                <a href="{{ route('movies.index') }}" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                    See All Movies
                </a>
            </div>

            <!-- Add Movie Details Card with Adjusted Width -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mx-auto" style="max-width: 500px;">
                <h2 class="mb-4 text-2xl font-semibold text-center text-gray-800">Add Movie Details</h2>

                <!-- Form for Adding Movie -->
                <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Movie Image -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Movie Image</label>
                        <input type="file" name="image_path"
                            class="w-full p-2 mt-1 border rounded 
                            @error('image_path') border-red-500 @else border-gray-300 @enderror">
                        @error('image_path')
                            <p class="text-sm text-red-600">{{ 'Pilih berkas.' }}</p>
                        @enderror
                    </div>

                    <!-- Movie Name -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Movie Name</label>
                        <input type="text" name="name"
                            class="w-full p-2 mt-1 border rounded
                            @error('name') border-red-500 @else border-gray-300 @enderror"
                            placeholder="Enter Movie name">
                        @error('name')
                            <p class="text-sm text-red-600">{{ 'Isi isian ini.' }}</p>
                        @enderror
                    </div>

                    <!-- Release Year -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Release Year</label>
                        <input type="number" name="release_year"
                            class="w-full p-2 mt-1 border rounded
                            @error('release_year') border-red-500 @else border-gray-300 @enderror"
                            placeholder="Enter release year">
                        @error('release_year')
                            <p class="text-sm text-red-600">{{ 'Masukkan angka.' }}</p>
                        @enderror
                    </div>

                    <!-- Movie Description -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Movie Description</label>
                        <textarea name="description" rows="4"
                            class="w-full p-2 mt-1 border rounded
                            @error('description') border-red-500 @else border-gray-300 @enderror"
                            placeholder="Enter movie description"></textarea>
                        @error('description')
                            <p class="text-sm text-red-600">{{ 'Isi isian ini.' }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <button type="submit"
                            class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
