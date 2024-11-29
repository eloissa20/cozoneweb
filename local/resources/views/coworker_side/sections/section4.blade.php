<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiYegG-lDsQcjOdCUirT6WBk-gTh6xT7Y&callback=initMap">
</script>

<div class="form-section" id="step4">

    <h2>LETS FIND YOUR SPACE</h2>
    <hr class="separator-line" />
    <form id="section4">
        <div class="container mb-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-check">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="text" class="form-control mb-4" id="longitude" name="longitude" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="text" class="form-control mb-2" id="latitude" name="latitude" readonly>
                    </div>
                </div>
            </div>

            {{-- <div class="form-check">
                <input type="text" class="form-control" id="addressInput" placeholder="Enter your space name AND city, your street address" style="width: 60%; margin: 0 auto;" />
            </div> --}}

            <div class="d-flex justify-content-center mb-3">
                <span style="font-size: .75rem;">
                    <i class="bi bi-geo-alt-fill"></i> Verify that the pin is positioned correctly. If it isn't, simply drag and drop it to the correct location
                </span>
            </div>

            <div class="form-check">
                <div id="map" class="map-container d-flex align-items-center justify-content-center" 
                    style="border: 1px solid #000000; height: 300px; width: 80%; border-radius: 5px; margin: 0 auto;">
                </div>
            </div>
        </div>

        <h2>COMPLETE THE DETAILS BELOW</h2>
        <hr class="separator-line" />
        <div class="row">
            <div class="col-md-4">
                <div class="form-check mb-3">
                    <label for="location" class="form-label">Location Name</label>
                    <input type="text" class="form-control" id="location" />
                </div>
                <div class="form-check mb-3">
                    <label for="telephone" class="form-label">Telephone No.</label>
                    <input type="text" class="form-control" id="telephone" />
                </div>
                <div class="form-check mb-3">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" class="form-control" id="country" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check mb-3">
                    <label for="unit" class="form-label">Unit/Floor Number</label>
                    <input type="text" class="form-control" id="unit" />
                </div>
                <div class="form-check mb-3">
                    <label for="postal" class="form-label">Zip/Postal Code</label>
                    <input type="text" class="form-control" id="postal" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" />
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="button" class="btn btn-light" id="prevButton4">Previous</button>
            <button type="button" class="btn btn-dark ms-3" id="nextButton4">Next</button>
        </div>        
    </form>
</div>

