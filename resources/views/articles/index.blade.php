@extends('layouts.template')

@section('title', 'Liste des Articles')

@section('content')

<h1 class="text-2xl text-center font-bold mb-4">Tous les articles</h1>

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
                    <button type="button" onclick="toggleMenu(event, '{{ $article->id }}')" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 point">
                        ⋮
                    </button>
                </div>
            
                <div id="menu-{{ $article->id }}" class="relative right-0 z-10 mt-2 w-56 rounded-md 
                    shadow-lg ring-1 ring-black bg-gray-300 ring-opacity-5 hidden"
                     role="menu" aria-orientation="vertical">
                    <div class="py-1" role="none">
                        <a href="{{ route('articles.edit', $article->id) }}" class="block px-4 py-2 text-sm text-gray-700" >Éditer</a>
                        <button type="button" onclick="confirmDelete('{{ $article->id }}', '{{ $article->title }}')" class="block px-4 py-2 text-sm text-gray-700 ">Supprimer</button>
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
    let openMenuId = null;

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

    // Afficher la confirmation de suppression avec SweetAlert
    function confirmDelete(articleId, articleTitle) {
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: `Vous allez supprimer "${articleTitle}". Cette action est irréversible.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui, supprimer !',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                // Créer un formulaire pour supprimer l'article
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/articles/' + articleId; // Lien vers la route de suppression

                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}'; // CSRF token

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE'; // Méthode de la requête

                form.appendChild(csrfInput);
                form.appendChild(methodInput);
                document.body.appendChild(form);
                form.submit(); // Soumettre le formulaire
            }
        });
    }
</script>

@endsection