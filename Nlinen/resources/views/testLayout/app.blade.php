<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">

        <!-- เมนูหลัก -->


        <!-- เนื้อหาหลัก -->
        <div class="container mt-3">
            @yield('content')
        </div>
    </div>

</body>

</html>
