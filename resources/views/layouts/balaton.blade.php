<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Balatoni hajók</title>
    <style>
        body { margin: 0; font-family: system-ui, sans-serif; background: #f3f7fa; color: #173047; }
        .container { max-width: 1100px; margin: 0 auto; padding: 1rem; }
        header { background: #103b58; color: white; }
        header nav { display: flex; flex-wrap: wrap; gap: 1rem; align-items: center; }
        header a, header button { color: inherit; }
        header form { margin: 0; }
        header button { background: none; border: 0; padding: 0; font: inherit; text-decoration: underline; cursor: pointer; }
        a[aria-current="page"] { font-weight: bold; }
        main { min-height: 55vh; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: .65rem; border-bottom: 1px solid #d6e1e9; text-align: left; }
        main nav { display: flex; flex-wrap: wrap; gap: 1rem; margin-top: 1rem; }
        footer { border-top: 1px solid #d6e1e9; }
    </style>
</head>
<body>
    <header>
        <nav class="container" aria-label="Főmenü">
            <a href="{{ route('home') }}" @if (request()->routeIs('home')) aria-current="page" @endif>
                Főoldal
            </a>
            <a href="{{ route('adatbazis') }}" @if (request()->routeIs('adatbazis')) aria-current="page" @endif>
                Adatbázis
            </a>

            <a href="{{ route('kapcsolat') }}" @if (request()->routeIs('kapcsolat')) aria-current="page" @endif>
                 Kapcsolat
            </a>

            <a href="{{ route('diagram') }}" @if (request()->routeIs('diagram')) aria-current="page" @endif>
                 Diagram
            </a>
            @guest
                <a href="{{ route('login') }}">Bejelentkezés</a>
                <a href="{{ route('register') }}">Regisztráció</a>
            @else
                <a href="{{ route('uzenetek') }}" @if (request()->routeIs('uzenetek')) aria-current="page" @endif>
                    Üzenetek
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Kijelentkezés</button>
                </form>
            @endguest
        </nav>
    </header>

    <main class="container">
        @yield('content')
    </main>

    <footer>
        <div class="container">Készítő · Kun Mihály (VFHZPB)</div>
    </footer>
</body>
</html>