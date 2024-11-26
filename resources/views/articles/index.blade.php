@extends('layouts.template')

@section('title', 'Liste des Articles')

@section('content')
<h1 class="text-2xl text-center font-bold mb-4">Mes Articles</h1>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($articles as $article)
        <div class="bg-white border border-gray-200 rounded-lg shadow-md transition-transform transform hover:scale-105 flex">
    @if ($article->image_path)
    <div class="bg-white border border-gray-200 rounded-lg shadow-md transition-transform transform hover:scale-105 flex">
        @if ($article->image_path)
            <div class="relative w-1/2">
                <img src="{{ asset('storage/' . $article->image_path) }}" alt="Image de l'article" class="h-full w-full object-cover rounded-l-lg">
                <div class="absolute inset-0 flex  items-center justify-center bg-black bg-opacity-20 rounded-l-lg">
                    <h2 class="text-2xl  font-semibold text-white ">{{ $article->title }}</h2>
                </div>
            </div>
        @endif
    
        <div class="flex-1 p-4 flex flex-col justify-between">
            <div>
                <p class="text-gray-700 mb-4">{{ $article->description }}</p>
            </div>
            <div class="mt-auto">
                <a href="{{ route('pdf.view', ['file' => asset('storage/' . $article->file_path), 'title' => $article->title, 'image' => $article->image_path]) }}" class="text-blue-500 hover:underline" target="_blank">Lire le PDF</a>
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
@endsection