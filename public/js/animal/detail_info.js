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

    var oldValue = $('button#btn-edit-create-at').parent().siblings().text();
    createButtonEdit('btn-edit-create-at');
    createButtonCancelEdit('btn-edit-create-at', oldValue);

    
    
});

function createButtonEdit(buttonId){
    var oldValue = $('button#'+buttonId).parent().siblings().text();
    $('button#'+buttonId).click(function(){
        $('button#'+buttonId).parent().siblings().html(`
            <input type="text" value=${oldValue}/>
            <button>
                gửi
            </button>
            `);

        $('button#'+buttonId).css({display: 'none',float: 'right'});
        $('button#'+buttonId+'-cancel').css({display: 'block', float: 'right'});
    });
    

}

function createButtonCancelEdit(buttonId, oldValue){
    $('button#'+buttonId+'-cancel').click(function(){
        $('button#'+buttonId+'-cancel').parent().siblings().html(`
                <p class="col-lg-9">
                    ${oldValue}
                </p>
            `);
    $('button#'+buttonId).css({display: 'block', float: 'right'});
    $('button#'+buttonId+'-cancel').css({display: 'none',float: 'right'});
    });
}