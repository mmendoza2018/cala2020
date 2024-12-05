@props(['type' => 'submit', 'description' => 'Button', 'btn' => false, 'color' => 'primary'])

@php
    // Define las clases basadas en el tipo y la configuración alternativa
    $classes = [
        'primary' => [
            'default' =>
                'bg-custom-500 border-custom-500 text-white hover:bg-custom-600 hover:border-custom-600 focus:bg-custom-600 focus:border-custom-600 active:bg-custom-600 active:border-custom-600 active:ring-custom-100 focus:ring-custom-100 dark:ring-custom-400/20',
            'alternative' =>
                'text-custom-500 bg-white border-custom-500 btn hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:bg-zink-700 dark:hover:bg-custom-500 dark:ring-custom-400/20 dark:focus:bg-custom-500',
        ],
        'success' => [
            'default' =>
                'bg-green-500 border-green-500 text-white hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 active:bg-green-600 active:border-green-600 active:ring-green-100 focus:ring-green-100 dark:ring-green-400/20',
            'alternative' =>
                'text-green-500 bg-white border-green-500 btn hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-100 active:text-white active:bg-green-600 active:border-green-600 active:ring active:ring-green-100 dark:bg-zink-700 dark:hover:bg-green-500 dark:ring-green-400/20 dark:focus:bg-green-500',
        ],
        'warning' => [
            'default' =>
                'bg-yellow-500 border-yellow-500 text-white hover:bg-yellow-600 hover:border-yellow-600 focus:bg-yellow-600 focus:border-yellow-600 active:bg-yellow-600 active:border-yellow-600 active:ring-yellow-100 focus:ring-yellow-100 dark:ring-yellow-400/20',
            'alternative' =>
                'text-yellow-500 bg-white border-yellow-500 btn hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:bg-zink-700 dark:hover:bg-yellow-500 dark:ring-yellow-400/20 dark:focus:bg-yellow-500',
        ],
        'danger' => [
            'default' =>
                'bg-red-500 border-red-500 text-white hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:border-red-600 active:bg-red-600 active:border-red-600 active:ring-red-100 focus:ring-red-100 dark:ring-red-400/20',
            'alternative' =>
                'text-red-500 bg-white border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:bg-zink-700 dark:hover:bg-red-500 dark:ring-red-400/20 dark:focus:bg-red-500',
        ],
        'secondary' => [
            'default' =>
                'bg-slate-500 text-white border-slate-500 hover:bg-slate-600 hover:border-slate-600 focus:bg-slate-600 focus:border-slate-600 active:bg-slate-600 active:border-slate-600 active:ring-slate-100 focus:ring-slate-100 dark:ring-slate-400/20',
            'alternative' =>
                'text-slate-500 bg-white border-slate-500 btn hover:text-white hover:bg-slate-600 hover:border-slate-600 focus:text-white focus:bg-slate-600 focus:border-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:border-slate-600 active:ring active:ring-slate-100 dark:bg-zink-700 dark:hover:bg-slate-500 dark:ring-slate-400/20 dark:focus:bg-slate-500',
        ],
    ];

    // Selecciona las clases correspondientes basadas en el tipo y si se usa la configuración alternativa
    $class =
        $outline && isset($classes[$color]['alternative'])
            ? $classes[$color]['alternative']
            : $classes[$color]['default'] ?? $classes['primary']['default'];
@endphp

<button type="{{ $type }}"
    {{ $attributes->merge(['class' => "btn hover:text-white focus:text-white focus:ring active:text-white active:ring $class"]) }}>
    {{ $description }}
</button>
