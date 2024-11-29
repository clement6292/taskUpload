<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        // Récupérer tous les articles ou des informations pertinentes pour le tableau de bord
        $articles = Article::all(); // Vous pouvez filtrer selon vos besoins
        return view('user.dashboard', compact('articles'));
    }

    public function myArticles()
    {
        // Récupérer uniquement les articles de l'utilisateur connecté
        $articles = Article::where('user_id', auth()->id())->get();
        return view('user.my_articles', compact('articles'));
    }
}