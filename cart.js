

function removeItem(){
    const buttons = document.querySelectorAll(".remove-button")
    const table = document.querySelector("#cart table")
    for(const button of buttons){
        button.addEventListener('click', function() {
            table.querySelector("tfoot th:nth-child(2)").textContent = parseFloat(table.querySelector("tfoot th:nth-child(2)").textContent, 10) - parseFloat(button.parentElement.querySelector("td:nth-child(5)").textContent,10)
            button.parentElement.remove()
        })
    }
}



function attachBuyEvents(){
    const buttons = document.querySelectorAll("#dishes button")
    for(const button of buttons){
        button.addEventListener('click', function() {
                                                    const table = document.querySelector("#cart table")

                                                    const id = document.createElement("td")
                                                    id.classList.add("dishId")
                                                    id.textContent = button.parentElement.querySelector(".dishId").textContent

                                                    const name = document.createElement("td")
                                                    name.textContent = button.parentElement.querySelector(".dishName").textContent
                                                    const quantity = document.createElement("td")
                                                    quantity.textContent = button.parentElement.querySelector(".quantity").value
                                                    if(parseInt(quantity.textContent,10) <= 0){
                                                        return;
                                                    }
                                                    const price = document.createElement("td")
                                                    price.textContent = button.parentElement.querySelector(".dishPrice").textContent
                                                    
                                                    const total = document.createElement("td")
                                                    total.textContent = parseFloat(price.textContent) * parseFloat(quantity.textContent)

                                                    const rows = table.querySelectorAll("tr td:nth-child(1)")
                                                    found = false;
                                                    var t = 0.0
                                                    for(const row of rows){
                                                        t += parseFloat(row.parentElement.querySelector("td:nth-child(5)").textContent, 10)
                                                        if(row.textContent == id.textContent){
                                                            row.parentElement.querySelector("td:nth-child(3)").textContent = parseFloat(row.parentElement.querySelector("td:nth-child(3)").textContent) + parseFloat(quantity.textContent)
                                                            row.parentElement.querySelector("td:nth-child(5)").textContent = parseFloat(row.parentElement.querySelector("td:nth-child(5)").textContent) + parseFloat(total.textContent)
                                                            found = true
                                                            break
                                                        }
                                                    }
                                                    table.querySelector("tfoot th:nth-child(2)").textContent = parseFloat(t, 10) + parseFloat(total.textContent, 10)
                                                    if(found){
                                                        return
                                                    }
                                                    const content = document.createElement("tr")
                                                    
                                                    
                                                    content.appendChild(id)
                                                    content.appendChild(name)
                                                    
                                                    content.appendChild(quantity)
                                                    
                                                    content.appendChild(price)
                                                     
                                                    content.appendChild(total)
                                                    const b = document.createElement("input")
                                                    b.type="button"
                                                    b.value = "X"
                                                    b.classList.add("remove-button")
                                                    b.addEventListener('click', function() {
                                                        table.querySelector("tfoot th:nth-child(2)").textContent = parseFloat(table.querySelector("tfoot th:nth-child(2)").textContent, 10) - parseFloat(b.parentElement.querySelector("td:nth-child(5)").textContent,10)
                                            
                                                        b.parentElement.remove()
                                                    })
                                                    content.appendChild(b)
                                                    
                                                    table.appendChild(content)

                                                    

                                                    })
    }
}


removeItem()
attachBuyEvents()
