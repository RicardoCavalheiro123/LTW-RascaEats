function attachBuyEvents(){
    const buttons = document.querySelectorAll("#dishes button")
    for(const button of buttons){
        button.addEventListener('click', function() {
                                                    const table = document.querySelector("#cart table")

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
                                                    total.textContent = parseInt(price.textContent) * parseInt(quantity.textContent)

                                                    const rows = table.querySelectorAll("tr td:nth-child(1)")
                                                    found = false;
                                                    var t = 0
                                                    for(const row of rows){
                                                        t += parseInt(row.parentElement.querySelector("td:nth-child(4)").textContent, 10)
                                                        if(row.textContent == name.textContent){
                                                            row.parentElement.querySelector("td:nth-child(2)").textContent = parseInt(row.parentElement.querySelector("td:nth-child(2)").textContent) + parseInt(quantity.textContent)
                                                            row.parentElement.querySelector("td:nth-child(4)").textContent = parseInt(row.parentElement.querySelector("td:nth-child(4)").textContent) + parseInt(total.textContent)
                                                            found = true
                                                            break
                                                        }
                                                    }
                                                    table.querySelector("tfoot th:nth-child(2)").textContent = parseInt(t, 10) + parseInt(total.textContent, 10)
                                                    if(found){
                                                        return
                                                    }
                                                    const content = document.createElement("tr")
                                                    
                                                    
                                                    
                                                    content.appendChild(name)
                                                    
                                                    content.appendChild(quantity)
                                                    
                                                    content.appendChild(price)
                                                     
                                                    content.appendChild(total)

                                                    
                                                    table.appendChild(content)
                                                    
                                                    })
    }
}

attachBuyEvents()