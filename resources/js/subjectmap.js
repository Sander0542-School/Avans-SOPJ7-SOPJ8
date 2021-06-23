const R = require("leaflet-responsive-popup");
const layerTemplate = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png";
const southWest = Leaflet.latLng(52.108672, 6.573487),
    northEast = Leaflet.latLng(52.120610, 6.614364),
    bounds = Leaflet.latLngBounds(southWest, northEast);

window.SubjectMap = {
    map: null,
    adminMap: false,
    renderMap: (adminMap = false) => {
        window.SubjectMap.adminMap = adminMap;

        const map = Leaflet.map('subjectmap', {
            minZoom: 15,
            maxZoom: 18,
            zoom: 15,
            zoomControl: false,
            maxBounds: bounds,
            attributionControl: false,
            doubleClickZoom: false,
            scrollWheelZoom: false,
            touchZoom: false,
            zoomSnap: 0,
            center: bounds.getCenter()
        });

        Leaflet.tileLayer(layerTemplate).addTo(map);

        window.SubjectMap.map = map;
        window.SubjectMap.loadSubjects();
        window.SubjectMap.zoomMap();
    },
    loadSubjects: () => {
        fetch('/api/subjects').then(function (response) {
            return response.json();
        }).then(function (response) {
            window.SubjectMap.placeMarkers(response.data, window.SubjectMap.adminMap);
        })
    },
    zoomMap: () => {
        window.SubjectMap.center = bounds.getCenter();
        let newBounds = bounds;
        if (window.SubjectMap.adminMap) {
            Leaflet.rectangle(bounds, {color: "rgba(0, 0, 0, 0.8)", weight: 1}).addTo(window.SubjectMap.map);
            newBounds = bounds.pad(0.1);
        }

        const target = window.SubjectMap.map._getBoundsCenterZoom(newBounds);
        window.SubjectMap.map.flyTo(target.center, target.zoom, {
            animate: true,
            duration: 1.4
        });
    },
    zoomMarker: (subjectId = null) => {
        const marker = window.SubjectMap.getMarker(subjectId);

        if (marker) {
            const map = window.SubjectMap.map;

            map.flyTo(marker.getLatLng(), map.options.maxZoom, {
                animate: true,
                duration: 1.4
            });
            window.SubjectMap.setMarkerVisibility(false);
        } else {
            window.SubjectMap.zoomMap();
            window.SubjectMap.setMarkerVisibility(true);
        }
    },
    placeMarkers: (subjects, draggable = false) => {
        if (window.SubjectMap.map == null) return;
        subjects.forEach(function (item) {

            let marker = new Leaflet.marker({lat: item.lat, lon: item.lon}, {
                draggable: draggable,
                icon: new Leaflet.DivIcon({
                    className: 'marker-subject',
                    html:
                        '<div class="marker-container">' +
                        '  <img class="marker-image" width="65" height="80" src="/images/MarkerImage.png"/>' +
                        `  <span type="button" class="btn btn-primary marker-button " data-container="body" style="background-color:#${item.domain.color};border-color:#${item.domain.color}">${item.name}</span>` +
                        '</div>'
                }),
                subjectId: item.id
            });

            if (draggable) {
                marker.addTo(window.SubjectMap.map);
            } else {
                let buttons = ""
                for (const layer of item.layers) {
                    buttons += `<button class="btn btn-sm btn-primary m-1" onclick="window.Layer.load('${layer.slug}', ${item.id})">${layer.name}</button></br>`
                }

                const popup = R.responsivePopup({
                    hasTip: true,
                    autoPan: true,
                    offset: [15, 20]
                }).setContent("<h3>" + item.name + "</h3> <p>" + item.description + "</p> " + buttons);

                marker.addTo(window.SubjectMap.map).bindPopup(popup);
                marker.on("mouseover", function (evt) {
                    this.openPopup();
                });
            }
        });
    },
    setMarkerVisibility: (visible) => {
        document.querySelectorAll('#subjectmap .marker-subject').forEach((marker) => {
            marker.style.display = visible ? '' : 'none';
        });
    },
    getMarker: (subjectId) => {
        if (isNaN(subjectId)) {
            return;
        }

        let layer = null;

        window.SubjectMap.map.eachLayer((mapLayer) => {
            if (mapLayer.options.subjectId === subjectId) {
                layer = mapLayer;
            }
        });

        return layer;
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
