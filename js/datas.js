// -------------------- 

// # INIT

window.onload = datasVars();
window.onload = datasGet();

// -------------------- 

// # DATAS VARS

function datasVars(){
    console.log("function : datasVars");
    
    sendDiv = document.getElementById("sendDiv");
    sendBtn = document.getElementById("sendBtn");
    fileCleanBtn = document.getElementById("fileCleanBtn");

    // function : datasEventsListeners
    datasEventsListeners();
}

// -------------------- 

// # DATAS EVENTS LISTENERS

function datasEventsListeners() {
    console.log("function : datasEventsListeners");
    
    // sendBtn -> click -> function : datasPost
    sendBtn.addEventListener("click", datasPost);

    // fileCleanBtn -> click -> function : fileClean
    fileCleanBtn.addEventListener("click", fileClean);

}

// -------------------- 

// # DATAS GET 

function datasGet(){
    console.log("function : datasGet");
    
    // ## REQUEST
    var request = $.ajax({
	url: "php/datasGet.php",
	type: "GET",
    });

    // ## DONE
    request.done(function(content) {
	contentDiv.innerHTML = content;
	ssfFilter();
    });
}

// -------------------- 

// # DATAS POST 

function datasPost(){
    console.log("function : datasPost");

    // ## DATAS
   
    // create form data and gets datas
    var formData = new FormData();
    var author = [];
    $("input:checkbox[name=author]:checked").each(function(){
        author.push($(this).val());
    });
    author.toString();
    console.log(author);
    var category = [];
    $("input:checkbox[name=category]:checked").each(function(){
        category.push($(this).val());
    });
    category.toString();
    console.log(category);
    var text = document.getElementById("text").value;
    console.log(text);
    var file = document.getElementById("file").files;
    console.log(file);
    var date = document.getElementById("date").value;
    console.log(date);
    var time = document.getElementById("time").value;
    console.log(time);
    
    // append datas to form datas and file to form file
    formData.append('data[]', author); 
    formData.append('data[]', category); 
    formData.append('data[]', text); 
    formData.append('data[]', date); 
    formData.append('data[]', time); 
    for (i = 0; i < file.length; i ++) {
    	formData.append('file[]', file[i]);
    }
   
   // ## REQUEST
    var request = $.ajax({
	url: "php/datasPost.php",
	type: "POST",
	processData: false,
	contentType: false,
	data: formData 
    });

    // ## DONE
    request.done(function(content) {
	alert(content);
	datasGet();
    });
}

// -------------------- 

// # FILE CLEAN INPUT

function fileClean(){
    console.log("function : fileClean");

    $("#file").val('');
      
}

// -------------------- 

// # DATE AND TIME PICKER 

$( "#date" ).datepicker({
  dateFormat: "y-mm-dd"
});
//$('#time').timepicker({ 'timeFormat': 'H-i-s' });
