const search = () => {
    const searchbox = document.getElementById("search").value.toUpperCase();
    const store = document.getElementById("item")
    const product = document.querySelectorAll(".item")
    const pname = store.getElementsByTagName("td")

    for(var i=0; i < pname.length; i++){
        let match = product[i].getElementsByTagName('td')[0];

        if(match) {
            let textvalue = match.textContent || match.innerHTML

            if(textvalue.toUpperCase().indexOf(searchbox) > -1) {
                product[i].style.display = "";
            } else {
                product[i].style.display = "none";
            }
        }
    }
}