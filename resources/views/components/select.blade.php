@props(['value'])

<select {{ $attributes->merge(['class' => 'text-center border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
    {{ $value ?? $slot }}
</select>
