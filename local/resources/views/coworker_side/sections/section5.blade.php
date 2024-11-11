<div class="form-section" id="step5">
    <h2>SPACE DIMENSIONS</h2>
    <hr class="separator-line" />
    <form id="section5">
        <div class="row">
            <div class="col-md-6">
                <div class="form-check mb-3">
                    <label for="tables" class="form-label">No. of Desks/Tables</label>
                    <input type="number" class="form-control" id="tables" />
                </div>
                <div class="form-check mb-3">
                    <label for="capacity" class="form-label">Total Capacity</label>
                    <input type="number" class="form-control" id="capacity" />
                </div>
                <div class="form-check mb-3">
                    <label for="meetingRooms" class="form-label">Meeting Rooms</label>
                    <input type="number" class="form-control" id="meetingRooms" />
                </div>
                <div class="form-check mb-3">
                    <label for="virtualOffices" class="form-label">Virtual Offices</label>
                    <input type="number" class="form-control" id="virtualOffices" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check mb-3">
                    <label for="unit" class="form-label">Unit</label>
                </div>
                <div class="form-check form-group radio-group mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="measurementUnit" id="feet" value="feet">
                        <label class="form-check-label" for="feet"><strong>Square Feet</strong></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="measurementUnit" id="meters" value="meters">
                        <label class="form-check-label" for="meters"><strong>Square Meters</strong></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="measurementUnit" id="squareInches" value="inches">
                        <label class="form-check-label" for="squareInches"><strong>Square Inches</strong></label>
                    </div>
                </div>
                <div class="form-check mb-3">
                    <label for="size" class="form-label">Size</label>
                    <input type="number" class="form-control" id="size" placeholder="Size range of your space (ex. 1-15)" />
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="button" class="btn btn-light" id="prevButton5">Previous</button>
            <button type="button" class="btn btn-dark ms-3" id="nextButton5">Next</button>
        </div>        
    </form>
</div>