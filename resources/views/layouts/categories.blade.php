<div class="optionSection bg-white dark:bg-gray-800 text-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
    <h3 class="text-center mt-4 text-gray-800 dark:text-white">{{__('Categories')}}</h3>
    @isset($categories)
    <form method="GET">
        @csrf
        <ul class="dropdown-menu text-primary text-gray-800 dark:text-white">
            @foreach($categories as $category)
            @if(count($category->posts) > 0)
            <li class="flex items-center gap-2">
                <a wire:navigate class="text-gray-800 text-primary dark:text-white" value="{{ $category->id }}" href="{{ route('dashboard.index', "category=$category->id") }}">{{ $category->name }}</a>
                <span class="text-white text-xs bg-gray-800 w-6 h-4 rounded-full flex justify-center items-center dark:text-black dark:bg-white">{{ count($category->posts) }}</span>
                @endif
            </li>
            @endforeach
        </ul>
    </form>
    @endisset
</div>
