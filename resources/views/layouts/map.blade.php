<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

    <!-- Scripts -->
        @livewireScripts

        <script src="{{ mix('js/app.js') }}"></script>
    </head>
    <body class="bg-light">
        <!-- Page Content -->
        <main class="wrapper">
            <x-navigation.side-menu/>
            <div class="content">
                <div class="sidemenu-control">
                    <div class="controls">
                        <button id="toggleSidemenu" onclick="window.SideMenu.toggle()" class="btn btn-link btn-sm text-black-50" style="outline: none; box-shadow: none"><i class="fas fa-3x fa-bars"></i></button>
                    </div>
                </div>

                <div class="page-content">
                    {{ $slot }}
                </div>
            </div>
        </main>

        @stack('modals')

        @stack('scripts')
    </body>
</html>
