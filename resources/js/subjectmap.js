const layerTemplate = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png";
const southWest = L.latLng(52.109024, 6.573585),
    northEast = L.latLng(52.123450, 6.616385),
    bounds = L.latLngBounds(southWest, northEast);

window.SubjectMap = {
    map: null,
    renderMap: (adminMap = false) => {
        const adminZoom = 15;
        const maxZoom = adminMap ? adminZoom : 19;
        const minZoom = adminMap ? adminZoom : 16;

        const map = Leaflet.map('subjectmap', {
            minZoom: minZoom,
            maxZoom: maxZoom,
            zoomControl: false,
            maxBounds: bounds,
            attributionControl: false
        }).setView([52.115329, 6.596776], 16);

        if (adminMap) {
            Leaflet.rectangle(bounds, {color: "rgba(0, 0, 0, 0.8)", weight: 1}).addTo(map);
        }

        Leaflet.tileLayer(layerTemplate, {
            maxZoom: maxZoom,
            minZoom: minZoom
        }).addTo(map);

        window.SubjectMap.map = map;
    },
    loadSubjects: (draggable = false) => {
        fetch('/api/subjects').then(function (response) {
            return response.json();
        }).then(function (response) {
            window.SubjectMap.placeMarkers(response.data, draggable);
        })
    },
    placeMarkers: (subjects, draggable = false) => {
        if (window.SubjectMap.map == null) return;
        subjects.forEach(function (item) {
            let button;
            //veranderen naarmate meer domeinen komen
            if(item.domain_id === 1) {
                button='<button class="btn btn-primary" class="markerButton" style="background-color: #1976D2;border-color:#1976D2;">' + item.name + '</button>';
            } else if (item.domain_id === 2) {
                button = '<button class="btn btn-primary" class="markerButton" style="background-color: #D32F2F;border-color: #D32F2F;">' + item.name + '</button>';
            } else {
                button = '<button class="btn btn-primary" class="markerButton" style="background-color:#2E7D32;border-color: #2E7D32;">' + item.name + '</button>';
            }
            let marker = new Leaflet.marker([item.lon, item.lat], {
                draggable: draggable,
                icon: new Leaflet.DivIcon({
                    className: 'my-div-icon',
                    html: '<div class="marker-container">' +
                        '<img class="my-div-image" width="65" height="80" src="/images/MarkerImage.png"/>' +
                        button +
                        '</div>'
                }),
                subjectId: item.id
            });

            marker.addTo(window.SubjectMap.map);
        });
    },
    getSubjects: () => {
        const subjects = [];

        window.SubjectMap.map.eachLayer((layer) => {
            if (layer.options.subjectId !== undefined) {
                subjects.push({
                    id: layer.options.subjectId,
                    lat: layer.getLatLng().lat,
                    lon: layer.getLatLng().lng,
                })
            }
        });

        return subjects;
    }
}
