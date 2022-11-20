<?php

    $appSection = 'api';
    $fromHome = '../';

    require_once 'components.php';

?>

<div class="ui top attached tabular menu menu_tab">
    <div class="link item" data-tab="data">
        Data
    </div>
    <div class="link item" data-tab="pass">
        Password
    </div>
    
    <div class="right menu">
        <div class="item">
            <div class="ui violet mini button" onclick="logout()">
                Logout
            </div>
        </div>
    </div>
</div>

<div class="ui segment bottom attached tab active" data-tab="data">
    <form id="form_token" class="ui form">
        <div class="field">
            <div class="ui labeled input">
                <div class="ui basic label">
                    Token
                </div>
                <input type="text" name="data_token" maxlength="8" placeholder="Input token" id="token_text">
            </div>
        </div>
        <div class="field">
            <button class="ui button primary" type="submit">
                <i class="save icon"></i> Simpan
            </button>
        </div>
    </form>
</div>
<div class="ui segment bottom attached tab" data-tab="pass">
    <form id="form_password" class="ui form">
        <div class="two fields">
            <div class="field">
                <label>Password</label>
                <div class="ui input">
                    <input type="password" id="p1" name="p1" placeholder="Password" maxlength="32" >
                </div>
            </div>
            <div class="field">
                <label>Ketik Ulang Password</label>
                <div class="ui input">
                    <input type="password" id="p2" name="p2" placeholder="Ketik Ulang Password" maxlength="32" >
                </div>
            </div>    
        </div>
        <div class="field">
            <button class="ui button primary" type="submit">
                <i class="save icon"></i> Simpan
            </button>
        </div>
    </form>
</div>


<div class="ui mini modal" id="konfirmasi_modal">
	<div class="header" id="konfirmasi_header"></div>
	<div class="content">
		<div class="description">
			<p id="konfirmasi_isi"></p>
		</div>
	</div>
	<div class="actions">
		<div class="ui form">
            <div class="two fields unstackable">
                <div class="field">
                    <div class="ui cancel button fluid">
						<i class="remove icon"></i> Batal
					</div>
                </div>
                <div class="field">
                    <div class="ui ok button fluid primary">
						<i class="checkmark icon"></i> Ya
					</div>
                </div>
            </div>
        </div>
        <br>
	</div>
</div>














<script>
    //init the tab menu
    $('.menu_tab .item').tab();

    get_data('token');

    function get_data_token_handle(data){
        var token = data[0]['token'],
            already = $('#token_text').val();

        if(token !== already){
            $('#token_text').val(token);
        }
    }

    //script to update password
    $('#form_token').submit(function(e){
        e.preventDefault();
        
        var token = $('#token_text').val(),
            tl = token.length;
        
        if(token == ''){
            pesan_tampil('2', 'Isi token.');
        }
        else if(parseInt(tl) < 6){
            pesan_tampil('2', 'Token minimal 6 karakter.');
        }
        else{
            var act = 'token-set';
            form_submit(act, 'form_token');
        }
    })

    function form_submit_token_set_handle(data) {
        pesan_tampil('1', 'Data berhasil disimpan.');
    }



    //script to update password
    $('#form_password').submit(function(e){
        e.preventDefault();
        
        var p1 = $('#p1').val(),
            p2 = $('#p2').val(),
            pp1 = p1.length;
        
        if(p1 == ''){
            pesan_tampil('2', 'Isi password.');
        }
        else if(parseInt(pp1) < 4){
            pesan_tampil('2', 'Password minimal 4 karakter.');
        }
        else if(p2 == ''){
            pesan_tampil('2', 'Ketik ulang password.');
        }
        else if(p1 !== p2){
            pesan_tampil('2', 'Password dan ketikan ulang password tidak sama.');
        }
        else{
            var act = 'pass-set';
            form_submit(act, 'form_password');
        }
    })

    function form_submit_pass_set_handle(data) {
        pesan_tampil('1', 'Data berhasil disimpan.');
    }

</script>