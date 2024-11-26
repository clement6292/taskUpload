<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImagesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PhotoController extends Controller
{
    public function create(): View
    {
        return view('articles.photo'); // Indiquez le chemin correct ici
    }

    public function store(ImagesRequest $request): View
    {
        // dd( $request);
        $request->image->store('images', 'public'); // Stockage de l'image
        $url=Storage::url($request->file('image'));
        dd($url);
        return view('articles.image_ok'); // Assurez-vous que cette vue existe également dans le bon dossier
    }
}
