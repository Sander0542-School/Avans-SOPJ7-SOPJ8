const layerTemplate = "http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png";
const southWest = L.latLng(52.109024, 6.573585),
    northEast = L.latLng(52.123450, 6.616385),
    bounds = L.latLngBounds(southWest, northEast);

const map = Leaflet.map('subjectmap', {
    minZoom: 10,
    maxZoom: 19,
    zoomControl: false,
    maxBounds: bounds,
    attributionControl: false
}).setView([52.115329, 6.596776], 16);

Leaflet.tileLayer(layerTemplate, {
    maxZoom: 19,
    minZoom: 16
}).addTo(map);

window.subjectMap = map;

getData();

async function getData(){
    let  data = fetch('/api/subjects').then(function(response){
        return response.json();
    }).then(function (obj){
        console.log(obj['data']);
        placeMarkers(obj['data'])
    })
}

function placeMarkers(obj){
    obj.forEach(function(item){
        if(item.lon != null && item.lat != null){
            let  marker = new L.marker([item.lon, item.lat], {
                icon: new L.DivIcon({
                    className: 'my-div-icon',
                    html: '<div>'+
                        '<img class="my-div-image" width="65" height="80" src="https://www.stichting-ranja.nl/wp-content/uploads/Boer.png"/>'+
                        '<button class="btn btn-primary" style="text-align: center;">'+item.name+'</button>'+
                        '</div>'
                })
            });
            marker.addTo(map);
        }
    })
}
