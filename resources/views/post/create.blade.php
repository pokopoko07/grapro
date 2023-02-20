<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            投稿の新規作成
        </h2>

        <x-validation-errors class="mb-4" :errors="$errors" />

        <x-message :message="session('message')" />
    </x-slot>
    
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mx-4 sm:p-8">
                <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="md:flex items-center mt-8">
                        <div class="w-full flex flex-col">
                        <label for="title" class="font-semibold leading-none mt-4">施設名</label>
                        <input type="text" name="title" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="title" value="{{old('title')}}" placeholder="Enter facility name">
                        </div>
                    </div>
    
                    <div class="w-full flex flex-col">
                        <label for="body" class="font-semibold leading-none mt-4">本文</label>
                        <textarea name="body" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="body" cols="30" rows="10">{{old('body')}}</textarea>
                    </div>
    
                    <div class="w-full flex flex-col">
                        <label for="image" class="font-semibold leading-none mt-4">画像 </label>
                        <div>
                            <input id="image_m" type="file" name="image_main">
                        </div>
                        <div>
                            <input id="image_s1" type="file" name="image_sub1">
                        </div>
                        <div>
                            <input id="image_s2" type="file" name="image_sub2">
                        </div>
                        <div>
                            <input id="image_s3" type="file" name="image_sub3">
                        </div>
                        <div>
                            <input id="image_s4" type="file" name="image_sub4">
                        </div>
                    </div>

                    <div class="w-full flex flex-col">
                        <label for="hpadress" class="font-semibold leading-none mt-4">HPアドレス</label>
                        <input type="text" name="hp_adress" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="hpadress" placeholder="Enter hp adress">
                    </div>

                    <div class="w-full flex flex-col">
                        <label for="areas_id" class="font-semibold leading-none mt-4">地域</label>
                        <select name="areas" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="areas_id">
                            @foreach($items_a as $item_a)
                                <option value="{{$item_a->id}}">{{$item_a->area}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full flex flex-col">
                        <label for="areas_id" class="font-semibold leading-none mt-4">施設区分</label>
                        <ul id="areas_id">
                            <li>
                                <label class="leading-none mt-4">
                                    <input type="checkbox" name="facility[]" class="placeholder-gray-300 border border-gray-300 rounded-md" value="park" checked>公園
                                </label>
                                <label class="leading-none mt-4">
                                    <input type="checkbox" name="facility[]" class="placeholder-gray-300 border border-gray-300 rounded-md" value="indoor_fac">屋内施設
                                </label>
                                <label class="leading-none mt-4">
                                    <input type="checkbox" name="facility[]" class="placeholder-gray-300 border border-gray-300 rounded-md" value="shopping">買物
                                </label>
                                <label class="leading-none mt-4">
                                    <input type="checkbox" name="facility[]" class="placeholder-gray-300 border border-gray-300 rounded-md" value="gourmet">グルメ
                                </label>
                                <label class="leading-none mt-4">
                                    <input type="checkbox" name="facility[]" class="placeholder-gray-300 border border-gray-300 rounded-md" value="others">その他
                                </label>
                            </li>
                        </ul>
                    </div>

                    <div class="w-full flex flex-col">
                        <label for="age_id" class="font-semibold leading-none mt-4">お勧め年代（お勧め度：１～５)</label>
                        <ul id="age_id">
                            <li><label>　幼　　児　：<input type="text" name="infant"           class="w-16 py-2 placeholder-gray-300 border border-gray-300 rounded-md"></label></li>
                            <li><label>小学生低学年：<input type="text" name="lower_grade"      class="w-16 py-2 placeholder-gray-300 border border-gray-300 rounded-md"></label></li>
                            <li><label>小学生高学年：<input type="text" name="highter_grade"    class="w-16 py-2 placeholder-gray-300 border border-gray-300 rounded-md"></label></li>
                            <li><label>中学生以上　：<input type="text" name="over13"           class="w-16 py-2 placeholder-gray-300 border border-gray-300 rounded-md"></label></li>
                        </ul>
                    </div>

                    <div class="w-full flex flex-col">
                        <label for="dog_id" class="font-semibold leading-none mt-4">犬OK？</label>
                        <ul id="dog_id">
                            <li><label>ＮＧ:<input type="radio" name="dogs" value=0></label></li>
                            <li><label>ＯＫ:<input type="radio" name="dogs" value=1></label></li>
                            <li><label>不明:<input type="radio" name="dogs" value=99 checked></label></li>
                        </ul>
                    </div>


                    <x-primary-button class="mt-4">
                        送信する
                    </x-primary-button>
                    
                </form>
            </div>
        </div>

</x-app-layout>