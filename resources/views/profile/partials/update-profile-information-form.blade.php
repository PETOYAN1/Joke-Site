@php
    if(session('status')) {
        $status = session('status');
    }
@endphp
<section>
    @isset( $status )
        <h1 class="success_message text-center">{{ $status }}</h1>
    @endisset
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
         <!-- Avatar -->
         <div class="mt-4">
            <x-input-label for="avatar" :value="__('Avatar')" />
            <div class="for_avatar">
                <input id="avatar" class="block mt-1 custom-file-input" type="file" name="avatar" required autocomplete="dob" />
                <img class="profile" src={{file_exists($user->avatar) ? asset($user->avatar) : ($user->gender == 'Male' ? asset('images/broken-image.png') : asset('images/broken-image_woman.png'))}} alt="profile_img">
                <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
            </div>
        </div>

        <!-- Gender -->
        <div class="mt-4">
            <p class="block font-medium text-sm text-gray-700 dark:text-gray-300 gender_label">Gender</p>
            <div class="gender">
                <div class="gender_box">
                    <label for="Male">Male</label>
                    <input type="radio" value="Male" class="block mt-1" name="gender" id="Male" {{$user->gender == 'Male' ? 'checked' : null}}>
                </div>
                <div class="gender_box">
                    <label for="Female">Female</label>
                    <input type="radio" value="Female" class="block mt-1" name="gender" id="Female" {{$user->gender == 'Female' ? 'checked' : null}}>
                </div>
            </div>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

        <!-- Date of Birth -->
        <div class="mt-4">
            <x-input-label for="dob" :value="__('Date of Birth')" />
            <x-text-input id="dob" class="block mt-1 w-full" type="date" name="dob" value='{{$user->dob}}' required autocomplete="dob" />
            <x-input-error :messages="$errors->get('dob')" class="mt-2" />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
