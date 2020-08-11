@extends("Backend.layouts.simple_form")

@section("content")
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if ($model->is_enable)
                        <a href="{{route("backend.banks.changeEnable", $model->id)}}" class="btn btn-outline-danger">
                            {{__("label.buttons.disable")}}
                        </a>
                    @else
                        <a href="{{route("backend.banks.changeEnable", $model->id)}}" class="btn btn-outline-success">
                           {{__("label.buttons.enable")}}
                        </a>
                    @endif

                    @if($bank_options !== null)
                            <a href="{{route("backend.banks-options.edit", $bank_options->id)}}"
                               class="btn btn-outline-primary">
                                {{__("label.banks_options_select")}}
                            </a>
                            <a href="{{route("backend.banks-options.query_attributes", $bank_options->id)}}"
                               class="btn btn-outline-primary">
                                {{__("label.banks_options.query_attributes")}}
                            </a>

                            <a href=""
                               class="btn btn-outline-success">
                                {{__("label.banks.parse.to_day")}}
                            </a>

                        @else
                            <a href="{{route("backend.banks-options.create")}}"
                               class="btn btn-outline-info">
                                {{__("label.banks_options_create")}}
                            </a>
                        @endif


                </div>
            </div>
        </div>
    </div>
    @parent
@stop
