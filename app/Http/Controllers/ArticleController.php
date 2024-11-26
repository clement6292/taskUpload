<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Méthode pour afficher le formulaire d'upload
    public function create()
    {
        return view('articles.upload'); // Retourne la vue pour uploader un article
    }

    // Méthode pour uploader un article
    public function upload(Request $request)
    {
        // Validation des entrées
       try {
        $validation = $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);
        // dd($validation);
        // Stocker le fichier PDF
        $filePath = $request->file('file')->store('articles', 'public');

        // Stocker l'image si elle est fournie
        $imagePath = $request->file('image') ? $request->file('image')->store('images', 'public') : null;

        // Créer l'article dans la base de données
        Article::create([
            'title' => $request->input('title'),
            'file_path' => $filePath,
            'description' => $request->input('description'),
            'image_path' => $imagePath,
        ]);
       } catch (\Throwable $th) {
       dd($th);
       }
       
           
        // Rediriger vers une page de succès ou vers la liste des articles
        return redirect()->route('articles.index')->with('success', 'Article uploaded successfully.');
    }

    // Méthode pour afficher la liste des articles
    public function index()
    {
        $articles = Article::paginate(9); // Récupérer les articles avec pagination
        return view('articles.index', compact('articles')); // Retourner la vue avec les articles
    }

    // Méthode pour afficher les détails d'un article
    public function show($id)
    {
        $article = Article::findOrFail($id); // Récupérer l'article par ID
        return view('articles.show', compact('article')); // Retourner la vue avec l'article
    }
}