
let mymap = L.map('mapid').setView([52.1305, 6.4893], 16);

L.tileLayer("http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png", {
    maxZoom: 20
}).addTo(mymap);
