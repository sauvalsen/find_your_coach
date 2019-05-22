var mymap = document.querySelector('#mymap');

var icon = L.icon({
    iconUrl: '../../asset_back/img/marker-icon.png',
});

let center = [mymap.dataset.lat, mymap.dataset.lng];

var mymap = L.map('mymap').setView(center, 15);

var token = 'pk.eyJ1Ijoic2F1dmFsc2VuIiwiYSI6ImNqdnc2MGpzajN3aHU0Ym1nODQ5ZzQxZ2oifQ.2XCtji5hMfAGDgewUyvYmA'
L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token='+token, {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    minZoom: 12,
    id: 'mapbox.streets',
}).addTo(mymap);
L.marker(center, {icon: icon}).addTo(mymap);