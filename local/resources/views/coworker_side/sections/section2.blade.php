<div class="form-section" id="step2">
  <h2>INTRODUCE YOUR SPACE</h2>
  <hr class="separator-line" />
  <form id="section2">
    <div class="row">
      <div class="col-md-6">
        <div class="form-check mb-3">
          <label for="spaceName" class="form-label">Space Name</label>
          <input type="text" class="form-control" id="spaceName" />
        </div>
        <div class="form-check mb-3">
          <label for="description" class="form-label">Description (minimum of 250 characters)</label>
          <textarea class="form-control" id="description" rows="4"></textarea>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-check mb-3">
          <label for="openingDate" class="form-label">Opening Date</label>
          <input type="date" class="form-control" id="openingDate" />
        </div>
        <div class="form-check">
          <label for="availableDays" class="form-label">Available Days</label>
          <div class="row">
            <div class="col-md-6 d-flex align-items-center">
              <label for="availableDaysFrom" class="form-label mb-0 me-2">From</label>
              <input type="text" class="form-control" id="availableDaysFrom" />
            </div>
            <div class="col-md-6 d-flex align-items-center">
              <label for="availableDaysTo" class="form-label mb-0 me-2">To</label>
              <input type="text" class="form-control" id="availableDaysTo" />
            </div>
          </div>
          <div class="row mt-2">
            <div class="form-check form-group radio-group p-2 mb-0">
              <label for="exceptions" class="form-label" style="font-size: 0.65rem; font-weight: 100;">Except:</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="exceptions" id="monday" value="monday" />
                <label class="form-check-label" for="monday" style="font-size: 0.65rem; font-weight: 100;">Monday</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="exceptions" id="tuesday" value="tuesday" />
                <label class="form-check-label" for="tuesday" style="font-size: 0.65rem; font-weight: 100;">Tuesday</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="exceptions" id="wednesday" value="wednesday" />
                <label class="form-check-label" for="wednesday" style="font-size: 0.65rem; font-weight: 100;">Wednesday</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="exceptions" id="thursday" value="thursday" />
                <label class="form-check-label" for="thursday" style="font-size: 0.65rem; font-weight: 100;">Thursday</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="exceptions" id="friday" value="friday" />
                <label class="form-check-label" for="friday" style="font-size: 0.65rem; font-weight: 100;">Friday</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="exceptions" id="saturday" value="saturday" />
                <label class="form-check-label" for="saturday" style="font-size: 0.65rem; font-weight: 100;">Saturday</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="exceptions" id="sunday" value="sunday" />
                <label class="form-check-label" for="sunday" style="font-size: 0.65rem; font-weight: 100;">Sunday</label>
              </div>
            </div>
          </div>
        </div>
        <div class="form-check mb-3">
          <label for="operatingHours" class="form-label">Operating Hours</label>
          <div class="row">
            <div class="col-md-6 d-flex align-items-center">
              <label for="operatingHoursFrom" class="form-label mb-0 me-2">From</label>
              <input type="time" class="form-control" id="operatingHoursFrom" />
            </div>
            <div class="col-md-6 d-flex align-items-center">
              <label for="operatingHoursTo" class="form-label mb-0 me-2">To</label>
              <input type="time" class="form-control" id="operatingHoursTo" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <h2>CONTACT INFORMATION</h2>
    <hr class="separator-line" />
    <div class="row">
      <div class="col-md-6">
        <div class="form-check">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" id="email" />
        </div>
        <div class="form-check">
          <label for="facebook" class="form-label">Facebook</label>
          <input type="text" class="form-control" id="facebook" />
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-check">
          <label for="instagram" class="form-label">Instagram</label>
          <input type="text" class="form-control" id="instagram" />
        </div>
        <div class="form-check">
          <label for="contactNo" class="form-label">Contact No.</label>
          <input type="text" class="form-control" id="contactNo" />
        </div>
      </div>
    </div>
    <div class="text-end mt-3">
      <button type="button" class="btn btn-dark ms-3" id="nextButton2">Next</button>
    </div>
  </form>
</div>
