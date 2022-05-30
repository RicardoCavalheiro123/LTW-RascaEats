const searchRestaurant = document.querySelector('.search')
if (searchRestaurant) {
  searchRestaurant.addEventListener('input', async function() {
    const response = await fetch('search_restaurant.php?search=' + this.value)
    const restaurants = await response.json()

    const section = document.querySelector('#restaurants')
    section.innerHTML = ''

    <article>
                        <a href="restaurant.php?id=<?php echo $restaurant['restaurantId']?>"><img src="https://picsum.photos/300/300?<?php echo $restaurant['restaurantName']?>" alt="Restaurant photo"></a>
                        <a href="restaurant.php?id=<?php echo $restaurant['restaurantId']?>"><p><?php echo $restaurant['restaurantName']?></p></a>
                        <p><?php echo $restaurant['rating']?>/5.0</p>
                        <p><?php echo $restaurant['adress']?></p>
                    </article>

    for (const restaurant of restaurants) {
      const article = document.createElement('article')
      const img = document.createElement('img')
      img.src = 'https://picsum.photos/200?' + restaurant.id
      const link = document.createElement('a')
      link.href = 'restaurant.php?id=' + restaurant.id
      link.textContent = restaurant.name
      article.appendChild(img)
      article.appendChild(link)
      section.appendChild(article)
    }
  })
}