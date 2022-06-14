function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      console.log(encodeURIComponent(k) + '=' + encodeURIComponent(data[k]))
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
  }

async function postData(url,data) {

    return fetch(url, {
      method: 'post',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: encodeForAjax(data)
    })
  }


  function toggleFavDish(cId, dId){
    postData('../actions/action_toggle_fav_dish.php/', {clientId: cId, dishId: dId})
        .catch(() => console.error('Network Error'))
        .then(response => response.json())
        .catch(() => console.error('Error parsing JSON'))
        .then(json => console.log(json))
    const dishFav = document.querySelector(".favDish [id = '" + dId + "']")
    if(dishFav.classList.contains('exists')){
        dishFav.classList.remove('exists');
    }
    else{
        dishFav.classList.add('exists');
    }
}