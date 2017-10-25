$(function () {
    $('button#btn-show-info').click(function(){
        $('div.history-box').slideUp( "slow", function(){
            $('div.info-box').slideDown('slow');
        });
    });

    $('button#btn-show-history').click(function(){
        $('div.info-box').slideUp( "slow", function(){
            $('div.history-box').slideDown('slow');
        });
    });

    createFormEditOneAttribute('btn-edit-phone');
    createFormEditOneAttribute('btn-edit-note');
    createFormEditOneAttribute('btn-edit-address');
    createFormEditOneAttribute('btn-edit-name');

});

function createFormEditOneAttribute(buttonId){
    this.oldValue = $('button#'+buttonId).parent().siblings().text().trim();
    createButtonEdit(buttonId, this.oldValue);
    createButtonCancelEdit(buttonId, this.oldValue);
}

function createButtonEdit(buttonId, oldValue){
    $('button#'+buttonId).click(function(){
        if(buttonId == 'btn-edit-note'){
           $('button#'+buttonId).parent().siblings().html(`
            <textarea type="text" rows="3" class="form-control" value="`+oldValue.trim()+`">
            </textarea>
            <button class="btn btn-primary" id="${buttonId+'-submit'}">
                gửi
            </button>
            `);
        } else {
            $('button#'+buttonId).parent().siblings().html(`
            <input type="text" class="form-control" value="`+oldValue.trim()+`"/>
            <button class="btn btn-primary" id="${buttonId+'-submit'}">
                gửi
            </button>
            `);
        }

        
        $('button#'+buttonId).css({display: 'none',float: 'right'});
        $('button#'+buttonId+'-cancel').css({display: 'block', float: 'right'});

        $('button#'+buttonId+'-submit').click(function(){
            var data = $('button#'+buttonId+'-submit').siblings().val();
            var nameUrl = buttonId.split("-");
                nameUrl.splice(0,1);
            var hospitalId = $('input[type="hidden"]#hospital-id').val();

            url = window.location.origin + "/hospital/edit/"+ nameUrl.join("-") +"/" +hospitalId;
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
                    data,
                },
                buttonId: buttonId,
                success: function(data){
                    $('button#'+this.buttonId+'-cancel').parent().siblings().html(`
                            <p>
                                ${data}
                            </p>
                        `);
                    $('button#'+this.buttonId).css({display: 'block', float: 'right'});
                    $('button#'+this.buttonId+'-cancel').css({display: 'none',float: 'right'});
                },
                error: function(data) {
                    alert('error');
                }
            });

        });
    });

}

function createButtonCancelEdit(buttonId, oldValue){
    $('button#'+buttonId+'-cancel').click(function(){
        $('button#'+buttonId+'-cancel').parent().siblings().html(`
                <p>
                    ${oldValue}
                </p>
            `);
        $('button#'+buttonId).css({display: 'block', float: 'right'});
        $('button#'+buttonId+'-cancel').css({display: 'none',float: 'right'});
    });
}
