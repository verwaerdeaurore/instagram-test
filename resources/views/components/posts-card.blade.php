<div>
    <div>
        <a class="flex flex-col h-full space-y-4 bg-white rounded-md shadow-md p-5 w-full hover:shadow-lg hover:scale-105 transition"
            href="{{ route('posts.show', $post) }}">
            <img  src="{{ Storage::url($post->img_path) }}" alt="Description de l'image">
            <div class="flex-grow text-gray-700 text-sm text-justify">
                {{ Str::limit($post->txt, 120) }}
            </div>
            <div class="text-xs text-gray-500">
                {{ $post->published_at->diffForHumans() }}
            </div>
        </a>
    </div>

</div>
