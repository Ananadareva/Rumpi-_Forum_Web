document.getElementById('addFileInput').addEventListener('click', function () {
    const fileInputsContainer = document.getElementById('fileInputs');

    // Periksa jumlah file input yang sudah ada
    const existingFileInputs = fileInputsContainer.querySelectorAll('.form-group').length;

    if (existingFileInputs < 4) {
        // Jika kurang dari 4, tambahkan file input baru
        const fileInput = document.createElement('div');
        fileInput.innerHTML = `
            <div class="form-group">
                <input type="file" name="files[]" class="form-control-file"  accept="image/*,video/*" required>
                <button type="button" class="removeFileInput btn btn-danger">Hapus File</button>
            </div>
        `;
        fileInputsContainer.appendChild(fileInput);

        // Event listener untuk menghapus file input yang ditambahkan
        fileInput.querySelector('.removeFileInput').addEventListener('click', function () {
            fileInput.remove();
            updatePreview(); // Perbarui preview ketika file dihapus
        });

        // Event listener untuk memperbarui preview saat file dipilih
        fileInput.querySelector('input[name="files[]"]').addEventListener('change', function (event) {
            updatePreview();
        });
    } else {
        alert('Anda telah mencapai batas maksimal (4) file.');
    }

    // Fungsi untuk memperbarui preview file
    function updatePreview() {
        const previewContainer = document.getElementById('previewContainer');
        previewContainer.innerHTML = '';

        const allFileInputs = document.querySelectorAll('input[name="files[]"]');
        allFileInputs.forEach(input => {
            Array.from(input.files).forEach(file => {
                const previewItem = document.createElement('div');
                previewItem.classList.add('preview-item');

                if (file.type.startsWith('image/')) {
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    previewItem.appendChild(img);
                } else if (file.type.startsWith('video/')) {
                    const video = document.createElement('video');
                    video.src = URL.createObjectURL(file);
                    video.setAttribute('controls', 'controls');
                    previewItem.appendChild(video);
                }

                previewContainer.appendChild(previewItem);
            });
        });
    }
});

document.addEventListener('click', function (event) {
    if (event.target && event.target.className === 'removeFileInput btn btn-danger') {
        event.target.parentElement.remove();
        updatePreview(); // Perbarui preview ketika file dihapus
    }
});
