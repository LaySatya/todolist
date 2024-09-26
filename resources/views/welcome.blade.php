<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        {{-- Tailwind Css --}}
        @vite('resources/css/app.css') 

    </head>
    <body>
        <h1 class="text-blue-500">Hello Laravel and Tailwind Css</h1>
        <!-- Open the modal using ID.showModal() method -->
<button class="btn" onclick="my_modal_1.showModal()">open modal</button>

    </body>
</html>
