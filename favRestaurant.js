
function addFavRestaurant(){
    const buttons = document.querySelectorAll("#restaurant .favRestaurant form button")
    for(const button of buttons){
        button.addEventListener('click', function(){
            console.log("ola")
            
        })
    }
}

addFavRestaurant()