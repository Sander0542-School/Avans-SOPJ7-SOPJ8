const layerTemplate = "http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png";
const southWest = L.latLng(52.12606258692764, 6.474997008464673),
    northEast = L.latLng(52.134743339394106, 6.501807460723494),
    bounds = L.latLngBounds(southWest, northEast);
const map = Leaflet.map('mapid', {minZoom: 16, maxZoom: 19, zoomControl: false, maxBounds: bounds}).setView([52.1305, 6.4893], 16);
map.scrollWheelZoom.disable();
Leaflet.tileLayer(layerTemplate, {
    maxZoom: 19,
    minZoom: 16
}).addTo(map);

// const StamenTemplate = "http://{s}.tile.stamen.com/watercolor/{z}/{x}/{y}.jpg";
// const StamenMap = Leaflet.map('mapid', {minZoom: 12, maxZoom: 14, zoomControl: false}).setView([41.055408357430274, -95.88192848817997],12)
// StamenMap.zoomControl = false;
// StamenMap.dragging.disable();
// Leaflet.tileLayer(StamenTemplate, {
//     maxZoom: 14,
//     minZoom: 12
// }).addTo(StamenMap);

window.subjectMap = map;

