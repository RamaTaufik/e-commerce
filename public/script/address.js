function unlockSelectOption(from, target, array) {
    let value = document.getElementById(from).value;
    let Select = document.getElementById(target);
    Select.disabled = false;
    Select.innerHTML = "";

    array[value].forEach(data => {
        let option = document.createElement("option");

        option.value = data['city_id'];
        option.innerHTML = data['name'];

        Select.appendChild(option);
    });
}