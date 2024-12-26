$(document).ready(() => {
    loadLocalStorageStep1();
});

function loadLocalStorageStep1() {
    if (localStorage.getItem("listSpace1") !== null) {
        let data = JSON.parse(localStorage.getItem("listSpace1"));

        if (data.role) {
            $(`input[name="role"][value="${data.role}"]`).prop('checked', true);
        }

        if (data.coworkingSpaceName) {
            $('#coworkingSpaceName').val(data.coworkingSpaceName);
        }

        if (data.coworkingSpaceAddress) {
            $('#coworkingSpaceAddress').val(data.coworkingSpaceAddress);
        }
    }
}

function moveToNextStepFromStep1() {
    const role = $('input[name="role"]:checked').val();
    const coworkingSpaceName = $('#coworkingSpaceName').val();
    const coworkingSpaceAddress = $('#coworkingSpaceAddress').val();

    if (!role || !coworkingSpaceName || !coworkingSpaceAddress) {
        Swal.fire({
            icon: "error",
            title: "Incomplete Form",
            text: "Please fill out all required fields before proceeding!"
        });
        return;
    }

    localStorage.setItem('listSpace1', JSON.stringify({
        role,
        coworkingSpaceName,
        coworkingSpaceAddress
    }));

    $('#s1').hide();
    $('#stepper').show();
    $('#s2').show();
}

function moveToPreviousStepFromStep1() {
    $('#s1').hide();
    $('#s2').show();
}
