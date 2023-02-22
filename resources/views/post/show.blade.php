<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            詳細ページ
        </h2>

        <x-message :message="session('message')" />

    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-4 sm:p-8">
            <div class="px-10 mt-4">

                <div class="bg-white w-full  rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500">
                    <div class="mt-4">
                        {{-- 施設名表示 --}}
                        <h1 class="text-4xl text-gray-700 font-semibold hover:underline cursor-pointer">
                            <a href="{{route('post.show', $post)}}">{{ $post->title }}</a>
                        </h1>

                        <div class="flex justify-end mt-4">
                            <a href="{{route('post.edit', $post)}}"><x-primary-button class="bg-teal-700 float-right">編集</x-primary-button></a>
                            <form method="post" action="{{route('post.destroy', $post)}}">
                                @csrf
                                @method('delete')
                                <x-primary-button class="bg-red-700 float-right ml-4" onClick="return confirm('本当に削除しますか？');">削除</x-primary-button>
                            </form>
                        </div>
                        <hr class="w-full">
                    </div>

                    <div class="container_syousai">
                        {{-- main画像表示 --}}
                        <div class="item1">
                            @if($post->image_main)
                                <a href="{{ asset('storage/images/'.$post->image_main)}}"  data-lightbox="group">
                                    <img src="{{ asset('storage/images/'.$post->image_main)}}" class="mx-auto fit_grid">
                                </a>
                            @else
                                <img src="{{ asset('logo/noimage.jpg')}}" class="mx-auto fit_grid">
                                {{-- <p class="text-4xl font-bold text-neutral-300">No Image</p> --}}
                            @endif
                        </div>

                        {{--本文表示--}}
                        <div class="item2">
                            <p class="mt-4 text-gray-600 py-4">{{$post->body}}</p>
                             @if($post->hp_adress)
                                <div class="text-sm font-semibold flex flex-row-reverse">
                                    <p> HP:<a href="{{ $post->hp_adress }}" target="_blank">{{ $post->hp_adress }}</a></p>
                                </div>
                            @endif
                        </div>
                            
                        {{--サブ画面表示--}}
                        <div class="item3">
                            @if($post->image_sub1)
                                <a href="{{ asset('storage/images/'.$post->image_sub1)}}"  data-lightbox="group">
                                    <img src="{{ asset('storage/images/'.$post->image_sub1)}}" class="mx-auto fit_grid">
                                </a>
                            @else
                                <img src="{{ asset('logo/noimage.jpg')}}" class="mx-auto fit_grid">
                                {{-- <p class="text-4xl font-bold text-neutral-300">No Image</p> --}}
                            @endif
                        </div>
                        <div class="item4">
                            @if($post->image_sub2)
                                <a href="{{ asset('storage/images/'.$post->image_sub2)}}"  data-lightbox="group">
                                    <img src="{{ asset('storage/images/'.$post->image_sub2)}}" class="mx-auto fit_grid">
                                </a>
                            @else
                                <img src="{{ asset('logo/noimage.jpg')}}" class="mx-auto fit_grid">
                                {{-- <p class="text-4xl font-bold text-neutral-300">No Image</p> --}}
                            @endif
                        </div>
                        <div class="item5">
                            @if($post->image_sub3)
                                <a href="{{ asset('storage/images/'.$post->image_sub3)}}"  data-lightbox="group">
                                    <img src="{{ asset('storage/images/'.$post->image_sub3)}}" class="mx-auto fit_grid">{{-- style="height:300px;"> --}}
                                </a>
                            @else
                                <img src="{{ asset('logo/noimage.jpg')}}" class="mx-auto fit_grid">
                                {{-- <p class="text-4xl font-bold text-neutral-300">No Image</p> --}}
                            @endif
                        </div>
                        <div class="item6">
                            @if($post->image_sub4)
                                <a href="{{ asset('storage/images/'.$post->image_sub4)}}"  data-lightbox="group">
                                    <img src="{{ asset('storage/images/'.$post->image_sub4)}}" class="mx-auto fit_grid">{{-- style="height:300px;"> --}}
                                </a>
                            @else
                                <img src="{{ asset('logo/noimage.jpg')}}" class="mx-auto fit_grid">
                                {{-- <p class="text-4xl font-bold text-neutral-300">No Image</p> --}}
                            @endif
                        </div>

                        {{--犬情報と、作成者、更新日時--}}
                        <div class="item7">
                            <span class="font-semibold leading-none mt-4">地域：</span>　{{$post->area->area}}<br>
                                
                            <span class="font-semibold leading-none mt-4">犬：</span>　{{$post->getDogsStr()}}
                            <div class="text-sm font-semibold flex flex-row-reverse mt-4">
                                <p> {{ $post->user->name }} </p>
                                <p>{{$post->created_at->format('Y/m/d H:i:s')}}</p>
                            </div>
                        </div>

                        {{--年代別 おすすめ度の表示--}}
                        <div class="item8">
                            <span class="font-semibold leading-none mt-4">施設区分:</span>　{{$post->getFacilityKubun()}}<br>
                            <span class="font-semibold leading-none mt-4">年代別お勧め度：</span>
                            <ul class="ml-8">
                                <li>　幼　　児　：{{$post->getAgeStr($post->infant)}}</li>
                                <li>小学生低学年：{{$post->getAgeStr($post->lower_grade)}}</li>
                                <li>小学生高学年：{{$post->getAgeStr($post->higher_grade)}}</li>
                                <li>中学生以上　：{{$post->getAgeStr($post->over13)}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>