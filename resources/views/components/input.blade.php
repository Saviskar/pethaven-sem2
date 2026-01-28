@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-border-light dark:border-border-dark dark:bg-card-dark dark:text-text-dark focus:border-[#f53003] dark:focus:border-[#FF4433] focus:ring-[#f53003] dark:focus:ring-[#FF4433] rounded-md shadow-sm']) !!}>
