<div class="optionSection bg-white dark:bg-gray-800 text-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
    <h3 class="text-center mt-4 text-gray-800 dark:text-white">{{__('Users')}}</h3>
    @isset($users)
        @foreach($users as $user)
        <ul class="blog_users">
            <a class="text-gray-800 dark:text-white" wire:navigate href="{{ route('profile.show', $user->id)}}"><img class="logo" src={{file_exists($user->avatar) ? asset($user->avatar) : ($user->gender == 'Male' ? asset('images/broken-image.png') : asset('images/broken-image_woman.png'))}} alt="avatar"></a>
            <li><a class="text-gray-800 dark:text-white" wire:navigate href="{{ route('profile.show', $user->id)}}">{{$user->name}}</a></li>
        </ul>
        @endforeach
    @endisset
</div>
