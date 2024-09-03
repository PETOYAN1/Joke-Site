<div {{ $attributes->merge([
    'class' => 'ml-2 flex text-black dark:text-white',
    'style' => 'gap: 2em; align-items: center;'
]) }} style="width: 100%; height: 100%; fill: currentcolor;">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" focusable="false" style="pointer-events: none; display: inherit; width: 5%; height: 100%;">
        {{ $slot }}
      </svg>
      @isset($title)
          <h1 class="text-black dark:text-gray-200">{{ $title }}</h1>
      @endisset

</div>
