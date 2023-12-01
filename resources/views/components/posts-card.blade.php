<div>
    <div>
        <a class="flex flex-col h-full space-y-4 bg-white  shadow-md p-5 w-full" href="{{ route('posts.show', $post) }}">
            <img src="{{ Storage::url($post->img_path) }}" alt="Description de l'image">
            <div class="flex-grow text-gray-700 text-sm text-justify">
                {{ Str::limit($post->txt, 120) }}
            </div>
            <div class="text-xs text-gray-500">
                {{ $post->published_at->diffForHumans() }}
            </div>
        </a>
    </div>

</div>
