function sumPositiveAndNegativeElement(arr) {
	var sumPos = 0, sumNeg = 0;
	for (var i = 0; i < arr.length; i++) {
		for (var j = 0; j < arr[i].length; j++){
			if(typeof(arr[i][j]) === "number"){
				if(arr[i][j] > 0){
					sumPos += arr[i][j];
				} 
				if(arr[i][j] < 0){
					sumNeg += arr[i][j];
				}
			}
		}
	}
	return { sumPos, sumNeg};
}

var a = [[1,2,-5],[7,-4,3],[-2,-1,5]]
var newA = sumPositiveAndNegativeElement(a);
console.log(newA);