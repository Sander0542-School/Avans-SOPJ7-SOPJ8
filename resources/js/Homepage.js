debugger;
let mymap = L.map('mapid', {minZoom: 16, maxZoom: 18}).setView([52.1305, 6.4893], 16);
let layerTemplate = "http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png";
let southWest = L.latLng(52.12506, 6.47332),
    northEast = L.latLng(52.13543, 6.50320),
    bounds = L.latLngBounds(southWest, northEast);

L.tileLayer(layerTemplate, {
    maxBounds: bounds,
    maxZoom: 18,
    minZoom: 16
}).addTo(mymap);

