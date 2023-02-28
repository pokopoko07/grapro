<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            投稿の一覧
        </h2>

        <x-message :message="session('message')" />

    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="font-semibold leading-none mt-4">こんにちは、あるいは、こんばんは、{{$user->name}}さん！</p>
        <p class="font-semibold leading-none mt-4">検索結果：{{$count}}件です</p>
        @foreach ($posts as $post)
            <div class="mx-4 sm:p-8">
                <div class="mt-4">
                    <div class="bg-white w-full  rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500">
                        <div class="mt-4">
                            <h1 class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer">
                                <a href="{{route('post.show', $post)}}">{{ $post->title }}</a>
                            </h1>
                            <hr class="w-full"><br>

                            <div class="container_list">
                                <div class="item-1">
                                    @if($post->image_main)
                                        <img src="{{ asset('storage/images/'.$post->image_main)}}" class="mx-auto fit_grid">{{-- style="height:300px;"> --}}
                                    @else
                                        <img src="{{ asset('logo/noimage.jpg')}}" class="mx-auto fit_grid">
                                        {{-- <p class="text-4xl font-bold text-neutral-300">No Image</p> --}}
                                    @endif
                                </div>
                                <div class="item-2">
                                    <p class="mt-4 text-gray-600 py-4">{{Str::limit($post->body,100,"...")}}　　
                                        <a href="{{route('post.show', $post)}}" class="text-red-500 hover:underline cursor-pointer">learn more</a>
                                    </p>
                                </div>
                                <div class="item-3 border-solid border-gray-400 rounded-md">
                                    <span class="font-semibold leading-none mt-4">地域：</span>　{{$post->area->area}}
                                    <br>
                                    <span class="font-semibold leading-none mt-4">犬：</span>　{{$post->getDogsStr()}}
                                </div>
                                <div class="item-4 border-solid border-gray-400 rounded-md">
                                    <span class="font-semibold leading-none mt-4">施設区分:</span>　{{$post->getFacilityKubun()}}
                                    <div class="text-sm font-semibold flex flex-row-reverse">
                                        <p> {{ $post->user->name }} • {{$post->created_at->diffForHumans()}}</p>
                                    </div>
                                </div>
                                {{-- <div class="item-5 border-solid border-gray-400 rounded-md">
                                    <span class="font-semibold leading-none mt-4">犬：</span>　{{$post->getDogsStr()}}
                                    <br><br><br><br>
                                    <div class="text-sm font-semibold flex flex-row-reverse">
                                        <p> {{ $post->user->name }} • {{$post->created_at->diffForHumans()}}</p>
                                    </div>
                                </div>
                                <div class="item-6 border-solid border-gray-400 rounded-md">
                                    <span class="font-semibold leading-none mt-4">年代別お勧め度：</span>
                                    <ul class="ml-4">
                                        <li>　幼　　児　：{{$post->getAgeStr($post->infant)}}</li>
                                        <li>小学生低学年：{{$post->getAgeStr($post->lower_grade)}}</li>
                                        <li>小学生高学年：{{$post->getAgeStr($post->higher_grade)}}</li>
                                        <li>中学生以上　：{{$post->getAgeStr($post->over13)}}</li>
                                    </ul>
                                </div> --}}
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>