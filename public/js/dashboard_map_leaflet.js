document.addEventListener('DOMContentLoaded', function () {
    var users = window.userHistory;

    // Inisialisasi map
    var map = L.map('map').setView([-6.2, 106.816666], 5);

    // Tiles OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var markers = [];

    users.forEach(function (user) {
        // pastikan latestLocation ada
        if (user.latestLocation && user.latestLocation.latitude && user.latestLocation.longitude) {
            var lat = parseFloat(user.latestLocation.latitude);
            var lng = parseFloat(user.latestLocation.longitude);

            if (!isNaN(lat) && !isNaN(lng)) {
                // buat marker dan popup
                var marker = L.marker([lat, lng]).addTo(map)
                    .bindPopup(
                        "<b>" + user.name + "</b><br>" +
                        lat + ", " + lng + "<br>" +
                         "<a href='/admin/history?user_id=" + user.id + "&date=" + new Date().toISOString().slice(0,10) + "' class='btn btn-sm btn-warning mt-1'>Lihat History</a>"
                    );
            }
        }
    });

    // Fit map ke semua marker jika ada
    if (markers.length > 0) {
        var group = new L.featureGroup(markers);
        map.fitBounds(group.getBounds().pad(0.5));
    } else {
        // kalau tidak ada marker, tetap set view default
        map.setView([-6.2, 106.816666], 5);
    }
});
