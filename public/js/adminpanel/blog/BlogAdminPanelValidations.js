function validateForm() {
    var title = document.getElementById('title').value;
    var description = document.querySelector('#description').value;
    var postImage = document.querySelector('#post_image').files[0]; // Obtener el archivo de imagen

    var titleErrorMessage = document.getElementById('title-error');
    var descriptionErrorMessage = document.getElementById('description-error');
    var imageErrorMessage = document.getElementById('image-error');

    // Limpiar mensajes de error anteriores
    titleErrorMessage.innerHTML = '';
    descriptionErrorMessage.innerHTML = '';
    imageErrorMessage.innerHTML = '';

    var isValid = true;

    if (title.trim() === '') {
        titleErrorMessage.innerHTML = 'Please enter a title.';
        isValid = false;
    }

    if (title.length < 5 || title.length > 100) {
        titleErrorMessage.innerHTML = 'Title must be between 5 and 100 characters.';
        isValid = false;
    }

    if (description.trim() === '') {
        descriptionErrorMessage.innerHTML = 'Please enter a description.';
        isValid = false;
    }

    if (description.length < 10) {
        descriptionErrorMessage.innerHTML = 'Description must be at least 10 characters.';
        isValid = false;
    }

    if (!postImage) {
        imageErrorMessage.innerHTML = 'Please select an image.';
        isValid = false;
    }

    var validImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
    if (postImage && !validImageTypes.includes(postImage.type)) {
        imageErrorMessage.innerHTML = 'Invalid image format. Please upload a JPEG, PNG, JPG, or GIF image.';
        isValid = false;
    }

    if (postImage && postImage.size > 2048 * 1024) {
        imageErrorMessage.innerHTML = 'Image size exceeds the maximum allowed size (2MB).';
        isValid = false;
    }

    return isValid;
}
