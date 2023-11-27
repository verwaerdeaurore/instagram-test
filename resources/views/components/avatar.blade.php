<div {{ $attributes->merge(['class' => 'rounded-full overflow-hidden']) }}>
    @if($user->avatar_path)
    <img
      class=" aspect-square object-cover object-center"
      src="{{ asset('storage/' . $user->avatar_path) }}"
      alt="{{ $user->name }}"
    />
    @else
    <div class="flex items-center justify-center bg-pink-100 h-full">
      <span class="text-2xl font-medium text-pink-800">
        {{ $user->name[0] }}
      </span>
    </div>
    @endif
  </div>
