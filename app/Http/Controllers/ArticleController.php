<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    // public function __construct()
    // {
    //     // Assurez-vous que Auth est correctement configuré
    //     $this->middleware('auth'); // Applique le middleware d'authentification
    // }

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
                'user_id' => auth()->id() // Ajoutez cette ligne pour inclure l'ID de l'utilisateur
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

        // Rediriger vers le PdfController avec les paramètres nécessaires
        return redirect()->route('pdf.view', [
            'file' => $article->file_path,
            'title' => $article->title,
            'image' => $article->image_path,
        ]);
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Valider l'image
    ]);

    $article = Article::findOrFail($id);
    $article->title = $request->title;
    $article->description = $request->description;

    // Vérifiez si une nouvelle image a été téléchargée
    if ($request->hasFile('image')) {
        // Supprimer l'ancienne image si elle existe
        if ($article->image_path) {
            Storage::delete($article->image_path);
        }

        // Stocker la nouvelle image
        $path = $request->file('image')->store('images', 'public');
        $article->image_path = $path;
    }

    $article->save(); // Sauvegarder les modifications

    return redirect()->route('articles.index')->with('success', 'Article mis à jour avec succès.');
}
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article supprimé avec succès.');
    }


    public function userArticles()
{
    $articles = Article::where('user_id', auth()->id())->paginate(9); // Récupérer les articles de l'utilisateur connecté
    return view('articles.user', compact('articles')); // Retourner la vue avec les articles de l'utilisateur
}

}