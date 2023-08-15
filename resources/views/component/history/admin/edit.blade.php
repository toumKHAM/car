<input type="hidden" name="id" value="{{$appr->id}}">
<!-- ຄົນຂັບລົດ -->
<div class="col-12 mb-3">
    <ul class="list-star">
        <li>ຊື່ຄົນຂັບ</li>
    </ul>
    <select name="driver_id" id="driver_id" class="form-control text-dark fontLao" required>
        <option value="">ເລືອກຄົນຂັບລົດ</option>
        @foreach($drivers as $val)
        <option value="{{$val->id}}" <?php if($val->id == $appr->driver_id) echo "selected" ?>>{{$val->name}}</option>
        @endforeach
    </select>
</div>

<!-- ລົດ -->
<div class="col-12 mb-3">
    <ul class="list-star">
        <li>ປ້າຍລົດ</li>
    </ul>
    <select name="car_id" id="car_id" class="form-control text-dark fontLao" required>
        <option value="">ເລືອກລົດ</option>
        @foreach($cars as $val)
        <option value="{{$val->id}}" <?php if($val->id == $appr->car_id) echo "selected" ?>>
            {{$val->car_no . ' '}} 
            {{-- --}}
            &emsp;&emsp; {{ $val->status != null ? "":" ( ວ່າງ )" }} 
            {{-- --}}
        </option>
        @endforeach
    </select>
</div>

<div class="col-12 text-center">
    <button class="btn btn-primary fontLao btn-save-edit">ບັນທຶກ</button>
</div>