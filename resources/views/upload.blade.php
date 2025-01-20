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

<body class="bg-gray-100">
    @include('navbar')

    <section id="upload-image" class="max-w-4xl mt-6 mx-auto bg-white p-6 rounded-lg shadow-lg flex flex-col gap-3">
        <h2 class="text-center text-2xl font-bold">Upload Image</h2>
        <form class="" method="POST" action="{{ route('gallery-store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Your picture name</label>
                <input type="text" id="name" name="name"
                    class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3"
                    placeholder="name pict example" required />
            </div>
            <div class="mb-5">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Your picture description</label>
                <input type="text" id="description" name="description"
                    class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3"
                    placeholder="description pict example" required />
            </div>
            <div class="mb-5">
                <label for="image" class="block mb-2 text-sm font-medium text-gray-700">Your image</label>
                <input type="file" id="image" name="image"
                    class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3"
                    accept="image/*" required onchange="previewImage(event)" />
            </div>
            <div id="preview-container" class="mb-5 hidden">
                <p class="text-sm text-gray-500 mb-2">Image Preview:</p>
                <img id="image-preview" class="max-w-full h-auto rounded-lg border border-gray-300 shadow-md" />
            </div>
            <button type="submit"
                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-3 text-center">Submit</button>
        </form>
    </section>

    <section id="manage-image"
        class="max-w-4xl mt-6 mx-auto bg-white p-6 rounded-lg shadow-lg flex flex-col gap-3 mb-6">
        <h2 class="text-center text-2xl mt-6 font-bold">Manage Image</h2>
        <!-- gallery.blade.php -->
        <table class="w-full text-sm text-left text-gray-700 border-collapse">
            <thead class="bg-blue-600 text-white">
                <tr>
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
                    <tr class="bg-gray-50 hover:bg-gray-100 transition duration-200">
                        <td class="py-3 px-4">{{ $gallery->id }}</td>
                        <td class="py-3 px-4">{{ $gallery->name }}</td>
                        <td class="py-3 px-4">{{ $gallery->image }}</td>
                        <td class="py-3 px-4">{{ $gallery->description }}</td>
                        <td class="py-3 px-4">
                            <button type="button"
                                onclick="openModal({{ $gallery->id }}, '{{ $gallery->name }}', '{{ $gallery->image }}')"
                                class="text-white bg-yellow-500 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
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
                                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                                    Delete
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </section>

    <div id="editModal"
        class="fixed w-full h-full flex inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50 ">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2 relative">
            <h2 class="text-2xl font-bold text-center mb-4">Edit Image</h2>
            <form action="" method="POST" id="editForm" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label for="edit-name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="edit-name"
                        class="w-full mt-2 p-2 border border-gray-300 rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="edit-image" class="block text-sm font-medium text-gray-700">Current Image</label>
                    <input type="text" name="current_image" id="edit-image"
                        class="w-full mt-2 p-2 border border-gray-300 rounded-lg" readonly>
                </div>
                <div class="mb-4">
                    <label for="edit-description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="edit-description"
                        class="w-full mt-2 p-2 border border-gray-300 rounded-lg" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="new-image" class="block text-sm font-medium text-gray-700">New Image (Optional)</label>
                    <input type="file" name="image" id="new-image"
                        class="w-full mt-2 p-2 border border-gray-300 rounded-lg" accept="image/*">
                </div>
                <div class="text-center">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg">Save Changes</button>
                </div>
            </form>
            <button onclick="closeModal()" class="absolute top-2 right-2 text-xl">
                <i class="fa-solid fa-circle-xmark fa-xl" style="color: #fd7272;"></i>
            </button>
        </div>
    </div>

    <script>
        function openModal(id, name, image) {
            const form = document.getElementById('editForm');
            form.action = `{{ route('gallery-update', '') }}/${id}`; // Use Laravel's route helper

            document.getElementById('edit-name').value = name;
            document.getElementById('edit-image').value = image;
            document.getElementById('edit-description').value = description;
            document.getElementById('editModal').classList.remove('hidden');
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById('editModal').classList.add('hidden'); // Hide the modal
        }

        function previewImage(event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('image-preview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
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
