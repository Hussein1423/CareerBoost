<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') ?? 'My Application' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-... your integrity key ..." crossorigin="anonymous" />

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    @vite(['resources/css/app.css', 'resources/js/app.js'])




    @stack('cssContent')


</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    @if (!Route::is('congrats'))
        @include('livewire.careerAI.shared.nav')
    @endif



    <div class="flex-grow-1">
        {{ $slot }}
    </div>

    @if (!Route::is('generateQuestines'))
        <footer class="footer bg-dark text-light py-4 mt-auto">
            <div class="container">
                <div class="row text-center">
                    <!-- Copyright Text -->
                    <div class="col-12 mb-3">
                        <p class="mb-0">© 2025 CareerAI. جميع الحقوق محفوظة.</p>
                        <p class="mb-0">صُمم لمساعدتك على النجاح في حياتك المهنية.</p>
                    </div>

                    <!-- Social Media Icons -->
                    <div class="col-12">
                        <a href="#" class="text-light ms-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-light ms-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-light ms-3"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </footer>
    @endif

    <!-- Bootstrap 5 JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
