<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Expense Tracker</title>

        @fonts

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
             <script src="https://cdn.tailwindcss.com"></script>
        @endif
        @livewireStyles
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <header class="mb-12">
                <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                    Expense Tracker
                </h1>
                <p class="mt-2 text-lg text-gray-600 dark:text-[#A1A09A]">
                    Manage your finances with ease and AI-powered receipt processing.
                </p>
            </header>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Sidebar: Expense Form -->
                <div class="lg:col-span-1">
                    @livewire('⚡expense-form')
                </div>

                <!-- Main Content: Dashboard -->
                <div class="lg:col-span-2">
                    @livewire('⚡expense-dashboard')
                </div>
            </div>
        </div>

        @livewireScripts
    </body>
</html>
