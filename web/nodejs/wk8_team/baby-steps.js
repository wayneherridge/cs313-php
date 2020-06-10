// console.log(process.argv);

// var result = 0
// for (var i = 2; i < process.argv.length; i++)
//     result += Number(process.argv[i])

// console.log(result)

var sum = process.argv.reduce(function (a, b, c) {
    if (c >= 2 && !isNaN(b)) {
        return +a + +b
    } else if (c >= 2) {
        return +a + 0;
    } else {
        return 0;
    }
})

console.log(sum)