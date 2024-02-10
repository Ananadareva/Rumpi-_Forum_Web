<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komentar</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">

    <link rel="stylesheet" href="{{ asset('css/comment.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <header>
        <h1>Forum Rumpi!</h1>
        <nav class="nav">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>

                <li><a href="profile.php">Profil</a></li>



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
    <!-- nanti isi comment nha dinamis dari db-->
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
        <script src="{{ asset('js/modal.js') }}"></script>
        <script>
            applyDarkModePreference();
        </script>

        <script src="{{ asset('js/darkmode.js') }}"></script>


        {{--       @dd($post) --}}

        <section class="comments-section">
            <div class="post-content">

                <div class="flex-content-center">
                    <div class="w3-content w3-display-container" style="">
                        @foreach ($post->files as $file)
                            @if ($file->url != null)
                                <img class="mySlides" src="{{ asset($file->url) }}"
                                    style="width:400px; height:400px; object-fit: contain; border:solid 2px;">
                            @endif
                        @endforeach

                        <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
                        <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
                    </div>
                </div>



                <script>
                    var slideIndex = 1;
                    showDivs(slideIndex);

                    function plusDivs(n) {
                        showDivs(slideIndex += n);
                    }

                    function showDivs(n) {
                        var i;
                        var x = document.getElementsByClassName("mySlides");
                        if (n > x.length) {
                            slideIndex = 1
                        }
                        if (n < 1) {
                            slideIndex = x.length
                        }
                        for (i = 0; i < x.length; i++) {
                            x[i].style.display = "none";
                        }
                        x[slideIndex - 1].style.display = "block";
                    }
                </script>


                <h3>{{ $post->title }}</h3>
                <p>{{ $post->updated_at->format('d-m-Y') }}</p>
                <p>{{ $post->content }}</p>
            </div>
        </section>


        <section class="comments-section">



            <h2>Komentar</h2>

            @foreach ($postComments as $comment)
                <div class="comment">
                    <div class="comment-header">
                        @if ($comment->user->profilePhoto == null)
                            <img id="imageProfile" src="{{ asset('profile_images/default_profile.webp') }}">
                        @else
                            <img id="imageProfile" src="{{ $comment->user->profilePhoto }}">
                        @endif
                        <div class="comment-info">
                            <div class="user-info">
                                <h3>{{ $comment->user->username }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="comment-content">
                        <p>{{ $comment->updated_at->format('d-m-Y') }}</p>
                        <p>{{ $comment->content }}</p>
                    </div>
                </div>
            @endforeach


            <h2>Tambahkan Komentar</h2>
            <div class="comment-form">
                <form action="comment.php" method="post" id="comment-form">




                    @if ($userId == 0)
                        <a href="{{ route('login') }}">Login Untuk Menambahkan Komentar</a>
                    @else
                        <label for="comment-content">Komentar Anda:</label> <br>
                        <textarea id="comment-content" name="comment_content" rows="5" required></textarea><br>
                        <button type="submit">Kirim Komentar</button>
                    @endif





                </form>
            </div>

        </section>






















        </section>


    </main>

    <footer>
        <p>&copy; 2023 Forum Rumpi!</p>
    </footer>

</body>

</html>
