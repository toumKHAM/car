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
        <br>
        <h3 class="fontLao  font-weight-bold">ຂໍ້ມູນການເຄື່ອນລົດ</h3>

        <div class="table-responsive pt-3">
            <table class="table table-bordered table-hover table-striped" id="table_id_example">
                <thead>
                    <tr class="fontLao">
                        <th width="25px">ລ/ດ</th>
                        <th>ວັນທີ ແລະ ເວລາ</th>
                        <th>ຈຸດເລີ່ມຕົ້ນ</th>
                        <th>ປາຍທາງ</th>
                        <th>ພະນັກງານຂັບລົດ</th>
                        <th width="50px">ປ້າຍລົດ</th>
                        <th>ຮັບໃຊ້ກົມກອງ</th>
                    </tr>
                </thead>
                <tbody>
                    @if( isset($approves) && sizeof($approves) > 0)
                        @foreach($approves as $key => $val)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    {{ date("d/m/Y  H:i",strtotime($val->from_date)) . ' --> ' . date("d/m/Y  H:i",strtotime($val->to_date)) }} 
                                </td>
                                <td class="fontLao">{{ $val->src }}</td>
                                <td class="fontLao">{{ $val->des }}</td>
                                <td class="fontLao text-primary font-weight-bold">{{ $val->driver->name }}</td>
                                <td class="fontLao text-primary font-weight-bold">{{ $val->car->car_no }}</td>
                                <td class="fontLao">{{ $val->user->dept->name }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="fontLao">
                            <td colspan="7" align="center">ບໍ່ມີຂໍ້ມູນ</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>
    // ----- for refresh ------ //
    var timecontrol = 10000;
    var myTimer = setInterval(() => {
        location.reload();
    }, timecontrol);
    // ----- end refresh ------ //

</script>

@endpush