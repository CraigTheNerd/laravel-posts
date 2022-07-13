@props(['post' => $post])

<div class="flex justify-center mt-6 mb-6">
    <div class="w-full bg-white p-6 rounded-lg">
        <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a>
        <span class="text-gray-600 text-sm block">{{ $post->created_at->diffForHumans() }}</span>
        <p class="mt-4">
            {{ $post->body }}
        </p>

        {{-- Logged in User --}}
        <div class="flex items-center mt-4">
            @auth
                {{-- Likes --}}
                @if(!$post->likedBy(auth()->user()))
                    <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                        @csrf
                        <button type="submit" class="text-blue-500 text-sm pr-2">Like</button>
                    </form>
                @else
                    <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                        @csrf
                        {{-- Method Spoofing --}}
                        @method('DELETE')
                        <button type="submit" class="text-blue-500 text-sm pr-2">Unlike</button>
                    </form>
                @endif
                {{-- Likes --}}
            @endauth
            <span class="text-gray-500 text-sm pr-3">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
            {{--                                    <div class="flex items-center mt-4">--}}
            {{-- Delete a Post --}}
            @can('delete', $post)
                <form action="{{ route('posts.destroy', $post) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-blue-500 text-sm pr-2">Delete</button>
                </form>
            @endcan
            {{-- Delete a Post --}}
            {{--                                    </div>--}}

        </div>

        {{-- Logged in User --}}

    </div>
</div>
