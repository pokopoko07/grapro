<x-guest-layout>
    <body class="antialiased">
        <div class="h-screen pb-14 bg-right bg-cover">
            <div class="container pt-2 md:pt-18 px-6 mx-auto flex flex-col md:flex-row items-center bg-white-100">
                <!--左側-->
                <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden ">
                    <h1 class="my-4 text-3xl md:text-5xl text-black-800 font-bold leading-tight text-center md:text-left slide-in-bottom-h1">アラカシ</h1>
                    <p class="leading-normal text-base md:text-2xl mb-8 text-center md:text-left slide-in-bottom-subtitle">
                    　「アラカシ」　柏周辺=around Kashiwa　略して「アラカシ」です。柏周辺の、子供と一緒にお出かけできるお出かけスポットを紹介しています。
                    <br>
                    　ぜひ、お気軽にご利用ください。
                    </p>
        
                    <div class="flex w-full justify-center md:justify-center pb-24 lg:pb-0 fade-in">
                        {{-- ボタン設定 --}}
                        <a href="{{route('login')}}">
                            <x-primary-button class="mr-4 bg-blue-600 font-bold text-base text-center">
                                ログインはこちら
                            </x-primary-button>
                        </a>
                        <a href="{{route('register')}}">
                            <x-primary-button class="mr-4 bg-red-600 font-bold text-base text-center">
                                ご登録はこちら
                            </x-primary-button>
                        </a>
                    </div>
                </div>
                {{-- 右側 --}}
                @php
                     // public/imagesディレクトリ内のファイル一覧を取得する
                    $files = \File::files(public_path('storage/images'));

                    // 取得したファイル一覧から、JPEGファイルだけをフィルタリングする
                    $jpeg_files = [];
                    foreach ($files as $file) {
                        if (in_array($file->getExtension(), ['jpg', 'jpeg', 'JPG','JPEG'], true)) {
                            $jpeg_files[] = $file->getFilename();
                        }
                    }
                @endphp
                <div class="container_welcome w-full xl:w-3/5 py-6 overflow-y-hidden">
                    <div class="item_w1 h-32 w-full"> 
                        <img class="h-full w-full object-contain lg:mr-0" src="{{asset('logo/welcome.jpg')}}">
                    </div>
                    <div class="item_w2 w-full">
                        <img id="slideshow" class="h-full w-full object-cover lg:mr-0" src="{{asset('logo/takaitakai.jpg')}}">
                    </div>
                    <div class="item_w3 h-32 w-full">
                        <img id="slideshow3" class="h-full w-full object-cover lg:mr-0" src="{{asset('logo/girl.jpg')}}">
                    </div>
                    <div class="item_w4 h-32 w-full">
                        <img id="slideshow4" class="h-full w-full object-cover lg:mr-0" src="{{asset('logo/girl2.jpg')}}">
                    </div>
                    <div class="item_w5 h-32 w-full">
                        <img class="h-full w-full object-contain lg:mr-0" src="{{asset('logo/tree.jpg')}}">
                    </div>
                    <div class="item_w6 h-32 w-full">
                        <img id="slideshow6" class="h-full w-full object-cover lg:mr-0" src="{{asset('logo/tetunagi.jpg')}}">
                    </div>
                </div>
            </div>
            <div class="container pt-10 md:pt-18 px-6 mx-auto flex flex-wrap flex-col md:flex-row items-center">
                <div class="w-full text-sm text-center md:text-left fade-in border-2 p-4 text-red-800 leading-8 mb-8">
                    <P> ここは色々いれてください。</p>
                </div>
                <!--フッタ-->
                <div class="w-full pt-10 pb-6 text-sm md:text-left fade-in">
                    <p class="text-gray-500 text-center">@2023 アラカシ</p>
                </div>
            </div>
        </div>
        <script>
            let images = {!! json_encode($jpeg_files) !!};
            let index = 0;
            
            setInterval(function() {
                let index = Math.floor( Math.random() * images.length);
                // 画像を順次表示する
                // index = (index + 1) % images.length;
                let url = "{{ asset('storage/images') }}/" + images[index];
                document.getElementById('slideshow').src = url;
            }, 3000);

            setInterval(function() {
                let index = Math.floor( Math.random() * images.length);
                // 画像を順次表示する
                // index = (index + 1) % images.length;
                let url = "{{ asset('storage/images') }}/" + images[index];
                document.getElementById('slideshow3').src = url;

                let index4=0;
                do{
                    index4 = Math.floor( Math.random() * images.length);
                }while(index == index4);
                let url4 = "{{ asset('storage/images') }}/" + images[index4];
                document.getElementById('slideshow4').src = url4;

                let index6=0;
                do{
                    index6 = Math.floor( Math.random() * images.length);
                }while(index == index6 || index4 == index6);
                let url6 = "{{ asset('storage/images') }}/" + images[index6];
                document.getElementById('slideshow6').src = url6;

            }, 2000);


        </script>
    </body>
</x-guest-layout>
