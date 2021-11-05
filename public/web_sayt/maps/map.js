function initMap() {
    $("#open_map").click(function () {

        var a =  Number(sessionStorage.getItem("lat"));
        var b = Number(sessionStorage.getItem("lng"));

        const myLatLng = { lat: a, lng: b };
        console.log(myLatLng)
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 4,
            center: myLatLng,
        });

        map.setZoom(10);
        // map.panTo(curmarker.position);
        new google.maps.Marker({
            position: myLatLng,
            map,
            title: "Hello World!",
        });

    })
}
