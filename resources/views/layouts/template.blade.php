<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mon Site')</title>
    @vite('resources/css/app.css') <!-- Charger le CSS compilé avec Vite -->
    @vite(['resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="container mx-auto p-6">
        <header class="mb-8 site">
            <h1 class="text-3xl text-center font-bold text-indigo-700 ">Mon Site d'Articles</h1>
            <nav class="mt-4 text-2xl text-end font-bold p-4 bg-amber-300">
                <a href="{{ url('/articles') }}" class="text-indigo-600 hover:text-indigo-800 transition duration-200">Articles</a>
                <a href="{{ route('articles.create') }}" class="text-indigo-600 hover:text-indigo-800 transition duration-200 ml-6">Créer un Article</a>
            </nav>
        </header>

        <main class="bg-white rounded-lg shadow-md p-6">
            @yield('content') <!-- Section pour le contenu spécifique des pages -->
            <script src="{{ asset('js/gsap-animations.js') }}"></script>
        </main>
    </div>

    @vite('resources/js/app.js') <!-- Charger le JS compilé avec Vite, si nécessaire -->
</body>
</html>
<script>


</script>