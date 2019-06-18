function cleanForm(){
	$("#form_new-existing_dog [name]").val("");
	var sf_file_containers = $(".sf-file-container");
	delete(sf_file_containers[sf_file_containers.length-1]);
	for(var i=0;i<sf_file_containers.length;i++){
		$(sf_file_containers[i]).remove();
	}
}
$("#link_dog_create").on("click",function(e){
	var open = $("#formWrapper").css("display")=="none";
	$('#formWrapper').slideToggle('show');
	$(this).html(open ? "Descartar cambios" : "Agregar perro");
	$("#reg_new-existing_dog").val("Agregar perro");
	$("#form_new-existing_dog").attr("action",domain+"intranet/dog/create");
	$("#formWrapper .sf-title").html("Nuevo perro");
	$("#formWrapper input[name=id]").remove();
	cleanForm();
});
$(".link_dog_show_edit").on("click",function(e){
	e.preventDefault();
	var id = $(this).attr("data-id");
	$.ajax({
		url:domain+"intranet/dog/get?id="+id,
		type:"post",
		dataType:"json",
		success:function(response){
			var file_types = {'img':'imagen'};
			if($("#formWrapper").css("display")=="none") $("#formWrapper").slideToggle('show');
			$("#link_dog_create").html("Descartar cambios");
			$("#reg_new-existing_dog").val("Ejecutar cambios");
			$("#formWrapper .sf-title").html("Editar perro");
			$("#form_new-existing_dog").attr("action",domain+"intranet/dog/edit");
			$("#formWrapper input[name=id]").remove();
			$("#form_new-existing_dog").append("<input type='hidden' name='id' value ='"+response["id"]+"' required>");
			$("#form_new-existing_dog [name=name]").val(response['name']);
			$("#form_new-existing_dog [name=sex]").val(response['sex']);
			$("#form_new-existing_dog [name=age]").val(response['age']);
			$("#form_new-existing_dog [name=size]").val(response['size']);
			$("#form_new-existing_dog [name=fur]").val(response['fur']);
			$("#form_new-existing_dog [name=activity]").val(response['activity']);
			$("#form_new-existing_dog [name=required_space]").val(response['required_space']);
			$("#form_new-existing_dog [name=time_alone]").val(response['time_alone']);
			$("#form_new-existing_dog [name=code]").val(response['code']);
			$("#form_new-existing_dog [name=adoption_contribution]").val(response['adoption_contribution']);
			$("#group_files").html(
				"<div class='sf-file-container boxed'>"+
					"<div class='sf-file bgContain' style='height:180px'>"+
						"<span>+</span>"+
						"<input type='file' accept='image/*' onchange='read_files(this);' multiple>"+
						"<input type='hidden'>"+
					"</div>"+
				"</div>"
			);
			var resource, path="";
			for(var i=0;i<response["resources"].length;i++){
				resource = response['resources'][i];
				path = domain+"assets/"+resource['type']+"/"+resource['body'];
				$("#group_files").prepend(
					"<div class='sf-file-container boxed'>"+
						"<div class='sf-file bgContain' style='height:180px;background-image:"+(resource['type'] == 'img' ? "url("+path+")'" : "none")+" data-type='"+resource['type']+"'>"+
							"<a href='#' class='sf-file-del link_dog_delete_resource' data-rid='"+resource['id']+"'>X</a>"+
							(resource['type']=='vid' ? "<label class='sf-file-title'>"+resource['name']+"</label>" : '')+
						"</div>"+
					"</div>"
				);
			}
		}
	});
});
$(".link_dog_change_status").on("click",function(e){
	e.preventDefault();
	var dog_status = $(this);
	var id = $(this).attr("data-id");
	$.ajax({
		url:domain+"intranet/dog/_status-edit",
		type:'post',
		dataType:'json',
		data:{'id':id},
		success:function(response){
			if(response[0]!="0"){alert("ERROR");return;}
			$(dog_status).html(response["message"]).css({"color":response["color"]});
		}
	});
});
function read_files(file){
	var files = file.files;
	if(files){
		var resources = [$(file).parent()], resource;
		var reader = [new FileReader()];
		var not_loaded_previously = resources[0].css("background-image")=="none"&&resources[0].find("label").length==0;
		for(var i=0;i<files.length;i++){
			resource = resources[i];
			resource.find("span").remove();
			resource.find("label").remove();
			reader[i].resource = resource;
			reader[i].onload = function(e){
				$(this.resource).css({"background-image":"url("+e.target.result+")"});
			}
			resource.append("<a href='#' class='sf-file-del' onclick='event.preventDefault();$(this).parent().parent().remove()'>X</a>");
			resource.find("input[type=file]").attr("name","resource[body][]");
			resource.find("input[type=file]")[0].onclick = function(){return false;};
			resource.find("input[type=hidden]").attr("name","resource[type][]").val('img');
			resource.next("input").attr("placeholder","Título de imagem (opcional)");
			reader[i].readAsDataURL(files[i]);
			if(!not_loaded_previously) break;
			$(resource).parent().after(
				"<div class='sf-file-container boxed'>"+
					"<div class='sf-file bgContain' style='height:180px'>"+
						"<span>+</span>"+
						"<input type='file' accept='image/*' onchange='read_files(this);' multiple>"+
						"<input type='hidden'>"+
					"</div>"+
				"</div>"
			);
			resources.push($(resource.parent().next().find(".sf-file")));
			reader.push(new FileReader());
		}
	}
}
$("#reg_new-existing_dog").on("click",function(e){
	if($("input[name=resource\\[type\\]\\[\\]][value=img]").length<1&&$(".sf-file[data\-type=img]").length<1){
		e.preventDefault();
		alert("Es necesario incluir al menos una foto.");
		return;
	}
	$("#form_new-existing_dog").validate();
	if($("#form_new-existing_dog").valid()){
		$("#form_new-existing_dog").submit();
	}
});
$("#group_files").ready(function(){
	$(this).on("click",".link_dog_delete_resource",function(e){
		e.preventDefault();
		$("#form_new-existing_dog").append(
			"<input type='hidden' name='resource_del[]' value='"+$(this).attr("data-rid")+"'>"
		);
		$(this).parent().parent().remove();
	});
});