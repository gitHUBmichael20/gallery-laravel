<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/logo-gallery.png') }}" type="image/x-icon">
    <title>Gallery</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 min-h-screen">
    @include('navbar')

    <main class="container mx-auto px-4 py-12 max-w-7xl">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4">Personal Blog</h1>
            <p class="text-gray-600 dark:text-gray-400">Browse and explore various images in the gallery</p>
        </div>

        <form action="{{ route('gallery') }}" method="GET">
            <div class="items-center mx-auto mb-3 space-y-4 max-w-screen-sm sm:flex sm:space-y-0">
                <div class="relative w-full">
                    <label for="search"
                        class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Search</label>
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input
                        class="block p-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:rounded-none sm:rounded-l-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Search the gallery" type="search" id="search" name="search" autocomplete="off"
                        value="{{ request('search') }}">
                </div>
                <div>
                    <button type="submit"
                        class="py-3 px-5 w-full text-sm font-medium text-center text-white rounded-lg border cursor-pointer bg-blue-700 border-blue-600 sm:rounded-none sm:rounded-r-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </div>
        </form>


        <!-- Pagination -->
        <div class="mb-8">
            {{ $galleries->links() }}
        </div>

        <!-- Gallery Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse ($galleries as $gallery)
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="aspect-w-16 aspect-h-9 overflow-hidden">
                        <img class="w-full h-full max-h-40 object-cover transform hover:scale-105 transition-transform duration-500"
                            src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->name }}">
                    </div>

                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                            {{ $gallery->name }}
                        </h2>
                        <p class="text-gray-600 dark:text-gray-300 line-clamp-2 mb-4">{{ $gallery->description }}</p>
                        <a href="/gallery/{{ $gallery->id }}" target="_blank">
                            <button
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                                View Details
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 12h14M12 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-800 dark:text-gray-200">No galleries found.</div>
            @endforelse
        </div>

        <!-- Bottom Pagination -->
        <div class="mt-12">
            {{ $galleries->links() }}
        </div>
    </main>
</body>

</html>
