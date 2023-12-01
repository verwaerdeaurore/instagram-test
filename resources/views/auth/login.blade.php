<x-guest-layout>
    <div class="m-auto w-1/2 bg-zinc-200">
    <div class="flex m-auto border border-zinc-300 overflow-hidden w-full">
    <div class="flex-col w-200 overflow-hidden">
        <div class="p-4 bg-gray-200">
            <h1 class=" font-bold text-2xl mb-4 underline decoration-pink-300 text-center uppercase text-zinc-700"> Bienvenue sur Amstramgram </h1>
            <p class="text-mg italic ">Amstramgram plateforme de médias sociaux incontournable, révolutionne le partage en mettant l'accent sur le visuel. Les utilisateurs partagent des moments de leur vie à travers des photos et des vidéos, favorisant ainsi une connexion authentique.En somme, Amstramgram offre un espace dynamique où l'expression visuelle et les interactions sociales convergent harmonieusement.</p>
        </div>
        <img src="https://images2.imgbox.com/d4/1a/VVS0TKYw_o.jpg" alt="Image" class="w-full h-auto">

    </div>

</div>

        <h1 class=" font-bold text-3xl mb-4 underline decoration-pink-300 text-center uppercase text-zinc-700"> Connexion </h1>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="m-8 ">
                <x-input-label for="email" :value="__('Email : ')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="m-8">
                <x-input-label for="password" :value="__('Mot de passe : ')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-2 ml-8 ">
                <label for="remember_me" class="inline-flex items-center justify-center m-auto">
                    <input id="remember_me" type="checkbox"
                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Se souvenir de moi') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end  mb-10 pb-2">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié ?') }}
                    </a>
                @endif

                <x-primary-button class="ms-3 mr-8 mb-8  bg-pink-300 hover:bg-pink-300">
                    {{ __('Se connecter') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
