@extends('layout')

@section('title', 'ລະບົບຈອງລົດ ທຫລ')

@push('css')
    <style>
        
    </style>
@endpush

@section('content')

 

    <div class="card">
        <div class="card-body">
            <br>
            <h3 class="fontLao  font-weight-bold">ປະຫວັດການຈອງລົດ</h3>
        </div>

        <div class="table-responsive p-3">
            <table class="table table-bordered table-hover table-striped" id="table_id_example">
                <thead>
                    <tr class="fontLao">
                        <th width="25px">ລ/ດ</th>    
                        <th width="40px">ເປີດອ່ານ</th>
                        
                        <th>ເວລາສັ່ງຈອງ</th>
                        <th>ຈຸດເລີ່ມຕົ້ນ</th>
                        <th>ປາຍທາງ</th>
                        <th width="80px">ສະຖານະ</th>
                        <th>ເວລາອະນຸມັດ</th>
                        <th width="50px">ປ້າຍລົດ</th>
                        <th>ຍົກເລີກ / ລຶບ</th>
                    </tr>
                </thead>
            
                <tbody>
                    @foreach($bookings as $key => $val)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td align="center">
                            <div style="cursor: pointer;" class="btn-view" data-id="{{$val->id}}">
                                <i class="mdi mdi-email-open-outline" style="font-size: 20px;"></i>
                            </div>
                        </td>
                        <td>{{ date("d/m/Y  H:i", strtotime($val->request_date)) }}</td>
                        <td class="fontLao">{{ $val->src }}</td>
                        <td class="fontLao">{{ $val->des }}</td>
                        <td class="fontLao">
                            @if($val->status == "W")
                            <div class="badge badge-warning text-white">ລໍຖ້າອະນຸມັດ</div>
                            @elseif($val->status == "U")
                            <div class="badge badge-danger">ຖືກປະຕິເສດ</div>
                            @elseif($val->status == "A")
                            <div class="badge badge-success">ອະນຸມັດແລ້ວ</div>
                            @elseif($val->status == "C")
                            <div class="badge badge-warning text-white">ລໍຖ້າຍົກເລີກ</div>  
                            @endif
                        </td>
                        <td>
                            @if($val->approve_date)
                            {{ date("d/m/Y  H:i", strtotime($val->approve_date)) }}
                            @endif
                        </td>
                        <td class="fontLao">
                            @if($val->car_id)
                            {{ $val->car->car_no }}
                            @endif
                        </td>
                        <td>
                            @if($val->status == "W")
                            <div class="badge badge-danger fontLao btn-delete" style="cursor: pointer;" data-id="{{$val->id}}">ລຶບ</div>
                            @elseif($val->status == "A" && date("Y-m-d H:i:s",time()) < $val->from_date )
                            <div class="badge badge-warning fontLao text-white btn-cancel" style="cursor: pointer;" data-id="{{$val->id}}">ຍົກເລີກ</div>
                            @endif
                            
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
        </div>
    </div>


    
<div class="modal fade" id="view" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="background-color: #F5F7FF;">
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="fontLao">ຂໍ້ມູນຈອງລົດ</h3>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-light fontLao btn-close">X</button>
                    </div>
                </div>
                <br>
                
                <div class="row" id="view-detial">

                </div>

                
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).on("click",".btn-view",function(){
        var id = $(this).attr("data-id")
        var req_url = "{{url('user/view/')}}" + "/" + id;
        $.ajax({
            url: req_url,
            type: 'GET',
            data: {},
            success:function (arg) {
                console.log(arg)
                $("#view-detial").html(arg)
                $("#view").modal('toggle');
            }
        })
    })

    $(document).on("click",".btn-close",function(){
        $("#view").modal('hide');
    })
</script>

<script>
    $(document).on("click",".btn-delete",function(){
        var id = $(this).attr("data-id")
        swal({
            title: "ຕ້ອງການລຶບແທ້ບໍ່ ?",
            icon: "warning",
            buttons: [
                'ຍົກເລີກ',
                'ຕົກລົງ'
            ],
            dangerMode: true,
        }).then(function(isConfirm) {
            if (isConfirm) {
                var req_url = "{{url('user/delete/')}}" + "/" + id;
                $.ajax({
                    url: req_url,
                    type: 'GET',
                    data: {},
                    success:function (arg) {
                        console.log(arg)
                        swal({
                            title: arg["msg"],
                            icon: arg["icon"],
                        }).then(()=>location.reload())
                    }
                })
            }
        })
    })

    $(document).on("click",".btn-cancel",function(){
        var id = $(this).attr("data-id")
        swal({
            title: "ຕ້ອງການຍົກເລີກແທ້ບໍ່ ?",
            icon: "warning",
        }).then(function(isConfirm) {
            if (isConfirm) {
                var req_url = "{{url('user/cancel/')}}" + "/" + id;
                $.ajax({
                    url: req_url,
                    type: 'GET',
                    data: {},
                    success:function (arg) {
                        console.log(arg)
                        swal({
                            title: arg["msg"],
                            icon: arg["icon"],
                        }).then(()=>location.reload())
                    }
                })
            }
        })
    })
</script>
@endpush