function rewersWordInString(str) {
	var temp_rewersWordInString = str.split(' ');
	for(i = 0, len = temp_rewersWordInString.length; i < len; i++){
		temp_rewersWordInString[i] = rewersWord(temp_rewersWordInString[i]);
	}
	str = temp_rewersWordInString.join(' ');
	return str;
}

function rewersWord(word) {
	return word.split('').reverse().join('');
}

var a = "123 456 789 1234567789";
var new_a = rewersWordInString(a);

console.log(new_a);