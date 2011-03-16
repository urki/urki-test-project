	var text_ok, text_error;
	text_ok = " ";
	text_error = "<span class='warning'>Napaka!</span>";
	
	function send_req(div_name,script_name,text_ok, text_error, id) {
		var email_from = "email_from";
		var email_to = "email_to";
		var body = "body";
		var post_document = "vdc_send";
		
		if(id !== undefined){
			body = body + "_" + id;
			post_document = post_document + "_" + id;
		}

		
	
		
		new Ajax(script_name, {
			method: 'post',
			encoding: 'utf-8',
			postBody: $(post_document),
			onComplete: function(response) {
				if (response == 'OK') {
					$(div_name).innerHTML = text_ok;
				} else {
					$(div_name).innerHTML = text_error;
				}
			}
		}).request();
	}
