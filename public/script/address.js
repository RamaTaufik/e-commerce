function unlockDatalistOption(from, target, array, secondTarget = "", secondArray = "") {
    let value = document.getElementById(from).value;
    let input = document.getElementById(target);
    let Datalist = document.getElementById(target+"List");
    input.disabled = false;
    Datalist.innerHTML = "";

    array[value].forEach(data => {
        let option = document.createElement("option");

        option.value = data;
        option.innerHTML = data;

        Datalist.appendChild(option);
    });

    if(secondTarget != "" && secondArray != "") {
        unlockDatalistOption(target, secondTarget, secondArray);
    }
}