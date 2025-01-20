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

    <!-- Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl max-w-4xl w-full mx-auto overflow-hidden shadow-2xl">
            <div class="relative">
                <img id="modalImage" class="w-full h-auto max-h-[70vh] object-contain" src="" alt="">
                <button onclick="closeModal()"
                    class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="p-8">
                <h3 id="modalTitle" class="text-3xl font-bold mb-4 text-gray-900 dark:text-white"></h3>
                <p id="modalDescription" class="text-gray-600 dark:text-gray-300 text-lg leading-relaxed"></p>
            </div>
        </div>
    </div>

    <main class="container mx-auto px-4 py-12 max-w-7xl">
        <!-- Page Title -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4">Tugas CRUD</h1>
            <p class="text-gray-600 dark:text-gray-400 text-lg">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Exercitationem.</p>
        </div>

        {{-- pagination --}}
        <div class="mb-8">
            {{ $galleries->links() }}
        </div>

        <!-- Blog Card Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ($galleries as $gallery)
                <article
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <!-- Image Container -->
                    <div class="aspect-w-16 aspect-h-9 overflow-hidden cursor-pointer"
                        onclick="openModal('{{ asset('storage/' . $gallery->image) }}', '{{ $gallery->name }}', '{{ $gallery->description }}')">
                        <img class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-500"
                            src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->name }}">
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <h2 class="text-xl font-bold mb-3 text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors cursor-pointer"
                            onclick="openModal('{{ asset('storage/' . $gallery->image) }}', '{{ $gallery->name }}', '{{ $gallery->description }}')">
                            {{ $gallery->name }}
                        </h2>
                        <p class="text-gray-600 dark:text-gray-300 line-clamp-2">
                            {{ $gallery->description }}
                        </p>
                        <div class="mt-4 flex items-center justify-between">
                            <button
                                onclick="openModal('{{ asset('storage/' . $gallery->image) }}', '{{ $gallery->name }}', '{{ $gallery->description }}')"
                                class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium transition-colors">
                                Read More
                            </button>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Bottom Pagination -->
        <div class="mt-12">
            {{ $galleries->links() }}
        </div>
    </main>

    <script>
        function openModal(imageSrc, title, description) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const modalTitle = document.getElementById('modalTitle');
            const modalDescription = document.getElementById('modalDescription');

            modalImage.src = imageSrc;
            modalTitle.textContent = title;
            modalDescription.textContent = description;
            modal.classList.remove('hidden');

            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal on background click
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>

</html>
