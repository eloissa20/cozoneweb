$(() => {
    loadLocalStorageStep3();
});

// Load data from localStorage for Step 3
function loadLocalStorageStep3() {
    const data = JSON.parse(localStorage.getItem("listSpace3"));

    if (data) {
        loadCheckboxes(data.basics, '.basic-container');
        loadCheckboxes(data.seats, '.seat-container');
        loadCheckboxes(data.equipment, '.equipment-container');
        loadCheckboxes(data.facilities, '.facilities-container');
        loadCheckboxes(data.accessibility, '.accessibility-container');
        loadCheckboxes(data.perks, '.perks-container');
    }
}

// Helper function to load checkboxes
function loadCheckboxes(items, container) {
    // Ensure items is an array to avoid errors
    if (Array.isArray(items)) {
        // Uncheck all checkboxes first to avoid carrying over previous selections
        $(`${container} input[type="checkbox"]`).prop('checked', false);
        items.forEach(item => {
            // Check each checkbox that matches the item value
            $(`${container} input[type="checkbox"][value="${item}"]`).prop('checked', true);
        });
    }
}

// Move to the next step from Step 3
function moveToNextStepFromStep3() {
    const formData = {
        basics: [],
        seats: [],
        equipment: [],
        facilities: [],
        accessibility: [],
        perks: []
    };

    // Capture all checkbox values
    $('input[type="checkbox"]').each(function() {
        const name = $(this).attr('name');
        if (name && $(this).is(':checked')) {
            formData[name].push($(this).val());
        }
    });

    // Validate required fields
    if (formData.basics.length === 0) {
        Swal.fire({
            icon: "error",
            title: "Incomplete Form",
            text: "Please select at least one option in the Basics section!"
        });
        return;
    }

    // Save data to localStorage
    localStorage.setItem('listSpace3', JSON.stringify(formData));

    // Transition to the next section
    $('#s3').hide();
    $('#s4').show();
}

function moveToPreviousStepFromStep3() {
    $('#s3').hide();
    $('#s2').show();
}