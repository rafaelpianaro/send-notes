<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div
            class="relative flex items-center justify-center min-h-screen bg-gray-100 bg-center bg-dots-darker dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            
            @if (Route::has('login'))
                <div class="absolute top-4 right-4">
                    <livewire:welcome.navigation />
                </div>
            @endif
    
            <!-- Conteúdo Principal -->
            <div 
                class="flex flex-col items-center justify-center max-w-screen-sm p-4 mx-auto space-y-6 text-center sm:max-w-screen-md lg:max-w-7xl lg:p-8">
                
                <!-- Logotipo -->
                <x-application-logo class="w-20 h-20 fill-current sm:w-24 sm:h-24 text-primary" />
                
                <!-- Botão -->
                <x-mary-button 
                    primary 
                    xl 
                    href="{{ route('register') }}" 
                    class="w-full sm:w-auto bg-primary text-base-100 hover:bg-primary/90">
                    Começar
                </x-mary-button>

                {{-- <x-mary-button label="You?" class="btn-error btn-sm" /> --}}
    
                <!-- Texto de boas-vindas -->
                <h1 class="text-2xl font-bold text-secondary sm:text-3xl">Bem-vindo ao Notes!</h1>
            </div>
        </div>
    </body>
</html>
