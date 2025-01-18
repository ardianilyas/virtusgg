<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('logo.svg') }}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&display=swap" rel="stylesheet">

    @vite(['resources/js/app.js', 'resources/css/app.css'])
    @inertiaHead
    @routes
    <title>Virtus.gg</title>
</head>
<style>
    body {
        font-family: "Bricolage Grotesque", serif;
    }
</style>
<body class="bg-neutral-100 antialiased">
    @inertia
</body>
</html>
