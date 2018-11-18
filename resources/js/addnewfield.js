$(document).ready(function(){
	$("#add-new-field-btn").click(function(e) {
		var fields = '<div class="input-group">'+
                '<input type="text" class="form-control field-name" placeholder="Enter Fields">'+
                '<div class="input-group-btn">'+
                  '<select class="form-control">'+
                    '<option value="0">Data Type</option>'+
                   ' <option value="1">Serial Number</option>'+
                    '<option value="2">Number</option>'+
                    '<option value="3">Text</option>'+
                   ' <option value="4">Indian Name(Male)</option>'+
                    '<option value="5">Indian Name(Female)</option>'+
                    '<option value="6">Foreign Name(Male)</option>'+
                    '<option value="7">Foreign Name(Female)</option>'+
                    '<option value="8">Indian Name</option>'+
                    '<option value="9">Foreign Name</option>'+
                    '<option value="10">Date</option>'+
                   ' <option value="11">Country</option>'+
                   ' <option value="12">Street Address</option>'+
                    '<option value="13">Email</option>'+
                    '<option value="14">Mobile Number</option>'+
                  '</select>'+
                '</div>'+
                '<span class="delete-field"><i class="glyphicon glyphicon-shaded-red glyphicon-ban-circle"></i></span>'+
              '</div>'+
              '<hr class="form-group-hr">';
              $(".fields-container").append(fields);

	});
$(".form-horizontal").on("focus","input[class='form-control field-name']",function(){
      $(this).css({"border-color":"#ccc"});
      console.log("focus");
});

$(".form-horizontal").on("focus","select[class='form-control']",function(){
      $(this).css({"border-color":"#ccc"});
      console.log("focus");
});

$("#generate_btn").click(function(){
  var validated = true;
  var selectValidated = true;
	var values = $(".form-horizontal input[class='form-control field-name']")
              .map(function(){
                if($(this).val()=="") {
                  validated = false;
                  $(this).css({"border-color":"red"});
                } else {
                  return $(this).val();
                }
              }).get();

      if(parseInt($("#numrow").val(),10)>99999) {
    $(".error-message").css({"display":"block"}); 
    $(".error-message").text("Limit is 1 lac"); 
    $("#numrow").css({"border-color":"red"});
    return false;
  } 
  if(isNaN($("#numrow").val())) {
    $(".error-message").css({"display":"block"}); 
    $(".error-message").text("Not a number"); 
    $("#numrow").css({"border-color":"red"});
    return false;
  }

    if(!validated) {
      validated = confirm("Some fields were blank. Continue without those fields?");
      if(!validated) {
          return false;
        } else {
          $(".form-horizontal input[class='form-control field-name']")
              .map(function(){
                if($(this).val()=="") {
                    $(this).parent().next("hr").remove();
                    $(this).parent().remove();
                }
              });
        }
    }
              console.log(values);

    var select = $(".form-horizontal select[class='form-control']")
              .map(function(){
                if($(this).val()!="0") {
                  return $(this).val();
                } else {
                  selectValidated=false;
                  $(this).css({"border-color":"red"});
                }
                
              }).get();
              console.log(select);
    if(!selectValidated) {
      selectValidated = confirm("Some Data types were not selected and will be removed. Continue without those fields?");
      if(!selectValidated) {
          return false;
        } else {
          $(".form-horizontal select[class='form-control']")
              .map(function(){
                if($(this).val()=="0") {
                    $(this).parent().parent().next("hr").remove();
                    $(this).parent().parent().remove();
                }
              });
        }
    }
    var userDelimeter = "";
    var userTableName = "";
    var datatype = $(".form-horizontal input[type='checkbox']:checked")
              .map(function(){
                userDelimeter = $(".form-horizontal input[name='udelifield']").val();
                userTableName = $(".form-horizontal input[name='tableNameField']").val();
                return $(this).val();
              }).get();
              console.log(datatype);
    if(datatype.length==0) {
      alert("Please select the file format to generate");
      return false;
    }


              $.ajax({
				    url : _baseUrl+'generator/generate',
				    type : "GET",
				    data:{"column":values,"type":select,"formats":datatype,"numrow":$("#numrow").val(),"udelifield":userDelimeter,"userTableName":userTableName},
				    success : function(sfilename) {
              $arr = $.parseJSON(sfilename);
              $.each( $arr, function( index, value ){
                var ext = value.substr(value.lastIndexOf(".") + 1);
              console.log(ext);
				         ifrm = document.createElement("IFRAME");
				         ifrm.setAttribute("src", _baseUrl+"downloader/download?sfilename=" + value + "&dfilename=tempvariable."+ext);
				         ifrm.style.width = 1 + "px";
				         ifrm.style.height = 1 + "px";
				         document.body.appendChild(ifrm);
				         setTimeout(function () { 
				         	document.body.removeChild(ifrm);
				         }, 2000);
               });
        }

});
            });
$(".on-off-btn").click(function(){
	
	if($(this).hasClass("on")) {
		$(this).removeClass("on");
      if($(this).children().val()=="udeli") {
      $(".form-horizontal .udeli").remove();
    }
    if($(this).children().val()=="sql") {
      $(".form-horizontal .sql").remove();
    }
	} else {
		$(this).addClass("on");
    if($(this).children().val()=="udeli") {
      $(this).parent().append("<div class='sqlDetailContainer udeli'><input type='text' placeholder='Your Delimeter here(default is :)' class='form-control' name='udelifield'></div>");
    }if($(this).children().val()=="sql") {
      $(this).parent().append("<div class='sqlDetailContainer sql'><input type='text' placeholder='Table Name(default is tempvariable)' class='form-control' name='tableNameField'></div>");
    }
    console.log($(this).children().val());
	}
	$(this).children().prop('checked', $(this).hasClass("on"));
});
$(".on-off-btn").each(function(){
  $(this).children().prop('checked', $(this).hasClass("on"));
});

$("form").on("click",".delete-field",function(){
  $(this).parent().next("hr").remove();
  $(this).parent().remove();
});
$("#convertSubmit").click(function(event){
  if($("#destinationType").val()=="0") {
  event.preventDefault();
  $("#destinationType").css({"border-color":"red"});
  }
  if($("#destinationType").val()=="5") {
  event.preventDefault();
  alert("Coming soon... please select another format to convert");
  $("#destinationType").css({"border-color":"red"});
  }

});
$("#destinationType").focus(function(){
      $(this).css({"border-color":"#ccc"});
});
$("#destinationType").change(function(){

  
  if($(this).val()=="1") {
    $(this).parent().append("<div class='sqlDetailContainer'><input type='text' placeholder='Table Name' class='form-control' name='tableName'></div>");
  }
    else {
      $(this).next('div').remove();
    }
  
});
$("#numrow").blur(function(event){
  if(parseInt($(this).val(),10)>99999) {
    $(".error-message").css({"display":"block"}); 
    $(".error-message").text("Limit is 1 lac"); 
    $(this).css({"border-color":"red"});
  } 
  if(isNaN($(this).val())) {
    $(".error-message").css({"display":"block"}); 
    $(".error-message").text("Not a number"); 
    $(this).css({"border-color":"red"});
  }
});
$("#numrow").focus(function(event){
  $(".error-message").css({"display":"none"}); 
    $(this).css({"border-color":"#ccc"});
});
});