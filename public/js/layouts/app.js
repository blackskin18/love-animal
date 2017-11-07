$(function () {

	function sendAjax (){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
		var url = window.location.origin + "/api/get_data/histories/today";

        $.ajax({
            url: url,
            type: "get",
            datatType: "json",
            async: false,
            success: function(data){
            	localStorage.setItem("data", JSON.stringify(data));
            },
            error: function(data) {
            }
        });
        var histories =  JSON.parse(localStorage.getItem("data"));
        // console.log(animal);
        var htmlAppend = `
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Ngày thay đổi</th>
						<th>Người Dùng</th>
						<th>Ghi Chú</th>
						<th>Trước khi thay Đổi</th>
						<th>Sau khi thay đổi</th>
					</tr>
				</thead>
				<tbody>`
		for(i in histories){
			htmlAppend += `<tr>
						<td>${histories[i].created_at}</td>
						<td>
							<a href="/volunteer/info/${histories[i].user_id }">
								${histories[i].user.name}
							</a>
						</td>
						<td>`;
						if(histories[i].note == null){
							htmlAppend +='';
						} else{
							htmlAppend += histories[i].note;
						};
						htmlAppend += `</td>
						<td>`;
						if(histories[i].attribute == 'image'){
							htmlAppend += `<img src="animal_image/${histories[i].animal_id}/${histories[i].old_value}" width="75" height="50" alt="">`;
						} else if (histories[i].attribute == 'place'){
							if(histories[i].old_value == 'volunteer'){
								htmlAppend += `<p> nhà TNV: 
					                                <a href="/volunteer/info/${histories[i].old_value_place.foster.id}">
					                                    ${histories[i].old_value_place.foster.name}
					                                </a> <br />
					                                ${histories[i].old_value_place.note}
					                            </p>`;
							} else if(histories[i].old_value == 'hospital'){
								htmlAppend += `<p> Bệnh Viện: 
					                                <a href="/volunteer/info/${histories[i].old_value_place.hospital.id}">
					                                    ${histories[i].old_value_place.hospital.name}
					                                </a> <br />
					                                	${histories[i].old_value_place.note}
					                            </p>`;
							} else if(histories[i].old_value == 'commonHome'){
								htmlAppend += `<p>Nhà Chung</p>`
							} else {
								htmlAppend += histories[i].old_value;
							}
						} else {
							htmlAppend += histories[i].old_value;
						}
			htmlAppend +=`</td>
						<td>`;
						if(histories[i].attribute == 'image'){
							htmlAppend += `<img src="animal_image/${histories[i].animal_id}/${histories[i].new_value}" width="75" height="50" alt="">`;
						} else if (histories[i].attribute == 'place'){
							if(histories[i].new_value == 'volunteer'){
								htmlAppend += `<p> nhà TNV: 
					                                <a href="/volunteer/info/${histories[i].new_value_place.foster.id}">
					                                    ${histories[i].new_value_place.foster.name}
					                                </a> <br/>
					                                	${histories[i].new_value_place.note}
					                            </p>`;
							} else if(histories[i].new_value == 'hospital'){
								htmlAppend += `<p> Bệnh Viện: 
					                                <a href="/volunteer/info/${histories[i].new_value_place.hospital.id}">
					                                    ${histories[i].new_value_place.hospital.name}
					                                </a> <br />
					                                	${histories[i].new_value_place.note}
					                            </p>`;
							} else if(histories[i].new_value == 'commonHome'){
								htmlAppend += `<p>Nhà Chung</p>`
							} else {
								htmlAppend += histories[i].new_value;
							}
						} else {
							htmlAppend += histories[i].new_value;
						}
			htmlAppend += `
						</td>
					</tr>`;
		}
		htmlAppend += `
				</tbody>
			</table>
        `;
        return htmlAppend;
	}

	$('button#btn-show-today-history').click(function(){
		$('button#btn-show-today-history').popModal({
			html : sendAjax(),
			placement : 'bottomCenter',
			showCloseBut : true,
			onOkBut : function(){ },
			onCancelBut : function(){ },
			onLoad : function(){ },
			onClose : function(){ }
		});
	});
})