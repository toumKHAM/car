<input type="hidden" name="id" value="{{$car->id}}">
<!-- ສີລົດ -->
<label for="car_color" class="col-3 col-form-label text-right">ສີລົດ</label>
<div class="col-9">
    <input type="text" name="car_color" id="car_color" value="{{$car->car_color}}" class="form-control" placeholder="ຂາວ, ດຳ, ຟ້າ, ແດງ ..." autocomplete="off" required>
</div>

<!-- ປ້າຍລົດ -->
<label for="car_no" class="col-3 col-form-label text-right">ປ້າຍລົດ</label>
<div class="col-9">
    <input type="text" name="car_no" id="car_no" value="{{$car->car_no}}" class="form-control" placeholder="ກກ-1234" autocomplete="off" required>
</div>

<!-- ປະເພດລົດ -->
<label for="car_type" class="col-3 col-form-label text-right">ປະເພດລົດ</label>
<div class="col-9">
    <input type="text" name="car_type" id="car_type" value="{{$car->car_type}}" class="form-control" placeholder="ເກັ໋ງ, ວີໂກ້, ຕູ້ ..." autocomplete="off" required>
</div>

<div class="col-9 offset-3">
    <button class="btn btn-primary fontLao btn-edit-car">ບັນທຶກ</button>
</div>