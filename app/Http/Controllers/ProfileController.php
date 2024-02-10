<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Profile;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function showProfile()
    { /*   dd($userID = auth()->user()->id); */

        $userID = auth()->user()->id;

        $dataUser = User::with('profile', 'Posts')->find($userID);


        $jenisKelaminAwal = Profile::where('user_id', $userID)->value('jenis_kelamin');

        /*   dd($jenisKelaminAwal); */
        // Narik Api Countries dan city
        $client = new Client();

        try {

            // Buat GET request ke APi
            $response = $client->get('https://countriesnow.space/api/v0.1/countries/population/cities');

            // Decode data Json 
            $data = json_decode($response->getBody(), true);

            //Ubah struktur jadi array negara dan kota-kotanya
            /*   $negaraDanKotanya = [];

            foreach ($data['data'] as $cityData) {
                $cityName = $cityData['city'];
                $countryName = $cityData['country'];

                //Jika negara tidak ada pada data 
                if (!isset($negaraDanKotanya[$countryName])) {
                    $negaraDanKotanya[$countryName] = [];
                }

                // Tambahkan kota ke negara masing-masing
                $negaraDanKotanya[$countryName][] = $cityName;
            }

            return view('profileView', compact('negaraDanKotanya', 'dataUser', 'jenisKelaminAwal')); */

            //  array untuk nyimpen nama-nama negara
            $negaraList = [];

            foreach ($data['data'] as $cityData) {
                $countryName = $cityData['country'];

                // Jika negara belum ada dalam list, tambahkan ke list
                if (!in_array($countryName, $negaraList)) {
                    $negaraList[] = $countryName;
                }
            }

            dd($negaraList);

        
            return view('profileView', compact('negaraList', 'dataUser', 'jenisKelaminAwal'));
        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }


        /*  return view('profileView', compact('dataUser')); */
    }


    public function updateProfile(Request $request, $idLogin)
    {


        // cek gambar diaupdate apa tidak
        if ($request->hasFile('profileUpdate')) {
            $url = 'post_images/' . $request->profileUpdate->getClientOriginalName();
         
        
            Storage::putFileAs('public', $request->profileUpdate, $url);
        
            Profile::where('user_id', $idLogin)->update([
                'jenis_kelamin' => $request->jenis_kelamin,
                'negara' => $request->negara,
                'tanggal_lahir' => $request->tanggl_lahir,
                'biografi' => $request->biografi,
                'url' => $url,
            ]);
        } else {
            Profile::where('user_id', $idLogin)->update([
                'jenis_kelamin' => $request->jenis_kelamin,
                'negara' => $request->negara,
                'tanggal_lahir' => $request->tanggl_lahir,
                'biografi' => $request->biografi,
            ]);
        }
        
        






        return redirect()->route('profile.show', $idLogin)->with('success', 'Profile Berhasil Diupdate');
    }
}
