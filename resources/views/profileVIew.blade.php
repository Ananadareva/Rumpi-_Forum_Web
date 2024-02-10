<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Postingan Baru</title>

    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
    </header>




    <main>



        <!-- Modal RejMsg -->
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

        <br>
        <div id="createPost">
            <a href="{{ route('post.create') }}" style="text-decoration: none;">
                <i class="fas fa-circle fa-lg" style="color: green; display: inline-block; position: relative;">
                    <i class="fas fa-plus"
                        style="color: white; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                </i>
                Buat Postingan
            </a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <section class="profil-section">


            <div class="profil-left">
                <form action="{{ route('profile.update', ['idLogin' => Auth::user()->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="profil-image">

                        @error('profileUpdate')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <script src="{{ asset('js/imageProfile.js') }}"></script>

                        {{-- Pakai Old Agar saat nggak diedit tetap ada value yang lama (tida k null) --}}
                        @if ($dataUser->profile->url == null)
                            <img id="imageProfile" src="{{ asset('profile_images/default_profile.webp') }}"
                                alt="profile">
                        @else
                            <img id="imageProfile" src="{{ asset($dataUser->profile->url) }}" alt="profile">
                        @endif

                        <label for="profileUpdate" style="position: relative; display: inline-block; cursor: pointer;">
                            <input accept="image/png, image/jpeg, image/jpeg, image/svg" type="file"
                                name="profileUpdate" id="profileUpdate" style="display: none;">
                            <i class="fas fa-camera fa-lg"
                                style="color: black; position: absolute; top: 0; left: 0;"></i>
                        </label>


                        <br>
                        Update gambar profil

                        <script src="{{ asset('js/imageProfile.js') }}"></script>
                    </div>

                    <div class="post-info">
                        <h3><span>{{ $dataUser->name }}</span></h3>

                        <textarea cols="50" rows="5" id="biography" required name="biografi">{{ old('biografi', $dataUser->profile->biografi) }}</textarea>
                        @error('biografi')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

            </div>

            <div class="profil-right">
                <div class="proflie-data">
                    <h3>Informasi Pribadi</h3>

                    <ul>
                        <li>
                            <strong>Email</strong><br>
                            <!-- Use old() to populate the input with the previous value -->
                            <input required type="text" name="email" value="{{ old('email', $dataUser->email) }}">
                            <hr>
                        </li>
                        <li>
                            <strong>Jenis Kelamin</strong><br>
                            <select name="jenis_kelamin" required>
                                <option value="L"
                                    {{ old('jenis_kelamin', $jenisKelaminAwal) == 'L' ? 'selected' : '' }}>L</option>
                                <option value="P"
                                    {{ old('jenis_kelamin', $jenisKelaminAwal) == 'P' ? 'selected' : '' }}>P</option>
                                <option value="T"
                                    {{ old('jenis_kelamin', $jenisKelaminAwal) == 'T' ? 'selected' : '' }}>T</option>
                            </select>
                            <hr>
                        </li>
                        <li>
                            <strong>Tanggal Lahir</strong><br>
                            <!-- Use old() to populate the input with the previous value -->
                            <input required type="date" name="tanggl_lahir"
                                value="{{ old('tanggl_lahir', $dataUser->profile->tanggal_lahir) }}">
                            <hr>
                        </li>
                        <li>
                            <strong>Negara</strong><br>
                            <select name="negara" required>
                                @foreach ($negaraList as $negara)
                                    <option value="{{ $negara }}"
                                        {{ old('negara', $dataUser->profile->negara) == $negara ? 'selected' : '' }}>
                                        {{ $negara }}
                                    </option>
                                @endforeach
                            </select>
                            <hr>
                        </li>
                    </ul>

                    <button style="background: blue; color: white;" type="submit" onclick="confirmAlert()">
                        Edit Profile
                    </button>

                    <script>
                        function confirmAlert() {
                            alert("Anda Yakin ingin Menyimpan Perubahan?");
                        }
                    </script>
                </div>
            </div>
            </form>
        </section>



        <div class="h2-position">

            <h2> Daftar Pos </h2>

        </div>


        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif




        @foreach ($dataUser->posts as $post)
            <section class="post-section">
                <div class="button-container">


                    <form method="get" action="{{ route('post.edit', ['idPost' => $post->id]) }}">
                        @csrf
                        <button style="background: blue; color: white;" type="submit">
                            Edit
                        </button>
                    </form>

                    <form method="post" action="{{ route('post.delete', ['idPost' => $post->id]) }}">
                        @csrf
                        <button style="background: red; color: white;"
                            onclick="return confirm(' Yakin ingin Menghapus Pos? Pos Akan dihapus permanen')">Hapus</button>
                    </form>
                </div>
                <br>



                <div class="post-content">
                    {{--   @dd($post->files) --}}
                    <div class="flex-content-center">

                        @php
                            $imageCount = $post->files->where('url', '!=', null)->count(); /* itung gambar */
                        @endphp

                        @foreach ($post->files->where('url', '!=', null)->take(1) as $file)
                            {{-- Ambil gambar index pertama --}}
                            <img class="mySlides" src="{{ asset($file->url) }}"
                                style="width:400px; height:400px; object-fit: contain; border:solid 2px;">
                            <br> <br>
                            <a href="{{ route('comment.show', ['idPost' => $post->id]) }}">Lihat
                                {{ $imageCount }} lainnya</a>
                        @endforeach

                    </div>


                    <h3>{{ $post->title }}</h3>
                    <p>{{ $post->updated_at->format('d-m-Y') }}</p>
                    <p>{{ $post->content }}</p>
                </div>

                <div class="post-footer">

                    <i class="fas fa-thumbs-up fa-lg" style="color: red;"></i> {{ $post->like_count }}


                    <form action="{{ route('comment.show', ['idPost' => $post->id]) }}" method="get"
                        style="display: inline-block;">
                        <button type="submit" style="background: none; border: none; cursor: pointer;">
                            <i class="fas fa-comment fa-lg" style="color: blue;"></i> Komentar
                        </button>
                    </form>





                </div>
            </section>
        @endforeach


        {{--  {{dd($dataUser->posts)}} --}}





        <br>
    </main>



    <footer>
        <p>&copy; 2023 Forum Rumpi!</p>
    </footer>
</body>

</html>
