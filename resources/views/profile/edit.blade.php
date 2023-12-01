<x-app-layout>
    <div class="bg-zinc-200">
        <x-slot name="header">
            <h2
                class="font-semibold text-center uppercase underline decoration-pink-400 text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Editer mon profile') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-gray-100 dark:bg-gray-800 shadow ">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-gray-100 dark:bg-gray-800 shadow ">
                    <div class="max-w-xl">
                        @include('profile.partials.update-avatar-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-gray-100 dark:bg-gray-800 shadow ">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-gray-100 dark:bg-gray-800 shadow ">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
