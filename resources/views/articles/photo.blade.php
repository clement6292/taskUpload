@extends('layouts.template')

@section('content')
    <div class="container mx-auto my-8">
        <div class="bg-gray-800 text-gray-700 rounded-lg shadow-lg">
            <h4 class="text-lg font-bold p-4 border-b border-gray-700">Envoi d'une photo</h4>
            <div class="p-6">
                <form action="{{ url('photo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium">Choisissez une image :</label>
                        <input class="mt-1 block w-full p-2 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:ring focus:ring-blue-500 @error('image') border-red-500 @enderror" 
                               type="file" id="image" name="image" required>
                        @error('image')
                            <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 textblack font-semibold py-2 rounded-md transition duration-150 ease-in-out">Envoyer !</button>
                </form>
            </div>
        </div>
    </div>
@endsection