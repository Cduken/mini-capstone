@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge([
        'class' =>
            'border-gray-700 bg-gray-800/80 text-white placeholder-gray-500 focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-md transition duration-200' .
            ($disabled ? ' opacity-60 cursor-not-allowed' : ''),
    ]) }}>
