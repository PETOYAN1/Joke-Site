<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update') }}
        </h2>
    </x-slot>
    <h1 class="text-center posts dark:text-gray-200 mt-2">{{__('Update your post')}}</h1>
    <div class="py-12">
        <div class="create bg-white dark:bg-gray-800 mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('posts.update-post')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

