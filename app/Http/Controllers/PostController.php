<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Area;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::orderBy('created_at','desc')->get();
        $user=auth()->user();
        return view('post.index', compact('posts', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items=Area::all();
        $param=[
            'items_a' => $items
        ];
        return view('post.create',$param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        switch (true) {
            case in_array('park', $request->facility):
                $post->park         =true;
            case in_array('indoor_fac', $request->facility):
                $post->indoor_fac   =true;
            case in_array('shopping', $request->facility):
                $post->shopping   =true;
            case in_array('gourmet', $request->facility):
                $post->gourmet   =true;
            case in_array('others', $request->facility):
                $post->others   =true;
                break;
        }
        // おすすめ年代
        $post->infant       =(int)$request->infant;
        $post->lower_grade  =(int)$request->lower_grade;
        $post->higher_grade=(int)$request->highter_grade;
        $post->over13       =(int)$request->over13;
        // 犬OK？
        $post->dogs         =(int)$request->dogs;

        $post->save();

        return redirect()->route('post.create')->with('message', '投稿を作成しました');    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
