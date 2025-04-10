<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ShopEase') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Flash Message Styles */
        .flash-container {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 50;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            width: 20rem;
            /* Fixed width for consistency */
        }

        .flash-message {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(8px);
            background: rgba(255, 255, 255, 0.1);
            /* Glassmorphism effect */
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .flash-message.show {
            opacity: 1;
            transform: translateX(0);
        }

        .flash-message.closing {
            opacity: 0;
            transform: translateX(100%);
        }

        /* Success Message */
        .flash-success {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.9), rgba(22, 163, 74, 0.8));
        }

        /* Info Message */
        .flash-info {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.9), rgba(37, 99, 235, 0.8));
        }

        /* Error Message */
        .flash-error {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.9), rgba(220, 38, 38, 0.8));
        }

        .flash-icon {
            flex-shrink: 0;
            width: 2rem;
            height: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            margin-right: 0.75rem;
        }

        .flash-content {
            flex: 1;
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        .flash-close {
            flex-shrink: 0;
            width: 1.5rem;
            height: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.8);
            transition: color 0.2s ease;
        }

        .flash-close:hover {
            color: white;
        }

        /* Progress Bar */
        .flash-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 0.25rem;
            background: rgba(255, 255, 255, 0.4);
            width: 0;
            transition: width 3s linear;
        }

        .flash-message.show .flash-progress {
            width: 100%;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @if (!request()->is('admin*'))
            @include('layouts.navigation')
        @endif

        <!-- Flash Messages -->
        <div class="flash-container">
            @if (session('success'))
                <div class="flash-message flash-success">
                    <div class="flash-icon">
                        <i class='bx bx-check-circle text-xl'></i>
                    </div>
                    <div class="flash-content">
                        {{ session('success') }}
                    </div>
                    <button class="flash-close" onclick="closeFlash(this.parentElement)">
                        <i class='bx bx-x text-xl'></i>
                    </button>
                    <div class="flash-progress"></div>
                </div>
            @endif

            @if (session('info'))
                <div class="flash-message flash-info">
                    <div class="flash-icon">
                        <i class='bx bx-info-circle text-xl'></i>
                    </div>
                    <div class="flash-content">
                        {{ session('info') }}
                    </div>
                    <button class="flash-close" onclick="closeFlash(this.parentElement)">
                        <i class='bx bx-x text-xl'></i>
                    </button>
                    <div class="flash-progress"></div>
                </div>
            @endif

            @if (session('error'))
                <div class="flash-message flash-error">
                    <div class="flash-icon">
                        <i class='bx bx-error-circle text-xl'></i>
                    </div>
                    <div class="flash-content">
                        {{ session('error') }}
                    </div>
                    <button class="flash-close" onclick="closeFlash(this.parentElement)">
                        <i class='bx bx-x text-xl'></i>
                    </button>
                    <div class="flash-progress"></div>
                </div>
            @endif
        </div>

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
            @stack('styles')
            @stack('scripts')
        </main>
    </div>

    <script>
        // Function to close flash message with animation
        function closeFlash(element) {
            element.classList.remove('show');
            element.classList.add('closing');
            setTimeout(() => {
                element.remove();
            }, 500); // Match the duration of the closing animation
        }

        // Automatically show and close flash messages
        document.addEventListener('DOMContentLoaded', () => {
            const flashMessages = document.querySelectorAll('.flash-message');
            flashMessages.forEach((message) => {
                // Show the message with animation
                setTimeout(() => {
                    message.classList.add('show');
                }, 10); // Slight delay for smooth entry

                // Auto-close after 3 seconds
                setTimeout(() => {
                    closeFlash(message);
                }, 3000);
            });
        });
    </script>
</body>

</html>
