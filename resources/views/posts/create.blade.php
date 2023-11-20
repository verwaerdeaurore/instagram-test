<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('posts') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex justify-between mt-8">
                <div class="text-2xl">
                    Créer une publication
                </div>
            </div>

            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="flex flex-col space-y-4 text-gray-500">

                @csrf

                <div>
                    <x-input-label for="img_path" :value="__('Image')" />
                    <x-file-input id="img_path" class="block mt-1 w-full" type="file" name="img_path" />
                    <x-input-error :messages="$errors->get('img_path')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="txt" :value="__('Texte')" />
                    <textarea id="txt"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        name="txt" rows="10">{{ old('txt') }}</textarea>
                    <x-input-error :messages="$errors->get('txt')" class="mt-2" />
                </div>

                <div class="flex justify-end">
                    <x-primary-button type="submit">
                        {{ __('Envoyer') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
