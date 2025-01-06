$(document).ready(() => {
    loadLocalStorageStep5();
});

function loadLocalStorageStep5() {
    if (localStorage.getItem("listSpace5") !== null) {
        let data = JSON.parse(localStorage.getItem("listSpace5"));
        $('#tables').val(data.tables);
        $('#capacity').val(data.capacity);
        $('#meetingRooms').val(data.meetingRooms);
        $('#virtualOffices').val(data.virtualOffices);
        $('#size').val(data.size);
        
        if (data.measurementUnit) {
            $(`input[name="measurementUnit"][value="${data.measurementUnit}"]`).prop('checked', true);
        }
    }
}

function moveToNextStepFromStep5() {
    const tables = $('#tables').val();
    const capacity = $('#capacity').val();
    const meetingRooms = $('#meetingRooms').val();
    const virtualOffices = $('#virtualOffices').val();
    const size = $('#size').val();
    const measurementUnit = $('input[name="measurementUnit"]:checked').val();

    if (!tables || !capacity || !meetingRooms || !virtualOffices || !size || !measurementUnit) {
        Swal.fire({
            icon: "error",
            title: "Incomplete Form",
            text: "Please fill out all required fields before proceeding!"
        });
        return;
    }

    localStorage.setItem('listSpace5', JSON.stringify({
        tables,
        capacity,
        meetingRooms,
        virtualOffices,
        size,
        measurementUnit,
    }));

    $('#s5').hide();
    $('#s6').show();
}

function moveToPreviousStepFromStep5() {
    $('#s5').hide();
    $('#s4').show();
}
