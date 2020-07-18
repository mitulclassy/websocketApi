@extends('root')

@section('body')

    <?php

    $jsonData=(gettype($data)!='array')?$data:collect($data)->toJson();


    ?>
    <userpage :ms-data="{{$jsonData}}" />

@endsection

