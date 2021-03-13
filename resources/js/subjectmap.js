const layerTemplate = "http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png";

const map = Leaflet.map('mapid', {minZoom: 16, maxZoom: 18}).setView([52.1305, 6.4893], 16);

map.setMaxBounds(map.getBounds());

Leaflet.tileLayer(layerTemplate, {
    maxZoom: 18,
    minZoom: 16
}).addTo(map);

window.subjectMap = map;

// $('mapid').on("mousedown", Leaflet.DomEvent.stopPropagation);
