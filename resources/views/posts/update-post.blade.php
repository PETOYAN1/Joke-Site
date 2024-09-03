<form method="POST" action="{{ route('dashboard.update', $posts->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">{{ __('title') }}</label>
            <input value="{{ $posts->title }}" type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>
        <div class="mb-4">
            <label for="category" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Category') }}</label>
            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="category" id="category">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}" {{ $category->id == $posts->category_id ? 'selected' : null }}>{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Image') }}</label>
            <img class="edit_post_image" src="{{ file_exists($posts->image) ? asset($posts->image) : asset('images/broken-post-image.png') }}" alt="img">
            <input name="image" type="file" id="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Description') }}</label>
            <textarea name="description" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="description" cols="30" rows="10">{{ $posts->description }}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
        <div class="form-check">
            <input {{ $posts->published ? 'checked' : null }} class="form-check-input" type="checkbox" value="1" name="published" id="flexCheckDefault">
            <label class="form-check-label text-gray-800 dark:text-white mb-4" for="flexCheckDefault">
                {{ __('Published') }}
            </label>
          </div>
        <div class="mb-4">
            <button type="submit" class="mt-4 bg-green-600 hover:bg-green-800 text-white font-bold py-1 px-3 rounded ">{{ __('Update') }}</button>
        </div>
</form>


