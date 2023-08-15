@extends('layout')

@section('title', 'ລະບົບຈອງລົດ ທຫລ')

@push('css')
    <style>
        
    </style>
@endpush

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="{{url('user/addBooking')}}" method="post">
                @csrf
                <br>
                <h3 class="fontLao font-weight-bold">ປ້ອນຂໍ້ມູນຈອງລົດ</h3>
                <br>
                <div class="row">
                    <div class="col-md-5 fontLao">
                        <label>ຈຸດເລີ່ມຕົ້ນ</label>
                        <div id="the-basics">
                            <span class="twitter-typeahead">
                                <input value="ທຫລ" name="src" id="src" class="typeahead tt-input" type="text" required
                                    placeholder="ພິມສະຖານທີ່" autocomplete="off" spellcheck="false" dir="auto" 
                                    style="position: relative; vertical-align: top; background-color: transparent;">                                            
                            </span>
                            <span style="display:none;font-size:10px" class="text-danger src">ກະລຸນາພິມຈຸດເລີ່ມຕົ້ນ</span>
                        </div>
                        
                        <br>

                        <label>ປາຍທາງ</label>
                        <div id="the-basics">
                            <span class="twitter-typeahead">
                                <input name="des" id="des" class="typeahead tt-input" type="text"  required
                                    placeholder="ພິມສະຖານທີ່" autocomplete="off" spellcheck="false" dir="auto" 
                                    style="position: relative; vertical-align: top; background-color: transparent;">                                            
                            </span>
                            <span style="display:none;font-size:10px" class="text-danger des">ກະລຸນາພິມປາຍທາງ</span>
                        </div>
                    </div>

                    <div class="col-md-5 offset-1 fontLao">
                        <label>ວັນທີ ແລະ ເວລາ ທີ່ລົດອອກ</label>
                        <div id="the-basics">
                            <span class="twitter-typeahead">
                                <input name="from_date" id="from_date" type="text" class="typeahead tt-input"  required
                                    placeholder="{{date('d/m/Y  H:i')}}" autocomplete="off" spellcheck="false" dir="auto" 
                                    style="position: relative; vertical-align: top; background-color: transparent;">                                            
                            </span>
                    </div>
                        
                        <br>

                        <label>ວັນທີ ແລະ ເວລາ ທີ່ລົດມາຮອດ</label>
                        <div id="the-basics">
                            <span class="twitter-typeahead">
                                <input name="to_date" id="to_date" class="typeahead tt-input" type="text"  required
                                    placeholder="{{date('d/m/Y  H:i')}}" autocomplete="off" spellcheck="false" dir="auto" 
                                    style="position: relative; vertical-align: top; background-color: transparent;">                                            
                            </span>
                        </div>
                    </div>
                </div>

                <br><br>
                
                <div class="row">
                    <div class="col-md-5 fontLao">
                        <label>ຈຸດປະສົງນຳໃຊ້ລົດ</label>
                        <textarea name="content" class="form-control" placeholder="ພິມຈຸດປະສົງທີ່ຂໍນຳໃຊ້ລົດ" id="content" rows="2" required></textarea>
                    </div>

                    <div class="col-md-5 offset-1 fontLao">
                        <label>ຈຳນວນຄົນ</label>
                        <div id="the-basics">
                            <span class="twitter-typeahead">
                                <input name="people" id="people" class="typeahead tt-input" type="text" required
                                    placeholder="2" autocomplete="off" spellcheck="false" dir="auto" 
                                    style="position: relative; vertical-align: top; background-color: transparent;">                                            
                            </span>
                            <span style="display:none;font-size:10px" class="text-danger people">ກະລຸນາພິມຈຳນວນຄົນ</span>
                        </div>
                    </div>
                </div>

                <br><br>

                <button id="submit" class="btn btn-primary mr-2 fontLao">ສົ່ງຄຳຂໍ</button>
            </form>
        </div>
        <br>
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
        

        $("#from_date, #to_date").flatpickr({
            enableTime: true,
            dateFormat: "d/m/Y  H:i",
        });
    </script>

@endpush