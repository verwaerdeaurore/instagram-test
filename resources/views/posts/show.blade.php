<x-app-layout>
    <div class="bg-zinc-200">

    <div class="m-auto w-1/3 justify-center  p-8 bg-zinc-300">
        <a href="{{ route('posts.index') }}" class="font-bold bg-white text-gray-700 px-4 py-2 rounded shadow">
            ←  Retour
        </a>
        <div class="flex items-center justify-center">
            <img class="items-center m-4 ml-4 " src="{{ asset('storage/' . $post->img_path) }}" alt="illustration du post"
                class="rounded shadow aspect-auto object-cover object-center" />
        </div>

        <div class="mt-4  bg-zinc-200 p-5 font-serif italic">{!! \nl2br($post->txt) !!}</div>

        <a class="flex mt-8 transition" href="{{ route('profile.show', $post->user) }}">
            <x-avatar class="h-20 w-20" :user="$post->user" />
            <div class="ml-4 flex flex-col justify-center">
                <div class="text-pink-700 uppercase font-sans  font-bold">{{ $post->user->name }}</div>
                <div class="text-gray-500 text-xs italic">{{ $post->published_at->diffForHumans() }}</div>
            </div>
        </a>
        <div class=" justify-end">
            <form action="{{ route('like.post', ['postId' => $post->id]) }}" method="post">
                @csrf
                <div class="flex col-span-3 font-sans uppercase ">
                    <div class="m-3 items-end uppercase ">
                        <p>{{ $post->likeCount() }}</p>
                    </div><button class ="uppercase" type="submit ">
                        @if (auth()->user() &&
                                auth()->user()->likes->contains('post_id', $post->id))
                            Dislike
                        @else
                            Like
                        @endif
                    </button>
            </form>
        </div>
    </div>


    <div class="mt-8">
        <h2 class="font-bold text-xl mb-4">Commentaires</h2>

        <div class="flex-col space-y-4">
            @forelse ($post->comments as $comment)
                <div class="flex bg-zinc-200  shadow p-4 space-x-4">
                    <a class="flex justify-start items-start h-full" href="{{ route('profile.show', $comment->user) }}">
                        <x-avatar class="h-10 w-10" :user="$comment->user" />
                    </a>
                    <div class="flex flex-col justify-center w-full space-y-4">
                        <div class="flex justify-between">
                            <div class="flex space-x-4 items-center justify-center">
                                <div class="flex flex-col justify-center">
                                    <a class="text-pink-700" href="{{ route('profile.show', $comment->user) }}">
                                        {{ $comment->user->name }}
                                    </a>
                                    <div class="text-gray-500 italic text-sm">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col justify-center w-full text-zinc-800 font-sans ">
                            <p class="border bg-zinc-200  p-4">
                                {{ $comment->comment }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="flex bg-zinc-200  shadow p-4 space-x-4">
                    Aucun commentaire pour l'instant
                </div>
            @endforelse @auth
            <form action="{{ route('posts.comments.add', $post) }}" method="POST"
                class="flex bg-zinc-200  shadow p-4">
                @csrf
                <div class="flex justify-start items-start h-full mr-4">
                    <x-avatar class="h-10 w-10" :user="auth()->user()" />
                </div>
                <div class="flex flex-col justify-center w-full">
                    <div class="text-gray-700">{{ auth()->user()->name }}</div>
                    <div class="text-gray-500 text-sm">{{ auth()->user()->email }}</div>
                    <div class="text-gray-700">
                        <textarea name="body" id="body" rows="4" placeholder="Votre commentaire"
                            class="w-full  shadow-sm border-gray-300 bg-gray-100 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-4"></textarea>
                    </div>
                    <div class="text-gray-700 mt-2 flex justify-end">
                        <button type="submit" class="font-bold bg-pink-300 text-white px-4 py-2 rounded shadow">
                            Publier votre commentaire
                        </button>
                    </div>
                </div>
            </form>
        @else
            <div class="flex bg-white  shadow p-4 text-gray-700 justify-between items-center">
                <span> Vous devez être connecté pour ajouter un commentaire </span>
                <a href="{{ route('login') }}" class="font-bold bg-white text-gray-700 px-4 py-2 rounded shadow-md">Se
                    connecter</a>
            </div>
        @endauth
    </div>

</div>

</div>
</div>
</x-app-layout>
