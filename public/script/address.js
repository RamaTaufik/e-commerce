function unlockSelectOption(from, target, array, selectedCity = null) {
    let value = document.getElementById(from).value;
    let Select = document.getElementById(target);
    Select.disabled = false;
    Select.innerHTML = "";

    array.forEach(item => {
        if(item['province_id'] == value) {
            let option = document.createElement("option");

            option.value = item['id'];
            option.innerHTML = item['name'];
            if(item['id'] == selectedCity) {
                option.selected = true;
            }

            Select.appendChild(option);
        }
    });
}

function changeAddress(addresses,cities) {
    let selectedAddress;
    let selectedValue = document.getElementById('myAddress').value;

    addresses.forEach(address => {
        if(address['id'] == selectedValue) {
            selectedAddress = address;
        }
    });
    document.getElementById('province').value = cities[selectedAddress['city_id']]['province_id'];
    unlockSelectOption('province','city',cities,selectedAddress['city_id']);
    document.getElementById('address_detail').value = selectedAddress['address_detail'];
}