@props([
    'disabled' => false
])

<div
    x-data="{ value: @entangle($attributes->wire('model')) }"
    x-on:change="value = $event.target.value"
    x-init="
        new Pikaday({
            field: $refs.input,
            toString(date, format) {
                return moment(date).format('YYYY-MM-DD');
            }
        })"
>

    <input
        {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) !!}
        {{ $attributes->whereDoesntStartWith('wire:model') }}
        x-ref="input"
        x-bind:value="value"
        type="text"
        {{ $disabled ? 'disabled' : '' }}
    >
</div>
