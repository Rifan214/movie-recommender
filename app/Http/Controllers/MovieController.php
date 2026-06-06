<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function index()
    {
        return view('movies.index');
    }

    public function recommend(Request $request)
    {
        $response = Http::post('http://127.0.0.1:5000/recommend', [
            'title' => $request->title
        ]);

        return view('movies.index', [
            'results' => $response->json(),
            'title' => $request->title
        ]);
    }
}
