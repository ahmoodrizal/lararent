<!doctype html>
<!-- dir="rtl" for RTL support -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Inter web font from bunny.net (GDPR compliant) -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@400;500;600;700&family=Inknut+Antiqua:wght@300;400;500;600;700;800;900&family=Raleway:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS Play CDN (mainly for development/testing purposes) -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>

    <!-- Tailwind CSS v3 Configuration -->
    <script>
        const defaultTheme = tailwind.defaultTheme;
        const colors = tailwind.colors;
        const plugin = tailwind.plugin;

        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    fontFamily: {
                        sans: ["Inter", ...defaultTheme.fontFamily.sans],
                    },
                },
            },
        };
    </script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Alpine.js (x-cloak - https://alpinejs.dev/directives/cloak) -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Scripts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div x-data="{ userDropdownOpen: false, notificationsDropdownOpen: false, mobileNavOpen: false }">
        <!-- Page Container -->
        <div id="page-container" class="mx-auto flex min-h-screen w-full min-w-[320px] flex-col bg-white lg:pt-20">
            <!-- Page Header -->
            <header id="page-header"
                class="z-50 flex items-center flex-none border-b border-neutral-200/75 bg-white/90 backdrop-blur-sm lg:fixed lg:end-0 lg:start-0 lg:top-0 lg:h-20">
                @include('layouts.header')
            </header>
            <!-- END Page Header -->

            <!-- Page Content -->
            <main id="page-content" class="flex flex-col flex-auto max-w-full">
                @yield('content')
            </main>
            <!-- END Page Content -->

            <!-- Page Footer -->
            {{-- @include('layouts.footer') --}}
            <!-- END Page Footer -->
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
        <!-- END Page Container -->
    </div>
</body>

</html>
