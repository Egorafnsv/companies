function confirmWindow(name, id){
    const span = document.getElementById("name-company-for-del")
    span.innerHTML = name

    const del_btn = document.getElementById("id-company-for-del")
    del_btn.value = id
}