<x-guest-layout>
    <body class="antialiased">
    <div class="h-screen pb-14 bg-right bg-cover">
    <div class="container pt-10 md:pt-18 px-6 mx-auto flex flex-wrap flex-col md:flex-row items-center bg-white-100">
        <!--左側-->
        <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden ">
            <h1 class="my-4 text-3xl md:text-5xl text-black-800 font-bold leading-tight text-center md:text-left slide-in-bottom-h1">アラカシ</h1>
            <p class="leading-normal text-base md:text-2xl mb-8 text-center md:text-left slide-in-bottom-subtitle">
                　「アラカシ」　柏周辺=around Kashiwa　略して「アラカシ」です。柏周辺の、子供と一緒にお出かけできるお出かけスポットを紹介しています。
                <br>
                　ぜひ、お気軽にご利用ください。
            </p>
        
            <p class="text-blue-400 font-bold pb-8 lg:pb-6 text-center md:text-left fade-in">
                会員募集中。お気軽にひょっこりきてください。
            </p>
            <div class="flex w-full justify-center md:justify-start pb-24 lg:pb-0 fade-in">
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
        <div class="w-full xl:w-3/5 py-6 overflow-y-hidden">
            <img class="w-5/6 mx-auto lg:mr-0 slide-in-bottom rounded-lg shadow-xl" src="{{asset('logo/welcome.jpg')}}">
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
    </body>
</x-guest-layout>
