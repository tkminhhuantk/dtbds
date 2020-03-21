@php
    $config = App\Config::first();
@endphp
<footer>
    <div class="container mx-auto px-4">
        <div class="contact">
            <div class="contact-info">
                <h2 class="text-2xl text-white font-bold mb-3">Liên hệ với chúng tôi</h2>
                <div class="flex flex-wrap">
                    <div class="w-full md:w-2/5">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.674390433455!2d105.77121671472739!3d10.043704792821192!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a08968f945c5ab%3A0x73d7641eb55dc3b1!2zQ8O0bmcgVHkgVE5ISCBNacOqdSDGr25n!5e0!3m2!1svi!2s!4v1584761423122!5m2!1svi!2s"
                                width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen=""
                                aria-hidden="false" tabindex="0"></iframe>
                    </div>
                    <div class="w-full md:w-3/5">
                        <div class="pl-5">
                            <div class="flex">
                                <i class="far fa-map-marker-alt text-main-100 mr-2 inline-flex items-center justify-center flex-col h-4 w-4"></i>
                                <p class="text-gray-500">
                                    <b>Địa chỉ:</b> <br>
                                    {{ $config->address }}
                                </p>
                            </div>
                            <div class="flex">
                                <i class="far fa-mobile text-main-100 mr-2 inline-flex items-center justify-center flex-col h-4 w-4"></i>
                                <p class="text-gray-500">
                                    <b>Hotline:</b> {{ $config->phone }}<br>
                                </p>
                            </div>
                            <div class="flex">
                                <i class="far fa-paper-plane text-main-100 mr-2 inline-flex items-center justify-center flex-col h-4 w-4"></i>
                                <p class="text-gray-500">
                                    <b>Open Hours</b> <br>
                                    {!! $config->time !!}
                                </p>
                            </div>
                            <a class="inline-block bg-main-100 hover:bg-main-200 px-4 py-2 uppercase font-bold mt-6" href="tel:{{ $config->phone }}">Gọi cho chúng tôi ngay</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-form">
                <h2 class="text-2xl font-bold mb-3">Đăng ký tư vấn</h2>
                <form action="{{ route('ContactPostAdd') }}" method="post" id="frm-add-contact-page">
                    <div class="form-group">
                        @csrf
                        <input type="text" name="name" placeholder="Tên của bạn *" class="form-control"/>
                        <div class="red d-none" id="inp-name-error"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" placeholder="Email *" class="form-control"/>
                        <div class="red d-none" id="inp-email-error"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" placeholder="Điện thoại" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="title" placeholder="Tiêu đề *" class="form-control"/>
                        <div class="red d-none" id="inp-title-error"></div>
                    </div>
                    <div class="form-group">
                        <textarea name="content" class="form-control" placeholder="Nội dung *" rows="3"></textarea>
                        <div class="red d-none" id="inp-content-error"></div>
                    </div>
                    <div class="text-center">
                        <button type="submit"
                                class="inline-block px-10 py-2 bg-white hover:bg-gray-300 font-bold transition duration-300 ease-in-out rounded">
                            Gửi yêu cầu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="copyright">
        <p>Ghi rõ nguồn <b>"dautubatdongsan.vn"</b> khi phát hành lại thông tin từ website này.</p>
    </div>
</footer>