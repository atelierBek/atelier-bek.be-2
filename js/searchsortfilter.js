
// -------------------- 

// # INIT

window.onload = ssfVars();

// -------------------- 

// # SSF VARS 

function ssfVars() {
    console.log("function : ssfVars");


    nav = document.getElementById("navDiv");
    filterBtnArr = nav.getElementsByClassName("filterBtn");
    filterTypeArrArr = {};
   

    content = document.getElementById("contentDiv");
    itemArr = content.getElementsByClassName("post");


    // function : ssfEventsListeners
    ssfEventsListeners();
}

// -------------------- 

// # SSF EVENTS LISTENERS

function ssfEventsListeners() {
    console.log("function : ssfEventsListeners");


    // filterBtnArr -> click -> function : ssfFilterStatusAndArray  
    for (i = 0; i < filterBtnArr.length; i ++) {
	filterBtnArr[i].addEventListener("click", ssfFilterStatusAndArray);
    } 
}

// -------------------- 

// # SSF FILTER STATUS AND ARRAY 

function ssfFilterStatusAndArray() {
    console.log("function : ssfFilterStatusAndArray");


    // vars
    var filterBtn = this; 
    var filterValue = this.innerHTML;
    var filterType = this.getAttribute("data-filterType");
    if (typeof window[filterType + "Arr"] == 'undefined') {
	window[filterType + "Arr"] = [];	
    }
    var filterTypeArr = window[filterType + "Arr"];

    console.log("filterValue : " + filterValue);
    console.log("filterType : " + filterType);
    console.log("filterTypeArr : " + filterType + "Arr");
    
    
    // check status and push or remove filterValue into corresponding filterTypeArr and filterTypeArr in filterTypeArrArr 
    if (filterBtn.classList.contains("checked")) {
	filterBtn.classList.remove("checked");
	var i = filterTypeArr.indexOf(filterValue);
	if (i != -1) {
	    filterTypeArr.splice(i, 1);
	}
	if (filterTypeArr.length == 0) {
	    delete filterTypeArrArr[filterType];    
	}
    } else {
	filterBtn.classList.add("checked");
	filterTypeArr.push(filterValue);
	if (!(filterType in filterTypeArrArr)){
	    filterTypeArrArr[filterType] = filterTypeArr;
	}
    }
    
    console.log(filterType+"Arr : " + filterTypeArr);
    console.log("filterTypeArrArr :" + filterTypeArrArr);
    console.log(filterTypeArrArr);

  
    // function : ssfFilter
    ssfFilter ();
}

// -------------------- 

// # SSF FILTER

function ssfFilter() {
    console.log("function : ssfFilter");

    // check if if filterTypeArrArr is empty and so display all items
    if (Object.keys(filterTypeArrArr).length === 0) {
	for (i = 0; i < itemArr.length; i ++) {
            itemArr[i].classList.add("block");
            itemArr[i].classList.remove("none");
	}
    } else {


	// iterate all itemArr
        for (i = 0; i < itemArr.length; i ++) {

            var match = 0;
            var item = itemArr[i];

            // compare each value of each filterTypeArr in filterTypeArrArr with each filterItem
            loop:
            for (var filterType in filterTypeArrArr) {
		
		var filterTypeArr = filterTypeArrArr[filterType];
        	var filterItemArr = item.querySelectorAll('[data-filterType="'+filterType+'"]');
		console.log(filterType);
		console.log(filterTypeArr);
		console.log(filterItemArr);
        	
        	for(k = 0; k < filterTypeArr.length; k ++){

        	    console.log(filterTypeArr[k]);
        	    
        	    for(l = 0; l < filterItemArr.length; l++){

        		if(filterTypeArr[k] === filterItemArr[l].innerHTML){

        		    match = 1;
        		    break loop;
        		}
        	    }
                }
            }
        
        // add class
        if (match == 1) {
            item.classList.add("block");
            item.classList.remove("none");
        } else if (match == 0){
            item.classList.add("none");
            item.classList.remove("block");
        }
    	    
	}
    }
}
