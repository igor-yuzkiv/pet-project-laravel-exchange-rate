@extends("Backend.layouts.dataTable", ["table_classes" => "table table-striped projects", "nowrap" => false])

@section("control_card")
    <a href="{{route("backend.banks.create")}}" class="btn btn-outline-success"><i class="fa fa-plus"></i> {{__("label.buttons.add")}}</a>
@endsection

@section("table_header")
    <tr>
        <th></th>
        <th>{{__("label.name_bank")}}</th>
        <th>{{__("label.alias_bank")}}</th>
        <th>{{__("label.banks.is_enable")}}</th>
        <th></th>
        <th></th>
    </tr>
@endsection

@section("table_body")
    @foreach($dataTable as $item)
        <tr>
            <td>
                <img class="table-avatar" style="" src="{{Storage::url($item->logo_path)}}">
            </td>
            <td>{!! $item->name !!}</td>
            <td>{!! $item->alias !!}</td>
            <td>

                @if ($item->is_enable)
                    <span class="badge bg-success">{{__("label.enabled")}}</span>

                    <a href="{{route("backend.banks.changeEnable", $item->id)}}" class="btn btn-sm btn-outline-warning">
                        <i class="fa fa-lock"></i> {{__("label.buttons.disable")}}
                    </a>
                @else
                    <span class="badge bg-warning">{{__("label.disabled")}}</span>
                    <a href="{{route("backend.banks.changeEnable", $item->id)}}" class="btn btn-sm btn-outline-success">
                        {{__("label.buttons.enable")}}
                    </a>
                @endif
            </td>
            <td>
                <a href="{{route("backend.banks.rateToDay", $item->id)}}" class="btn btn-sm btn-outline-primary">
                    {{__("label.rate_to_day")}}
                </a>

            </td>
            <td class="float-right">
                <a href="{{route("backend.banks.edit", $item->id)}}" class="btn btn-sm btn-outline-info">
                    <i class="fa fa-edit"> </i> {{__("label.buttons.edit")}}
                </a>
                <button data-href="{{route("backend.banks.destroy", $item->id)}}" class="btn btn-sm btn-outline-danger deleteItem">
                    <i class="fa fa-trash"></i> {{__("label.buttons.delete")}}
                </button>
            </td>
        </tr>
    @endforeach
@endsection

@section("table_footer")
    <tr>
        <th></th>
        <th>{{__("label.name_bank")}}</th>
        <th>{{__("label.alias_bank")}}</th>
        <th>{{__("label.is_enable")}}</th>
        <th></th>
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
