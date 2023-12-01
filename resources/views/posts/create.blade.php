<x-app-layout>
²   <h2 class="font-bold text-3xl mb-4 underline decoration-pink-300 text-center uppercase text-zinc-700">
            {{ __('Créer une publication') }}
        </h2>

    <div class="max-w-7xl m-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white overflow-hidden shadow-xl m-auto p-6">

            <form method="POST" action="{{ route('posts.store') }}" class="flex flex-col space-y-4 text-gray-500"
                enctype="multipart/form-data">

                @csrf
                <div class="">
                    <label for="img_path" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        {{ __('Choisir une image : ') }}
                    </label>

                    <div class="mt-1">
                        <input type="file" name="img_path" id="img_path" accept="image/*"
                            class="block w-full shadow-sm sm:text-sm dark:bg-gray-700 dark:border-gray-700 dark:text-gray-200 dark:focus:ring-gray-500 dark:focus:border-gray-500 dark:placeholder-gray-400 dark:focus:ring-opacity-50 dark:focus:ring-offset-gray-800 dark:focus:ring-offset-opacity-50 dark:ring-offset-gray-800 dark:ring-offset-opacity-50 dark:ring-gray-500 dark:ring-opacity-50 rounded-md" />
                    </div>

                    <x-input-error :messages="$errors->get('img_path')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="txt" :value="__('Texte du post')" />
                    <textarea id="body"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        name="txt" rows="10">{{ old('txt') }}</textarea>
                    <x-input-error :messages="$errors->get('txt')" class="mt-2" />
                </div>

                <div class="flex justify-end">
                    <x-primary-button class="bg-pink-300 text-white" type="submit">
                        {{ __('Créer') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
     </div>
</x-app-layout>
