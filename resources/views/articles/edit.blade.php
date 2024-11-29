@extends('layouts.template')

@section('title', 'Éditer l\'Article')

@section('content')
<div class="container mx-auto my-8 p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6">Éditer l'Article</h2>

    @if ($errors->any())
        <div class="mb-6">
            <ul class="text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="title" class="block text-sm font-medium text-gray-700">Titre :</label>
            <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}" class="mt-1 block w-full p-3 bg-gray-100 text-gray-800 border border-gray-300 rounded-md" required>
        </div>

        <div class="mb-6">
            <label for="description" class="block text-sm font-medium text-gray-700">Description :</label>
            <textarea name="description" id="description" rows="4" class="mt-1 block w-full p-3 bg-gray-100 text-gray-800 border border-gray-300 rounded-md" required>{{ old('description', $article->description) }}</textarea>
        </div>

        <div class="mb-6">
            <label for="image" class="block text-sm font-medium text-gray-700">Image :</label>
            <input type="file" name="image" id="image" class="mt-1 block w-full p-3 bg-gray-100 text-gray-800 border border-gray-300 rounded-md">
            @if ($article->image_path)
                <div class="mt-4">
                    <p class="text-sm text-gray-600">Image actuelle :</p>
                    <img src="{{ asset('storage/' . $article->image_path) }}" alt="Image de l'article" class="mt-2 rounded-md" style="max-width: 200px;">
                </div>
            @endif
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold py-3 rounded-md">Mettre à jour l'Article</button>
    </form>
</div>

@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Succès !',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif
@endsection