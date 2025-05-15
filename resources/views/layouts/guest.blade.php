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
            background: linear-gradient(135deg, #1a1a20 0%, #262630 100%);
        }

        .card-shadow {
            box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.4), 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        }

        .input-focus:focus {
            border-color: #a855f7;
            box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.25);
        }

        .purple-glow {
            filter: blur(80px);
            opacity: 0.15;
            background: #a855f7;
        }

        .purple-accent {
            background: linear-gradient(to right, #a855f7, #d580ff);
        }
    </style>
</head>

<body class="font-sans text-gray-300 antialiased">
    <div class="min-h-screen bg-auth-gradient flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute top-40 right-20 w-64 h-64 rounded-full purple-glow"></div>
            <div class="absolute -bottom-20 -left-20 w-96 h-96 rounded-full purple-glow"></div>
            <div class="absolute top-1/4 left-1/3 w-32 h-32 rounded-full bg-gray-800 opacity-30"></div>
        </div>

        <div class="w-full sm:max-w-md px-6 py-8 relative z-10">
            <!-- Logo at the top -->
            <div class="mb-8 flex justify-center">
                <div class="flex items-center gap-1">
                    <box-icon name='cube-alt' color="purple" size="md" class="h-7 w-7 animate-spin"></box-icon>

                    <span class="text-xl font-sans">
                        <span class="font-semibold text-white">Shop</span><span class="font-thin text-white">Ease</span>
                    </span>
                </div>
            </div>

            <div class="bg-gray-900/90 backdrop-blur-sm rounded-xl card-shadow overflow-hidden border border-gray-800">
                <!-- Purple accent line at top -->
                <div class="h-1 w-full purple-accent"></div>

                <div class="px-8 py-6">
                    <!-- Card header with decorative element -->
                    <div class="mb-6 relative">
                        <div class="absolute -left-8 top-0 w-1 h-full purple-accent rounded-r"></div>
                        <h2 class="text-xl font-semibold text-white">
                            @if (Request::is('login'))
                                <div class="flex items-center">
                                    <i class='bx bx-log-in-circle align-middle mr-2'></i>
                                    Sign In
                                </div>
                            @elseif(Request::is('register'))
                                <i class='bx bx-user-plus align-middle mr-2'></i> Create Account
                            @elseif(Request::is('forgot-password'))
                                <i class='bx bx-key align-middle mr-2'></i> Reset Password
                            @else
                                {{ $title ?? '' }}
                            @endif
                        </h2>
                        <p class="text-sm text-gray-400 mt-1">
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
                    <div class="px-8 py-4 bg-gray-800/50 border-t border-gray-800 text-center text-sm text-gray-400">
                        New to our platform? <a href="{{ route('register') }}"
                            class="text-purple-400 hover:text-purple-300 font-medium">Create an account</a>
                    </div>
                @endif
            </div>

            <!-- Footer links -->
            {{-- <div class="mt-4 text-center text-sm text-gray-500">
                <a href="#" class="hover:text-gray-300 transition duration-150">Terms of Service</a>
                <span class="mx-2">•</span>
                <a href="#" class="hover:text-gray-300 transition duration-150">Privacy Policy</a>
            </div> --}}
        </div>
    </div>
</body>

</html>
