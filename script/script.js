function showSelect() {
    const checkBox = document.getElementById("useExisting");
    const selectBox = document.getElementById("selectedParser");
    if (checkBox.checked == true){
        selectBox.style.display = "block";
    } else {
        selectBox.style.display = "none";
    }
}