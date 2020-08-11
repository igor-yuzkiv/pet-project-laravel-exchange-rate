@extends("Frontend.template.master")

@push("css_post")
    <link rel="stylesheet" href="{{asset("css/app.css")}}"/>
@endpush

@push("js_post")
    <script src="{{asset("js/app.js")}}"></script>
@endpush

@section('plugins.jquery-confirm', true)


@push("sections")
    <div class="section padding_layout_1">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @yield("content")
                </div>
                <div class="col-md-4">
                    <div class="side_bar">
                        @yield("side_bar")
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush
