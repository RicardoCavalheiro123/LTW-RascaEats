const searchInput = document.querySelector("#searchrestaurant")

if(searchInput){
    searchInput.addEventListener('input', async function() {
        const response = await fetch('api_restaurants.php?search=' + this.value)
        const restaurants = await response.json()

        const section = document.querySelector('#restaurants')
        section.innerHTML = ''

        for(const restaurant of restaurants) {
            console.log(restaurant)
            const article = document.createElement('article')
            const link = document.createElement('a')
            link.href = 'restaurant.php?id=' + restaurant.restaurantId
            link.textContent = restaurant.restaurantName
            article.appendChild(link)
            section.appendChild(article)
        }
    })
}