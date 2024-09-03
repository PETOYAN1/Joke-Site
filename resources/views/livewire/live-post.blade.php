<div>
    <button wire:click="toggleLike" class="unlike-btn"><i  class="{{ Auth::user()->hasLiked($post) ? 'fa-solid' : 'fa-regular' }} fa-lg fa-heart dark:text-gray-200" style='{{ Auth::user()->hasLiked($post) ? 'color: #f44336;' : null}}'></i></button>
    <span class="lead" style="font-size: 18px"><small>{{ $post->likes->count() }}</small></span>
    <button class="btn" type="button" data-bs-toggle="collapse" tabindex="{{ $post->id }}" data-bs-target="#collapseExample{{ $post->id }}" aria-expanded="false" aria-controls="collapseExample{{ $post->id }}">
        <i class="fa-regular fa-lg fa-comment dark:text-gray-200"></i> Comments
</button>
</div>

