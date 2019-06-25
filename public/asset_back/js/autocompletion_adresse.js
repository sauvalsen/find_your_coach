// Autocomplétion adresse //

let inputAdresse = document.querySelector('#user_adresse')
if (inputAdresse !== null){
    let place = places({
        container: inputAdresse
    });
    place.on('change', e => {
        document.querySelector('#user_ville').value = e.suggestion.city
        document.querySelector('#user_code_postal').value = e.suggestion.postcode
        document.querySelector('#user_lat').value = e.suggestion.latlng.lat
        document.querySelector('#user_lng').value = e.suggestion.latlng.lng
    })
}

let inputEditAdresse = document.querySelector('#edit_user_adresse')
if (inputEditAdresse !== null){
    let place = places({
         container: inputEditAdresse
    });
    place.on('change', e => {
         document.querySelector('#edit_user_ville').value = e.suggestion.city
         document.querySelector('#edit_user_code_postal').value = e.suggestion.postcode
         document.querySelector('#edit_user_lat').value = e.suggestion.latlng.lat
         document.querySelector('#edit_user_lng').value = e.suggestion.latlng.lng
    })
}

/////////////////////////////////