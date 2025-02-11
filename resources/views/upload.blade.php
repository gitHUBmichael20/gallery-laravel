<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/logo-gallery.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @vite('resources/css/app.css')
    <title>Upload Your Images</title>
</head>

<body class="bg-gray-100 dark:bg-gray-900">
    @include('navbar')

    <!-- Upload Image Section -->
    <section class="max-w-5xl mt-6 mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col gap-3">
        <h2 class="text-center text-2xl font-bold text-gray-900 dark:text-white">Upload Image</h2>
        <form method="POST" action="{{ route('gallery-store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Your
                    picture name</label>
                <input type="text" id="name" name="name"
                    class="bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3"
                    placeholder="name pict example" required />
            </div>
            <div class="mb-5">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Your
                    picture description</label>
                <input type="text" id="description" name="description"
                    class="bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3"
                    placeholder="description pict example" required />
            </div>
            <div class="mb-5">
                <label for="image" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Your
                    image</label>

                <!-- Custom file upload area -->
                <div class="flex items-center justify-center w-full">
                    <label for="image"
                        class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                        <!-- Upload icon -->
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L7 9m3-3 3 3" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                <span class="font-semibold">Click to upload</span> or drag and drop
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, or GIF (MAX. 800x400px)</p>
                        </div>
                        <!-- Hidden file input -->
                        <input id="image" type="file" name="image" class="hidden" accept="image/*" required
                            onchange="previewImage(event)" />
                    </label>
                </div>

                <!-- Image preview container -->
                <div id="image-preview" class="mt-4 hidden">
                    <img id="preview" class="max-w-full h-48 rounded-lg object-cover" src="#"
                        alt="Image preview" />
                </div>
            </div>
            <button type="submit"
                class="text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-3 text-center">
                Submit
            </button>
        </form>
    </section>

    {{-- Manage Image Section --}}
    <section class="max-w-5xl mt-6 mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col gap-3 mb-6">
        <h2 class="text-center text-2xl mt-6 font-bold text-gray-900 dark:text-white">Manage Image</h2>
        <div class="overflow-x-auto">
            <div class="my-3">
                {{ $galleries->links() }}
            </div>
            <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300 border-collapse">
                <thead class="bg-blue-600 dark:bg-blue-700 text-white">
                    <tr>
                        <th class="py-3 px-4 text-center">No</th>
                        <th class="py-3 px-4 text-center">ID</th>
                        <th class="py-3 px-4 text-center">Name</th>
                        <th class="py-3 px-4 text-center">Image</th>
                        <th class="py-3 px-4 text-center">Description</th>
                        <th class="py-3 px-4 text-center">Edit</th>
                        <th class="py-3 px-4 text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($galleries as $gallery)
                        <tr
                            class="bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-200">
                            <td class="py-3 px-4 text-center">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4">{{ $gallery->id }}</td>
                            <td class="py-3 px-4">{{ $gallery->name }}</td>
                            <td class="py-3 px-4">{{ $gallery->image }}</td>
                            <td class="py-3 px-4">{{ $gallery->description }}</td>
                            <td class="py-3 px-4">
                                <button type="button"
                                    onclick="openModal({{ $gallery->id }}, '{{ $gallery->name }}', '{{ $gallery->image }}')"
                                    class="text-white bg-yellow-500 hover:bg-yellow-600 dark:bg-yellow-600 dark:hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-300 dark:focus:ring-yellow-800 font-medium rounded-lg text-sm px-5 py-2.5">
                                    Edit
                                </button>
                            </td>
                            <td class="py-3 px-4">
                                <form action="{{ route('gallery-destroy') }}" method="POST" style="display: inline;"
                                    id="delete-form-{{ $gallery->id }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $gallery->id }}">
                                    <button type="button" onclick="confirmDelete({{ $gallery->id }})"
                                        class="text-white bg-red-700 hover:bg-red-800 dark:bg-red-600 dark:hover:bg-red-700 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="my-3">
                {{ $galleries->links() }}
            </div>
        </div>
    </section>


    <!-- Edit Modal -->
    <section id="editModal"
        class="fixed w-full h-full flex inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-1/2 relative">
            <h2 class="text-2xl font-bold text-center mb-4 text-gray-900 dark:text-white">Edit Image</h2>
            <form action="" method="POST" id="editForm" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label for="edit-name"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
                    <input type="text" name="name" id="edit-name"
                        class="w-full mt-2 p-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                        required>
                </div>
                <div class="mb-4">
                    <label for="edit-image" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Current
                        Image</label>
                    <input type="text" name="current_image" id="edit-image"
                        class="w-full mt-2 p-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                        readonly>
                </div>
                <div class="mb-4">
                    <label for="description"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-200">Description</label>
                    <textarea name="description" id="description"
                        class="w-full mt-2 p-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                        required></textarea>
                </div>
                <div class="mb-4">
                    <label for="new-image" class="block text-sm font-medium text-gray-700 dark:text-gray-200">New
                        Image (Optional)</label>
                    <input type="file" name="image" id="new-image"
                        class="w-full mt-2 p-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                        accept="image/*">
                </div>
                <div class="text-center">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white px-6 py-2 rounded-lg">
                        Save Changes
                    </button>
                </div>
            </form>
            <button onclick="closeModal()" class="absolute top-2 right-2 text-xl">
                <i
                    class="fa-solid fa-circle-xmark fa-xl text-red-500 hover:text-red-600 dark:text-red-400 dark:hover:text-red-500"></i>
            </button>
        </div>
    </section>

    <script>
        function openModal(id, name, image) {
            const form = document.getElementById('editForm');
            form.action = `{{ route('gallery-update', '') }}/${id}`; // Use Laravel's route helper

            document.getElementById('edit-name').value = name;
            document.getElementById('edit-image').value = image;
            document.getElementById('description').value = description;
            document.getElementById('editModal').classList.remove('hidden');
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById('editModal').classList.add('hidden'); // Hide the modal
        }

        function previewImage(event) {
            const previewContainer = document.getElementById('image-preview');
            const previewImage = document.getElementById('preview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                previewImage.src = '';
                previewContainer.classList.add('hidden');
            }
        }

        function confirmDelete(galleryId) {
            const isConfirmed = confirm("Are you sure you want to delete this image?");

            if (isConfirmed) {
                document.getElementById('delete-form-' + galleryId).submit();
            }
        }
    </script>
</body>

</html>
