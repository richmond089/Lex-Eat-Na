// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
    modal.classList.remove("hidden");
    document.getElementById('modalTitle').textContent = "Add Product"; // Reset title for add
    document.getElementById('sampleForm').reset(); // Reset form
    document.getElementById('edit_id').value = ''; // Clear edit ID
    document.getElementById('old_image').value = ''; // Clear old image path
    document.getElementById('imagePreview').innerHTML = `<span class="text-gray-400">No image selected</span>`; // Reset image preview
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.classList.add("hidden");
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.classList.add("hidden");
    }
}

// Get all edit buttons and set click events
const editButtons = document.querySelectorAll('.edit-button');

editButtons.forEach(button => {
    button.onclick = function() {
        const row = this.closest('tr');
        const quantity = row.children[0].textContent;
        const category = row.children[1].textContent;
        const name = row.children[2].textContent;
        const description = row.children[3].textContent;
        const price = row.children[4].textContent;
        const image = row.children[5].querySelector('img').src;
        const id = row.children[6].textContent;

        console.log(id);
        // Extract relative path from the full image URL
        const relativeImagePath = image.substring(image.indexOf('uploads/'));

        // Populate the modal fields
        document.getElementById('modalTitle').textContent = "Edit Product";
        document.getElementById('pquantity').value = quantity;
        document.getElementById('category').value = category;
        document.getElementById('pname').value = name;
        document.getElementById('pdescription').value = description;
        document.getElementById('pprice').value = price;
        document.getElementById('old_image').value = relativeImagePath; // Store old image path
        document.getElementById('edit_id').value = id; // Set edit ID

        // Set the image preview
        const preview = document.getElementById('imagePreview');
        preview.innerHTML = `<img src="${image}" alt="Image Preview" class="h-full w-auto object-cover rounded-lg">`;

        // Show the modal
        modal.classList.remove("hidden");
    };
});
