type Digit = "0" | "1" | "2" | "3" | "4" | "5" | "6" | "7" | "8" | "9";

export type TwoDNumber = `${Digit}${Digit}`;

export function factorial(length: number) {
    let result = 1;
    for (let i = 2; i <= length; i++) {
        result *= i;
    }
    return result;
}

export function combination(nums: string) {
    let result: string[] = [];

    function backtrack(curr: string, remaining: string) {
        if (curr.length === nums.length) {
            result.push(curr);
            return;
        }

        for (let i = 0; i < remaining.length; i++) {
            let num = remaining[i];
            let newRemaining = remaining.slice(0, i) + remaining.slice(i + 1);
            backtrack(curr + num, newRemaining);
        }
    }
    backtrack("", nums);
    return [...new Set(result)].sort();
}

export function twoDNumberTransformer(inputNumber: string): TwoDNumber[] {
    if (inputNumber === "A" || inputNumber === "a") {
        // power
        return twoDPowerNumber() as TwoDNumber[];
    }

    if (inputNumber === "B" || inputNumber === "b") {
        // brothers
        return twoDBrotherNumber() as TwoDNumber[];
    }

    if (inputNumber === "Z" || inputNumber === "z") {
        // zodiac
        return twoDZodiacNumber() as TwoDNumber[];
    }

    if (inputNumber === "-+") {
        // odd even
        return twoDOddEvenNumber() as TwoDNumber[];
    }

    if (inputNumber === "+-") {
        // even odd
        return twoDEvenOddNumber() as TwoDNumber[];
    }

    if (inputNumber === "++") {
        // even even
        return twoDEvenEvenNumber() as TwoDNumber[];
    }

    if (inputNumber === "--") {
        // odd odd
        return twoDOddOddNumber() as TwoDNumber[];
    }

    if (inputNumber.length === 2 && /^\d{2}$/.test(inputNumber)) {
        return [inputNumber as TwoDNumber];
    }

    if (/^\d{2}\*$/.test(inputNumber)) {
        return combination(inputNumber.slice(0, -1)) as TwoDNumber[];
    }

    if (inputNumber.startsWith("//")) {
        return [
            "11",
            "22",
            "33",
            "44",
            "55",
            "66",
            "77",
            "88",
            "99",
            "00",
        ] as unknown as TwoDNumber[];
    }

    return [];
}

export function twoDPowerNumber() {
    // power
    return ["05", "16", "27", "38", "49", "50", "61", "72", "83", "94"];
}

export function twoDBrotherNumber() {
    // brothers
    return [
        "12",
        "23",
        "34",
        "45",
        "56",
        "67",
        "78",
        "89",
        "90",
        "10",
        "21",
        "32",
        "43",
        "54",
        "65",
        "76",
        "87",
        "98",
        "09",
    ];
}

export function twoDZodiacNumber() {
    // zodiac
    return ["07", "18", "24", "35", "69", "70", "81", "42", "53", "96"];
}

export function twoDOddEvenNumber() {
    // odd even
    return [
        "10",
        "12",
        "14",
        "16",
        "18",
        "30",
        "32",
        "34",
        "36",
        "38",
        "50",
        "52",
        "54",
        "56",
        "58",
        "70",
        "72",
        "74",
        "76",
        "78",
        "90",
        "92",
        "94",
        "96",
        "98",
    ];
}

export function twoDEvenOddNumber() {
    return [
        "01",
        "03",
        "05",
        "07",
        "09",
        "21",
        "23",
        "25",
        "27",
        "29",
        "41",
        "43",
        "45",
        "47",
        "49",
        "61",
        "63",
        "65",
        "67",
        "69",
        "81",
        "83",
        "85",
        "87",
        "89",
    ];
}

export function twoDEvenEvenNumber() {
    return [
        "02",
        "04",
        "06",
        "08",
        "20",
        "22",
        "24",
        "26",
        "28",
        "40",
        "42",
        "44",
        "46",
        "48",
        "60",
        "62",
        "64",
        "66",
        "68",
        "80",
        "82",
        "84",
        "86",
        "88",
    ];
}

export function twoDOddOddNumber() {
    return [
        "11",
        "13",
        "15",
        "17",
        "19",
        "31",
        "33",
        "35",
        "37",
        "39",
        "51",
        "53",
        "55",
        "57",
        "59",
        "71",
        "73",
        "75",
        "77",
        "79",
        "91",
        "93",
        "95",
        "97",
        "99",
    ];
}

// export function threeDNumberTransformer(betNumber: string) {
//   const items: string[] = [];
//   if (/^\d{3}$/.test(betNumber)) {
//     items.push(betNumber);
//   }

//   return items;
// }
