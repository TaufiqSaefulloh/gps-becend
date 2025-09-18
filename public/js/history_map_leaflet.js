document.addEventListener('DOMContentLoaded', function() {
    var locations = window.userHistory;
    if(!locations || locations.length === 0) return;

    var firstLoc = locations[0];
    var map = L.map('map').setView([firstLoc.latitude, firstLoc.longitude], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var latlngs = [];

    locations.forEach(function(loc){
        var lat = parseFloat(loc.latitude);
        var lng = parseFloat(loc.longitude);
        if(!isNaN(lat) && !isNaN(lng)){
            latlngs.push([lat, lng]);
            L.marker([lat, lng]).addTo(map)
                .bindPopup(loc.timestamp);
        }
    });

    if(latlngs.length > 0){
        var polyline = L.polyline(latlngs, {color: 'red'}).addTo(map);
        map.fitBounds(polyline.getBounds().pad(0.5));
    }
});
