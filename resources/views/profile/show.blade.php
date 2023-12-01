<x-app-layout>
    <div class="bg-zinc-200 mx-auto h-full p-8">
        <div class="flex w-full">
            <x-avatar class="h-40 w-40" :user="$user" />
            <div class="ml-8 mt-5 flex flex-col">
                <div class=" font-mono uppercase text-4xl text-gray-800 font-bold">{{ $user->name }}</div>
                <div class="italic text-gray-700 text-sm">{{ $user->email }}</div>
                <div class="text-gray-500 text-xs">
                    Membre depuis {{ $user->created_at->diffForHumans() }}
                </div>

                <p class=" m-4 text-center">{{ $user->followerCount() }} Abonnés</p>

                <form class= "bg-pink-400 rounded-md text-center p-2 uppercase"
                    action="{{ route('user.follow', ['userId' => $user->id]) }}" method="post">
                    @csrf
                    <button type="submit">
                        @if (auth()->user() &&
                                auth()->user()->follows &&
                                auth()->user()->follows->contains('following_id', $user->id))
                            Unfollow
                        @else
                            Follow
                        @endif
                    </button>
                </form>

            </div>
        </div>
        <div class="mt-8">
            <h2 class="font-bold text-xl mb-4">Biographie</h2>
            <div class="text-gray-700 text-sm">{{ $user->bio }}</div>
        </div>
        <div class="mt-8">
            <h2 class="font-bold text-xl mb-4">Posts</h2>
            <ul class="grid sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-6 gap-8">
                @forelse ($posts as $post)
                    <li>
                        <x-posts-card :post="$post" />
                    </li>
                @empty
                    <div class="text-gray-700">Aucun post</div>
                @endforelse
            </ul>
        </div>

        {{-- <div class="mt-8">
        <h2 class="font-bold text-xl mb-4">Commentaires</h2>

        <div class="flex-col space-y-4">
            @forelse ($comments as $comment)
                <div class="flex bg-white rounded-md shadow p-4 space-x-4">
                    <div class="flex justify-start items-start h-full">
                        <x-avatar class="h-10 w-10" :user="$comment->user" />
                    </div>
                    <div class="flex flex-col justify-center w-full space-y-4">
                        <div class="flex justify-between">
                            <div class="flex space-x-4 items-center justify-center">
                                <div class="flex flex-col justify-center">
                                    <div class="text-gray-700">{{ $comment->user->name }}</div>
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
            @endforelse
        </div>
    </div> --}}
    </div>
</x-app-layout>
