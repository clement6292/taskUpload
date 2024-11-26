<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function show(Request $request)
    {
        // Récupérer l'URL du PDF, le titre et l'image depuis la requête
        $pdfUrl = $request->query('file'); // Assurez-vous de passer le paramètre 'file' dans l'URL
        $title = $request->query('title'); // Récupérer le titre
        $imageUrl = asset('storage/' . $request->query('image')); // Assurez-vous de créer l'URL correctement

          // Vérifiez que les valeurs ne sont pas nulles
    if (!$pdfUrl || !$title || !$imageUrl) {
        return redirect()->back()->with('error', 'Informations manquantes.');
    }


        return view('articles.pdfviewer', compact('pdfUrl', 'title', 'imageUrl'));
    }
}
