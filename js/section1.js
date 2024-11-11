$(document).ready(() => {
    loadLocalStorageStep1();
});

// Function to load saved data from localStorage
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

// Function to save data and move to the next step
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

    // Move to the next step
    $('#s1').hide();
    $('#s2').show();
}

// Function to move to the previous step
function moveToPreviousStepFromStep1() {
    $('#s1').hide();
    $('#s2').show(); // Go back to the previous step
}