<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ShopEase') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Box Icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .bg-auth-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-shadow {
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .input-focus:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
        }
    </style>
</head>

<body class="font-sans text-gray-800 antialiased">
    <div class="min-h-screen bg-auth-gradient flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <!-- Animated background elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-32 h-32 rounded-full bg-white opacity-10"></div>
            <div class="absolute bottom-10 right-10 w-64 h-64 rounded-full bg-white opacity-5"></div>
            <div class="absolute top-1/3 right-20 w-16 h-16 rounded-full bg-white opacity-15"></div>
        </div>

        <div class="w-full sm:max-w-md px-6 py-8 relative z-10">
            <!-- Logo with icon -->
            {{-- <div class="text-center mb-8">
                <a href="/" class="inline-flex flex-col items-center">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-lg mb-3">
                        <i class='bx bxs-shield-alt text-2xl text-indigo-600'></i>
                    </div>
                    <h1 class="text-2xl font-bold text-white">{{ config('app.name', 'Laravel') }}</h1>
                </a>
            </div> --}}

            <!-- Card -->
            <div class="bg-white rounded-xl card-shadow overflow-hidden " >
                <div class="px-8 py-6">
                    <!-- Card header with decorative element -->
                    <div class="mb-6 relative">
                        <div
                            class="absolute -left-8 top-0 w-1 h-full bg-gradient-to-b from-indigo-500 to-purple-600 rounded-r">
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800">
                            @if (Request::is('login'))
                                <i class='bx bx-log-in-circle align-middle mr-2'></i> Welcome Back
                            @elseif(Request::is('register'))
                                <i class='bx bx-user-plus align-middle mr-2'></i> Create Account
                            @elseif(Request::is('forgot-password'))
                                <i class='bx bx-key align-middle mr-2'></i> Reset Password
                            @else
                                {{ $title ?? '' }}
                            @endif
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">
                            @if (Request::is('login'))
                                Please sign in to continue
                            @elseif(Request::is('register'))
                                Join us today
                            @elseif(Request::is('forgot-password'))
                                Enter your email to reset password
                            @endif
                        </p>
                    </div>

                    <!-- Content slot -->
                    {{ $slot }}
                </div>

                <!-- Card footer -->
                @if (Request::is('login'))
                    <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 text-center text-sm text-gray-500">
                        New to our platform? <a href="{{ route('register') }}"
                            class="text-indigo-600 hover:text-indigo-800 font-medium">Create an account</a>
                    </div>
                {{-- @elseif(Request::is('register'))
                    <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 text-center text-sm text-gray-500">
                        Already have an account? <a href="{{ route('login') }}"
                            class="text-indigo-600 hover:text-indigo-800 font-medium">Sign in here</a>
                    </div> --}}
                @endif
            </div>

            <!-- Footer links -->
            <div class="mt-6 text-center text-sm text-white opacity-80">
                <a href="#" class="hover:underline">Terms of Service</a>
                <span class="mx-2">•</span>
                <a href="#" class="hover:underline">Privacy Policy</a>
            </div>
        </div>
    </div>
</body>

</html>
