// take the str parameter being passed and find the longest substring
// that contains k unique characters, where k will be the first character from the string.
// The substring will start from the second position in the string because
// the first character will be the integer k. For example: if str is "2aabbacbaa"
// there are several substrings that all contain 2 unique characters,
// namely: ["aabba", "ac", "cb", "ba"], but your program should return "aabba"
// because it is the longest substring. If there are multiple longest substrings,
// then return the first substring encountered with the longest length.
// k will range from 1 to 6.


// Input:"3aabacbebebe"
// Output:"cbebebe"

// Input:"2aabbcbbbadef"
// Output:"bbcbbb"


function countUniqueCharacters(str) {
    var uniqueChars = new Set();
    for (var c of str) {
        uniqueChars.add(c);
    }
    return uniqueChars.size;
}


function KUniqueCharacters(str) {
    var k = Number(str[0]);
    str = str.slice(1);

    // iterate with the substring with a size of (subStrSize)
    for (var subStrSize = str.length; subStrSize > 0; subStrSize--) {
        // pick a position to start with
        for (var i = 0; i <= str.length - subStrSize; i++) {
            var subStr = str.slice(i, i + subStrSize);
            //console.log(subStr)
            if (countUniqueCharacters(subStr) === k) {
                return subStr;
            }
        }
    }
}


console.log(KUniqueCharacters("2aabbacbaa")) // "aabba" //2hggdddddddgg
console.log(KUniqueCharacters("2hggdddddddgg")) // "aabba" //2hggdddddddgg
