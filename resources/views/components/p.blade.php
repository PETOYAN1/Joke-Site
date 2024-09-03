
@props(['attr' => 'text-gray-800 dark:text-gray-300'])
<div class="flex justify-between gap-1">
    <p class="{{ $attr }}">
        {{ $slot }}
    </p>
    @isset($slot2)
        <p class="{{ $attr }}">
            {{ $slot2 }}
        </p>
    @endisset
</div>
