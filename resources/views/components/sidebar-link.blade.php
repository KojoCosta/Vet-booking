@props(['href', 'active'])

@php
  $base = 'block px-4 py-2 text-sm rounded transition';
  $activeClasses = 'bg-blue-600 text-white';
  $inactiveClasses = 'text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700';
@endphp

<a href="{{ $href }}"
   class="{{ $base }} {{ $active ? $activeClasses : $inactiveClasses }}">
  {{ $slot }}
</a>