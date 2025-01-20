<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/logo-gallery.png') }}" type="image/x-icon">
    <title>Gallery</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100">

    @include('navbar')

    <div class="flex flex-col items-center mt-8 px-4 py-4">
        <!-- Page Title -->
        <h1 class="text-3xl font-bold mb-6">Gallery</h1>
        
        <!-- Gallery Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6 max-w-7xl w-full">
            @foreach ($galleries as $gallery)
                <div class="relative overflow-hidden rounded-lg shadow-lg group">
                    <!-- Image -->
                    <img class="h-48 w-full object-cover transform group-hover:scale-105 transition-transform duration-300"
                        src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->name }}">

                    <!-- Overlay -->
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black via-transparent opacity-0 group-hover:opacity-90 transition-opacity duration-300 flex items-end p-4">
                        <!-- Image Title -->
                        <span class="text-white font-semibold text-lg">{{ $gallery->name }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>

</html>
