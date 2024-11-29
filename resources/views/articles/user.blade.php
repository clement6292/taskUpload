@extends('layouts.template')

@section('title', 'Mes Articles')

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
                        
                        <!-- Liens d'édition et de suppression -->
                        <div class="flex justify-between mt-4">
                            <a href="{{ route('articles.edit', $article->id) }}" class="text-yellow-500 hover:underline">Éditer</a>
                            <button onclick="confirmDelete('{{ $article->id }}', '{{ $article->title }}')" class="text-red-500 hover:underline">Supprimer</button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endforeach
</div>

<div class="mt-4">
    {{ $articles->links() }} <!-- Pagination -->
</div>

<script>
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