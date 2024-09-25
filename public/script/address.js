function unlockSelectOption(from, target, array, secondTarget = "", secondArray = "") {
    let value = document.getElementById(from).value;
    let select = document.getElementById(target);
    select.disabled = false;
    select.innerHTML = "";

    array[value].forEach(data => {
        let option = document.createElement("option");

        option.value = data;
        option.innerHTML = data;

        select.appendChild(option);
    });

    if(secondTarget != "" && secondArray != "") {
        unlockSelectOption(target, secondTarget, secondArray);
    }
}