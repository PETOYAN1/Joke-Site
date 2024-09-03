<div {{ $attributes->merge([
    'class' => 'user_post flex flex-col items-center flex-wrap text-gray-100 dark:text-dray-800',
    'style' => 'width: 45%'
])}}>
    {{ $slot }}
</div>
