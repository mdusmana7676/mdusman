
const display = document.getElementById("display");

function appendValue(value) {
    display.value += value;
}

function clearDisplay() {
    display.value = "";
}

function deleteLast() {
    display.value = display.value.slice(0, -1);
}

function calculate() {
    try {
        let expression = display.value;

        expression = expression.replace(/sin\(/g, "Math.sin(Math.PI/180*");
        expression = expression.replace(/cos\(/g, "Math.cos(Math.PI/180*");
        expression = expression.replace(/tan\(/g, "Math.tan(Math.PI/180*");
        expression = expression.replace(/sqrt\(/g, "Math.sqrt(");
        expression = expression.replace(/log\(/g, "Math.log10(");
        expression = expression.replace(/ln\(/g, "Math.log(");
        expression = expression.replace(/\bpi\b/g, "Math.PI");
        expression = expression.replace(/\be\b/g, "Math.E");
        expression = expression.replace(/\^/g, "**");

        if (!/^[0-9+\-*/().\sA-Za-z]*$/.test(expression)) {
            throw new Error("Invalid");
        }

        const result = Function('"use strict"; return (' + expression + ')')();

        if (!Number.isFinite(result)) {
            throw new Error("Invalid");
        }

        display.value = Number(result.toPrecision(12)).toString();

    } catch (error) {
        display.value = "Error";
    }
}
