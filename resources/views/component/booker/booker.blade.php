<input type="hidden" name="id" value="{{$booker->id}}">
<!-- ກົມ -->
<div class="col-12 mb-3">
    <select name="dept_id" id="dept_id" class="form-control text-dark fontLao" required>
        <option value="">ເລືອກກົມກອງ</option>
        @foreach($depts as $val)
        <option value="{{$val->id}}" <?php if($val->id == $booker->dept_id) echo "selected" ?>>{{$val->name}}</option>
        @endforeach
    </select>
</div>

<!-- ຊື່ ແລະ ນາມສະກຸນ -->
<div class="col-12 mb-3">
    <input type="text" name="name" id="name" value="{{$booker->name}}" class="form-control" placeholder="ຊື່ ແລະ ນາມສະກຸນ" autocomplete="off" required>
</div>

<!-- ເບີໂທ -->
<div class="col-12 mb-3">
    <input type="text" name="phone" id="phone" value="{{$booker->phone}}" class="form-control" placeholder="ເບີໂທ" autocomplete="off" required>
</div>


<!-- Username -->
<div class="col-12 mb-3">
    <input type="text" name="username" id="username" value="{{$booker->username}}" class="form-control" placeholder="Username" autocomplete="off" required>
</div>

<!-- Password -->
<div class="col-12 mb-3">
    <input type="password" name="password" id="password" class="form-control" placeholder="ປ່ຽນລະຫັດຜ່ານໃໝ່" autocomplete="off">
</div>

<div class="col-12 text-center">
    <button class="btn btn-primary fontLao btn-save-booker">ບັນທຶກ</button>
</div>