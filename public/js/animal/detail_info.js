$(function () {
    $('input#btn-show-info').click(function(){
        $('div.history-box').slideUp( "slow", function(){
            $('div.info-box').slideDown('slow');
        });
    });

    $('input#btn-show-history').click(function(){
        $('div.info-box').slideUp( "slow", function(){
            $('div.history-box').slideDown('slow');
        });
    });

    createFormEditOneAttribute('btn-edit-create-at');
    createFormEditOneAttribute('btn-edit-status');
    createFormEditOneAttribute('btn-edit-address');
    createFormEditOneAttribute('btn-edit-name');
    createFormEditOneAttribute('btn-edit-type');
    createFormEditOneAttribute('btn-edit-age');
    createFormEditOneAttribute('btn-edit-description');
    createFormEditOneAttribute('btn-edit-place');
    createFormEditOneAttribute('btn-edit-note');

    var sumImage = $('input#sum-image').val();

    for(let i=1 ; i<=sumImage; i++){
        $('div#delete-image-'+i).click(function(){
            var agree =confirm("bạn có muốn xóa ảnh này không?");
            if(agree){
                var imageId = $('div#delete-image-'+i+' input[type=hidden]').val();
                url = window.location.origin + "/animal_image/delete/" + imageId;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                $.ajax({
                    url: url,
                    type: "get",
                    datatType: "json",
                    success: function(data){
                        location.reload();
                    },
                    error: function(data) {
                        alert('error');
                    }
                });
            }
        });

        $('div#update-image-'+ i +' input[type="file"]').change(function(){
            var agree =confirm("Bạn có muốn thay đổi ảnh này không?");
            if(agree){
                var imageId = $('div#update-image-'+i+' input[type=hidden]').val();
                url = window.location.origin + "/animal_image/change/" + imageId;
                // var data = $('div#update-image-'+i+' input[type=file]').val();
                var file_data = $('div#update-image-'+i+' input[type=file]').prop('files')[0];
                var form_data = new FormData();                  
                form_data.append('file', file_data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                $.ajax({
                    url: url,
                    data:new FormData($('div#update-image-'+i+' form.change-photo')[0]),
                    dataType:'json',
                    async:false,
                    type:'post',
                    processData: false,
                    contentType: false,                        
                    success: function(data){
                        location.reload();
                    },
                    error: function(data) {
                        alert('error');
                    }
                });
            }
        });
    }



});

function createFormEditOneAttribute(buttonId){
    this.oldValue = $('input#'+buttonId).parent().siblings().text().trim();
    createButtonEdit(buttonId, this.oldValue);
    createButtonCancelEdit(buttonId, this.oldValue);
}

function createButtonEdit(buttonId, oldValue){
    $('input#'+buttonId).click(function(){
        
        if(buttonId == 'btn-edit-status'){
            url = window.location.origin + "/api/get_all_status";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
            $.ajax({
                url: url,
                type: "get",
                datatType: "json",
                async: false,
                buttonId: buttonId,
                success: function(data){
                    console.log(data);
                    var optionTag = "";
                    for(let i =0; i<data.length; i++){
                        optionTag +=  '<option value="'+data[i].id+'">'+data[i].name+'</option>'   
                    }
                    $('input#'+buttonId).before(` <button class="btn btn-primary" id="${buttonId+'-submit'}">
                                            gửi
                                        </button>`);
                    $('input#'+this.buttonId).parent().siblings().html(`
                        <select class="form-control" id="sel1">
                            ${optionTag}
                        </select>
                    `);
                },
                error: function(data) {
                    alert('error1');
                }
            });
        } else if(buttonId == 'btn-edit-place') {
            $('input#'+buttonId).before(` <button class="btn btn-primary" id="${buttonId+'-submit'}">
                    gửi
                </button>`);
             $('input#'+buttonId).parent().siblings().html(`
                <select class="form-control" id="select-place">
                    <option value=""> ---- Chọn Một ---- </option>
                    <option value="other"> Khác </option>
                    <option value="commonHome">Nhà Chung</option>
                    <option value="volunteer">nhà TNV</option>
                    <option value="hospital">Bệnh Viện</option>
                </select>
            `);
            $('select#select-place').change(function(){
                $('select#select-place').siblings('select, textarea').remove();
                let selectValue =  $('select#select-place').val();
                if(selectValue == 'volunteer'){
                    url = window.location.origin + "/api/get_list_volunteer";
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        }
                    });
                    $.ajax({
                        url: url,
                        type: "get",
                        datatType: "json",
                        async: false,
                        buttonId: buttonId,
                        success: function(data){
                            console.log($('input#'+this.buttonId).parent().siblings().children('select'));
                            var optionTag = "";
                            for(let i =0; i<data.length; i++){
                                optionTag +=  '<option value="'+data[i].id+'">'+data[i].name+'</option>'   
                            }

                            $('input#'+this.buttonId).parent().siblings().children('select').after(`
                                <select class="form-control" id="obj">
                                    ${optionTag}
                                </select>
                                <textarea class="form-control" name="note" id="" cols="60" rows="3" placeholder="Ghi Chú"></textarea>
                            `);
                        },
                        error: function(data) {
                            alert('error1');
                        }
                    });
                }
                else if(selectValue == 'hospital'){
                    url = window.location.origin + "/api/get_list_hospital";
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        }
                    });
                    $.ajax({
                        url: url,
                        type: "get",
                        datatType: "json",
                        async: false,
                        buttonId: buttonId,
                        success: function(data){
                            console.log($('input#'+this.buttonId).parent().siblings().children('select'));
                            var optionTag = "";
                            for(let i =0; i<data.length; i++){
                                optionTag +=  '<option value="'+data[i].id+'">'+data[i].name+'</option>'   
                            }
                            
                            $('input#'+this.buttonId).parent().siblings().children('select').after(`
                                <select class="form-control" id="obj">
                                    ${optionTag}
                                </select>
                                <textarea class="form-control" name="note" id="" cols="60" rows="3" placeholder="Ghi Chú"></textarea>
                            `);
                        },
                        error: function(data) {
                            alert('error1');
                        }
                    });
                }
                else if(selectValue == 'other'){
                    $('input#'+buttonId).parent().siblings().children('select').after(`
                        <textarea class="form-control" name="note" id="" cols="60" rows="3" placeholder="Ghi Chú"></textarea>
                    `);
                }
            });
        } else if(buttonId == 'btn-edit-type'){
            $('input#'+buttonId).before(` <button class="btn btn-primary" id="${buttonId+'-submit'}">
                    gửi
                </button>`);
            $('input#'+buttonId).parent().siblings().html(`
                <select class="form-control" id="select-place">
                    <option value=""> ---- Chọn Một ---- </option>
                    <option value="Mèo">Mèo</option>
                    <option value="Chó">Chó</option>
                </select>
            `);
        } 

        else {
            $('input#'+buttonId).before(` <button class="btn btn-primary" id="${buttonId+'-submit'}">
                    gửi
                </button>`);
            $('input#'+buttonId).parent().siblings().html(`
                <textarea class="form-control" name="" id="" cols=60" rows="3">`+oldValue.trim()+`</textarea>
            `);
        }

        
        $('input#'+buttonId).css({display: 'none',float: 'right'});
        $('input#'+buttonId+'-cancel').css({display: 'block', float: 'right'});

        $('input#'+buttonId+'-submit').click(function(){
            var data = $('input#'+buttonId+'-submit').siblings().val();
            var obj  = $('input#'+buttonId+'-submit').siblings('select#obj').val();
            var note = $('input#'+buttonId+'-submit').siblings('textarea').val();

            var nameUrl = buttonId.split("-");
                nameUrl.splice(0,1);
            var animalId = $('input[type="hidden"]#animal-id').val();

            url = window.location.origin + "/animal/edit/"+ nameUrl.join("-") +"/" +animalId;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
            $.ajax({
                url: url,
                type: "post",
                datatType: "json",
                data: {
                    data: data,
                    obj: obj,
                    note: note
                },
                buttonId: buttonId,
                success: function(data){
                    if(this.buttonId == 'btn-edit-place'){
                        let contentAppend = null;
                        if(data.data == 'other'){
                            contentAppend = '<p>' +data.note+ '</p>';
                        } else if (data.data == 'commonHome'){
                            contentAppend = "<p>Nhà Chung</p>";
                        } else if (data.data == 'volunteer'){
                            let note = (data.note == null) ? '': data.note;
                            contentAppend = `<p>
                                                Nhà TNV: <a href="/volunteer/info/${data.obj.id}"> ${data.obj.name} </a> <br> 
                                                Ghi chú: ${note}
                                            </p>`;
                        } else if (data.data == "hospital"){
                            let note = (data.note == null) ? '': data.note;
                            contentAppend = `<p>
                                                Bệnh Viện: <a href="/hospital/detail_info/${data.obj.id}"> ${data.obj.name} </a> <br> 
                                                Ghi chú: ${note}
                                            </p>`;
                        }

                        $('input#'+this.buttonId+'-cancel').parent().siblings().html(`
                                    ${contentAppend}
                            `);
                        $('input#'+this.buttonId).css({display: 'block', float: 'right'});
                        $('input#'+this.buttonId+'-cancel').css({display: 'none',float: 'right'});
                    } else{
                        $('input#'+this.buttonId+'-cancel').parent().siblings().html(`
                                <p>
                                    ${data}
                                </p>
                            `);
                        $('input#'+this.buttonId).css({display: 'block', float: 'right'});
                        $('input#'+this.buttonId+'-cancel').css({display: 'none',float: 'right'});
                    }
                },
                error: function(data) {
                    alert('error');
                }
            });

        });
    });

}

function createButtonCancelEdit(buttonId, oldValue){
    $('input#'+buttonId+'-cancel').click(function(){
        $('input#'+buttonId+'-cancel').parent().siblings().html(`
                <p>
                    ${oldValue}
                </p>
            `);
        $('button#'+buttonId+'-submit').remove();
        $('input#'+buttonId).css({display: 'block', float: 'right'});
        $('input#'+buttonId+'-cancel').css({display: 'none',float: 'right'});
    });
}
