@extends('layout')

@section('title', 'ລະບົບຈອງລົດ ທຫລ')

@push('css')
    <style>
        tbody td{
            padding-bottom: 8px !important;
            padding-top: 8px !important;
        }
    </style>
    <link rel="stylesheet" href="{{asset('vendors/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/select2-bootstrap-theme/select2-bootstrap.min.css')}}">
@endpush

@section('content')

<div class="card">
    <div class="card-body ml-3 mr-3">
        <div class="d-flex justify-content-between mt-2 mb-3">
            <div><h3 class="fontLao font-weight-bold">ຂໍໍ້ມູນຜູ້ຈອງລົດທັງໝົດ</h3></div>
            <div><button class="btn btn-primary fontLao" id="btn-add-booker">ເພີ່ມຜູ້ຈອງລົດ</button></div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped fontLao">
                <thead>
                    <tr>
                        <th width="40px">ລຳດັບ</th>    
                        <th>ຊື່ ແລະ ນາມສະກຸນຜູ້ຈອງລົດ</th>
                        <th>ເບີໂທຜູ້ຈອງລົດ</th>
                        <th>ສັງກັດໜ່ວຍກົມ</th>
                        <th>ຊື່ເຂົ້າໃຊ້ລະບົບ</th>
                        <th>ແກ້ໄຂ / ລຶບ</th>
                    </tr>
                </thead>
                <tbody>
                    @if( isset($users) && sizeof($users) > 0)
                        @foreach($users as $key => $val)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $val->name }}</td>
                                <td>{{ $val->phone }}</td>
                                <td>{{ $val->dept->name }}</td>
                                <td>{{ $val->username }}</td>
                                <td>
                                    <div class="badge badge-warning fontLao text-white btn-edit mr-2" style="cursor: pointer;" data-id="{{$val->id}}">ແກ້ໄຂ</div>
                                    <div class="badge badge-danger fontLao btn-delete" style="cursor: pointer;" data-id="{{$val->id}}">ລຶບ</div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="6" align="center">ບໍ່ມີຂໍ້ມູນ</td>
                    </tr>
                    @endif
                </tbody>

            </table>
        </div>

    </div>
</div>

<!-- add modal -->
<div class="modal fade" id="add-booker-modal" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #F5F7FF;">
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="fontLao">ເພີ່ມຂໍ້ມູນຜູ້ຈອງລົດ</h3>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-light fontLao" data-dismiss="modal">X</button>
                    </div>
                </div>
                <br>
                
                <div class="card">
                    <div class="card-body fontLao">
                        <form id="add-booker-form" action="{{url('admin/booker/add')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <!-- ກົມ -->
                                <div class="col-12 mb-3">
                                    <select name="dept_id" id="dept_id" class="form-control text-dark fontLao" required>
                                        <option value="">ເລືອກກົມກອງ</option>
                                        @foreach($depts as $val)
                                        <option value="{{$val->id}}">{{$val->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- ຊື່ ແລະ ນາມສະກຸນ -->
                                <div class="col-12 mb-3">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="ຊື່ ແລະ ນາມສະກຸນ" autocomplete="off" required>
                                </div>

                                <!-- ເບີໂທ -->
                                <div class="col-12 mb-3">
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="ເບີໂທ" autocomplete="off" required>
                                </div>


                                <!-- Username -->
                                <div class="col-12 mb-3">
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" autocomplete="off" required>
                                </div>

                                <!-- Password -->
                                <div class="col-12 mb-3">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off" required>
                                </div>

                                <div class="col-12 text-center">
                                    <button class="btn btn-primary fontLao btn-save-booker">ບັນທຶກ</button>
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
<div class="modal fade" id="edit-booker-modal" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #F5F7FF;">
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="fontLao">ແກ້ໄຂຂໍ້ມູນຜູ້ຈອງລົດ</h3>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-light fontLao" data-dismiss="modal">X</button>
                    </div>
                </div>
                <br>
                
                <div class="card">
                    <div class="card-body fontLao">
                        <form id="edit-booker-form" action="{{url('admin/booker/edit')}}" method="post">
                            @csrf
                            <div class="form-group row" id="booker-detial">
                                
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
<script src="{{asset('vendors/select2/select2.min.js')}}"></script>
<script>
    var alert_msg = $('#alert_msg').val();
    var alert_icon = $('#alert_icon').val();
    if(alert_msg !== ''){
        swal({
            title: alert_msg,
            icon: alert_icon,
        });
    }
        

    $(document).on("click","#btn-add-booker",function(){
        $("#add-booker-modal").modal('toggle');
    })
    $(document).on("click","#btn-save-booker",function(e){
        e.preventDefault()
        var valid =  document.querySelector('#add-booker-form').reportValidity()
        if(valid){
            $("#add-booker-form").submit()
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
                var req_url = "{{url('admin/booker/delete/')}}" + "/" + id;
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
        var req_url = "{{url('admin/booker/view/')}}" + "/" + id;
        $.ajax({
            url: req_url,
            type: 'GET',
            data: {},
            success:function (arg) {
                console.log(arg)
                $("#booker-detial").html(arg)
                $("#edit-booker-modal").modal('toggle');
            }
        })
    })

    $(document).on("click","#btn-edit-booker",function(e){
        e.preventDefault()
        var valid =  document.querySelector('#edit-booker-form').reportValidity()
        if(valid){
            $("#edit-booker-form").submit()
        }
    })
</script>

@endpush