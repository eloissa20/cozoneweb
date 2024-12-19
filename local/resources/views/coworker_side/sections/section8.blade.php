<div class="form-section" id="step8">
    <h2>MANAGE PRICING</h2>
    <hr class="separator-line" />
    <form id="section8">
        
        {{-- <!-- DESKS Section -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="d-flex align-items-center">DESKS <input type="checkbox" class="ms-3" id="isdeskCheck" onchange="toggleDeskButtons()"></h3>
            <button type="button" class="btn btn-outline-secondary add-desk" id="add-desk-btn" disabled><i class="bi bi-plus-lg"></i></button>
        </div>
        <div class="desk-section">
            <div class="row desk-fields align-items-center mb-2">
                <div class="col-md-4">
                    <div class="form-check mb-3">
                        <label for="duration" class="form-label">Duration</label>
                        <input type="text" class="form-control form-control-sm" id="duration" placeholder="1 hour - 2 hours"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check mb-3">
                        <label for="deskPrice" class="form-label">Price</label>
                        <input type="text" class="form-control form-control-sm" id="deskPrice" placeholder="PHP"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-check mb-3">
                        <label for="deskHours" class="form-label">Hours</label>
                        <input type="text" class="form-control form-control-sm" id="deskHours" placeholder="1 - 2"/>
                    </div>
                </div>
                <div class="col-auto ms-auto">
                    <button type="button" class="btn btn-outline-danger remove-desk" disabled><i class="bi bi-dash-lg"></i></button> <!-- Remove button -->
                </div>
            </div>
        </div>

        <!-- MEETING ROOMS Section -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="d-flex align-items-center">MEETING ROOMS <input type="checkbox" class="ms-3" id="ismeetingCheck" onchange="toggleMeetingButtons()"></h3>
            <button type="button" class="btn btn-outline-secondary add-meeting" id="add-meeting-btn" disabled><i class="bi bi-plus-lg"></i></button>
        </div>
        <div class="meeting-section">
            <div class="row meeting-fields align-items-center mb-2">
                <div class="col-md-4">
                    <div class="form-check mb-3">
                        <label for="numPeople" class="form-label">No. of people</label>
                        <input type="text" class="form-control form-control-sm" id="numPeople" placeholder="1 - 5 persons"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check mb-3">
                        <label for="meetingPrice" class="form-label">Price</label>
                        <input type="text" class="form-control form-control-sm" id="meetingPrice" placeholder="PHP"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-check mb-3">
                        <label for="meetingHours" class="form-label">Hours</label>
                        <input type="text" class="form-control form-control-sm" id="meetingHours" placeholder="1 hour - 2 hours"/>
                    </div>
                </div>
                <div class="col-auto ms-auto">
                    <button type="button" class="btn btn-outline-danger remove-meeting" disabled><i class="bi bi-dash-lg"></i></button> <!-- Remove button -->
                </div>
            </div>
        </div> --}}

        <!-- VIRTUAL OFFICES Section -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="d-flex align-items-center">VIRTUAL OFFICES {{-- <input type="checkbox" class="ms-3" id="isvirtualCheck" onchange="toggleVirtualOfficeFields()"> --}}</h3>
        </div>
        <div class="virtual-section">
            <div class="row virtual-fields align-items-center mb-2">
                <div class="col-md-6">
                    <div class="form-check mb-3">
                        <label for="service" class="form-label">Do you offer virtual office services</label>
                    </div>
                    <div class="form-check form-group radio-group mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="virtualService" id="yes" value="yes">
                            <label class="form-check-label" for="yes"><strong>Yes</strong></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="virtualService" id="no" value="no">
                            <label class="form-check-label" for="no"><strong>No</strong></label>
                        </div>
                    </div>
                    <div class="form-check mb-3">
                        <label for="memberships" class="form-label">Do you offer reduced rates for long-term memberships</label>
                    </div>
                    <div class="form-check form-group radio-group mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="membership" id="longTermYes" value="yes">
                            <label class="form-check-label" for="longTermYes"><strong>Yes</strong></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="membership" id="longTermNo" value="no">
                            <label class="form-check-label" for="longTermNo"><strong>No</strong></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check mb-3">
                        <label for="membershipDuration" class="form-label">Duration</label>
                        <input type="text" class="form-control form-control-sm" id="membershipDuration" placeholder="Starting Price per Week"/>
                    </div>
                    <div class="form-check mb-3">
                        <label for="membershipPrice" class="form-label">Price</label>
                        <input type="text" class="form-control form-control-sm" id="membershipPrice" placeholder="PHP"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="button" class="btn btn-light" id="prevButton8">Previous</button>
            <button type="button" class="btn btn-dark ms-3" id="nextButton8">Next</button>
        </div>   
    </form>
</div>

<script>
    function toggleDeskButtons() {
        const isDeskChecked = document.getElementById('isdeskCheck').checked;
        const deskFields = document.querySelectorAll('.desk-fields input');
        const addDeskBtn = document.getElementById('add-desk-btn');
        const removeDeskBtns = document.querySelectorAll('.remove-desk');
        
        deskFields.forEach(field => {
            field.disabled = !isDeskChecked;
        });

        addDeskBtn.disabled = !isDeskChecked;
        removeDeskBtns.forEach(button => {
            button.disabled = !isDeskChecked || deskFields.length <= 1;
        });
    }

    function toggleMeetingButtons() {
        const isMeetingChecked = document.getElementById('ismeetingCheck').checked;
        const meetingFields = document.querySelectorAll('.meeting-fields input');
        const addMeetingBtn = document.getElementById('add-meeting-btn');
        const removeMeetingBtns = document.querySelectorAll('.remove-meeting');
        
        meetingFields.forEach(field => {
            field.disabled = !isMeetingChecked;
        });

        addMeetingBtn.disabled = !isMeetingChecked;
        removeMeetingBtns.forEach(button => {
            button.disabled = !isMeetingChecked || meetingFields.length <= 1;
        });
    }

    function toggleVirtualOfficeFields() {
        const isVirtualChecked = document.getElementById('isvirtualCheck').checked;
        const virtualFields = document.querySelectorAll('.virtual-fields input, .virtual-fields .form-check-input');
        
        virtualFields.forEach(field => {
            field.disabled = !isVirtualChecked;
        });
    }

    function toggleVirtualOfficeFields() {
        const isVirtualChecked = document.getElementById('isvirtualCheck').checked;
        const virtualFields = document.querySelectorAll('.virtual-fields input, .virtual-fields .form-check-input');
        
        virtualFields.forEach(field => {
            field.disabled = !isVirtualChecked;
        });
    }

    document.querySelector('.add-desk').addEventListener('click', function() {
        const deskSection = document.querySelector('.desk-section');
        const newDeskFields = document.querySelector('.desk-fields').cloneNode(true);
        
        newDeskFields.querySelectorAll('[id]').forEach(function(item) {
            item.removeAttribute('id');
        });
        
        deskSection.appendChild(newDeskFields);
        toggleDeskButtons();
    });


    document.querySelector('.add-meeting').addEventListener('click', function() {
        const meetingSection = document.querySelector('.meeting-section');
        const newMeetingFields = document.querySelector('.meeting-fields').cloneNode(true);
        
        newMeetingFields.querySelectorAll('[id]').forEach(function(item) {
            item.removeAttribute('id');
        });

        meetingSection.appendChild(newMeetingFields);
        toggleMeetingButtons();
    });


    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-desk')) {
            const deskFields = document.querySelectorAll('.desk-fields');
            if (deskFields.length > 1) {
                deskFields[deskFields.length - 1].remove();
            }
        }
        toggleDeskButtons();
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-meeting')) {
            const meetingFields = document.querySelectorAll('.meeting-fields');
            if (meetingFields.length > 1) {
                meetingFields[meetingFields.length - 1].remove();
            }
        }
        toggleMeetingButtons();
    });

    toggleDeskButtons();
    toggleMeetingButtons();
    toggleVirtualOfficeFields();
</script>