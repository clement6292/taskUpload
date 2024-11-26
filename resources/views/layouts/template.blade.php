<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mon Site')</title>
    @vite('resources/css/app.css') <!-- Charger le CSS compilé avec Vite -->
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <header class="mb-6">
            <h1 class="text-2xl font-bold">Mon Site d'Articles</h1>
            <nav class="mt-2">
                <a href="{{ url('/articles') }}" class="text-blue-500 hover:underline">Articles</a>
                <a href="{{ route('articles.create') }}" class="text-blue-500 hover:underline ml-4">Uploader un Article</a>
            </nav>
        </header>

        <main>
            @yield('content') <!-- Section pour le contenu spécifique des pages -->
        </main>

        <footer class="mt-6 text-center">
            <p>&copy; {{ date('Y') }} Mon Site</p>
        </footer>
    </div>

    @vite('resources/js/app.js') <!-- Charger le JS compilé avec Vite, si nécessaire -->
</body>
</html>