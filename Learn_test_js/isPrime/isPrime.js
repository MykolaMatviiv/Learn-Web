var num = Number(prompt("Enter the end of the prime numbers sequence : "));

function isPrime(number) {
	if(number === 1) {
		return false;
	}
	if(number % 2 === 0) {
		return false
	}
	for (var divider = 2; divider * divider <= number; divider++) {
            if (number % divider === 0) {
                return false;
            }
        }
        return true;
}

function showPrimeNumbersSequence(number) {
	for (var i = 2; i < number; i++) {
		if (isPrime(i)) {
			console.log(i);
		}
	}
}

console.log(isPrime(num));
showPrimeNumbersSequence(num);