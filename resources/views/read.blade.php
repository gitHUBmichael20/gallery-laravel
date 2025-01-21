<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/logo-gallery.png') }}" type="image/x-icon">
    <title>Read More</title>
    @vite('resources/css/app.css')
</head>
<body>
    @include('navbar')
        <div class="">
            <div class="flex items-center justify-center bg-gray-100 dark:bg-gray-900 min-h-screen">
                <div class="max-w-4xl w-full sm:px-6 lg:px-4">
                    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden">
                        <!-- Full Width Image -->
                        <div class="w-full h-[400px]">
                            <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->name }}" class="w-full h-full object-cover">
                        </div>
                    
                        <!-- Content Section -->
                        <div class="p-6">
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $gallery->name }}</h1>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                                <span>{{ $gallery->created_at->format('F j, Y') }}</span>
                            </p>
                            <div class="mt-6 text-gray-700 dark:text-gray-300 leading-relaxed">
                                {!! nl2br(e($gallery->description)) !!}
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
</body>
</html>