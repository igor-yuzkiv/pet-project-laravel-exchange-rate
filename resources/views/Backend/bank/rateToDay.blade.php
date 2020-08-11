@extends("Backend.layouts.dataTable", ["control_card" => false])

@section("before_table")
    <h4 class="text-success">{!! $title !!}</h4>
@endsection

@section("table_header")
    <tr>
        <th>{{__("label.currency_code")}}</th>
        <th>{{__("label.sale")}}</th>
        <th>{{__("label.purchase")}}</th>
    </tr>
@endsection


@section("table_body")
   @if ($dataTable != null or !empty($dataTable))
       @foreach($dataTable as $item)
           <tr>
               <td>{{$item['currency_code']}}</td>
               <td>{{$item['sale']}}</td>
               <td>{{$item['purchase']}}</td>
           </tr>
       @endforeach
    @else
        <tr>
            <td colspan="3">{!! __("label.bank.rate_to_day.is_empty", ["bankName", $bankInfo->name]) !!}</td>
        </tr>
    @endif
@endsection

@section("table_footer")
    <tr>
        <th>{{__("label.currency_code")}}</th>
        <th>{{__("label.sale")}}</th>
        <th>{{__("label.purchase")}}</th>
    </tr>
@endsection

