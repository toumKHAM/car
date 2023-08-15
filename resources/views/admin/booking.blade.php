@extends('layout')

@section('title', 'ລະບົບຈອງລົດ ທຫລ')

@push('css')
    <style>
        tbody td{
            padding-bottom: 12px !important;
            padding-top: 12px !important;
        }
    </style>
@endpush

@section('content')

<div class="card">
    <div class="card-body ml-3 mr-3" style="min-height: 70vh;">
        
        <div class="d-flex justify-content-between mt-2 mb-3">
            <div><h3 class="fontLao font-weight-bold">ຄຳຂໍຈອງລົດທັງໝົດ</h3></div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped fontLao">
                <thead>
                    <tr>
                        <th width="40px">ລໍາດັບ</th>
                        <th>ເວລາສົ່ງຄຳຂໍ</th>
                        <th>ຄຳຂໍຈາກໜ່ວຍກົມ</th>
                        <th>ຈຸດເລີ່ມຕົ້ນ</th>
                        <th>ປາຍທາງ</th>
                        <th width="40px">ເປີດອ່ານ</th>
                    </tr>
                </thead>
                <tbody>
                    @if( isset($bookings) && sizeof($bookings) > 0)
                        @foreach($bookings as $key => $val)
                            <tr <?php if($val->status =="C"){?> class="table-danger"; <?php } ?> >
                                <td>{{ $key+1 }}</td>
                                <td><code class="text-dark">{{ date("d/m/Y H:i",strtotime($val->request_date)) }}</code></td>
                                <td>{{ $val->user->dept->name }}</td>
                                <td>{{ $val->src }}</td>
                                <td>{{ $val->des }}</td>
                                <td width="40px">
                                    <div style="cursor: pointer;" class="open" data-id="{{$val->id}}"><i class="mdi mdi-chevron-double-down"></i></div> 
                                </td>
                            </tr>
                            <tr style="display: none;" class="content-{{$val->id}} content">
                                <td></td>
                                <td colspan="5">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <ul class="list-arrow">
                                                <li>ເວລາ ແລະ ວັນທີທີ່ລົດອອກ: <code class="text-primary">{{ date("d/m/Y H:i",strtotime($val->from_date)) }}</code></li>
                                                <li>ເວລາ ແລະ ວັນທີທີ່ລົດກັບມາຮອດ: <code class="text-primary">{{ date("d/m/Y H:i",strtotime($val->to_date)) }}</code></li>
                                                <li>ຈຸດປະສົງນຳໃຊ້ລົດ: <code class="text-primary fontLao">{{ $val->content }}</code></li>
                                                <li>ຈຳນວນຄົນ: <code>{{ $val->people }}</code></li>
                                            </ul>
                                        </div>

                                        <div class="col-md-5">
                                            <ul class="list-arrow">
                                                <li>ຊື່ຜູ້ຮ້ອງຂໍ : <code class="text-primary fontLao">{{ $val->user->name }}</code></li>
                                                <li>ເບີໂທຜູ້ຮ້ອງຂໍ : <code class="text-primary">{{ $val->user->phone }}</code></li>
                                                @if( $val->status == "C" )
                                                <li><code class="text-danger fontLao">ຂໍຍົກເລີກ</code></li>
                                                @endif
                                            </ul>
                                            <div class="row">
                                                @if( $val->status == "W" )
                                                <div class="col-md-4">    
                                                    <button class="btn btn-block btn-success font-weight-medium btn-approve" data-id="{{$val->id}}">
                                                        ອະນຸມັດ
                                                    </button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-block btn-danger  font-weight-medium btn-reject" data-id="{{$val->id}}">
                                                        ປະຕິເສດ
                                                    </button>
                                                </div>
                                                @endif
                                                @if( $val->status == "C" )
                                                <div class="col-md-4"></div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-block btn-warning font-weight-medium btn-accept" data-id="{{$val->id}}">
                                                        ຕົກລົງ
                                                    </button>
                                                </div>
                                                <div class="col-md-4"></div>
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="6" align="center">ບໍ່ມີຂໍ້ມູນຈອງລົດ</td>
                    </tr>
                    @endif
                </tbody>

            </table>
        </div>

    </div>
</div>

<!-- approve modal -->
<div class="modal fade" id="approve-modal" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #F5F7FF;">
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="fontLao">ອະນຸມັດລົດ</h3>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-light fontLao" id="btn-close" data-dismiss="modal">X</button>
                    </div>
                </div>
                <br>
                
                <div class="card">
                    <div class="card-body fontLao">
                        <form id="approve-form" action="{{url('admin/booking/approve')}}" method="post">
                            @csrf
                            <div class="form-group row" id="approve-detial">
                                
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
    // ----- for refresh ------ //
    var timecontrol = 10000;
    var myTimer = setInterval(() => {
        location.reload();
    }, timecontrol);
    $(document).on("click",".btn-approve, .btn-reject",function(){
        clearInterval(myTimer);
    })
    $(document).on("click","#btn-close",function(){
        setInterval(() => {
            location.reload();
        }, timecontrol);
    })
    // ----- end refresh ------ //

</script>

<script>
    $(document).on("click",".open",function(){
        var id = $(this).attr("data-id")
        $(".content").hide()
        $(".content-"+id).show(800)
    })

    $(document).on("click",".btn-approve",function(){
        var id = $(this).attr("data-id")
        var req_url = "{{url('admin/view/')}}" + "/" + id  + "/A";
        $.ajax({
            url: req_url,
            type: 'GET',
            data: {},
            success:function (arg) {
                console.log(arg)
                $("#approve-detial").html(arg)
                $("#approve-modal").modal('toggle');
            }
        })
    })

    $(document).on("click",".btn-reject",function(){
        var id = $(this).attr("data-id")
        var req_url = "{{url('admin/view/')}}" + "/" + id  + "/U";
        $.ajax({
            url: req_url,
            type: 'GET',
            data: {},
            success:function (arg) {
                console.log(arg)
                $("#approve-detial").html(arg)
                $("#approve-modal").modal('toggle');
            }
        })
    })

    $(document).on("click","#btn-approve-save",function(e){
        e.preventDefault()
        var valid =  document.querySelector('#approve-form').reportValidity()
        if(valid){
            $("#approve-form").submit()
        }
    })

    $(document).on("click",".btn-accept",function(){
        var id = $(this).attr("data-id")
        swal({
            title: "ເຫັນດີຍົກເລີກແທ້ບໍ່ ?",
            icon: "warning",
        }).then(function(isConfirm) {
            if (isConfirm) {
                var req_url = "{{url('admin/booking/accept/')}}" + "/" + id;
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