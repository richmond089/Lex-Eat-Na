function previewImage(event) {
    const preview = document.getElementById('imagePreview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" alt="Image Preview" class="h-full w-auto object-cover rounded-lg">`;
        }
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = `<span class="text-gray-400">No image selected</span>`;
    }
}