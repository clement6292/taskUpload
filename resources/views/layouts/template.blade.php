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
        @if (!request()->is('login') && !request()->is('register'))
            <header class="mb-8 site">
                <h1 class="text-3xl text-center font-bold text-indigo-700">Mon Site d'Articles</h1>
                <nav class="mt-4 text-2xl text-end font-bold p-4 bg-amber-300">
                    <a href="{{ url('/articles') }}"
                        class="text-indigo-600 hover:text-indigo-800 transition duration-200">Articles</a>
                    <a href="{{ route('articles.create') }}"
                        class="text-indigo-600 hover:text-indigo-800 transition duration-200 ml-6">Créer un Article</a>

                    @if (Auth::check())
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="inline-flex items-center border border-t-red-600 text-red-600 hover:text-indigo-800 transition duration-100 ml-12">
                            <!-- Icône de déconnexion en SVG -->
                            <svg width="50px" height="50px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                fill="none">
                                <path fill="#000000" fill-rule="evenodd"
                                    d="M6 2a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5a3 3 0 0 0-3-3H6zm10.293 5.293a1 1 0 0 1 1.414 0l4 4a1 1 0 0 1 0 1.414l-4 4a1 1 0 0 1-1.414-1.414L18.586 13H10a1 1 0 1 1 0-2h8.586l-2.293-2.293a1 1 0 0 1 0-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            Déconnexion
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-indigo-600 hover:text-indigo-800 transition duration-200 ml-6">Connexion</a>
                    @endif
                </nav>
            </header>
        @endif

        <main class="bg-white rounded-lg shadow-md p-6">
            @yield('content') <!-- Section pour le contenu spécifique des pages -->
            <script src="{{ asset('js/gsap-animations.js') }}"></script>
        </main>
    </div>

    @vite('resources/js/app.js') <!-- Charger le JS compilé avec Vite, si nécessaire -->
</body>

</html>
