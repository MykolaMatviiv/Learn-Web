function bigLetterAfterPoint(str) {
	var temp = str.split(".");
	for (var i = 0, len = temp.length; i < len; i++) {
		temp[i] = firstLetterToUpperCase(temp[i]);
	}
	str = temp.join(".");
	return str;
}

function firstLetterToUpperCase(str){
	var arr = str.split("");
	for(var i = 0, len = arr.length; i < len; i++){
		if(arr[i]>"A" && arr[i]<"z"){
			arr[i] = arr[i].toUpperCase();
			str = arr.join("");
			return str;
		}
	continue;
	console.log("Isn't letter")
	}
}


var a = "ghdsfsf odsfh odsh. sdfhuhifh iubisubdf df. djifb.";
var newA = bigLetterAfterPoint(a);


console.log(a);
console.log(newA);
