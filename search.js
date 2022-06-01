const searchInput = document.querySelector("#searchrestaurant")

if(searchInput){
    searchInput.addEventListener('input', async function() {
        const response = await fetch('api_restaurants.php?search=' + this.value)
        const restaurants = await response.json()
        const s = document.createElement('section')
        s.setAttribute('id', 'rs');

        const section = document.querySelector('#restaurants')
        if(this.value != ''){
            const articles = document.querySelectorAll('article.sr');
            for(const article of articles){
                article.remove();
            }
            section.classList.add('searching');
            for(const restaurant of restaurants) {
                console.log(restaurant)
                const article = document.createElement('article')
                article.classList.add('sr');
                const link1 = document.createElement('a')
                const link2 = document.createElement('a')
                const p1 = document.createElement('p')
                const img = document.createElement('img')
                const p2 = document.createElement('p')
                const p3 = document.createElement('p')
                img.src = "https://picsum.photos/300/300?" + restaurant.restaurantId
                link1.href = 'restaurant.php?id=' + restaurant.restaurantId
                link1.appendChild(img)
                link2.href = 'restaurant.php?id=' + restaurant.restaurantId
                p1.textContent = restaurant.restaurantName
                link2.appendChild(p1)
                p2.textContent = restaurant.rating + '/5.0 ☆'
                p3.textContent = restaurant.address

                article.appendChild(link1)
                article.appendChild(link2)
                article.appendChild(p2)
                article.appendChild(p3)

                //section.appendChild(article)
                s.appendChild(article)
                document.body.insertBefore(s, document.body.lastElementChild);
            }
        }
        else{
            const articles = document.querySelectorAll('article.sr')
            for(const article of articles){
                article.remove();
            }
            section.classList.remove('searching');
        }
        
        
        //section.innerHTML = ''

        
    })
}