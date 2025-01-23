<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/logo-gallery.png') }}" type="image/x-icon">
    <title>{{ $gallery->name }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 dark:bg-gray-900">
    @include('navbar')
    <div class="flex items-center justify-center bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl w-full sm:px-6 lg:px-4">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden">
                <!-- Full Width Image -->
                <div class="w-full h-[400px]">
                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->name }}"
                        class="w-full h-full object-cover">
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

    <div class="flex flex-col text-black dark:text-white max-w-4xl my-6 mx-auto">
        <h2 class=" text-2xl py-4">Related Content</h2>
        @if ($related->isNotEmpty())
            <div class="grid grid-cols-3 gap-3">
                @foreach ($related as $rel)
                    <div
                        class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                        <img class="w-full h-auto rounded-t-xl" src="{{ asset('storage/' . $rel->image) }}"
                            alt="{{ $rel->name }}">
                        <div class="p-4 md:p-5">
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                                {{ $rel->name }}
                            </h3>
                            <p class="mt-1 text-gray-500 dark:text-neutral-400">
                                {{ $rel->description }}
                            </p>
                            <a class="mt-2 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                href="{{ $rel->id }}">
                                Read Now !
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No related content found.</p>
        @endif
    </div>
</body>

</html>
