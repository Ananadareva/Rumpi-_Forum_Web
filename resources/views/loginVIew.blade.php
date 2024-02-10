<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Rumpi!</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>
    <header>
        <h1>Forum Rumpi!</h1>
        <nav class="nav">

        </nav>
        <button type="button" class="modal-button" onclick="openModal('modal1')"> <i class="fa-solid fa-gear"></i>
        </button>
    </header>


    <main>





        <!-- Modal Setting -->
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

        

        <div class="login-box">
            <a style="color: white" href="{{ route('home', ['id'=>0]) }}">Lanjutkan sebagai Tamu</a>
            <h2>Login</h2>

            @if (session('status') && session('status') == 'gagal')
            <div class="alert alert-danger text-center" role="alert">
                <h4>{{ session('message') }}</h4>
            </div>
            <div class="text-center">
                <h5 style="color: red">Username atau password salah!</h5>
            </div>

  
        @endif
        


            <form method="post" action="">
                @csrf

                <label>Email</label><br>
                <input type="text" name="email" placeholder="Masukkan Email" required><br>


                <label>Password</label><br>
                <input type="password" name="password" placeholder="Masukkan Password" required><br>

                <input type="submit" name="submit" value="Login">
            </form>

            <p> email: admin@gmail.com, pw: admin123 </p>


            <div class="text-center">
                <h5>Belum punya akun? <a href="register">Daftar</a></h5>
            </div>




        </div>


    </main>

    <footer>
        <p>&copy; 2023 Forum Rumpi! </p>
    </footer>
</body>

</html>
