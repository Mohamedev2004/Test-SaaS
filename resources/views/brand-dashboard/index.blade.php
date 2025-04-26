@extends('layouts.dashboard')

@section('content')

<style>

 .upload-btn {
    display: inline-block;
    padding: 8px 12px;
    background-color: #9c04ff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 5px;
}
#alert-border-1{
        background: #9c04ff !important;
        color: white !important;
        border-radius: 10px;
    }


.file-input {
    display: none;
}

.preview-image {
    display: inline-block;
    position: relative;
    margin: 5px;
}

.preview-image img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 5px;
}

.remove-btn, .remove-profile-btn, .remove-video-btn {
    position: absolute;
    top: 2px;
    right: 5px;
    background: red;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 50%;
    font-size: 12px;
    width: 20px;
    height: 20px;
}

</style>
<!-- content area -->
<div class="dashboard__content d-flex">
    <div class="dashboard__right">
        <div class="dash__content">
            @if (auth()->user()->status === 'Inactive')
            <div id="alert-border-1" class="flex items-center justify-center p-4 mb-4 text-blue-800 border-t-4 border-blue-300 bg-blue-50 dark:text-blue-400 dark:bg-gray-800 dark:border-blue-800" role="alert">
                <div class="ms-3 text-sm font-medium">
                    Votre compte n'est pas encore activé. Nous vous contacterons dès que possible.
                </div>
            </div>
            @else
            <div class="my__profile__tab radius-16 bg-white">
                <nav>
                    <div class="nav nav-tabs">
                        <a class="nav-link active" href="#info">Mon Profil</a>
                    </div>
                </nav>
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
                <form action="{{ $brand ? route('brand.update', $brand->id) : route('brand.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if($brand)
                        @method('PUT')
                    @endif
                    <div class="my__details" id="info">
<!-- Profile Image Upload -->
<div class="info__top">
    <div class="author__image">
        <img class=""
            src="{{ $brand && $brand->logo_image ? Storage::disk('do_spaces')->url($brand->logo_image) : secure_asset('assets/images/influencer-default.jpg') }}"
            alt="">
    </div>
    <button type="button" id="profile-upload-btn" class="upload-btn"><i class="fa-solid fa-upload"></i></button>
    <input type="file" id="logo_image" name="logo_image" class="file-input" hidden accept="image/*">
</div>
                        <div class="info__field">
                            <div class="row row-cols-sm-2 row-cols-1 g-3">
                                <div class="rt-input-group">
                                    <label for="brandName">Nom de la Marque</label>
                                    <input type="text" id="brandName" name="brandName" value="{{ old('brandName', $brand ? $brand->brandName : '') }}" placeholder="Nom de la marque" required>
                                </div>
                                <div class="rt-input-group">
                                    <label for="brandDescription">Description</label>
                                    <textarea id="brandDescription" name="brandDescription" placeholder="Description de la marque" required>{{ old('brandDescription', $brand ? $brand->brandDescription : '') }}</textarea>
                                </div>
                            </div>

                            <div class="row row-cols-sm-2 row-cols-1 g-3">
                                <div class="rt-input-group">
                                    <label for="brandSize">Taille</label>
                                    <select name="brandSize" id="brandSize" class="form-select">
                                        <option value="Petite" {{ old('brandSize', $brand ? $brand->brandSize : '') == 'Petite' ? 'selected' : '' }}>Petite</option>
                                        <option value="Moyenne" {{ old('brandSize', $brand ? $brand->brandSize : '') == 'Moyenne' ? 'selected' : '' }}>Moyenne</option>
                                        <option value="Grande" {{ old('brandSize', $brand ? $brand->brandSize : '') == 'Grande' ? 'selected' : '' }}>Grande</option>
                                    </select>
                                </div>
                                <div class="rt-input-group">
                                    <label for="brandLocalisation">Localisation</label>
                                    <input type="text" id="brandLocalisation" name="brandLocalisation" value="{{ old('brandLocalisation', $brand ? $brand->brandLocalisation : '') }}" placeholder="Localisation de la marque" required>
                                </div>
                            </div>

                            <div class="row row-cols-sm-2 row-cols-1 g-3">
                                <div class="rt-input-group">
                                    <label for="sector_id">Domaine</label>
                                    <select name="sector_id" id="sector_id" class="form-select">
                                        @foreach ($sectors as $sector)
                                            <option value="{{ $sector->id }}"

                                                {{ old('sector_id', $brand ? $brand->sector_id : '') == $sector->id ? 'selected' : '' }}>

                                                {{ $sector->name }}

                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="rt-input-group">
                                    <label for="collaboration_id">Type de collaboration</label>
                                    <select name="collaboration_id" id="collaboration_id" class="form-select">
                                        @foreach ($collaborations as $collaboration)
                                            <option value="{{ $collaboration->id }}"
                                                {{ old('collaboration_id', $brand ? $brand->collaboration_id : '') == $collaboration->id ? 'selected' : '' }}>

                                                {{ $collaboration->name }}

                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="rt-input-group">
                                <label>Images (Max: 3)</label>
                                {{-- <button type="button" id="image-upload-btn" class="upload-btn">📤 Ajouter Images</button> --}}

                                <!-- Three file inputs -->
                                <input type="file" id="image_upload_1" name="image_upload_1" class="file-input" accept="image/*" hidden>
                                <input type="file" id="image_upload_2" name="image_upload_2" class="file-input" accept="image/*" hidden>
                                <input type="file" id="image_upload_3" name="image_upload_3" class="file-input" accept="image/*" hidden>

                                <!-- Three hidden inputs for final images -->
                                <input type="hidden" id="final_image_1" name="final_images[1]" value="">
                                <input type="hidden" id="final_image_2" name="final_images[2]" value="">
                                <input type="hidden" id="final_image_3" name="final_images[3]" value="">

                                <!-- Image preview container -->
                                <div id="image-preview-container">
                                    @php
                                        // Get existing images from database
                                        $existingImages = [];
                                        if ($brand && $brand->post && $brand->post->images) {
                                            $existingImages = json_decode($brand->post->images, true) ?? [];
                                        }

                                        // Display existing images with their slots
                                        foreach ($existingImages as $index => $image) {
                                            if ($index < 3) {
                                                echo '<div class="preview-image" data-slot="'.($index+1).'">
                                                    <img src="'.Storage::disk('do_spaces')->url($image).'" width="100">
                                                    <button type="button" class="remove-btn" data-image="'.$image.'">✖</button>
                                                </div>';
                                                echo '<script>document.getElementById("final_image_'.($index+1).'").value = "'.$image.'";</script>';
                                            }
                                        }
                                    @endphp
                                </div>
                                <button type="button" id="image-upload-btn" class="upload-btn"><i class="fa-solid fa-upload"></i> </button>
                            </div>
                            <div class="rt-input-group">
                                <label>Vidéo</label>
                                <input type="file" id="video" name="video" class="file-input" accept="video/*" hidden>
                                <div id="video-preview-container">
                                    @php
                                        $existingVideo = null;
                                        if ($brand && $brand->post) {
                                            $existingVideo = $brand->post->video;
                                        }
                                        $existingVideo = old('existing_video', $existingVideo);
                                    @endphp

                                    @if($existingVideo)
                                        <div style="position:relative;">
                                            <video width="200" controls>
                                                <source src="{{ Storage::disk('do_spaces')->url($existingVideo) }}" type="video/mp4">
                                                </video>
                                                <button type="button" class="remove-video-btn">✖</button>
                                                <input type="hidden" name="existing_video" value="{{ $existingVideo }}">
                                            </div>
                                    @endif
                                </div>
                                <button type="button" id="video-upload-btn" class="upload-btn"><i class="fa-solid fa-upload"></i></button>
                            </div>
                            <div class="rt-input-group">
                                <div class="textarea"></div>
                            </div>
                        </div>
                    </div>

                    <button class="boutton" type="submit">{{ $brand ? 'Mettre à jour' : 'Enregistrer' }}</button>
                </form>

            </div>
            @endif
        </div>
        <div class="d-flex justify-content-center mt-30">
            <p class="copyright" style="font-size: 15px !important;">Copyright © 2025 All Rights Reserved by cocollab</p>
        </div>
    </div>
</div>
<!-- content area end -->

<x-canva />

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Profile Image Upload Handling
        const profileUploadBtn = document.getElementById("profile-upload-btn");
        const profileInput = document.getElementById("logo_image");

        profileUploadBtn.addEventListener('click', function() {
            profileInput.click();
        });

        profileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            if (!file.type.match('image.*')) {
    Swal.fire({
        icon: 'error',
        title: 'Fichier invalide',
        text: 'Veuillez sélectionner une image valide.',
        confirmButtonText: 'OK'
    });
    return;
}


            const reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('.author__image img').src = e.target.result;
            };
            reader.readAsDataURL(file);
        });

        // Image Upload Handling
        const imageUploadBtn = document.getElementById("image-upload-btn");
        const imageInputs = [
            document.getElementById("image_upload_1"),
            document.getElementById("image_upload_2"),
            document.getElementById("image_upload_3")
        ];
        const finalImageInputs = [
            document.getElementById("final_image_1"),
            document.getElementById("final_image_2"),
            document.getElementById("final_image_3")
        ];
        const imagePreviewContainer = document.getElementById("image-preview-container");

        // Handle image removal
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-btn')) {
                const previewDiv = e.target.closest('.preview-image');
                const slot = previewDiv.getAttribute('data-slot');

                // If it was an existing image, mark for deletion
                if (e.target.hasAttribute('data-image')) {
                    const deleteInput = document.createElement("input");
                    deleteInput.type = "hidden";
                    deleteInput.name = "delete_images[]";
                    deleteInput.value = e.target.getAttribute('data-image');
                    document.querySelector("form").appendChild(deleteInput);
                }

                // Clear the corresponding hidden input
                finalImageInputs[slot - 1].value = '';

                // Remove the preview element
                previewDiv.remove();

                // Reindex remaining images
                reindexImages();
            }
        });

        // Function to reindex images after removal
        function reindexImages() {
            const previews = Array.from(imagePreviewContainer.querySelectorAll('.preview-image'));

            // Clear all hidden inputs first
            finalImageInputs.forEach(input => input.value = '');

            // Reindex previews and update hidden inputs
            previews.forEach((preview, index) => {
                const newSlot = index + 1;
                preview.setAttribute('data-slot', newSlot);

                // Update hidden input
                const imgElement = preview.querySelector('img');
                if (imgElement.hasAttribute('data-existing')) {
                    finalImageInputs[newSlot - 1].value = imgElement.getAttribute('data-existing');
                } else {
                    // For new uploads, the file input will handle this
                }
            });
        }

        // Handle upload button click
        imageUploadBtn.addEventListener('click', function() {
            const previews = imagePreviewContainer.querySelectorAll('.preview-image');
            if (previews.length >= 3) {
    Swal.fire({
        icon: 'warning',
        title: 'Limite atteinte',
        text: 'Vous pouvez seulement télécharger jusqu’à 3 images.',
        confirmButtonText: 'OK',
    });
    return;
}


            // Find first available input (1, 2, or 3)
            for (let i = 0; i < 3; i++) {
                if (!finalImageInputs[i].value) {
                    imageInputs[i].click();
                    return;
                }
            }
        });

        // Handle file selection
        imageInputs.forEach((input, index) => {
            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) return;

                if (!file.type.match('image.*')) {

                    Swal.fire({
    icon: 'error',
    title: 'Fichier invalide',
    text: 'Veuillez sélectionner une image valide.',
    confirmButtonText: 'OK',
});

                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    // Find first empty slot
                    let targetSlot = null;
                    for (let i = 0; i < 3; i++) {
                        if (!finalImageInputs[i].value) {
                            targetSlot = i + 1;
                            break;
                        }
                    }

                    if (!targetSlot) return;

                    // Remove any existing preview for this slot
                    const existingPreview = document.querySelector(`.preview-image[data-slot="${targetSlot}"]`);
                    if (existingPreview) {
                        existingPreview.remove();
                    }

                    // Create new preview
                    const previewDiv = document.createElement('div');
                    previewDiv.className = 'preview-image';
                    previewDiv.setAttribute('data-slot', targetSlot);
                    previewDiv.innerHTML = `
                        <img src="${e.target.result}" width="100">
                        <button type="button" class="remove-btn">✖</button>
                    `;
                    imagePreviewContainer.appendChild(previewDiv);

                    // Store the file reference in the hidden input
                    finalImageInputs[targetSlot - 1].value = file.name;
                };
                reader.readAsDataURL(file);
            });
        });

        // Video Upload Handling
        const videoUploadBtn = document.getElementById("video-upload-btn");
        const videoInput = document.getElementById("video");
        const videoPreviewContainer = document.getElementById("video-preview-container");

        const removeVideoInput = document.createElement("input");
        removeVideoInput.type = "hidden";
        removeVideoInput.name = "remove_video";
        removeVideoInput.value = "0";
        document.querySelector("form").appendChild(removeVideoInput);

        videoUploadBtn.addEventListener("click", () => videoInput.click());

        videoInput.addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (!file) return;

            if (!file.type.match('video.*')) {
    Swal.fire({
        icon: 'error',
        title: 'Fichier invalide',
        text: 'Veuillez sélectionner un fichier vidéo valide.',
        confirmButtonText: 'OK'
    });
    return;
}


            const reader = new FileReader();
            reader.onload = function(e) {
                videoPreviewContainer.innerHTML = `
                    <div style="position:relative;">
                    <video width="200" controls>
                        <source src="${e.target.result}">
                    </video>
                    <button type="button" class="remove-video-btn">✖</button>
                    <input type="hidden" name="remove_video" value="0">
                    </div>
                `;

                videoPreviewContainer.querySelector(".remove-video-btn").addEventListener("click", function() {
                    videoPreviewContainer.innerHTML = "";
                    videoInput.value = "";
                    removeVideoInput.value = "1";
                });
            };
            reader.readAsDataURL(file);
        });

        // Handle existing video removal
        const existingVideoBtn = videoPreviewContainer.querySelector(".remove-video-btn");
        if (existingVideoBtn) {
            existingVideoBtn.addEventListener("click", function() {
                videoPreviewContainer.innerHTML = "";
                removeVideoInput.value = "1";
            });
        }

        // Initialize existing images with proper data attributes
        document.querySelectorAll('.preview-image img').forEach(img => {
            const src = img.getAttribute('src');
            if (src.includes('digitaloceanspaces.com')) {
                const urlParts = src.split('.fra1.digitaloceanspaces.com/');
                const imagePath = urlParts.length > 1 ? urlParts[1] : '';
                img.setAttribute('data-existing', imagePath);
                const slot = img.closest('.preview-image').getAttribute('data-slot');
                document.getElementById(`final_image_${slot}`).value = imagePath;
            }
        });
    });




    </script>

    <style>
    .preview-image {
        position: relative;
        display: inline-block;
        margin: 5px;
    }
    .preview-image img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 5px;
    }
    .remove-btn, .remove-video-btn {
        position: absolute;
        top: 2px;
        right: 2px;
        background: red;
        color: white;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 12px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    </style>

@endsection
