@extends('layouts.app')

@section('content')

    <div class="flex justify-center">
        <div class="w-8/12">

            <div class="pt-6 pb-6">
                <h1 class="text-2xl font-medium mb-1">
                    {{ $user->name }}
                </h1>
                <p class="text-sm text-gray-400">
                    Posted {{ $posts->count() }} {{ Str::plural('post', $posts->count()) }} and received {{ $user->receivedLikes->count() }} {{ Str::plural('like', $user->receivedLikes->count()) }}
                </p>
            </div>

            <div>
                @if ($posts->count())

                    @foreach($posts as $post)

                        {{-- COMPONENT --}}
                        <x-post :post="$post" />
                        {{-- COMPONENT --}}

                    @endforeach

                    {{-- Pagination --}}
                    <div class="flex justify-center mt-6">
                        <div class="w-full p-6 mb-40">
                            {{ $posts->links() }}
                        </div>
                    </div>
                    {{-- Pagination --}}

                @else

                    <div class="flex justify-center mt-6 mb-40">
                        <div class="w-full bg-white p-7 rounded-lg">
                            <p>
                                {{ $user->name }} does not have any posts
                            </p>
                        </div>
                    </div>

                @endif
            </div>

        </div>
    </div>

@endsection
