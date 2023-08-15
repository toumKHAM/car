@extends('layout')

@section('title', 'ລະບົບຈອງລົດ ທຫລ')

@push('css')
    <style>
        .body-center{
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endpush

@section('content')

<div style="height:100%;display: flex;align-items: center;justify-content: center;">

    <center>
      <h1 class="fontLao" style="font-size: 50px;color: #4B49AC;font-weight:bold">ລະບົບຈອງລົດ</h1>
      
      <h3 class="fontLao" style="color: #4B49AC;">ທະນາຄານ ແຫ່ງ ສປປ ລາວ</h3>
      <br><br>
      <img src="{{asset('images/car.png')}}" alt="">
    </center>
    
</div>

@endsection

@push('scripts')


@endpush