<x-app-layout>
    <div class="bg-zinc-200 mx-auto p-8">
        <form action="{{ route('posts.index') }}" method="GET" class="mb-4 text-center">
            <div class="flex items-center justify-center">
                <input type="text" name="search" id="search" placeholder="Rechercher un post"
                    class="border  border-gray-300 focus:ring-pink-500 shadow px-3 py-2 mr-2 w-2/3 sm:w-1/2 md:w-1/3 lg:w-1/4"
                    value="{{ request()->search }}" autofocus />
                <button type="submit" class="bg-white text-gray-600 px-4 py-2 -lg shadow">
                    <x-heroicon-o-magnifying-glass class="h-5 w-5" />
                </button>
            </div>
        </form>
        <ul class="grid sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-3 gap-8 w-2/3 m-auto justify-center">
            @foreach ($posts as $post)
                <li>
                    <x-posts-card :post="$post" />
                </li>
            @endforeach
        </ul>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
