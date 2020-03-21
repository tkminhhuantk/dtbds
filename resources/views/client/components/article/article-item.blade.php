<div class="relative bg-white mb-4">
    <span class="absolute block bg-dark top-4 left-4 py-2 px-4 text-white text-sm uppercase rounded pointer-events-none">
        Dự án mới
    </span>
    <a href="{{ route('Project',['slugCat'=>$data->categories->slug, 'slugPro'=>$data->slug]) }}">
        <img src="{{ $data->avatar }}" title="{{ $data->title }}" alt="{{ $data->title }}"
             class="w-full h-56 md:h-64 object-cover object-center">
    </a>
    <div class="relative p-6">
        <a title="{{ $data->title }}"
           href="{{ route('Project',['slugCat'=>$data->categories->slug, 'slugPro'=>$data->slug]) }}"
           class="absolute block font-bold bg-main-100 hover:bg-main-200 text-white text-xs rounded uppercase px-4 py-2 -top-4 right-4">
            Chi tiết
        </a>
        <a title="{{ $data->title }}"
           href="{{ route('Project',['slugCat'=>$data->categories->slug, 'slugPro'=>$data->slug]) }}"
           class="webkit-box line-clamp-2 font-bold hover:text-main-200 overflow-hidden h-10 mb-1 transition duration-75 ease-in">
            {{ $data->title }}
        </a>
        <p class="webkit-box line-clamp-2 h-8 mb-1 text-xs text-gray-700">
            <i class="fas fa-map-marker-alt"></i> {{ $data->address }}
        </p>
        <p class="font-bold text-red-600">{{ $data->price }}</p>
    </div>
</div>