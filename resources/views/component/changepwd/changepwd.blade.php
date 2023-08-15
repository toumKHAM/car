<div class="modal fade" id="changepwd-modal" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #F5F7FF;">
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="fontLao">ປ່ຽນລະຫັດຜ່ານ</h3>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-light fontLao btn-close-changepwd">X</button>
                    </div>
                </div>
                <br>
                
                <div class="card">
                    <div class="card-body">
                        <form id="changepwd-form" action="{{url('changepwd')}}" method="post">
                            @csrf
                            <div class="form-group row mt-3">                                   
                                <div class="col-md-12">
                                    <label class="fontLao">ລະຫັດຜ່ານໃໝ່</label>
                                    <div id="the-basics">
                                        <input type="password" id="newpass" name="newpass" class="form-control form-control-lg" required>
                                    </div>
                                </div>                        
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-md-12">
                                    <label class="fontLao">ຢືນຢັນລະຫັດຜ່ານໃໝ່</label>
                                    <div id="the-basics">
                                        <input type="password" id="confirmnewpass" name="confirmnewpass" class="form-control form-control-lg" required>
                                    </div>
                                </div>                        
                            </div>

                            <div class="form-group row mt-3"> 
                                <div class="col-md-2"></div>                                  
                                <div class="col-md-4">
                                    <button id="savepass" class="btn btn-block btn-primary font-weight-medium auth-form-btn fontLao">
                                        ຢືນຢັນ
                                    </button>
                                </div>

                                <div class="col-md-4">
                                    <div class="btn btn-block btn-outline-light font-weight-medium auth-form-btn fontLao" data-dismiss="modal">
                                        ຍົກເລີກ
                                    </div>
                                </div>        
                                <div class="col-md-2"></div>                   
                            </div>
                        </form>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
</div>

<!-- for alert_msg -->
<input type="hidden" id="changepwd_msg" value="{{ session()->pull('changepwd_msg') }}"/>
<input type="hidden" id="changepwd_icon" value="{{ session()->pull('changepwd_icon') }}"/>