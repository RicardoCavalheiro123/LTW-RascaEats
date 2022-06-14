const searchInput = document.querySelector("#searchrestaurant")

if(searchInput){
    searchInput.addEventListener('input', async function() {
        const response = await fetch('../api/api_restaurants.php?search=' + this.value)
        const restaurants = await response.json()
        const s = document.createElement('section')
        s.setAttribute('id', 'rs');

        const section = document.querySelector('#restaurants')
        if(this.value != ''){
            const divs = document.querySelector("body > div");
            if(divs != null){
                divs.remove();
            }
            

            const articles = document.querySelectorAll('section#rs');
            for(const article of articles){
                article.remove();
            }
            section.classList.add('searching');
            const div = document.createElement("div");
            let count = 0;
            for(const restaur of restaurants) {
                count++;
            }
            console.log(count);
            if(count == 0){

                const span = document.createElement("span");
                span.classList.add("bold");
                const p = document.createElement("p");
                p.textContent = "Não foram encontrados Restaurantes!";
                span.appendChild(p);
                div.appendChild(span);

                div.classList.add("no_restaurants");
            }
            else if(count<4){
                div.classList.add("one_line");
            }
            const footer = document.querySelector('footer')

           
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
                img.src = restaurant.photo
                link1.href = '..pages/restaurant.php?id=' + restaurant.restaurantId
                link1.appendChild(img)
                link2.href = '..pages/restaurant.php?id=' + restaurant.restaurantId
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
            document.body.insertBefore(div, footer);
        }
        else{
            const articles = document.querySelectorAll('section#rs')
            for(const article of articles){
                article.remove();
            }
            section.classList.remove('searching');
        }
        
        
        //section.innerHTML = ''

        
    })
}