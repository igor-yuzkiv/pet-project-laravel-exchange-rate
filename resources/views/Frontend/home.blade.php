@extends("Frontend.template.master", ["inner_banner" => false])
@section('plugins.Chartjs', true)

@push("sections")

<div class="section padding_layout_1 testmonial_section white_fonts">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <div class="main_heading text_align_left">
                        <h2 style="text-transform: none;">Telegram-бот</h2>
                        <p class="large">Lorem Ipsum..</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
                <div class="full">
                    <div id="testimonial_slider" class="carousel slide" data-ride="carousel">
                        <div class="carousel-item active">
                            <div class="testimonial-container">
                                <div class="testimonial-content">
                                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                                    alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                                </div>
                                <div class="testimonial-photo"> <img src="{{asset("frontend/images/qr_telegram.png")}}" class="img-responsive" alt="#" width="160" height="160"> </div>
                                <div class="testimonial-meta">
                                    <a class="btn btn-info" href="{!! config("telegram.shareLink") !!}"> <i class="fa fa-telegram"></i> Telegram-бот</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="full"> </div>
            </div>
        </div>
    </div>
</div>


    @if($rateBaseCurrency !== null)
        <div class="section padding_layout_1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="full">
                            <div class="main_heading text_align_center">
                                <h2>{{__("frontend.page.home.main_heading.h2")}}</h2>
                                <p class="large">{!! __("label.avarage.rate.to.day") !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($rateBaseCurrency as $rbc_item)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="full text_align_center margin_bottom_30">
                                <div class="center">
                                    <div class="icon">
                                        <img class="table-avatar" style=""
                                             src="{{asset("frontend/images/currency/".$rbc_item->currency_code.".png")}}">
                                    </div>
                                </div>
                                <h4 class="theme_color">{{ $rbc_item->currency_code }}
                                    - {{$rbc_item->currency_name}}</h4>
                                <p> {{__("label.sale")}}: <strong
                                        style="font-size: 1.4em">{{$rbc_item->sale}}</strong>, {{__("label.purchase")}}
                                    : <strong style="font-size: 1.4em">{{$rbc_item->purchase}}</strong></p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <a class="btn main_bt"
                           href="{{route("frontend.exchange-rate.index")}}">{{__("label.btn_read_mode")}}</a>
                    </div>
                </div>
            </div>
        </div>

    @endif
@endpush


@section("js")
    @parent
    <script>

    </script>
@endsection
