function changeVariant(element, data) {
    let labels = document.getElementsByClassName("variant-label");
    [].forEach.call(labels, function(label) {
        label.classList.add("btn-secondary");
        label.classList.remove("btn-primary");
    });
    document.getElementById("label-" + element.id).classList.add("btn-primary");
    document.getElementById("label-" + element.id).classList.remove("btn-secondary");
    document.getElementById("price").innerHTML = "Rp" + data['price'].toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
    document.getElementById("size").innerHTML = data['size_in_cm'].replaceAll("-", " cm x ") + " cm";
    document.getElementById("weight").innerHTML = data['weight_in_gram'] + " gram";
    document.getElementById("stock").innerHTML = data['stock'];
    document.getElementById("qty").setAttribute("max", data['stock']);
}