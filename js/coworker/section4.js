let map;
let marker;

function initMap() {
    const initialPosition = { lat: 14.587186, lng: -239.015398 };
    
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 8,
        center: initialPosition,
    });
    
    marker = new google.maps.Marker({
        position: initialPosition,
        map: map,
        draggable: true, 
    });

    google.maps.event.addListener(marker, 'dragend', function() {
        let position = marker.getPosition();
        document.getElementById('latitude').value = position.lat();
        document.getElementById('longitude').value = position.lng();
    });

    map.addListener("click", (e) => {
        placeMarkerAndPanTo(e.latLng, map);
    });
}

function placeMarkerAndPanTo(latLng, map) {
    marker.setPosition(latLng);
    map.panTo(latLng);
    document.getElementById('latitude').value = latLng.lat();
    document.getElementById('longitude').value = latLng.lng();
}

$(() => {
    loadLocalStorageStep4();
});

function loadLocalStorageStep4() {
    if (localStorage.getItem("listSpace4") !== null) {
        let data = JSON.parse(localStorage.getItem("listSpace4"));
        $('#location').val(data.location);
        $('#telephone').val(data.telephone);
        $('#country').val(data.country);
        $('#unit').val(data.unit);
        $('#postal').val(data.postal);
        $('#city').val(data.city);
        $('#latitude').val(data.latitude);
        $('#longitude').val(data.longitude);

        const savedPosition = { lat: parseFloat(data.latitude), lng: parseFloat(data.longitude) };
        
        marker.setLatLng(savedPosition);
        map.setView(savedPosition, map.getZoom());
    }
}

function moveToNextStepFromStep4() {
    const location = $('#location').val();
    const telephone = $('#telephone').val();
    const country = $('#country').val();
    const unit = $('#unit').val();
    const postal = $('#postal').val();
    const city = $('#city').val();
    const latitude = $('#latitude').val();
    const longitude = $('#longitude').val();

    if (!location || !telephone || !country || !unit || !postal || !city || !latitude || !longitude) {
        Swal.fire({
            icon: "error",
            title: "Incomplete Form",
            text: "Please fill out all required fields before proceeding!"
        });
        return;
    }

    localStorage.setItem('listSpace4', JSON.stringify({
        location,
        telephone,
        country,
        unit,
        postal,
        city,
        latitude,
        longitude
    }));

    $('#s4').hide();
    $('#s5').show();
}

function moveToPreviousStepFromStep4() {
    $('#s4').hide();
    $('#s3').show();
}