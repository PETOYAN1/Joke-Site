@php
    // Upload Avatar
    if(isset($user)) {
        $avatar = $user->gender == 'Male' ? asset('images/broken-post-image.png') : asset('images/broken-image_woman.png');
    }
@endphp
<div class="py-12">
    <div class="profile_edit mx-auto sm:px-6 lg:px-8 space-y-6 bg-white dark:bg-gray-800">
        @if (isset($user))
        <x-h1>
            {{ $user->id == Auth::id() ? __('Your Profile') : __('User Profile')}}
        </x-h1>
        <div class="flex justify-center user_profile">
            <img class="profile" src={{asset(file_exists($user->avatar) ? $user->avatar : $avatar)}} alt="avatar">
            <div>
                <h3 class="mb-2 posts dark:text-gray-200">{{$user->name}}</h3>
                <x-p>
                    {{ $user->email }}
                    <x-slot name="slot2">{{count($follows)  . __(' Followers')}}</x-slot>
                </x-p>
                @if ($user->id == Auth::id())
                    <x-popup :user="$user" :follows="$follows">
                        {{ __('More about the channel') }}
                    </x-popup>
                @endif
                @if($user->id !== Auth::id())
                        @if (Auth::user()->follows($user))
                        <form action="{{ route('profile.unFollow', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="mt-2 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded">
                                UnFollow
                            </button>
                        </form>
                    @else
                        <form action="{{ route('profile.follow', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="mt-2 bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-4 rounded">
                                Follow
                            </button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
        <div class="flex justify-center user_data dark:text-gray-50">
            <div>
                <p class="text-gray-800 dark:text-white">{{__('Email:')}}</p>
                <p class="text-gray-800 dark:text-white">{{$user->email}}</p>
            </div>
            <div>
                <p class="text-gray-800 dark:text-white">{{__('Gender:')}}</p>
                <p class="text-gray-800 dark:text-white">{{$user->gender}}</p>
            </div>
            <div>
                <p class="text-gray-800 dark:text-white">{{__('Date of Birth:')}}</p>
                <p class="text-gray-800 dark:text-white">{{$user->dob}}</p>
            </div>
        </div>
        @if ($posts->isNotEmpty())
        <div class="flex flex-wrap post-card justify-center">
            @foreach ($posts as $post)
            @props(['post_image' => $post_image = file_exists($post->image) ? asset($post->image) : asset('images/broken-post-image.png')])
            @if ($user->id == auth()->user()->id)
                <x-userposts>
                    <h1 class="post_title mt-4 text-center dark:text-gray-200">{{$post->title}}</h1>
                    <h2 class="text-center mb-2 mt-2 {{$post->published == 1 ? 'text-green-600' : 'text-red-600'}}" >{{$post->published == 1 ? __('Public') : __('Private')}} </h2>
                            <x-postimage>
                                {{ $post_image }}
                            </x-postimage>
                            <h2 class="text-center mt-3 mb-3 text-gray-800 dark:text-white" >{{ __('Category') }}: {{$post->categories->name}}</h2>
                            @if (auth()->user()->id == $post->user_id)
                                <div class="text-center mt-2 flex justify-center gap-2">
                                    <a wire:navigate class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{ route('dashboard.edit', $post->id) }}">Edit</a>
                                    <form action="{{ route('dashboard.destroy', $post->id)}}" method="POST" onsubmit="return confirm('{{ __('Are You Sure to Delete') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                    </form>
                                </div>
                            @endif
                    </x-userposts>
            @else
                @if ($post->published)
                <x-userposts>
                    <x-h1 class="mb-2">{{$post->title}}</x-h1>
                        <x-postimage>
                            {{ $post_image }}
                        </x-postimage>
                        <h2 class="text-center mt-3 mb-3 text-gray-800 dark:text-white" >Category: {{$post->categories->name}}</h2>
                    </x-userposts>
                    @endif
            @endif
                @endforeach
            </div>
            @else
            <x-not_found>
                <x-h1>{{__('Nothing to posted')}}</x-h1>
            </x-not_found>
            @if (auth()->user()->id == $user->id)
                <div class="mb-4 text-center h-12">
                    <a href="{{ route('dashboard.store')}}" class="mb-4 bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded">Create</a>
                </div>
            @endif
        @endif
        @else
    <x-not_found class="mb-4">
        <x-h1>{{__('User Not Found')}}</x-h1>
    </x-not_found>
        @endif
    </div>
</div>
