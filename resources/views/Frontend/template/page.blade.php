@extends("Frontend.template.master")

@section('plugins.LaravelWebpackMix', true)
@section('plugins.jquery-confirm', true)

@push("sections")
<div class="section padding_layout_1 checkout_section">
    <div class="container">
        @yield("content")
    </div>
</div>
@endpush
