function changeStockByColor(stock) {
    document.getElementById("stock").innerHTML = stock;
    document.getElementById("qty").setAttribute("max", stock);
}