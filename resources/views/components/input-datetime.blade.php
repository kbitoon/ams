@props([
    'disabled' => false,
    'model' => null,
    'id' => null
])

<div
    x-data
    x-init="
        flatpickr($refs.input, {
            enableTime: true,
            dateFormat: 'Y-m-d H:i',
            time_24hr: true,
            onChange: (selectedDates, dateStr) => {
                $dispatch('input', dateStr); // Ensure Livewire gets the updated value
            }
        });
    "
>

    <input
        {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) !!}
        {{ $attributes->whereDoesntStartWith('wire:model') }}
        x-ref="input"
        type="text"
        {{ $disabled ? 'disabled' : '' }}
        id="{{ $id }}"
    >
</div>
