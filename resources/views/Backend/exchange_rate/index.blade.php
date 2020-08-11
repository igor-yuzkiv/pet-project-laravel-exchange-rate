@extends("Backend.layouts.dataTable")
@section("plugins.daterangepicker", true)
@section("plugins.Select2", true)

@section("control_card")
    {{Form::open(["method" => "GET" ,"id" => "filter"])}}
    <div class="row">

        <div class="col-4">
            <div class="form-group">
                {{Form::label(__("label.exchange_rate.date"))}}
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    {{Form::text("date_between", isset($_GET['date_between']) ? $_GET['date_between'] : "", ["class" => "form-control float-right", "style" => "width:100%", "id" => "date_between"])}}
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="form-group">
                {{Form::label(__("label.Bank"))}}
                {{Form::select("bank_id", ["%" => __("label.all")] + $filter_data["bank_id"] , isset($_GET['bank_id']) ? $_GET['bank_id'] : null, ["id" => "bank_id", "style" => "width:100%", "class" => "form-control select2",])}}
            </div>
        </div>

        <div class="col-4">
            <div class="form-group">
                {{Form::label(__("label.currency_code"))}}
                {{Form::select("currency_code", ["%" => __("label.all")] + $filter_data["currency_code"] , isset($_GET['currency_code']) ? $_GET['currency_code'] : null, ["id" => "currency_code", "style" => "width:100%", "class" => "form-control select2",])}}
            </div>
        </div>

    </div>
    <div class="row">
        <div class="form-group">
            {{Form::submit(__("label.btn_filter"), ["class" => "btn btn-info", "id" => "filter_submit"])}}
            <a href="{{route("backend.exchange-rate.index")}}" class="btn btn-info"> {!! __("label.btn_drop_filter") !!} </a>
        </div>
    </div>
    {{Form::close()}}
@endsection

@section("before_table")
    {{$dataTable->withQueryString()->links()}}
@endsection

@section("table_header")
    <tr>
        <th>{{__("label.currency_code")}}</th>
        <th>{{__("label.currency_name")}}</th>
        <th>{{__("label.Bank")}}</th>
        <th>{{__("label.sale")}}</th>
        <th>{{__("label.purchase")}}</th>
        <th>{{__("label.exchange_rate.date")}}</th>
        <th>{{__("label.created_at")}}</th>
    </tr>
@endsection

@section("table_body")
    @foreach($dataTable as $item)
        <tr>
            <td>{{$item->currency_code}}</td>
            <td>{{$item->currency_name}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->sale}}</td>
            <td>{{$item->purchase}}</td>
            <td>{{$item->date}}</td>
            <td>{{$item->created_at}}</td>
        </tr>
    @endforeach
@endsection

@section("table_footer")
    <tr>
        <th>{{__("label.currency_code")}}</th>
        <th>{{__("label.currency_name")}}</th>
        <th>{{__("label.Bank")}}</th>
        <th>{{__("label.sale")}}</th>
        <th>{{__("label.purchase")}}</th>
        <th>{{__("label.exchange_rate.date")}}</th>
        <th>{{__("label.created_at")}}</th>
    </tr>
@endsection

@section("js")
    @parent
    <script>
        $(() => {
            $(".select2").select2();

            let table = $("#exchange_rate_rate_data_table").DataTable({
                language: scripts.getDataTableLanguageOptions(),
                paging: false,
                lengthChange: false,
                searching: false,
                ordering: true,
                info: false,
                autoWidth: false,
                responsive: true,
                pageLength: 50,
            });

            table.order([[5, 'desc']]).draw();

        });

        let datePickerLocaleOptions = scripts.getDatePickerLocaleOptions();
        datePickerLocaleOptions.format = "Y-MM-DD";

        $("#date_between").daterangepicker({
            showDropdowns: true,
            timePicker: false,
            timePicker24Hour: false,
            timePickerIncrement: 30,
            locale: datePickerLocaleOptions,
        });



    </script>
@stop
