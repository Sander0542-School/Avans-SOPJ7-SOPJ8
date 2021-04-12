const layerTemplate = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png";
const southWest = L.latLng(52.109024, 6.573585),
    northEast = L.latLng(52.123450, 6.616385),
    bounds = L.latLngBounds(southWest, northEast);

window.SubjectMap = {
    map: null,
    renderMap: () => {
        const map = Leaflet.map('subjectmap', {
            minZoom: 16,
            maxZoom: 19,
            zoomControl: false,
            maxBounds: bounds,
            attributionControl: false
        }).setView([52.115329, 6.596776], 16);

        Leaflet.tileLayer(layerTemplate, {
            maxZoom: 19,
            minZoom: 16
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
            if (item.lon != null && item.lat != null) {
                let marker = new L.marker([item.lon, item.lat], {
                    icon: new L.DivIcon({
                        className: 'my-div-icon',
                        html: '<div>' +
                            '<img class="my-div-image" width="65" height="80" src="/images/MarkerImage.png"/>' +
                            '<button class="btn btn-primary" style="text-align: center;">' + item.name + '</button>' +
                            '</div>'
                    })
                });
                marker.addTo(window.SubjectMap.map);
            }
        });
    }
}
