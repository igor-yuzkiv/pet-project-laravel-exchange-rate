@extends("Backend.layouts.page")



@section("content")
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-default" title="{{__("label.buttons.add")}}"><i class="fa fa-plus"></i></button>
                    <table class="table projects" id="formTable">
                        <thead>
                        <tr>
                            <th>{{__("label.banks_options.query_attributes.key")}}</th>
                            <th>{{__("label.banks_options.query_attributes.value")}}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ( $queryAttributes != null OR !empty($queryAttributes)  )
                            @foreach($queryAttributes as $key => $value )
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$value}}</td>
                                    <td class="float-right">
                                        <a href="{{route("backend.banks-options.query_attributes_delete", [$banks_options_id, $key])}}" class="btn btn-outline-success btn-sm" title="Видалити"><i class="fa fa-minus"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            {{Form::open(["method" => "POST", "url" => route("backend.banks-options.query_attributes_store", $banks_options_id)])}}
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__("label.query_attributes.title")}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {{Form::label(__("label.banks_options.query_attributes.key"))}}
                        {{Form::text("query_attributes[key]", "", ["class" => "form-control"])}}
                    </div>
                    <div class="form-group">
                        {{Form::label("Коефіцієнт")}}
                        {{Form::text("query_attributes[value]", "", ["class" => "form-control"])}}
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal" >{!! __("form.base.attr.cancel") !!}</button>
                    <button type="submit" class="btn btn-outline-success" title="{{__("label.buttons.save")}}"><i class="fa fa-save"></i> {{__("labels.buttons.save")}}</button>
                </div>
            </div>
        {{Form::close()}}
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection

@section("js")
    @parent
    {{Html::script("js/components/bank/bank_options_query_attributes.js")}}
@stop
