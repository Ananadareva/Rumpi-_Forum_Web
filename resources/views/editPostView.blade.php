<div>
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
</div>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Rumpi!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body>
    <header>
        <h1>Forum Rumpi!</h1>
        <nav class="nav">
            <ul>
            
                <li><a href={{ route('home') }}>Home</a></li>

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
        <style>
            body,
            h1,
            h2,
            h3,
            p,
            ul,
            li {
                margin: 0;
                padding: 0;
            }

            body {
                font-family: 'Arial', sans-serif;
                font-size: 16px;
            }

            .post-section {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
            }

            form {
                margin-bottom: 20px;
            }

            label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }

            input {
                width: 100%;
                padding: 8px;
                margin-bottom: 10px;
                box-sizing: border-box;
                max-width: 200;
            }

            textarea {
                width: 100%;
                padding: 8px;
                margin-bottom: 10px;
                box-sizing: border-box;
                max-width: 200;
            }

            label[for="selected_files[]"] {
                margin-top: 15px;
                display: block;
            }

            div {
                margin-bottom: 10px;
            }

            img {
                max-width: 100px;
                max-height: 100px;
                margin-right: 10px;
                margin-bottom: 5px;
            }

            .btn-primary {
                background-color: #333;
                color: #fff;
                padding: 10px 15px;
                border: none;
                cursor: pointer;
            }

            .btn-primary:hover {
                background-color: #0056b3;
            }
        </style>
    </header>


    <!--IsI kontene dinamis dari db-->

    <main>





        <!-- Modal Setting -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <button type="button" class="close-button" onclick="closeModal('modal1')">˂</button>
                <br>
                <center>




                    <br>
                    <div class="profil-box">{{--  
                                                session_start();
                                                if (isset($_SESSION['username'])) {
                                                    $username = $_SESSION['username'];
                                                    echo "<strong> $username</strong>";
                                                } else {
                                                    // Handle the case when the username is not set in the session
                                                    $username = "Guest";
                                                }


                                               --}}</div>

                    <h3>Pengaturan</h3>
                    <button onclick="darkMode()">Mode Gelap</button>

                    <br>

                </center>
            </div>
        </div>


        <script src={{ asset('js/modal.js') }}></script>
        <script>
            applyDarkModePreference();
        </script>


        <script src={{ asset('js/darkMode.js') }}></script>




        <br>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif



        <br>
        <section class="post-section">
            {{-- {{ dd($post) }} --}}
            <div>
                <center>
                    <h2> Edit Post </h2>
                </center>

                <form method="post" action=" {{ route('post.update', ['idPost' => $post->id]) }}"
                    enctype="multipart/form-data">
                    @csrf

                    <label> Judul</label>
                    <input type="text" value="{{ $post->title }}" name="title" required> <br>

                    <label> Konten</label>
                    <textarea rows="4" name="content" required>{{ $post->content }}</textarea>

                    <br>



                    <label>Hapus File</label> <br>

                    @foreach ($post->files as $file)
                        <div>
                            <input type="checkbox" name="selected_files[]"
                                value="{{ $file->id }}:{{ $file->url }}">
                            {{ $file->fileName }} <br>
                            <img src="{{ asset($file->url) }}" alt="File Image"
                                style="max-width: 100px; max-height: 100px;">
                        </div>
                    @endforeach

                    <br>

                    <button type="submit" class="btn btn-primary"
                        onclick="return confirm(' Yakin ingin menyimpan perubahan?')">Update</button>

                </form>



            </div>



        </section>









    </main>

    <footer>
        <p>&copy; 2023 Forum Rumpi! </p>
    </footer>
</body>

</html>
