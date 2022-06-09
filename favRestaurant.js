function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
  }

async function postData(data) {

    return fetch('action_toggle_favorite.php/', {
      method: 'post',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: encodeForAjax(data)
    })
  }


  function toggleFavRestaurant(cId, rId){
    postData({clientId: cId, restaurantId: rId})
        .catch(() => console.error('Network Error'))
        .then(response => response.json())
        .catch(() => console.error('Error parsing JSON'))
        .then(json => console.log(json))
    const restaurantFav = document.querySelector(".favRestaurant button")
    if(restaurantFav.classList.contains('exists')){
        restaurantFav.classList.remove('exists');
    }
    else{
        restaurantFav.classList.add('exists');
    }
}
