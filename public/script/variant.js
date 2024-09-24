function chooseColorVariant(colorVariant) {
    let div = document.getElementById("colorVariant");
    div.innerHTML = "";
    if(colorVariant.length > 1) {
        let label = document.createElement("p");
        label.classList.add("form-label", "m-0");
        label.innerHTML = "Warna";

        div.appendChild(label);
        div.classList.add("mb-2");
        document.getElementById("stock").innerHTML = "-";

        colorVariant.forEach(variant => {
            let data = variant.split("/");
            let option = document.createElement("input");
            let optionLabel = document.createElement("label");

            option.type = "radio";
            option.classList.add("btn-check");
            option.setAttribute("name", "color");
            option.setAttribute("id", data[1]);
            option.setAttribute("onclick", "changeStockByColor(" + data[0] + ")");
            option.value = data[1];

            optionLabel.classList.add("btn", "btn-primary", "me-1");
            optionLabel.setAttribute("for", data[1]);
            optionLabel.innerHTML = data[1];

            div.appendChild(option);
            div.appendChild(optionLabel);
        });
    } else {
        let option = document.createElement("input");

        div.classList.remove("mb-2")
        changeStockByColor(colorVariant[0].split("/")[0]);

        option.type = "hidden";
        option.setAttribute("name", "color");
        option.setAttribute("id", colorVariant[0].split("/")[1]);
        option.value = colorVariant[0].split("/")[1];
        
        div.appendChild(option);
    }
}

function changeStockByColor(stock) {
    document.getElementById("stock").innerHTML = stock;
    document.getElementById("qty").setAttribute("max", stock);
}