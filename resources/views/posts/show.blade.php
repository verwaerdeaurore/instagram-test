<x-app-layout>
    <div class="mb-4 text-xs text-gray-500">
        {{ $post->published_at->diffForHumans() }}
    </div>

    <div class="flex items-center justify-center">
        <img src="{{ asset('storage/' . $post->img_path) }}" alt="illustration du post"
            class="rounded shadow aspect-auto object-cover object-center" />
    </div>

    <div class="mt-4">{!! \nl2br($post->txt) !!}</div>

    <a class="flex mt-8 hover:-translate-y-1 transition
      " href="{{ route('profile.show', $post->user) }}">
        <x-avatar class="h-20 w-20" :user="$post->user" />
        <div class="ml-4 flex flex-col justify-center">
            <div class="text-gray-700">{{ $post->user->name }}</div>
            <div class="text-gray-500">{{ $post->user->email }}</div>
        </div>
    </a>
    <form action="{{ route('like.post', ['postId' => $post->id]) }}" method="post">
        @csrf
        <div>
            <p>{{ $post->likeCount() }} Likes</p>
        </div><button type="submit">
            @if (auth()->user() &&
                    auth()->user()->likes->contains('post_id', $post->id))
                Unlike
            @else
                Like
            @endif
        </button>
    </form>

    <div class="mt-8 flex items-center justify-center">
        <a href="{{ route('posts.index') }}" class="font-bold bg-white text-gray-700 px-4 py-2 rounded shadow">
            Retour à la liste des posts
        </a>
    </div>

    <div class="mt-8">
        <h2 class="font-bold text-xl mb-4">Commentaires</h2>

        <div class="flex-col space-y-4">
            @forelse ($post->comments as $comment)
                <div class="flex bg-white rounded-md shadow p-4 space-x-4">
                    <a class="flex justify-start items-start h-full" href="{{ route('profile.show', $comment->user) }}">
                        <x-avatar class="h-10 w-10" :user="$comment->user" />
                    </a>
                    <div class="flex flex-col justify-center w-full space-y-4">
                        <div class="flex justify-between">
                            <div class="flex space-x-4 items-center justify-center">
                                <div class="flex flex-col justify-center">
                                    <a class="text-gray-700" href="{{ route('profile.show', $comment->user) }}">
                                        {{ $comment->user->name }}
                                    </a>
                                    <div class="text-gray-500 text-sm">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col justify-center w-full text-gray-700">
                            <p class="border bg-gray-100 rounded-md p-4">
                                {{ $comment->comment }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="flex bg-white rounded-md shadow p-4 space-x-4">
                    Aucun commentaire pour l'instant
                </div>
            @endforelse @auth
            <form action="{{ route('posts.comments.add', $post) }}" method="POST"
                class="flex bg-white rounded-md shadow p-4">
                @csrf
                <div class="flex justify-start items-start h-full mr-4">
                    <x-avatar class="h-10 w-10" :user="auth()->user()" />
                </div>
                <div class="flex flex-col justify-center w-full">
                    <div class="text-gray-700">{{ auth()->user()->name }}</div>
                    <div class="text-gray-500 text-sm">{{ auth()->user()->email }}</div>
                    <div class="text-gray-700">
                        <textarea name="body" id="body" rows="4" placeholder="Votre commentaire"
                            class="w-full rounded-md shadow-sm border-gray-300 bg-gray-100 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-4"></textarea>
                    </div>
                    <div class="text-gray-700 mt-2 flex justify-end">
                        <button type="submit" class="font-bold bg-white text-gray-700 px-4 py-2 rounded shadow">
                            Ajouter un commentaire
                        </button>
                    </div>
                </div>
            </form>
        @else
            <div class="flex bg-white rounded-md shadow p-4 text-gray-700 justify-between items-center">
                <span> Vous devez être connecté pour ajouter un commentaire </span>
                <a href="{{ route('login') }}" class="font-bold bg-white text-gray-700 px-4 py-2 rounded shadow-md">Se
                    connecter</a>
            </div>
        @endauth
    </div>

</div>
</x-app-layout>
