@dd($data)
<div class="bg-white">
    <a href="{{ route('Project',['slugCat'=>$data->categories->slug, 'slugPro'=>$data->slug]) }}">
        <img src="{{ $data->avatar }}" alt="" class="w-full">
    </a>
</div>