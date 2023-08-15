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
    <div class="card-body">
        <br>
        <h3 class="fontLao  font-weight-bold">ປະຫວັດການອະນຸມັດລົດ</h3>
    </div>

    <div class="table-responsive p-3">
            <table class="table table-bordered table-hover table-striped" id="table_id_example">
                <thead>
                    <tr class="fontLao">
                        <th width="25px">ລ/ດ</th>    
                        <th width="40px">ເປີດອ່ານ</th>
                        <th>ເວລາອະນຸມັດ</th>
                        <th>ຄຳຂໍຈາກໜ່ວຍກົມ</th>
                        <th>ຈຸດເລີ່ມຕົ້ນ</th>
                        <th>ປາຍທາງ</th>
                        <th width="80px">ສະຖານະ</th>
                        <th width="50px">ປ້າຍລົດ</th>
                        <th>ແກ້ໄຂ</th>
                    </tr>
                </thead>

                <tbody class="fontLao">
                @if(sizeof($approves) > 0)
                    @foreach($approves as $key => $val)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td align="center">
                            <div style="cursor: pointer;" class="btn-view" data-id="{{$val->id}}">
                                <i class="mdi mdi-email-open-outline" style="font-size: 20px;"></i>
                            </div>
                        </td>
                        <td>
                            <code class="text-dark">
                            @if($val->approve_date)
                            {{ date("d/m/Y  H:i", strtotime($val->approve_date)) }}
                            @endif
                            </code>
                        </td>
                        <td class="fontLao">{{ $val->user->name }}</td>
                        <td class="fontLao">{{ $val->src }}</td>
                        <td class="fontLao">{{ $val->des }}</td>
                        <td class="fontLao">
                            @if($val->status == "U")
                            <div class="badge badge-danger">ປະຕິເສດ</div>
                            @elseif($val->status == "A")
                            <div class="badge badge-success">ອະນຸມັດແລ້ວ</div>
                            @endif
                        </td>
                        <td class="fontLao">
                            @if($val->car_id)
                            {{ $val->car->car_no }}
                            @endif
                        </td>
                        <td>
                            @if($val->status == "A" && date("Y-m-dH:i:s",time()) < str_replace(" ","",$val->from_date)  )
                            <div class="badge badge-warning fontLao text-white btn-show-edit" style="cursor: pointer;" data-id="{{$val->id}}">ແກ້ໄຂ</div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9" align="center">ບໍ່ມີຂໍ້ມູນ</td>
                    </tr>
                @endif
                </tbody>
            </table>
    </div>

</div>

<div class="modal fade" id="view-show-edit" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #F5F7FF;">
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="fontLao">ແກ້ໄຂຂໍ້ມູນອະນຸມັດລົດ</h3>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-light fontLao "  data-dismiss="modal">X</button>
                    </div>
                </div>
                <br>
                
                <div class="card">
                    <div class="card-body fontLao">
                        <form id="edit-form" action="{{url('admin/history/saveedit')}}" method="post">
                            @csrf
                            <div class="form-group row" id="view-detial-edit">
                                
                            </div>
                        </form>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="view" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: #F5F7FF;">
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="fontLao">ຂໍ້ມູນຈອງລົດ</h3>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-light fontLao" data-dismiss="modal">X</button>
                    </div>
                </div>
                <br>
                
                <div class="row" id="view-detial">

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
    $(document).on("click",".btn-view",function(){
        var id = $(this).attr("data-id")
        var req_url = "{{url('admin/history/view')}}" + "/" + id;
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


    $(document).on("click",".btn-show-edit",function(){
        var id = $(this).attr("data-id")
        var req_url = "{{url('admin/history/viewedit')}}" + "/" + id;
        $.ajax({
            url: req_url,
            type: 'GET',
            data: {},
            success:function (arg) {
                console.log(arg)
                $("#view-detial-edit").html(arg)
                $("#view-show-edit").modal('toggle');
            }
        })

    })
    $(document).on("click","#btn-save-edit",function(e){
        e.preventDefault()
        var valid =  document.querySelector('#edit-form').reportValidity()
        if(valid){
            $("#edit-form").submit()
        }
    })
</script>

@endpush