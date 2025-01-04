$(document).ready(() => {
    loadLocalStorageStep8();
});

function loadLocalStorageStep8() {
    if (localStorage.getItem("listSpace8") !== null) {
        let data = JSON.parse(localStorage.getItem("listSpace8"));

        if (data.desks) {
            data.desks.forEach(desk => {
                addDeskField(desk.duration, desk.price, desk.hours, desk.isChecked);
            });
        }

        if (data.meetingRooms) {
            data.meetingRooms.forEach(meeting => {
                addMeetingField(meeting.numPeople, meeting.price, meeting.hours, meeting.isChecked);
            });
        }

        if (data.virtualService) {
            $(`input[name="virtualService"][value="${data.virtualService}"]`).prop('checked', true);
        }

        if (data.membership) {
            $(`input[name="membership"][value="${data.membership}"]`).prop('checked', true);
        }

        if (data.membershipDuration) {
            $('#membershipDuration').val(data.membershipDuration);
        }

        if (data.membershipPrice) {
            $('#membershipPrice').val(data.membershipPrice);
        }
    }
}

function moveToNextStepFromStep8() {
    const desks = [];
    const meetingRooms = [];

    $('.desk-fields').each(function() {
        const duration = $(this).find('#duration').val();
        const price = $(this).find('#deskPrice').val();
        const hours = $(this).find('#deskHours').val();
        const isChecked = $(this).find('#deskCheckbox').is(':checked');

        if (duration && price && hours) {
            desks.push({ duration, price, hours, isChecked });
        }
    });

    $('.meeting-fields').each(function() {
        const numPeople = $(this).find('#numPeople').val();
        const price = $(this).find('#meetingPrice').val();
        const hours = $(this).find('#meetingHours').val();
        const isChecked = $(this).find('#meetingCheckbox').is(':checked');

        if (numPeople && price && hours) {
            meetingRooms.push({ numPeople, price, hours, isChecked });
        }
    });

    const virtualService = $('input[name="virtualService"]:checked').val();
    const membership = $('input[name="membership"]:checked').val();
    const membershipDuration = $('#membershipDuration').val();
    const membershipPrice = $('#membershipPrice').val();

    // if (!virtualService || !membership || !membershipDuration || !membershipPrice) {
    //     Swal.fire({
    //         icon: "error",
    //         title: "Incomplete Form",
    //         text: "Please fill out all required fields before proceeding!"
    //     });
    //     return;
    // }

    localStorage.setItem('listSpace8', JSON.stringify({
        desks,
        meetingRooms,
        virtualService,
        membership,
        membershipDuration,
        membershipPrice
    }));

    $('#s8').hide();
    $('#s9').show();
}

function moveToPreviousStepFromStep8() {
    $('#s8').hide();
    $('#s7').show();
}

// Helper functions to add desk and meeting fields
function addDeskField(duration = '', price = '', hours = '', isChecked = false) {
    const deskSection = $('.desk-section');
    const newDeskFields = `
        <div class="row desk-fields align-items-center mb-2">
            <div class="col-md-4">
                <div class="form-check mb-3">
                    <label for="duration" class="form-label">Duration</label>
                    <input type="text" class="form-control form-control-sm" id="duration" placeholder="1 hour - 2 hours" value="${duration}"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check mb-3">
                    <label for="deskPrice" class="form-label">Price</label>
                    <input type="text" class="form-control form-control-sm" id="deskPrice" placeholder="PHP" value="${price}"/>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-check mb-3">
                    <label for="deskHours" class="form-label">Hours</label>
                    <input type="text" class="form-control form-control-sm" id="deskHours" placeholder="1 - 2" value="${hours}"/>
                </div>
            </div>
            <div class="col-auto ms-auto">
                <input type="checkbox" class="form-check-input" id="deskCheckbox" ${isChecked ? 'checked' : ''}/>
                <button type="button" class="btn btn-outline-danger remove-desk ms-2"><i class="bi bi-dash-lg"></i></button>
            </div>
        </div>`;
    deskSection.append(newDeskFields);
}

function addMeetingField(numPeople = '', price = '', hours = '', isChecked = false) {
    const meetingSection = $('.meeting-section');
    const newMeetingFields = `
        <div class="row meeting-fields align-items-center mb-2">
            <div class="col-md-4">
                <div class="form-check mb-3">
                    <label for="numPeople" class="form-label">No. of people</label>
                    <input type="text" class="form-control form-control-sm" id="numPeople" placeholder="1 - 5 persons" value="${numPeople}"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check mb-3">
                    <label for="meetingPrice" class="form-label">Price</label>
                    <input type="text" class="form-control form-control-sm" id="meetingPrice" placeholder="PHP" value="${price}"/>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-check mb-3">
                    <label for="meetingHours" class="form-label">Hours</label>
                    <input type="text" class="form-control form-control-sm" id="meetingHours" placeholder="1 hour - 2 hours" value="${hours}"/>
                </div>
            </div>
            <div class="col-auto ms-auto">
                <input type="checkbox" class="form-check-input" id="meetingCheckbox" ${isChecked ? 'checked' : ''}/>
                <button type="button" class="btn btn-outline-danger remove-meeting ms-2"><i class="bi bi-dash-lg"></i></button>
            </div>
        </div>`;
    meetingSection.append(newMeetingFields);
}

// // Event listeners for add and remove buttons
// document.querySelector('.add-desk').addEventListener('click', function() {
//     addDeskField();
//     toggleDeskButtons(); // Update button states after adding fields
// });

// document.querySelector('.add-meeting').addEventListener('click', function() {
//     addMeetingField();
//     toggleMeetingButtons(); // Update button states after adding fields
// });

// document.addEventListener('click', function(e) {
//     if (e.target.classList.contains('remove-desk')) {
//         const deskFields = document.querySelectorAll('.desk-fields');
//         if (deskFields.length > 1) {
//             deskFields[deskFields.length - 1].remove();
//         }
//     }
//     toggleDeskButtons(); // Update button states after removing fields
// });

// document.addEventListener('click', function(e) {
//     if (e.target.classList.contains('remove-meeting')) {
//         const meetingFields = document.querySelectorAll('.meeting-fields');
//         if (meetingFields.length > 1) {
//             meetingFields[meetingFields.length - 1].remove();
//         }
//     }
//     toggleMeetingButtons(); // Update button states after removing fields
// });

// // Enable/Disable buttons on page load
// toggleDeskButtons();
// toggleMeetingButtons();
