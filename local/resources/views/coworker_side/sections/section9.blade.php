<div class="form-section" id="step9">
    <h2>PROMOTIONS</h2>
    <hr class="separator-line" />
    <form id="section9">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="short" class="form-label"><strong>Short term reservation</strong></label>
                    </div>
                    <div class="col-md-3">
                        <input class="form-check-input" type="radio" name="shortTerm" id="shortEnable" value="enable">
                        <label class="form-check-label ms-2" for="shortEnable">Enable</label>
                    </div>
                    <div class="col-md-3">
                        <input class="form-check-input" type="radio" name="shortTerm" id="shortDisable" value="disable">
                        <label class="form-check-label ms-2" for="shortDisable">Disable</label>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="offer" class="form-label"><strong>Offer a Free Day Pass</strong></label>
                    </div>
                    <div class="col-md-3">
                        <input class="form-check-input" type="radio" name="freePass" id="offerEnable" value="enable">
                        <label class="form-check-label ms-2" for="offerEnable">Enable</label>
                    </div>
                    <div class="col-md-3">
                        <input class="form-check-input" type="radio" name="freePass" id="offerDisable" value="disable">
                        <label class="form-check-label ms-2" for="offerDisable">Disable</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row mb-3">
                    <input type="text" class="form-control" name="shortTermDetails" id="shortTermDetails" placeholder="Add detail">
                </div>
                <div class="row mb-3">
                    <input type="text" class="form-control" name="freePassDetails" id="freePassDetails" placeholder="Add detail">
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-md-3">
                <input type="number" class="form-control" name="price" id="price" placeholder="Price of your space">
            </div>
        </div> --}}

        <div class="d-flex justify-content-end mt-4">
            <button type="button" class="btn btn-light" id="prevButton9">Previous</button>
            <button type="button" class="btn btn-dark ms-3" id="submitBtn">Submit</button>
        </div>        
    </form>
</div>