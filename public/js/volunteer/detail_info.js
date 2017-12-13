 $(function () {
    $('div.button-show-log>button#button-show-log').click(function(){
        $('div.log-content').slideToggle( "slow");
    });
    var check = true;
    $('div.button-show-log>button#button-show-edit').click(function(){
        if(check == true){
            $('div.detail-info').slideToggle( "slow", function(){
                $('div.edit-info-box').slideToggle( "slow");
                $('input#input-name').val($('td#name-value').text());
                $('input#input-email').val($('td#email-value').text());
                $('input#input-phone').val($('td#phone-value').text());
                $('input#input-address').val($('td#address-value').text());
                $('input#input-note').val($('td#note-value').text());

                let oldRoldes = $('.roles');
                var roles = [];
               for(var i = 0; i< 8; i++){
                    let roleValue = $('#roles_'+i).val();
                    if(typeof roleValue != "undefined"){
                        roles.push(roleValue);
                    }
               }

               console.log(roles)
                $('select#user_roles').val(roles);

                if( $('select#gender-value').val() == "Nữ" ){
                    $('select#input-gender').val("G");
                } else {
                    $('select#input-gender').val("M");
                }
                check = false;
            });
        } else {
            $('div.edit-info-box').slideToggle( "slow", function(){
                $('div.detail-info').slideToggle( "slow");
                check = true;
            });
        }
    });

    $('button#submit-edit').click(function(){
        var data = {
            'name'      : $('input#input-name').val(),
            'email'     : $('input#input-email').val(),
            'phone'     : $('input#input-phone').val(),
            'address'   : $('input#input-address').val(),
            'note'      : $('input#input-note').val(),
            'gender'    : $('select#input-gender').val(),
            'user_roles': $('select#user_roles').val()
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                // 'accepts': 'application/json',
            }
        });
         $.ajax({
            url: window.location.origin + "/volunteer/edit_info/" + $('input#user_id').val(),
            dataType:'json',
            async:false,
            type:'post',
            data:{
                data,
            },
            success:function(data){
                location.reload();
            },
            error:function() {
                location.reload();
            }
        });

    });

    //======================================change avatar===========================================

    $('input#change-avatar-input').change(function(){
        var agree =confirm("Bạn có muốn thay đổi avatar không?");
        if(agree){
            $("form#change-avatar-form").submit();
        }
    });

});