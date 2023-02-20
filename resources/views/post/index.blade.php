<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            投稿の一覧
        </h2>

        <x-message :message="session('message')" />

    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{$user->name}}さん、こんにちは！
        @foreach ($posts as $post)
            <div class="mx-4 sm:p-8">
                <div class="mt-4">
                    <div class="bg-white w-full  rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500">
                        <div class="mt-4">
                            <h1 class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer">{{ $post->title }}</h1>
                            <hr class="w-full"><br>

                            <div class="container_list">
                                <div class="item-1">
                                    @if($post->image_main)
                                        <img src="{{ asset('storage/images/'.$post->image_main)}}" class="mx-auto fit_grid">{{-- style="height:300px;"> --}}
                                    @else
                                        <p class="text-4xl font-bold text-neutral-300">No Image</p>
                                    @endif
                                </div>
                                <div class="item-2">
                                    <p class="mt-4 text-gray-600 py-4">{{$post->body}}</p>
                                </div>
                                <div class="item-3">地域：{{$post->area->area}}</div>
                                <div class="item-4">施設区分:{{$post->getFacilityKubun()}}</div>
                                <div class="item-5">
                                    <span>年代別お勧め度：</span>
                                    <ul>
                                        <li>　幼　　児　：{{$post->getAgeStr($post->infant)}}</li>
                                        <li>小学生低学年：{{$post->getAgeStr($post->lower_grade)}}</li>
                                        <li>小学生高学年：{{$post->getAgeStr($post->higher_grade)}}</li>
                                        <li>中学生以上　：{{$post->getAgeStr($post->over13)}}</li>
                                    </ul>
                                </div>
                                <div class="item-6">
                                    犬：{{$post->getDogsStr()}}
                                    <br><br><br><br>
                                    <div class="text-sm font-semibold flex flex-row-reverse">
                                        <p> {{ $post->user->name }} • {{$post->created_at->diffForHumans()}}</p>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>