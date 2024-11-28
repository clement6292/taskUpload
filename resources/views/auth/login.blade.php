@extends('layouts.template')

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <form method="POST" action="{{ route('login') }}" class="max-w-md w-full p-8 bg-gradient-to-r from-indigo-500 to-blue-500 shadow-lg rounded-lg">
        @csrf
        <h2 class="text-3xl font-bold text-white text-center mb-6">Connexion</h2>

        @if (session('success'))
            <div class="mb-4 text-green-200 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4">
            <label for="email" class="block text-sm font-bold text-white">Email</label>
            <input type="email" name="email" required class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" placeholder="Entrez votre email">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-bold text-white">Mot de passe</label>
            <input type="password" name="password" required class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" placeholder="Entrez votre mot de passe">
        </div>

        <button type="submit" class="w-full bg-red-600 text-white font-semibold py-2 rounded-md hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-blue-300">
            Se connecter
        </button>

        <div class="mt-4 text-center">
            <p class="text-sm text-gray-200">
                Vous n'avez pas encore de compte ? 
                <a href="{{ route('register') }}" class="text-lime-400 hover:underline text-l">Inscrivez-vous ici</a>
            </p>
        </div>

        @if ($errors->any())
            <div class="mt-4 text-red-200 text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
</div>
@endsection