    <div class="col-md-6">
        <div class="card" style="height: 100%;">
            <div class="card-body fontLao">
                <h4 class="card-title text-danger">ຖືກປະຕິເສດ</h4>
                <p class="card-description">
                    <?php $apv_date = $booking->approve_date; ?>
                    ວັນທີ <code>{{ date("d/m/Y", strtotime($apv_date)) }}</code>, 
                    ເວລາ <code>{{ date("H:i:s", strtotime($apv_date)) }}</code></p>
                <ul class="list-star">
                    <li>ເຫດຜົນ: {{ $booking->because }}</li>
                    <li>ຜູ້ອະນຸມັດ: {{ $admin->name }}</li>
                    <li>ເບີໂທ: {{ $admin->phone }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card" style="height: 100%;">
            <div class="card-body fontLao">
                <h4 class="card-title text-primary">ຂໍ້ມູນຈອງລົດ</h4>
                <p class="card-description">ຈຸດປະສົງ: <code class="fontLao">{{ $booking->content }}</code></p>
                <ul class="list-arrow">
                    <li>ຈຸດເລີ່ມຕົ້ນ: {{ $booking->src }}</li>
                    <li>ປາຍທາງ: {{ $booking->des }}</li>
                    <li>ຈຳນວນຄົນ: {{ $booking->people }}</li>
                    <?php $fdate = $booking->from_date; $tdate = $booking->to_date; ?>
                    <li>ເລີ່ມຈາກວັນທີ: {{ date("d/m/Y H:i:s", strtotime($fdate)) }}</li>
                    <li>ເຖິງວັນທີ: {{ date("d/m/Y H:i:s", strtotime($tdate)) }}</li>
                </ul>
            </div>
        </div>
    </div>