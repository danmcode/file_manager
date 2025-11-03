@props([
'name',
'options' => [],
'selected' => null,
'placeholder' => 'Seleccione una opción',
'disabled' => false,
])

<select name="{{ $name }}" id="{{ $name }}" @disabled($disabled) {{ $attributes->merge([
    'class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full'
    ]) }}
    >
    @if ($placeholder)
    <option value="">{{ $placeholder }}</option>
    @endif

    {{-- Validar que haya data --}}
    @forelse ($options as $value => $label)
    <option value="{{ $value }}" @selected($value==$selected)>
        {{ $label }}
    </option>
    @empty
    <option value="" disabled>No hay opciones disponibles</option>
    @endforelse
</select>