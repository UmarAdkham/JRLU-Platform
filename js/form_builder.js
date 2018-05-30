function addFields(){
	//var number = document.getElementById("noFields").value;
	var container = document.getElementById("fields-container");
	var arrayType = ["EditText"];

	/*while (container.hasChildNodes()) {
		container.removeChild(container.lastChild);
	}*/
	//for (i=0; i<number; i++){
		var nameDiv = document.createElement("div");
		nameDiv.className = "col-xs-5";
		nameDiv.appendChild(document.createTextNode("Field Name"));
		var input = document.createElement("input");
		input.type = "text";
		input.name = "field_name[]";
		input.className += "form-control";
		nameDiv.appendChild(input);

		var typeDiv = document.createElement("div");
		typeDiv.className = "col-xs-4";
		typeDiv.appendChild(document.createTextNode("Field Type"));
		var select = document.createElement("select");
		select.name = "field_type[]";
		select.className = "form-control";
		typeDiv.appendChild(select);

		/*var requiredDiv = document.createElement("div");
		requiredDiv.className = "col-xs-3";
		requiredDiv.innerHTML = '<label class="checkbox-inline pull-right" style="padding-top: 27px;"><input type="checkbox" name="required" value="">Required</label>';
*/
		var clearfixDiv = document.createElement("div");
		clearfixDiv.className = "clearfix";


		for (var t = 0; t < arrayType.length; t++) {
			var option = document.createElement("option");
			option.setAttribute("value", arrayType[t]);
			option.text = arrayType[t];
			select.appendChild(option);
		}

		container.appendChild(nameDiv);
		container.appendChild(typeDiv);
		//container.appendChild(requiredDiv);
		//container.appendChild(clearfixDiv);
	}

