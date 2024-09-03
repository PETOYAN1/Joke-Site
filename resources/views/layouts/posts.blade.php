<div class="p-6 text-gray-900 dark:text-gray-100">
    @if($posts->isNotempty())
        @foreach ($posts as $post)
        <div class="post_section">
            <div>
                <a wire:navigate href="{{ route('profile.show', $post->users->id)}}"><img class="logo" src={{file_exists($post->users->avatar) ? asset($post->users->avatar) : ($post->users->gender == 'Male' ? asset('images/broken-image.png') : asset('images/broken-image_woman.png'))}} alt="avatar"></a>
                <a wire:navigate href="{{ route('profile.show', $post->users->id)}}"><h2>{{$post->users->name}}</h2></a>
            </div>
            <div>
                <span>{{$post->created_at}}</span>
                @if ($post->user_id == auth()->id())
                    <a wire:navigate class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-[5px] px-[0.7em] rounded" href="{{ route('dashboard.edit', $post->id) }}"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></a>
                    <form action="{{ route('dashboard.destroy', $post->id)}}" method="POST" onsubmit="return confirm('{{ __('Are You Sure to Delete') }}')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-[5px] px-[0.7em] rounded"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button>
                    </form>
                @endif
            </div>
        </div>
        <section class="section">
            <h3 class="text-center mb-4 mt-4">{{$post->title}}</h3>
            <img class="post_image" src="{{ file_exists($post->image) ? asset($post->image) : asset('images/broken-post-image.png') }}" alt="avatar">
            <h2 class="text-[15px] my-2">{{$post->description}}</h2>
        </section>
        <div class="post_section2">
            <livewire:live-post :key="'likes' . $post->id" :post="$post" />
            <livewire:post-comments :key="'comments-' . $post->id" :post="$post"/>
        </div>
        @endforeach
        <div class="m-4">
            {{ $posts->withQueryString()->links() }}
        </div>
        @else
        <x-not_found>
            {{__('Not Found posts')}}
        </x-not_found>
    @endif
</div>
