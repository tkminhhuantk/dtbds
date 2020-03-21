@extends('client.masterlayout')
@section('content')
    <div class="relative w-full h-64 bg-main-100 mb-20">
{{--        @foreach($sliders as $slider)--}}

{{--        @endforeach--}}
        <div class="container flex flex-col-reverse h-full mx-auto px-4">
            <div class="-mb-16">
                <div class="flex bg-white">
                    <img class="w-1/4 object-center object-cover" src="{{ asset('assets/images/about-us.png') }}"
                         alt="About us">
                    <div class="p-4">
                        <h2 class="font-bold text-black text-2xl">Về chúng tôi</h2>
                        <p>Công nghệ dẫn đầu - Bứt phá kinh doanh. Tầm nhìn mới trong ngành bất động sản</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php $false = false @endphp
    <div class="container mx-auto px-3">
        <x-main-title title="Dự án nổi bật"
                      text="63 tỉnh thành trên cả nước, bạn cần sản phẩm bất động sản ở đâu chúng tôi cũng có. Bạn chỉ cần đưa nhu cầu, chúng tôi giúp bạn tìm kiếm sản phẩm phù hợp"
                      :h1="$false"></x-main-title>
        <div class="flex flex-wrap -mx-2">
            @foreach($projects as $project)
                <div class="w-full md:w-1/2 px-2">
                    <x-article-item :data="$project"></x-article-item>
                </div>
            @endforeach
        </div>
    </div>
    <div class="w-full">
        <div class="container mx-auto px-3">
            <x-main-title title="Nhà đầu tư"
                          text="Đối tác đầu tư làm cho nước đi táo bạo trong lĩnh vực công nghệ"
                          :h1="$false"></x-main-title>
        </div>
        <div class="flex flex-wrap">
            @php $clients = [
                'https://inspirothemes.com/polo/images/clients/1.png',
                'https://inspirothemes.com/polo/images/clients/2.png',
                'https://inspirothemes.com/polo/images/clients/3.png',
                'https://inspirothemes.com/polo/images/clients/4.png',
                'https://inspirothemes.com/polo/images/clients/5.png',
                'https://inspirothemes.com/polo/images/clients/6.png',
                'https://inspirothemes.com/polo/images/clients/7.png',
                'https://inspirothemes.com/polo/images/clients/8.png',
                'https://inspirothemes.com/polo/images/clients/9.png',
                'https://inspirothemes.com/polo/images/clients/10.png',
                'https://inspirothemes.com/polo/images/clients/11.png',
                'https://inspirothemes.com/polo/images/clients/12.png',
            ] @endphp
            @foreach($clients as $client)
                <div class="w-1/3 md:w-1/6">
                    <div class="flex items-center justify-center bg-white hover:bg-gray-200 p-4 h-32 border-gray-200 border transition duration-300 ease-in-out">
                        <img class="w-32" src="{{ $client }}" alt="">
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center py-4">
            <a href=""
               class="inline-block bg-main-100 hover:bg-main-200 transition duration-300 ease-in-out px-4 py-2 font-bold uppercase rounded">Tất
                cả nhà đầu tư</a>
        </div>
    </div>
    <div class="w-full mb-4">
        <img class="w-full" src="{{ asset('assets/images/about-us-2.png') }}" alt="">
    </div>
    <div class="container mx-auto px-4">
        <x-main-title title="Dự án trên toàn quốc"
                      text="63 tỉnh thành trên cả nước, bạn cần sản phẩm bất động sản ở đâu chúng tôi cũng có."
                      :h1="$false"></x-main-title>
        <div class="flex flex-wrap -mx-2">
            @for($i=0;$i<4;$i++)
                <div class="w-1/2 md:w-1/4 px-2">
                    <div class="city-item">
                        <img src="https://r-cf.bstatic.com/images/hotel/max1024x768/823/82372156.jpg" alt="Cần Thơ">
                        <p class="name">Cần Thơ</p>
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endsection