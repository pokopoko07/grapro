<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            記事の検索ページ
        </h2>

        {{-- <x-validation-errors class="mb-4" :errors="$errors" />

        <x-message :message="session('message')" /> --}}
    </x-slot>
    
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mx-4 sm:p-8">
                <form method="post" action="/result" enctype="multipart/form-data">
                    @csrf
                    <table class="border w-3/4 mt-8">
                        <tr><th class="mt-4">単語で検索：<br>（複数単語可：カンマもしくはスペースで区切って下さい）</th>
                            <td class="w-3/4">
                                <div class="md:flex items-center mt-4">
                                    <input type="text" name="word" class="w-3/4 py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="word" value="{{old('word')}}" placeholder="複数ある場合は、「,」で区切って入力して下さい。例)遊具,公園">
                                </div>
                            </td>
                        </tr>
                        <tr><th><div class="mt-8">施設区分：</div></th>
                            <td>
                                <div class="w-full flex flex-row mt-8">
                                    <label class="ml-4"><input type="checkbox" name="facility_name[]" value="park">公園</label>
                                    <label class="ml-4"><input type="checkbox" name="facility_name[]" value="indoor_fac">屋内施設</label>
                                    <label class="ml-4"><input type="checkbox" name="facility_name[]" value="shopping">買物</label>
                                    <label class="ml-4"><input type="checkbox" name="facility_name[]" value="gourmet">グルメ</label>
                                    <label class="ml-4"><input type="checkbox" name="facility_name[]" value="others">その他</label>
                                </div>
                            </td>
                        </tr>
                        <tr><th><div class="mt-8">場所：</div></th>
                            <td>
                                <div class="w-full flex flex-row  mt-8">
                                    @foreach($items_a as $item_a)
                                        <label class="ml-4"><input type="checkbox" name="area_name[]" value="{{$item_a->id}}" checked>{{$item_a->area}}</label>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th><div class="mt-8">犬OK?:</div></th>
                            <td>
                                <div class="w-full flex flex-row  mt-8">
                                    <label class="ml-4">全て:<input type="radio" name="dogs" value=100 checked></label>
                                    <label class="ml-4">ＮＧ:<input type="radio" name="dogs" value=1></label>
                                    <label class="ml-4">ＯＫ:<input type="radio" name="dogs" value=2></label>
                                    <label class="ml-4">不明:<input type="radio" name="dogs" value=99></label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th><div class="mt-8">対象年代:</div></th>
                            <td>
                                <div class="w-full flex flex-row  mt-8">
                                    <label class="ml-4"><input type="checkbox" name="age_name[]" value="infant">幼児</label>
                                    <label class="ml-4"><input type="checkbox" name="age_name[]" value="lower_grade">小学生低学年</label>
                                    <label class="ml-4"><input type="checkbox" name="age_name[]" value="higher_grade">小学生高学年</label>
                                    <label class="ml-4"><input type="checkbox" name="age_name[]" value="over13">中学生以上</label>
                                </div>
                            </td>
                        </tr>
                        <tr><th></th>
                            <td>
                                <x-primary-button class="mt-12">
                                    検　索
                                </x-primary-button>
                            </td>
                        </tr>
                    </table>
                    
                </form>
            </div>
        </div>

</x-app-layout>