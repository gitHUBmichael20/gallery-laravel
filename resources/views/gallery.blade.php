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

        <!-- Pagination -->
        <div class="mb-8">
            {{ $galleries->links() }}
        </div>

        <!-- Gallery Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ($galleries as $gallery)
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="aspect-w-16 aspect-h-9 overflow-hidden">
                        <img class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-500"
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
            @endforeach
        </div>

        <!-- Bottom Pagination -->
        <div class="mt-12">
            {{ $galleries->links() }}
        </div>
    </main>
</body>

</html>
