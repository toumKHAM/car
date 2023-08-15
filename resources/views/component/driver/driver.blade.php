<input type="hidden" name="id" value="{{$driver->id}}">
<!-- ຊື່ ແລະ ນາມສະກຸນ -->
<div class="col-12 mb-3">
    <input type="text" name="name" id="name" value="{{$driver->name}}" class="form-control" placeholder="ຊື່ ແລະ ນາມສະກຸນ" autocomplete="off" required>
</div>

<!-- ເບີໂທ -->
<div class="col-12 mb-3">
    <input type="text" name="phone" id="phone" value="{{$driver->phone}}" class="form-control" placeholder="ເບີໂທ" autocomplete="off" required>
</div>

<div class="col-9 offset-3">
    <button class="btn btn-primary fontLao btn-edit-driver">ບັນທຶກ</button>
</div>