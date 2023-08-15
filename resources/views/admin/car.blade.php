@extends('layout')

@section('title', 'ລະບົບຈອງລົດ ທຫລ')

@push('css')
    <style>
        tbody td{
            padding-bottom: 8px !important;
            padding-top: 8px !important;
        }
    </style>
@endpush

@section('content')

<div class="card">
    <div class="card-body ml-3 mr-3">
        
        <div class="d-flex justify-content-between mt-2 mb-3">
            <div><h3 class="fontLao font-weight-bold">ຂໍໍ້ມູນລົດທັງໝົດ</h3></div>
            <div><button class="btn btn-primary fontLao" id="btn-add-car">ເພີ່ມຂໍ້ມູນລົດ</button></div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped fontLao">
                <thead>
                    <tr>
                        <th width="40px">ລຳດັບ</th>    
                        <th>ປ້າຍລົດ</th>
                        <th>ປະເພດລົດ</th>
                        <th>ສີລົດ</th>
                        <th>ແກ້ໄຂ / ລຶບ</th>
                    </tr>
                </thead>
                <tbody>
                    @if(sizeof($cars) > 0)
                        @foreach($cars as $key => $val)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $val->car_no }}</td>
                                <td>{{ $val->car_type }}</td>
                                <td>{{ $val->car_color }}</td>
                                <td>
                                    <div class="badge badge-warning fontLao text-white btn-edit mr-2" style="cursor: pointer;" data-id="{{$val->id}}">ແກ້ໄຂ</div>
                                    <div class="badge badge-danger fontLao btn-delete" style="cursor: pointer;" data-id="{{$val->id}}">ລຶບ</div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="5" align="center">ບໍ່ມີຂໍ້ມູນ</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- add modal -->
<div class="modal fade" id="add-car-modal" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #F5F7FF;">
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="fontLao">ເພີ່ມຂໍ້ມູນລົດ</h3>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-light fontLao" data-dismiss="modal">X</button>
                    </div>
                </div>
                <br>
                
                <div class="card">
                    <div class="card-body fontLao">
                        <form id="add-car-form" action="{{url('admin/car/add')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <!-- ສີລົດ -->
                                <label for="car_color" class="col-3 col-form-label text-right">ສີລົດ</label>
                                <div class="col-9">
                                    <input type="text" name="car_color" id="car_color" class="form-control" placeholder="ຂາວ, ດຳ, ຟ້າ, ແດງ ..." autocomplete="off" required>
                                </div>

                                <!-- ປ້າຍລົດ -->
                                <label for="car_no" class="col-3 col-form-label text-right">ປ້າຍລົດ</label>
                                <div class="col-9">
                                    <input type="text" name="car_no" id="car_no" class="form-control" placeholder="ກກ-1234" autocomplete="off" required>
                                </div>

                                <!-- ປະເພດລົດ -->
                                <label for="car_type" class="col-3 col-form-label text-right">ປະເພດລົດ</label>
                                <div class="col-9">
                                    <input type="text" name="car_type" id="car_type" class="form-control" placeholder="ເກັ໋ງ, ວີໂກ້, ຕູ້ ..." autocomplete="off" required>
                                </div>

                                <div class="col-9 offset-3">
                                    <button class="btn btn-primary fontLao btn-save-car">ບັນທຶກ</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- edit modal -->
<div class="modal fade" id="edit-car-modal" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #F5F7FF;">
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="fontLao">ແກ້ໄຂຂໍ້ມູນລົດ</h3>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-light fontLao" data-dismiss="modal">X</button>
                    </div>
                </div>
                <br>
                
                <div class="card">
                    <div class="card-body fontLao">
                        <form id="edit-car-form" action="{{url('admin/car/edit')}}" method="post">
                            @csrf
                            <div class="form-group row" id="car-detial">
                                
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- for alert_msg -->
<input type="hidden" id="alert_msg" value="{{ session()->pull('alert_msg') }}"/>
<input type="hidden" id="alert_icon" value="{{ session()->pull('alert_icon') }}"/>

@endsection

@push('scripts')
<script>
    var alert_msg = $('#alert_msg').val();
    var alert_icon = $('#alert_icon').val();
    if(alert_msg !== ''){
        swal({
            title: alert_msg,
            icon: alert_icon,
        });
    }
        

    $(document).on("click","#btn-add-car",function(){
        $("#add-car-modal").modal('toggle');
    })
    $(document).on("click","#btn-save-car",function(e){
        e.preventDefault()
        var valid =  document.querySelector('#add-car-form').reportValidity()
        if(valid){
            $("#add-car-form").submit()
        }
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
                var req_url = "{{url('admin/car/delete/')}}" + "/" + id;
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

    $(document).on("click",".btn-edit",function(){
        var id = $(this).attr("data-id")
        var req_url = "{{url('admin/car/view/')}}" + "/" + id;
        $.ajax({
            url: req_url,
            type: 'GET',
            data: {},
            success:function (arg) {
                console.log(arg)
                $("#car-detial").html(arg)
                $("#edit-car-modal").modal('toggle');
            }
        })
    })

    $(document).on("click","#btn-edit-car",function(e){
        e.preventDefault()
        var valid =  document.querySelector('#edit-car-form').reportValidity()
        if(valid){
            $("#edit-car-form").submit()
        }
    })
</script>

@endpush