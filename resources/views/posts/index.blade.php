@extends('layouts.app')

@section('content')

    @auth
    <div class="flex justify-center mb-4">
        <div class="w-8/12 bg-white p-6 rounded-lg">

                <form action="{{ route('posts') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="body" class="sr-only">Body</label>
                        <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Post something!"></textarea>

                        @error('body')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
                    </div>
                </form>

        </div>
    </div>
    @endauth

            @if ($posts->count())

                @foreach($posts as $post)

                    <div class="flex justify-center mt-6 mb-6">
                        <div class="w-8/12 bg-white p-6 rounded-lg">
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

                @endforeach

                {{-- Pagination --}}
                <div class="flex justify-center mt-6">
                    <div class="w-8/12 p-6 mb-40">
                        {{ $posts->links() }}
                    </div>
                </div>
                {{-- Pagination --}}

            @else

                <div class="flex justify-center mt-6 mb-40">
                    <div class="w-8/12 bg-white p-6 rounded-lg">
                        <p>There are no posts</p>
                    </div>
                </div>

            @endif


@endsection
