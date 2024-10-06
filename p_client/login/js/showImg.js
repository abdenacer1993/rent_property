function displayImage() {
    const fileInput = document.getElementById('fileToUpload');
    const uploadImageSpan = document.getElementById('upload_image');

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.width = 200; // adjust the width as needed
            img.height = 200; // adjust the height as needed
            uploadImageSpan.innerHTML = ''; // Clear any previous content
            uploadImageSpan.appendChild(img);
        };

        reader.readAsDataURL(fileInput.files[0]);
    }
}