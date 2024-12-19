{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIARDIKU - Sistem Arsip Digital Keuangan</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm fixed w-full z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="/" class="flex items-center">
                            <x-application-logo class="w-16 h-16 sm:w-20 sm:h-20 fill-current text-gray-500" />
                        </a>
                        <h2 class="text-xl ml-2 font-bold text-gray-900">SIARDIKU</h2>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="ml-6">
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            Masuk
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="h-screen flex items-center bg-gradient-to-br from-blue-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 sm:text-5xl md:text-6xl">
                        Sistem Arsip Digital
                        <span class="text-blue-600">Keuangan</span>
                    </h1>
                    <p class="mt-3 text-base text-gray-600 sm:mt-5 sm:text-lg sm:max-w-xl">
                        Kelola dokumen keuangan Anda dengan lebih efisien. SIARDIKU membantu Anda mengorganisir,
                        menyimpan, dan mengelola arsip keuangan secara digital dengan aman.
                    </p>
                </div>
                <div class="mt-12 lg:mt-0">
                    <img src="{{ asset('img/Scenes05.svg') }}" alt="SIARDIKU Preview">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-gray-400">&copy; 2024 SIARDIKU. Powered by Politeknik STIA LAN Makassar</p>
            </div>
        </div>
    </footer>
</body>

</html>
