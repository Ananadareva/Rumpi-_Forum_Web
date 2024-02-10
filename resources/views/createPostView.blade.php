<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Postingan Baru</title>

    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/createPost.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>
    <header>
        <h1>Forum Rumpi!</h1>
        <nav class="nav">
            <ul>
                <li><a href="home.php">Home</a></li>
            </ul>
        </nav>

        <div style="display: flex; justify-content: space-between;">
            <button id="backBtn" onclick="window.history.back()">
                <i class="fas fa-arrow-left"></i>
            </button>
            
            
            <button id="setBtn" type="button" class="modal-button" onclick="openModal('modal1')">
                <i class="fa-solid fa-gear"></i>
            </button>
        </div>
        
    </header>

    <main>
        <div id="modal1" class="modal">
            <div class="modal-content">
                <button type="button" class="close-button" onclick="closeModal('modal1')">˂</button>
                <br>
                <center>
                    <h3>Pengaturan</h3>
                    <button onclick="darkMode()">Mode Gelap</button>
                </center>
            </div>
        </div>


        <script src="js/modal.js"></script>
        <script>
            applyDarkModePreference();
        </script>

        <script src="js/darkmode.js"></script>

        <div class="create-post-container">
            <h2>Buat Postingan Baru</h2>
            <div class="grid-container">

                <form id="postForm" enctype="multipart/form-data" class="grid-item" action="{{ route('post.store') }}"
                    method="post">
                    @csrf

                    <input type="text" name="title" placeholder="Masukkan Judul" required> <br>
                    <br>
                    <textarea required name="postContent" placeholder="Tulis sesuatu..."></textarea>
                    <div id="fileInputs" class="file-inputs">
                        <!-- File Input -->
                        <div class="form-group">
                            <input type="file" name="files[]" class="form-control-file" accept="image/*,video/*"
                                required>
                            <button type="button" class="removeFileInput btn btn-danger">Hapus
                                File</button>
                        </div>
                    </div>

                    <button type="button" id="addFileInput" class="btn btn-secondary">Tambahkan
                        File</button>

                    <br>
                    <br>
                    <button type="submit" class="btn btn-primary">Posting</button>
                </form>

                <div class="preview-container grid-item" id="previewContainer"></div>
            </div>
        </div>


        <script src="{{ asset('js/modal.js') }}"></script>
        <script src="{{ asset('js/darkmode.js') }}"></script>
        <script src="{{ asset('js/addFile.js') }}"></script>
        <script src="{{ asset('js/previewPost.js') }}"></script>


    </main>



    <footer>
        <p>&copy; 2023 Forum Rumpi!</p>
    </footer>
</body>

</html>
