<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Post;
use App\Models\File;



class PostController extends Controller
{
  public function index()
  {

    /*  User::where */

    // Ambil semua data post
    $postDatas = Post::orderBy('created_at', 'desc')->with('user.profile', 'files')->paginate(5);



    $userId = Auth::check() ? Auth::user()->id : 0;

    $usernameLogin = Auth::check() ? Auth::user()->name : 0;







    //ambil data user

    /*    dd($userId); */
    /*    dd($postDatas);
     foreach ($postDatas as $post) {
        // Akses user untuk setiap post
        dd($post->user);
    } */

    return view('home', compact('postDatas', 'userId', 'usernameLogin'));
  }

  public function showComment($id)
  {
    $post = Post::find($id);
    return view('post', compact('post'));
  }



  public function create()
  {
    return view('createPostView');
  }

  public function store(Request $request)
  {
    /*     dd($request->all()); */
    $userId = $request->user()->id;

    $title = $request->title;
    $content = $request->postContent;
    $files = $request->file('files');


    $post = Post::create([
      'user_id' => $userId,
      'title' => $title,
      'content' => $content,
    ]);

    if ($files) {
      foreach ($files as $file) {
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('post_images'), $fileName);

        File::create([
          'post_id' => $post->id,
          'fileName' => $fileName,
          'url' => 'post_images/' . $fileName,
        ]);
      }
    }

    return redirect()->route('home')->with('success', 'Pos Berhasil Dibuat');
  }

  public function edit($postId)
  {
    $post = Post::with('files')->find($postId);
    return view('editPostView', compact('post'));
  }
  public function update(Request $request, $postId)
  {



    $title = $request->title;
    $content = $request->content;
    $selectedFiles = $request->input('selected_files');

    //update post
    Post::where('id', $postId)->update([
      'title' => $title,
      'content' => $content,
    ]);

    if (is_array($selectedFiles)) {
      foreach ($selectedFiles as $selectedFile) {
        // Pisahkan ID dan URL dari nilai checkbox yang terpilih
        list($fileId, $fileUrl) = explode(':', $selectedFile);

        // Hapus dari penyimpanan (storage)
        Storage::delete($fileUrl);

        // Hapus di table
        File::find($fileId)->delete();
      }
    }

    return redirect()->back()->with('success', 'Pos Berhasil Diubah');
  }


  public function destroy($postId)
  {

    $post = Post::find($postId);
    $post->delete();

    if ($post) {

      $post = Post::find($postId);

      // cari file post
      $files = File::where('post_id', $postId)->get();

      // cek ada file gk
      if ($files->count() > 0) {

        foreach ($files as $file) {

          Storage::delete($file->url);

          $file->delete();
        }
      }
    }

    $idLogin = auth()->user()->id;



    return redirect()->route('profile.show', ['idLogin' => $idLogin])->with('success', 'Post Berhasil Dihapus');
  }
}
