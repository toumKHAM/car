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
            <div><h3 class="fontLao font-weight-bold">ຂໍໍ້ມູນພະນັກງານຂັບລົດທັງໝົດ</h3></div>
            <div><button class="btn btn-primary fontLao" id="btn-add-driver">ເພີ່ມພະນັກງານຂັບລົດ</button></div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped fontLao">
                <thead>
                    <tr>
                        <th width="40px">ລຳດັບ</th>    
                        <th>ຊື່ ແລະ ນາມສະກຸນຄົນຂັບ</th>
                        <th>ເບີໂທ</th>
                        <th>ແກ້ໄຂ / ລຶບ</th>
                    </tr>
                </thead>
                <tbody>
                    @if(sizeof($drivers) > 0)
                        @foreach($drivers as $key => $val)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $val->name }}</td>
                                <td>{{ $val->phone }}</td>
                                <td>
                                    <div class="badge badge-warning fontLao text-white btn-edit mr-2" style="cursor: pointer;" data-id="{{$val->id}}">ແກ້ໄຂ</div>
                                    <div class="badge badge-danger fontLao btn-delete" style="cursor: pointer;" data-id="{{$val->id}}">ລຶບ</div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="4" align="center">ບໍ່ມີຂໍ້ມູນ</td>
                    </tr>
                    @endif
                </tbody>

            </table>
        </div>

    </div>
</div>

<!-- add modal -->
<div class="modal fade" id="add-driver-modal" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #F5F7FF;">
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="fontLao">ເພີ່ມຂໍ້ມູນພະນັກງານຂັບລົດ</h3>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-light fontLao" data-dismiss="modal">X</button>
                    </div>
                </div>
                <br>
                
                <div class="card">
                    <div class="card-body fontLao">
                        <form id="add-driver-form" action="{{url('admin/driver/add')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <!-- ຊື່ ແລະ ນາມສະກຸນ -->
                                <div class="col-12 mb-3">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="ຊື່ ແລະ ນາມສະກຸນ" autocomplete="off" required>
                                </div>

                                <!-- ເບີໂທ -->
                                <div class="col-12 mb-3">
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="ເບີໂທ" autocomplete="off" required>
                                </div>

                                <div class="col-12 text-center">
                                    <button class="btn btn-primary fontLao btn-save-driver">ບັນທຶກ</button>
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
<div class="modal fade" id="edit-driver-modal" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #F5F7FF;">
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="fontLao">ແກ້ໄຂຂໍ້ມູນຄົນຂັບລົດ</h3>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-light fontLao" data-dismiss="modal">X</button>
                    </div>
                </div>
                <br>
                
                <div class="card">
                    <div class="card-body fontLao">
                        <form id="edit-driver-form" action="{{url('admin/driver/edit')}}" method="post">
                            @csrf
                            <div class="form-group row" id="driver-detial">
                                
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
        

    $(document).on("click","#btn-add-driver",function(){
        $("#add-driver-modal").modal('toggle');
    })
    $(document).on("click","#btn-save-driver",function(e){
        e.preventDefault()
        var valid =  document.querySelector('#add-driver-form').reportValidity()
        if(valid){
            $("#add-driver-form").submit()
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
                var req_url = "{{url('admin/driver/delete/')}}" + "/" + id;
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
        var req_url = "{{url('admin/driver/view/')}}" + "/" + id;
        $.ajax({
            url: req_url,
            type: 'GET',
            data: {},
            success:function (arg) {
                console.log(arg)
                $("#driver-detial").html(arg)
                $("#edit-driver-modal").modal('toggle');
            }
        })
    })

    $(document).on("click","#btn-edit-driver",function(e){
        e.preventDefault()
        var valid =  document.querySelector('#edit-driver-form').reportValidity()
        if(valid){
            $("#edit-driver-form").submit()
        }
    })
</script>

@endpush