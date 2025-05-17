<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title inertia>Curotec tecnical assignment</title>
    <link rel="icon" href="https://www.curotec.com/wp-content/uploads/2023/10/cropped-curotec-favicon.png?w=32"
        sizes="32x32">
    <link rel="icon" href="https://www.curotec.com/wp-content/uploads/2023/10/cropped-curotec-favicon.png?w=192"
        sizes="192x192">

    @vite('resources/js/app.ts')
    @inertiaHead
</head>

<body>
    @inertia
</body>

</html>