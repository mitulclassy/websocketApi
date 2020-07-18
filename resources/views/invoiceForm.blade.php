@extends('root')

@section('body')

<?php $jsonData=($data)?$data:collect([])->toJson();
?>
<invoiceform :ms-data="{{$jsonData}}" />

@endsection