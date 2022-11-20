<?php

    $appSection = 'api';
    require_once 'components.php';

?>

<style>
    #login_area {
        max-width: 340px !important;
        margin: 0px auto !important;
    }
</style>

<div class="ui basic segment" id="login_area">
    <div class="ui vertical basic segment">
        <img src="../icon.png" alt="icon" class="ui image centered">
    </div>
    <div class="ui segment secondary top attached">
        <div class="ui header">
            Login
        </div>
    </div>
    <div class="ui segment bottom attached">
        <div class="ui form">
            <form id="form_login" autocomplete="off">
                <div class="field">
                    <label for="uname">Username</label>
                    <input type="text" id="uname" name="uname" maxlength="64" placeholder="Username">
                </div>
                <div class="field">
                    <label for="pass">Password</label>
                    <input type="password" id="pass" name="pass" maxlength="64" placeholder="Password">
                </div>
                <div class="field">
                    <button type="submit" class="ui primary button fluid">
                        <i class="send icon"></i> Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>





<script>

    $('#form_login').submit(function(e){
        e.preventDefault();

        var uname = $('#uname').val(),
            pass = $('#pass').val();
        
        if(uname == ''){
            pesan_tampil('2', 'Isi username.');
        }
        else if(pass == ''){
            pesan_tampil('2', 'Isi password.');
        }
        else{
            var kegiatan = 'login',
                form_id = 'form_login';
            
            form_submit(kegiatan, form_id);
        }
    })


    function form_submit_login_handle(data) {
        localStorage.setItem("user_id", data[0]['id']);
        page_reload();
    }

</script>