<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function show(Request $request)
    {
        // Récupérer l'URL du PDF depuis la requête (ou passer l'URL directement)
        $pdfUrl = $request->query('file'); // Assurez-vous de passer le paramètre 'file' dans l'URL
        return view('articles.pdfviewer', compact('pdfUrl'));
    }
}
