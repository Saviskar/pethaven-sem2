@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-text-light dark:text-text-dark']) }}>
    {{ $value ?? $slot }}
</label>
