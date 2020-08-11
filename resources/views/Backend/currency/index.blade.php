@extends("Backend.layouts.dataTable")

@section("control_card")
    <a href="{{route("backend.currency.create")}}" class="btn btn-outline-success"><i class="fa fa-plus"></i> {{__("label.buttons.add")}}</a>
    <a href="{{route("backend.currency.import_currencies_nbu")}}" class="btn btn-outline-success"><i class="fa fa-plus"></i> {{__("label.currency.import_nbu")}}</a>
@endsection

@section("table_header")
    <tr>
        <th>{{__("label.currency_code")}}</th>
        <th>{{__("label.currency_name")}}</th>
        <th>{{__("label.county")}}</th>
        <th>{{__("label.created_at")}}</th>
        <th>{{__("label.updated_at")}}</th>
        <th></th>
    </tr>
@endsection

@section("table_body")
    @if(!$dataTable->isEmpty())
        @foreach($dataTable as $item)
            <tr>
                <td>{{$item->code}}</td>
                <td>{{$item->currency_name}}</td>
                <td>{{$item->country}}</td>
                <td>{{$item->created_at}}</td>
                <td>{{$item->updated_at}}</td>
                <td class="float-right">
                    <a href="{{route("backend.currency.edit", $item->code)}}" class="btn btn-sm btn-outline-info">
                        <i class="fa fa-edit"> </i> {{__("label.buttons.edit")}}
                    </a>
                    <button data-href="{{route("backend.currency.destroy", $item->code)}}" class="btn btn-sm btn-outline-danger deleteItem">
                        <i class="fa fa-trash"></i> {{__("label.buttons.delete")}}
                    </button>
                </td>

            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="4"><h3 class="text-danger text-center">{!! __("label.table_is_empty", ["tableName" => "`currencies`"]) !!}</h3></td>
        </tr>
    @endif
@endsection

@section("table_footer")
    <tr>
        <th>{{__("label.currency_code")}}</th>
        <th>{{__("label.currency_name")}}</th>
        <th>{{__("label.county")}}</th>
        <th>{{__("label.created_at")}}</th>
        <th>{{__("label.updated_at")}}</th>
        <th></th>
    </tr>
@endsection

@section("js")
    @parent
    <script>
        $(".deleteItem").on("click", function () {
            let href = $(this).attr("data-href");
            scripts.confirmDeleteItemByHref(href)
        })
    </script>
@stop
