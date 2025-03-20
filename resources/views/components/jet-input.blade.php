@props(['type' => 'text', 'name', 'id' => null, 'value' => '', 'placeholder' => '', 'required' => false])

<input
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $id ?? $name }}"
    value="{{ old($name, $value) }}"
    placeholder="{{ $placeholder }}"
    {{ $required ? 'required' : '' }}
    {{ $attributes->merge([
        'class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'
    ]) }}
>
