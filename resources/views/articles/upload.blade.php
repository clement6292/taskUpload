@extends('layouts.template')

@section('title', 'Uploader un Article')

@section('content')
    <div class="container mx-auto my-8 p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl text-center font-bold mb-6 text-gray-800">Formulaire de création d'articles</h2>
        <form action="{{ route('articles.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700">Titre :</label>
                <input type="text" name="title" id="title" class="mt-1 block w-full p-3 bg-gray-100 text-gray-800 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300" required>
            </div>
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700">Description :</label>
                <textarea name="description" id="description" rows="4" class="mt-1 block w-full p-3 bg-gray-100 text-gray-800 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300"></textarea>
            </div>
            <div class="mb-6">
                <label for="file" class="block text-sm font-medium text-gray-700">Fichier PDF :</label>
                <input type="file" name="file" id="file" class="mt-1 block w-full p-3 bg-gray-100 text-gray-800 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300" required>
            </div>
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700">Image :</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full p-3 bg-gray-100 text-gray-800 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300">
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold py-3 rounded-md transition duration-150 ease-in-out">Ajouter l'Article</button>
        </form>
    </div>
@endsection