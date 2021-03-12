debugger;
let map = L.map('mapid', {minZoom: 16, maxZoom: 18}).setView([52.1305, 6.4893], 16);
let layerTemplate = "http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png";
let southWest = L.latLng(52.12506, 6.47332),
    northEast = L.latLng(52.13543, 6.50320),
    bounds = map.getBounds();

map.setMaxBounds(bounds);

<<<<<<< Updated upstream
L.tileLayer(layerTemplate, {
    maxZoom: 18,
    minZoom: 16
}).addTo(map);

map.on({ resize: mapOnResize });

$('mapid').on("mousedown", L.DomEvent.stopPropagation);

function mapOnResize(){
    //fit bounds op nieuw zoomniveau
}
=======
L.tileLayer("http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png", {
    maxZoom: 20
}).addTo(mymap);

>>>>>>> Stashed changes
