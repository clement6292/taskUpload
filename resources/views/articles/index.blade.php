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

    <div class="flex-1 p-4 flex flex-col justify-between relative">
        <div>
            <p class="text-gray-700 mb-4">{{ $article->description }}</p>
        </div>
        <div class="mt-auto">
            <a href="{{ route('pdf.view', ['file' => asset('storage/' . $article->file_path), 'title' => $article->title, 'image' => $article->image_path]) }}" class="text-blue-500 text-2xl hover:underline" target="_blank">Lire</a>
            
            <!-- Menu pour Éditer et Supprimer -->
            <div class="relative inline-block text-left mt-4"> 
                <div class="inline-block">
                    <button type="button" onclick="toggleMenu(event, '{{ $article->id }}')" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        ⋮
                    </button>
                </div>
            
                <div id="menu-{{ $article->id }}" class="relative right-0 z-10 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden" role="menu" aria-orientation="vertical">
                    <div class="py-1" role="none">
                        <a href="{{ route('articles.edit', $article->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Éditer</a>
                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" data-article-id="{{ $article->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="showConfirmationModal(event, '{{ $article->id }}')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Supprimer</button>
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

<!-- Modal de Confirmation -->
<div id="confirmation-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="bg-white rounded-lg p-6 w-1/3">
        <h2 class="text-lg font-bold mb-4">Confirmation</h2>
        <p>Êtes-vous sûr de vouloir supprimer cet article ?</p>
        <div class="mt-4 flex justify-end">
            <button id="cancel-btn" class="mr-2 px-4 py-2 bg-gray-300 rounded">Annuler</button>
            <button id="confirm-btn" class="px-4 py-2 bg-red-600 text-white rounded">Supprimer</button>
        </div>
    </div>
</div>

<script>
    let openMenuId = null;
    let currentDeleteForm = null;

    function toggleMenu(event, articleId) {
        const menuId = 'menu-' + articleId;
        const menu = document.getElementById(menuId);    
        if (openMenuId && openMenuId !== menuId) {
            // Fermer le menu ouvert précédemment
            document.getElementById(openMenuId).classList.add('hidden');
        }
    
        if (menu) {
            const isHidden = menu.classList.contains('hidden');
            menu.classList.toggle('hidden', !isHidden);
            openMenuId = isHidden ? menuId : null;
        } else {
            console.error('Menu not found:', menuId);
        }
    
        // Empêche la propagation du clic sur le bouton
        event.stopPropagation();
    }
    
    // Fermer le menu si on clique en dehors
    document.addEventListener('click', function(event) {
        if (openMenuId) {
            const openMenu = document.getElementById(openMenuId);
            if (openMenu && !openMenu.contains(event.target)) {
                openMenu.classList.add('hidden');
                openMenuId = null; // Réinitialiser l'ID du menu ouvert
            }
        }
    });

    // Afficher le modal de confirmation
    function showConfirmationModal(event, articleId) {
        event.preventDefault();
        currentDeleteForm = document.querySelector(`form[data-article-id="${articleId}"]`); 
        console.log(currentDeleteForm); // Vérifiez ici
        document.getElementById('confirmation-modal').classList.remove('hidden');
    }

    // Confirmer la suppression
    document.getElementById('confirm-btn').addEventListener('click', function() {
        if (currentDeleteForm) {
            currentDeleteForm.submit(); // Soumettre le formulaire
        }
    });

    // Fermer le modal
    document.getElementById('cancel-btn').addEventListener('click', function() {
        document.getElementById('confirmation-modal').classList.add('hidden');
    });
</script>

@endsection