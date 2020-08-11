@extends("Backend.layouts.page")
@section("plugins.Select2", true)

@section("content")
    <div class="row">
        <div class="col-12">
            {!! form($form) !!}
        </div>
    </div>
@endsection



@section("js")
    @parent()

    <script>
        $(() => {
            $(".select2").select2();
        })
    </script>

@stop
