$(() => {
    loadLocalStorageStep4();
});

// Load data from localStorage for Step 4
function loadLocalStorageStep4() {
    if (localStorage.getItem("listSpace4") !== null) {
        let data = JSON.parse(localStorage.getItem("listSpace4"));
        $('#location').val(data.location);
        $('#telephone').val(data.telephone);
        $('#country').val(data.country);
        $('#unit').val(data.unit);
        $('#postal').val(data.postal);
        $('#city').val(data.city);
    }
}

// Move to the next step from Step 4
function moveToNextStepFromStep4() {
    // Get form data
    const location = $('#location').val();
    const telephone = $('#telephone').val();
    const country = $('#country').val();
    const unit = $('#unit').val();
    const postal = $('#postal').val();
    const city = $('#city').val();

    // Validate required fields
    if (!location || !telephone || !country || !unit || !postal || !city) {
        Swal.fire({
            icon: "error",
            title: "Incomplete Form",
            text: "Please fill out all required fields before proceeding!"
        });
        return;
    }

    // Save data to localStorage
    localStorage.setItem('listSpace4', JSON.stringify({
        location,
        telephone,
        country,
        unit,
        postal,
        city
    }));

    // Transition to the next section
    $('#s4').hide();
    $('#s5').show(); // Assuming s4 is the next step's section
}

// Move to the previous step
function moveToPreviousStepFromStep4() {
    $('#s4').hide();
    $('#s3').show(); // Go back to the second step
}