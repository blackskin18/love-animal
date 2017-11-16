
$(function(){
	let test = $('img.animal_image').width();
	$('img.animal_image').css('height', test);
	// console.log(test);

	let sumImage = $('input#sum_image').val();
	function sendAjax (url){
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
            success: function(data){
            	localStorage.setItem("info", JSON.stringify(data));
            },
            error: function(data) {
            }
        });
        let animal =  JSON.parse(localStorage.getItem("info"));
        // console.log(animal);
        let htmlAppend = 
        `<div class="text-center">
        	<h3 class="text">
        		Ca ${animal.id}
        	</h3>
			<table class="table">
				<tr>
					<td>Ngày nhận</td>
					<td>${animal.created_at}</td>
				</tr>
				<tr>
					<td>Trạng thái</td>
					<td>${animal.status}</td>
				</tr>
				<tr>
					<td>Địa điểm</td>
					<td>${animal.address}</td>
				</tr>
				<tr>
					<td>trường hợp</td>
					<td>${animal.name}</td>
				</tr>
			</table>
        </div>`
        return htmlAppend;
	}
	for(let i = 0; i <= sumImage; i++){
		let animalId = $('div#image_' + i + '>input').val();
		$('div#image_' + i +'>img').hover(function(){
			console.log(animalId);
			url = window.location.origin + "/animal/summary_detail/" + animalId;
			$('div#image_' + i).popModal({
				html : sendAjax(url),
				placement : 'rightTop',
				showCloseBut : true,
				onOkBut : function(){ },
				onCancelBut : function(){ },
				onLoad : function(){ },
				onClose : function(){ }
			});
		});
		$('div#image_' + i +'>img').click(function(){
			window.open(window.location.origin + "/animal/detail_info/" + animalId);
		});
	}
	
	//=====================================###===============================================
	let nearToBottom = 100;
	$(window).scroll(function () {
		if ($(window).scrollTop() + $(window).height() > 
		    $(document).height() - nearToBottom) {
				let lastAnimalId = $('input#last_animal_id').val();
				let url = window.location.origin + "/animal/list_image/loadmore/" + lastAnimalId;
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
		            success: function(data){
		            	let lastIndex = 0;
		            	for(let index in data){
		            		lastIndex = index;
		            		content = `
							<div class="col-sm-2" style = "padding-bottom: 10px">
								<div id="image_${data[index].id}">
									<input type="hidden" disabled value="${data[index].animal_id}">
		            		`;
		            		if(data[index].file_name){
		            			content += `<img src="${window.location.origin + "/animal_image/"+ data[index].animal_id + "/" + data[index].file_name }" 
		            			alt="ảnh ca ${data[index].animal_id}" width="100%" class ="animal_image" height="130px" >`
		            		} else{
		            			content += `<img src="${window.location.origin + "/animal_image/default_image/default.jpg"}"
		            			alt="ảnh ca ${data[index].animal_id}" width="100%" class ="animal_image" height="130px" >`;
		            		}
		            		content += `</div>
								<div class="text-center">
									${data[index].animal_id}
								</div>
		            		`
		            		$('div#list-image-box').append(content);
		            	}
	            		$('input#last_animal_id').val(data[lastIndex].animal_id);
	            		//=================================================================================
	            		// thêm sự kiện cho ảnh vừa thêm vào
	            		let sumImage = $('input#sum_image').val();
	            		console.log(sumImage);
						for(let i = 0; i <= sumImage; i++){
							let animalId = $('div#image_' + i + '>input').val();
							$('div#image_' + i+'>img').unbind();
							$('div#image_' + i+'>img').hover(function(){
								console.log(animalId);
								url = window.location.origin + "/animal/summary_detail/" + animalId;
								$('div#image_' + i +'>img').popModal({
									html : sendAjax(url),
									placement : 'rightTop',
									showCloseBut : true,
									onOkBut : function(){ },
									onCancelBut : function(){ },
									onLoad : function(){ },
									onClose : function(){ }
								});
							})
							$('div#image_' + i).click(function(){
								window.open(window.location.origin + "/animal/detail_info/" + animalId);
							});
						}
		            },
		            error: function(data) {
		            }
		        });
	    	let test = $('img.animal_image').width();
			$('img.animal_image').css('height', test);
		}
	});
})