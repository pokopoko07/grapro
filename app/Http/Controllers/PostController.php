<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Area;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // 投稿された記事を、新しい順に表示させます
    public function index()
    {
        $posts=Post::orderBy('created_at','desc')->get();
        $user=auth()->user();
        return view('post.index', compact('posts', 'user'));
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
            'hp_adress' =>'url',
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
