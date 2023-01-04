<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Agama;
use App\Models\DetailData;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class User18Controller extends Controller
{
    public function index18()
    {
        $client = new Client();
        $response = $client->request('GET', url('api/show-user18/') . '/' . Auth::user()->id);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $result = json_decode($body, true);
        $user = $result['data'][0];
        $data = $result['data'][1];

        return view('apiclient.user.dashboard', compact('user', 'data'));
    }
    public function approve18($id)
    {
        $client = new Client();
        $response = $client->request('GET', url('api/approve-user18/') . '/' . $id);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $result = json_decode($body, true);
        $data = $result['data'];
        return redirect('/client/admin18')->with(['approved' => $result['message']]);
    }
    public function edit18()
    {
        $client = new Client();
        $response = $client->request('GET', url('api/show-user18/') . '/' . Auth::user()->id);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();
        $result = json_decode($body, true);
        $data = $result['data'][1];

        $response = $client->request('GET', url('api/data-agama18'));
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();
        $result = json_decode($body, true);
        $agama = $result['data'];

        return view('apiclient.user.edit', compact('data', 'agama'));
    }
    public function update18(Request $request)
    {
        $client = new Client();
        $response = $client->request('GET', url('api/show-user18/') . '/' . Auth::user()->id);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();
        $result = json_decode($body, true);
        $user = $result['data'][1][0];

        $dateOfBirth = $request->tanggal;
        $age = Carbon::parse($dateOfBirth)->age;
        $file = $request->file('ktp');
        $tujuan_upload = 'ktp';
        if ($file == null) {
            $filename = $user['foto_ktp'];
        } else {
            $filename = Carbon::now()->timestamp . "_" . $file->getClientOriginalName();
            $file->move($tujuan_upload, $filename);
            File::delete(public_path('ktp/' . $user['foto_ktp']));
        }

        $response = $client->request('POST', url('api/update-user18/'), [
            'json' => [
                'id' => Auth::user()->id,
                'alamat' => $request->alamat,
                'tempat' => $request->tempat,
                'tanggal' => $request->tanggal,
                'agama' => $request->agama,
                'foto_ktp' => $filename,
                'umur' => $age
            ]
        ]);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();
        $result = json_decode($body, true);

        return redirect('/dashboard18')->with(['updated' => $result['message']]);
    }
    public function gantipass18()
    {
        return view('apiclient.user.password');
    }
    public function updatepass18(Request $request)
    {
        $this->validate($request, [
            'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:8'
        ]);
        $client = new Client();
        $response = $client->request('POST', url('api/update-password18'), [
            'json' => [
                'id' => Auth::user()->id,
                'password' => Hash::make($request->password)
            ]
        ]);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();
        $result = json_decode($body, true);

        return redirect('/dashboard18')->with(['password' => $result['message']]);
    }
}