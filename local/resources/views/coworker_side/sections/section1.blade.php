<style>
    .main-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 70vh;
    }

    .form-container {
        width: 45%;
        padding: 40px;
        border: 1px solid #000000;
        border-radius: 10px;
        background-color: white;
    }

    .radio-group {
        margin-bottom: 20px;
    }

    .center-text {
        font-size: 3rem;
        font-weight: bold;
        text-align: right;
        width: 45%;
    }
</style>

<div class="container main-container">
    <div class="form-container d-flex flex-column justify-content-center bg-secondary">
        <form id="section1" class="w-100">
            <div class="form-group radio-group text-center mb-5">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" id="roleOwner" value="Owner">
                    <label class="form-check-label" for="roleOwner"><strong>Owner</strong></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" id="roleAdmin" value="Admin">
                    <label class="form-check-label" for="roleAdmin"><strong>Admin</strong></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" id="roleMember" value="Member">
                    <label class="form-check-label" for="roleMember"><strong>Member</strong></label>
                </div>
            </div>
    
            <div class="form-group mb-4">
                <input type="text" class="form-control" id="coworkingSpaceName" placeholder="Name of your coworking space">
            </div>
    
            <div class="form-group mb-4">
                <input type="text" class="form-control" id="coworkingSpaceAddress" placeholder="Address/City">
            </div>
    
            <div class="text-center">
                <button type="button" class="btn btn-dark" id="nextButton1">Done</button>
            </div>
        </form>
    </div>
    
    <div class="center-text">
        ADD YOUR COWORKING SPACE IN COZONE
    </div>
</div>