<div @class(['logo_box' => true])
    {{ $attributes->merge([
        'style' => 'width: 120px'
    ])}}
    >
    <img class="page_logo" src="{{ asset('images/logo.png') }}" draggable="false" alt="">
</div>
