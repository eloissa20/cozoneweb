<div class="form-section" id="step6">
    <h2>INSIDE YOUR SPACE</h2>
    <hr class="separator-line" />
    <form id="section6">
        <!-- Header Image Upload -->
        <div class="mb-3">
            <label for="headerImage" class="form-label">Upload Header Image</label>
            <input type="file" class="form-control" name="headerImage" accept="image/*"/>
            <img id="imagePreview" alt="Image Preview" style="display: none; width: 150px; height: auto;"/> <!-- Adjusted size -->
        </div>

        <!-- Additional Images Upload -->
        <div class="mb-3">
            <label for="additionalImages" class="form-label">Upload Additional Images</label>
            <input type="file" class="form-control" name="additionalImages[]" accept="image/*" multiple/>
            <div id="additionalImagesPreview"></div>
        </div>


        <div class="d-flex justify-content-end mt-4">
            <button type="button" class="btn btn-light" id="prevButton6">Previous</button>
            <button type="button" class="btn btn-dark ms-3" id="nextButton6">Next</button>
        </div>        
    </form>
</div>
