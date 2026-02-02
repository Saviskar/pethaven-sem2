@props(['class' => ''])

<div {{ $attributes->merge(['class' => 'animate-pulse bg-gray-200 dark:bg-zinc-800 rounded ' . $class]) }}></div>
