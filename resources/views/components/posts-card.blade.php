<div>
    <div>
        <a class="flex flex-col h-full space-y-4 bg-white  shadow-md p-5 w-full" href="{{ route('posts.show', $post) }}">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <x-avatar class="h-10 w-10" :user="$post->user" />
                    <div class="text-gray-700 ml-2">{{ $post->user->name }}</div>
                </div>

                <div class="text-xs text-gray-500">
                    {{ $post->published_at->diffForHumans() }}
                </div>
            </div>

            <img src="{{ Storage::url($post->img_path) }}" alt="Description de l'image">
            <div class="flex-grow text-gray-700 text-sm text-justify">
                {{ Str::limit($post->txt, 120) }}
            </div>
        </a>
    </div>

</div>
