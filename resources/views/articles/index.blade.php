@extends('layouts.template')

@section('title', 'Liste des Articles')

@section('content')

<h1 class="text-2xl text-center font-bold mb-4">Mes Articles</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

@foreach ($articles as $article)

<div class="bg-white border border-gray-200 rounded-lg shadow-md transition-transform transform hover:scale-105 flex">

@if ($article->image_path)

<div class="relative w-1/2">

<img src="{{ asset('storage/' . $article->image_path) }}" alt="Image de l'article" class="h-full w-full object-cover rounded-l-lg">

<div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-20 rounded-l-lg">

<h2 class="text-2xl font-semibold text-white">{{ $article->title }}</h2>

</div>

</div>

    <div class="flex-1 p-4 flex flex-col justify-between relative"> <!-- Ajout de relative ici -->
        <div>
            <p class="text-gray-700 mb-4">{{ $article->description }}</p>
        </div>
        <div class="mt-auto">
            <a href="{{ route('pdf.view', ['file' => asset('storage/' . $article->file_path), 'title' => $article->title, 'image' => $article->image_path]) }}" class="text-blue-500 hover:underline" target="_blank">Lire le PDF</a>
            
            <!-- Menu pour Éditer et Supprimer -->
            <div class="relative inline-block text-left "> 
                <div class=" inline-block">
                    <button type="button" onclick="toggleMenu(event, '{{ $article->id }}')" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        ⋮
                    </button>
                </div>
            
                <div id="menu-{{ $article->id }}" class="relative right-0 z-10 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden" role="menu" aria-orientation="vertical" aria-labelledby="options-menu " v-if="">
                    <div class="py-1" role="none">
                        <a href="{{ route('articles.edit', $article->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Éditer</a>
                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full text-left">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endforeach
</div>

<div class="mt-4">

{{ $articles->links() }} <!-- Affiche les liens de pagination -->

</div>

<script>

function toggleMenu(event, articleId) {

const menuId = 'menu-' + articleId;
console.log(menuId);

const menu = document.getElementById(menuId);


if (menu) {

menu.classList.toggle('hidden'); 

} else {

console.error('Menu not found:', menuId);

}

}

</script>

@endsection