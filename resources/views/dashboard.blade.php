<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        @include('layouts.search-bar')
    </x-slot>
    <h1 class="text-center posts dark:text-gray-200 mt-[10px]">{{__('All Posts of users')}}</h1>
    <a wire:navigate href="{{ route('dashboard.store')}}" class="create_link bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded">Create</a>
    <div class="py-12">
        @include('layouts.categories')
        <div class="max-w-7xls mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @include('layouts.posts')
            </div>
        </div>
        @include('layouts.users')
    </div>
</x-app-layout>

