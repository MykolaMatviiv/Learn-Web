function twoMaxNamber(arr) {
	var max = arr[0], max_max = arr[0];
	for(var i = 0, len = arr.length; i < len-1; i++){
		if(arr[i] > max_max){
			max = max_max;
			max_max = arr[i];
		}
	}	
	return {max, max_max}
}


var a = [1, 2, 6, 8, 12, 4, 16, 32, 3, 7];

console.log(twoMaxNamber(a));