

function removeItem(){
    const buttons = document.querySelectorAll(".remove-button")
    const table = document.querySelector("#cart table")
    for(const button of buttons){
        button.addEventListener('click', function() {
            table.querySelector("tfoot th:nth-child(2)").textContent = parseFloat(table.querySelector("tfoot th:nth-child(2)").textContent, 10) - parseFloat(button.parentElement.parentElement.querySelector("td:nth-child(4)").textContent,10)
            button.parentElement.parentElement.remove()
        })
    }
}

removeItem()
