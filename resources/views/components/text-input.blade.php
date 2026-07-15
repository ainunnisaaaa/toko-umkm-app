@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-tokopedia focus:ring-tokopedia rounded-md shadow-sm']) !!}>
