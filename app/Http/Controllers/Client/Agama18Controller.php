<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Agama;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class Agama18Controller extends Controller
{
    public function index18()
    {
        $client = new Client();
        $response = $client->request('GET', url('api/data-agama18'));
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $result = json_decode($body, true);
        $agama = $result['data'];
        return view('apiclient.admin.agama', compact('agama'));
    }
    public function create18(Request $request)
    {
        $client = new Client();
        $response = $client->request('POST', url('api/create-agama18'), [
            'json' => [
                'agama' => $request->agama
            ]
        ]);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $result = json_decode($body, true);
        return Redirect::back()->with(['agamaadd' => $result['message']]);
    }
    public function edit18($id)
    {
        $client = new Client();
        $response = $client->request('GET', url('api/show-agama18/') . '/' . $id);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $result = json_decode($body, true);
        $agama = $result['data'];
        return view('apiclient.admin.edit_agama', compact('agama'));
    }
    public function update18(Request $request)
    {
        $client = new Client();
        // dd($request->id);
        $response = $client->request('POST', url('api/update-agama18'), [
            'json' => [
                'id' => $request->id, 'agama' => $request->agama
            ]
        ]);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $result = json_decode($body, true);

        return redirect('/client/admin18/data-agama18')->with(['agama' => $result['message']]);
    }
    public function delete18($id)
    {
        $client = new Client();
        $response = $client->request('GET', url('api/delete-agama18/') . '/' . $id);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $result = json_decode($body, true);
        return Redirect::back()->with(['agamadel' => $result['message']]);
    }
}