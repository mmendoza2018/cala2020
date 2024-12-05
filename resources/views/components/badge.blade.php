@props(['color' => 'custom', 'description' => 'Custom', 'badge' => false])

@php
    // Define las clases basadas en el tipo y la configuración alternativa
    $labelClasses = [
        'custom' => [
            'default' =>
                'bg-custom-100 border-transparent text-custom-500 dark:bg-custom-500/20 dark:border-transparent',
            'alternative' => 'bg-custom-500 border-custom-500 text-custom-50',
        ],
        'success' => [
            'default' => 'bg-green-100 border-transparent text-green-500 dark:bg-green-500/20 dark:border-transparent',
            'alternative' => 'bg-green-500 border-green-500 text-green-50',
        ],
        'warning' => [
            'default' =>
                'bg-yellow-100 border-transparent text-yellow-500 dark:bg-yellow-500/20 dark:border-transparent',
            'alternative' => 'bg-yellow-500 border-yellow-500 text-yellow-50',
        ],
        'danger' => [
            'default' => 'bg-red-100 border-transparent text-red-500 dark:bg-red-500/20 dark:border-transparent',
            'alternative' => 'bg-red-500 border-red-500 text-red-50',
        ],
        'secondary' => [
            'default' => 'bg-slate-100 border-transparent text-slate-500 dark:bg-slate-500/20 dark:border-transparent',
            'alternative' => 'bg-slate-500 border-slate-500 text-slate-50',
        ],
    ];

    // Selecciona las clases correspondientes basadas en el tipo y si se usa la configuración alternativa
    $labelClass =
        $outline && isset($labelClasses[$color]['alternative'])
            ? $labelClasses[$color]['alternative']
            : $labelClasses[$color]['default'] ?? $labelClasses['custom']['default'];
@endphp

<span
    {{ $attributes->merge(['class' => "px-2.5 py-0.5 inline-block text-xs font-medium rounded border $labelClass"]) }}>
    {{ $description }}
</span>
