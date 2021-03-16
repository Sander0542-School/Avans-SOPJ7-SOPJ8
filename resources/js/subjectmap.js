const layerTemplate = "http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png";
const southWest = L.latLng(52.112274861603105, 6.581252579235523),
    northEast = L.latLng(52.122157941753734, 6.611493785039989),
    bounds = L.latLngBounds(southWest, northEast);

const map = Leaflet.map('subjectmap', {
    minZoom: 16,
    maxZoom: 19,
    zoomControl: false,
    maxBounds: bounds,
    attributionControl: false
}).setView([52.11662944833734, 6.595218386682539], 16);

Leaflet.tileLayer(layerTemplate, {
    maxZoom: 19,
    minZoom: 16
}).addTo(map);

window.subjectMap = Map;
