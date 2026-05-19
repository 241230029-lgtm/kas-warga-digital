<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kas Warga Digital</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    <!-- Icon -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .gradient-bg {
            background:
            radial-gradient(circle at top left, rgba(16,185,129,0.14), transparent 28%),
            radial-gradient(circle at bottom right, rgba(14,165,233,0.16), transparent 28%);
        }
    </style>
</head>

<body class="min-h-screen bg-slate-950 text-slate-100 flex flex-col">
    <main class="flex-1">
        @yield('content')
    </main>
</body>
</html>
