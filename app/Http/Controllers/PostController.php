<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    // 投稿された記事を、新しい順に表示させます
    public function index()
    {
        $items=Area::all();
        $param=[
            'items_a' => $items
        ];
        return view('post.serch',$param);
    }

    public function result_back(Request $request, Post $posts)
    {
        $word           = explode(",",$request->session()->get('words'));
        if($request->session()->get('facilitys') == -1){
            $facility   =[];
        }else{
            $facility   = explode(",",$request->session()->get('facilitys'));
        }

        if($request->session()->get('areas') == -1){
            $area       = [];
        }else{
            $area       = explode(",",$request->session()->get('areas'));
        }

        $dogs           = $request->session()->get('dogs');

        if($request->session()->get('ages') == -1){
            $age        = [];
        }else{
            $age        = explode(",",$request->session()->get('ages'));
        }

        $posts = Post::where(function($query) use ($word) {
            // 1.2単語の数だけ、where文を作成します
            for($i=0;$i<count($word);$i++){
                if($i==0){
                    $query->where('title', 'LIKE', "%$word[$i]%")
                        ->orWhere('body', 'LIKE', "%$word[$i]%");
                }else{
                    $query->where('title', 'LIKE', "%$word[$i]%")
                    ->orWhere('body', 'LIKE', "%$word[$i]%");
                }
            }
        })->where(function($query) use ($facility) {
            // 2.2選ばれた施設区分の数だけ繰り返して、施設区分にtrueが入っている
            // データを抽出する
            if(empty($facility)==false){
                $first=0;
                for($i=0;$i<count($facility);$i++){
                    switch ($facility[$i]){
                        case "park":
                            if($first==0){
                                $query->where('park', '=', true);
                                $first=1;
                            }else{
                                $query->orWhere('park', '=', true);
                            }
                            break;
                        case "indoor_fac":
                            if($first==0){
                                $query->where('indoor_fac', '=', true);
                                $first=1;
                            }else{
                                $query->orWhere('indoor_fac', '=', true);
                            }
                            break;
                        case "shopping":
                            if($first==0){
                                $query->where('shopping', '=', true);
                                $first=1;
                            }else{
                                $query->orWhere('shopping', '=', true);
                            }
                            break;
                        case "shopping":
                            if($first==0){
                                $query->where('shopping', '=', true);
                                $first=1;
                            }else{
                                $query->orWhere('shopping', '=', true);
                            }
                            break;
                        case "gourmet":
                            if($first==0){
                                $query->where('gourmet', '=', true);
                                $first=1;
                            }else{
                                $query->orWhere('gourmet', '=', true);
                            }
                            break;
                        case "others":
                            if($first==0){
                                $query->where('others', '=', true);
                                $first=1;
                            }else{
                                $query->orWhere('others', '=', true);
                            }
                        break;
                    }
                }
            }
        })->where(function($query) use ($area) {
            // 3.2 選択された地域で検索をします
            if(empty($area)==false){
                $first=0;
                for($i=0;$i<count($area);$i++){
                    if($first==0){
                        $query->where('area_id', '=', $area[$i]);
                        $first=1;
                    }else{
                        $query->orWhere('area_id', '=', $area[$i]);
                    }
                }
            }
        })->where(function($query) use ($dogs) {
            // 4.犬ＯＫかで検索
            if($dogs<100){
                $query->where('dogs', '=', $dogs);
            }
        })->where(function($query) use ($age) {
            // 5.年代で検索
            // お勧め度が3以上のデータを検索
            $first=0;
            if(empty($age)==false){
                for($i=0;$i<count($age);$i++){
                    if($first==0){
                        $query->where($age[$i], '>', 3);
                        $first=1;
                    }else{
                        $query->orWhere($age[$i], '>', 3);
                    }
                }
            }
        })->orderBy('created_at', 'desc')->get();

        $user=auth()->user();

        $count=count($posts);
        return view('post.index', compact('posts', 'user','count'));
    }

    public function result(Request $request)
    {
        // 1.単語検索
        // 1.1入力されたデータを成形して、word[]に入力します
        $word = str_replace('、', ',', $request->word);
        $word = str_replace(' ',  ',', $word);
        $word = str_replace('　',  ',', $word);

        $request->session()->put('words',$word);//セッションに単語検索の単語を入れる
        $word = explode(",",$word);
        for($i=0;$i<count($word);$i++){
            $word[$i]=trim($word[$i]);
        }
        
        // 2.施設区分で検索
        // 2.1 得られたデータをわかりやすく変数に入れます
        $facility   = $request->facility_name;
        if (empty($facility)){
            $request->session()->put('facilitys', -1);
        }else{
            $request->session()->put('facilitys',implode(',', $facility));//セッションに施設区分を入れます
        }

        // 3.地域で検索
        // 3.1　得られたデータをわかりやすく変数に入れます
        $area       = $request->area_name;
        if (empty($area)){
            $request->session()->put('areas', -1);
        }else{
            $request->session()->put('areas',implode(',', $area));//セッションに地域を入れます
        }

        // 4.犬ＯＫかで検索
        $dogs       = $request->dogs;
        $request->session()->put('dogs',$dogs);//セッションに犬OKを入れます

        // 5.年代で検索
        $age        = $request->age_name;
        if (empty($age)){
            $request->session()->put('ages', -1);
        }else{
            $request->session()->put('ages',implode(',', $age));//セッションに地域を入れます
        }

        $posts = Post::where(function($query) use ($word) {
            // 1.2単語の数だけ、where文を作成します
            for($i=0;$i<count($word);$i++){
                if($i==0){
                    $query->where('title', 'LIKE', "%$word[$i]%")
                        ->orWhere('body', 'LIKE', "%$word[$i]%");
                }else{
                    $query->where('title', 'LIKE', "%$word[$i]%")
                    ->orWhere('body', 'LIKE', "%$word[$i]%");
                }
            }
        })->where(function($query) use ($facility) {
            // 2.2選ばれた施設区分の数だけ繰り返して、施設区分にtrueが入っている
            // データを抽出する
            if(empty($facility)==false){
                $first=0;
                for($i=0;$i<count($facility);$i++){
                    switch ($facility[$i]){
                        case "park":
                            if($first==0){
                                $query->where('park', '=', true);
                                $first=1;
                            }else{
                                $query->orWhere('park', '=', true);
                            }
                            break;
                        case "indoor_fac":
                            if($first==0){
                                $query->where('indoor_fac', '=', true);
                                $first=1;
                            }else{
                                $query->orWhere('indoor_fac', '=', true);
                            }
                            break;
                        case "shopping":
                            if($first==0){
                                $query->where('shopping', '=', true);
                                $first=1;
                            }else{
                                $query->orWhere('shopping', '=', true);
                            }
                            break;
                        case "shopping":
                            if($first==0){
                                $query->where('shopping', '=', true);
                                $first=1;
                            }else{
                                $query->orWhere('shopping', '=', true);
                            }
                            break;
                        case "gourmet":
                            if($first==0){
                                $query->where('gourmet', '=', true);
                                $first=1;
                            }else{
                                $query->orWhere('gourmet', '=', true);
                            }
                            break;
                        case "others":
                            if($first==0){
                                $query->where('others', '=', true);
                                $first=1;
                            }else{
                                $query->orWhere('others', '=', true);
                            }
                        break;
                    }
                }
            }
        })->where(function($query) use ($area) {
            // 3.2 選択された地域で検索をします
            if(empty($area)==false){
                $first=0;
                for($i=0;$i<count($area);$i++){
                    if($first==0){
                        $query->where('area_id', '=', $area[$i]);
                        $first=1;
                    }else{
                        $query->orWhere('area_id', '=', $area[$i]);
                    }
                }
            }
        })->where(function($query) use ($dogs) {
            // 4.犬ＯＫかで検索
            if($dogs<100){
                $query->where('dogs', '=', $dogs);
            }
        })->where(function($query) use ($age) {
            // 5.年代で検索
            // お勧め度が3以上のデータを検索
            $first=0;
            if(empty($age)==false){
                for($i=0;$i<count($age);$i++){
                    if($first==0){
                        $query->where($age[$i], '>', 3);
                        $first=1;
                    }else{
                        $query->orWhere($age[$i], '>', 3);
                    }
                }
            }
        })->orderBy('created_at', 'desc')->get();

        $user=auth()->user();

        $count=count($posts);
        return view('post.index', compact('posts', 'user','count'));
    }

    /* create 関数
    　新規投稿画面に遷移します　　　　　　　　　　　　　　　　 */
    public function create()
    {
        $items=Area::all();
        $param=[
            'items_a' => $items
        ];
        return view('post.create',$param);
    }

    // 投稿記事をDBに格納します
    public function store(Request $request)
    {
        // 入力のバリデーション処理
        $inputs=$request->validate([
            'title'     =>'required|max:255',
            'body'      =>'required|max:5000',
            'image_main'=>'image|max:1024',
            'image_sub1'=>'image|max:1024',
            'image_sub2'=>'image|max:1024',
            'image_sub3'=>'image|max:1024',
            'image_sub4'=>'image|max:1024',
            // 'hp_adress' =>'url',
            'infant'    =>'numeric|between:1,5',
            'lower_grade'=>'numeric|between:1,5',
            'higher_grade'=>'numeric|between:1,5',
            'over13'    =>'numeric|between:1,5'
        ]);

        $post=new Post();

        // ユーザID
        $post->user_id=auth()->user()->id;
        // 施設名
        $post->title=$request->title;
        // 本文
        $post->body=$request->body;
        // 画像
        if (request('image_main')){
            $original = request()->file('image_main')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            request()->file('image_main')->move('storage/images', $name);
            $post->image_main = $name;
        }
        if (request('image_sub1')){
            $original = request()->file('image_sub1')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            request()->file('image_sub1')->move('storage/images', $name);
            $post->image_sub1 = $name;
        }
        if (request('image_sub2')){
            $original = request()->file('image_sub2')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            request()->file('image_sub2')->move('storage/images', $name);
            $post->image_sub2 = $name;
        }
        if (request('image_sub3')){
            $original = request()->file('image_sub3')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            request()->file('image_sub3')->move('storage/images', $name);
            $post->image_sub3 = $name;
        }
        if (request('image_sub4')){
            $original = request()->file('image_sub4')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            request()->file('image_sub4')->move('storage/images', $name);
            $post->image_sub4 = $name;
        }
        // HPアドレス
        $post->hp_adress=$request->hp_adress;
        // 地域
        $post->area_id=(int)$request->areas;
        // 施設区分
        $post->park         =false;
        $post->indoor_fac   =false;
        $post->shopping     =false;
        $post->gourmet      =false;
        $post->others       =false;
        if(in_array('park', $request->facility)){
            $post->park=true;
        }
        if(in_array('indoor_fac', $request->facility)){
            $post->indoor_fac=true;
        }
        if(in_array('shopping', $request->facility)){
            $post->shopping=true;
        }
        if(in_array('gourmet', $request->facility)){
            $post->gourmet=true;
        }
        if(in_array('others', $request->facility)){
            $post->others   =true;
        }

        // おすすめ年代
        $post->infant       =(int)$request->infant;
        $post->lower_grade  =(int)$request->lower_grade;
        $post->higher_grade =(int)$request->higher_grade;
        $post->over13       =(int)$request->over13;
        // 犬OK？
        $post->dogs         =(int)$request->dogs;

        $post->save();

        return redirect()->route('post.create')->with('message', '投稿を作成しました');    
    }

    // 投稿した内容を一覧表示する
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    // 詳細画面の編集を行う画面を表示する
    public function edit(Post $post)
    {
        $items=Area::all();
        $param=[
            'items_a' => $items,
            'post'=> $post
        ];
        return view('post.edit', $param);
    }

    //　記事を編集後、DBをアップデートします 
    public function update(Request $request, Post $post)
    {
        // 入力のバリデーション処理
        $inputs=$request->validate([
            'title'     =>'required|max:255',
            'body'      =>'required|max:5000',
            'image_main'=>'image|max:1024',
            'image_sub1'=>'image|max:1024',
            'image_sub2'=>'image|max:1024',
            'image_sub3'=>'image|max:1024',
            'image_sub4'=>'image|max:1024',
            'hp_adress' =>'url',
            'infant'    =>'numeric|between:1,5',
            'lower_grade'=>'numeric|between:1,5',
            'higher_grade'=>'numeric|between:1,5',
            'over13'    =>'numeric|between:1,5'
        ]);

        // ユーザID
        $post->user_id = auth()->user()->id;
        // 施設名
        $post->title = $request->title;
        // 本文
        $post->body = $request->body;
        // 画像
        if (request('image_main')){
            $original = request()->file('image_main')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            $file = request()->file('image_main')->move('storage/images', $name);
            $post->image_main = $name;
        }
        if (request('image_sub1')){
            $original = request()->file('image_sub1')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            $file = request()->file('image_sub1')->move('storage/images', $name);
            $post->image_sub1 = $name;
        }
        if (request('image_sub2')){
            $original = request()->file('image_sub2')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            $file = request()->file('image_sub2')->move('storage/images', $name);
            $post->image_sub2 = $name;
        }
        if (request('image_sub3')){
            $original = request()->file('image_sub3')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            $file = request()->file('image_sub3')->move('storage/images', $name);
            $post->image_sub3 = $name;
        }
        if (request('image_sub4')){
            $original = request()->file('image_sub4')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            $file = request()->file('image_sub4')->move('storage/images', $name);
            $post->image_sub4 = $name;
        }
        // HPアドレス
        $post->hp_adress=$request->hp_adress;
        // 地域
        $post->area_id=(int)$request->areas;
        // 施設区分
        $post->park         =false;
        $post->indoor_fac   =false;
        $post->shopping     =false;
        $post->gourmet      =false;
        $post->others       =false;
        if(in_array('park', $request->facility)){
            $post->park=true;
        }
        if(in_array('indoor_fac', $request->facility)){
            $post->indoor_fac=true;
        }
        if(in_array('shopping', $request->facility)){
            $post->shopping=true;
        }
        if(in_array('gourmet', $request->facility)){
            $post->gourmet=true;
        }
        if(in_array('others', $request->facility)){
            $post->others   =true;
        }

        // おすすめ年代
        $post->infant       =(int)$request->infant;
        $post->lower_grade  =(int)$request->lower_grade;
        $post->higher_grade =(int)$request->higher_grade;
        $post->over13       =(int)$request->over13;
        // 犬OK？
        $post->dogs         =(int)$request->dogs;
                
        $post->save();

        return redirect()->route('post.show', $post)->with('message', '記事を更新しました');
    }

    // 投稿記事を削除します
    public function destroy(Post $post)
    {
        $post->comments()->delete();
        $post->delete();
        return redirect()->route('post.index')->with('message', '記事を削除しました');
    }
}
