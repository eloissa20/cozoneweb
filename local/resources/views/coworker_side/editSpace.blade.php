@extends('coworker_side.side')

@section('content')
{{-- <meta name="csrf-token" content="{{ csrf_token() }}" enctype="multipart/form-data"> --}}
<form action="{{ route('coworker_side.updateSpace', $space->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    {{-- 1 --}}
    <div class="mt-3" id="step1">
    <h2>EDIT YOUR COWORKING SPACE IN COZONE</h2>
    <hr class="separator-line" />
        <div class="row">
            <div class="form-group radio-group mb-2 mt-4">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" id="roleOwner" value="Owner" {{ $space->role == 'Owner' ? 'checked' : '' }}>
                    <label class="form-check-label" for="roleOwner"><strong>Owner</strong></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" id="roleAdmin" value="Admin" {{ $space->role == 'Admin' ? 'checked' : '' }}>
                    <label class="form-check-label" for="roleAdmin"><strong>Admin</strong></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" id="roleMember" value="Member" {{ $space->role == 'Member' ? 'checked' : '' }}>
                    <label class="form-check-label" for="roleMember"><strong>Member</strong></label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-4">
                    <input type="text" class="form-control" value="{{ old('coworkingSpaceName', $space->coworking_space_name) }}" id="coworkingSpaceName" name="coworkingSpaceName" placeholder="Name of your coworking space">
                </div>
        
                <div class="form-group mb-4">
                    <input type="text" class="form-control" value="{{ old('coworkingSpaceAddress', $space->coworking_space_address) }}" id="coworkingSpaceAddress" name="coworkingSpaceAddress" placeholder="Address/City">
                </div>
            </div>
        </div>
    </div>

    {{-- 2 --}}
    <div id="step2">
    <h2>INTRODUCE YOUR SPACE</h2>
    <hr class="separator-line" />
        <div class="row">
            <div class="col-md-6">
                <div class="form-check mb-3">
                    <label for="spaceName" class="form-label">Space Name</label>
                    <input type="text" class="form-control" value="{{ $space->space_name ?? '' }}" id="spaceName" name="spaceName" />
                </div>
                <div class="form-check mb-3">
                    <label for="typeOfSpace" class="form-label">Type of Space</label>
                    <select class="form-select" id="typeOfSpace" name="typeOfSpace">
                        <option value="coworking" {{ (isset($space->type_of_space) && $space->type_of_space == 'coworking') ? 'selected' : '' }}>Coworking</option>
                        <option value="sample1" {{ (isset($space->type_of_space) && $space->type_of_space == 'sample1') ? 'selected' : '' }}>Sample 1</option>
                        <option value="sample2" {{ (isset($space->type_of_space) && $space->type_of_space == 'sample2') ? 'selected' : '' }}>Sample 2</option>
                        <option value="sample3" {{ (isset($space->type_of_space) && $space->type_of_space == 'sample3') ? 'selected' : '' }}>Sample 3</option>
                    </select>
                </div>
                <div class="form-check mb-3">
                    <label for="description" class="form-label">Description (minimum of 250 characters)</label>
                    <textarea class="form-control" id="description" rows="4" name="description">{{ $space->description ?? '' }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check mb-3">
                    <label for="openingDate" class="form-label">Opening Date</label>
                    <input type="date" class="form-control" value="{{ $space->opening_date ?? '' }}" id="openingDate" name="openingDate"/>
                </div>
                <div class="form-check">
                    <label for="availableDays" class="form-label">Available Days</label>
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center">
                            <label for="availableDaysFrom" class="form-label mb-0 me-2">From</label>
                            <input type="text" class="form-control" value="{{ $space->available_days_from ?? '' }}" id="availableDaysFrom" name="availableDaysFrom" />
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <label for="availableDaysTo" class="form-label mb-0 me-2">To</label>
                            <input type="text" class="form-control" value="{{ $space->available_days_to ?? '' }}" id="availableDaysTo" name="availableDaysTo" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="form-check mb-3">
                            <label for="excepts" class="form-label" style="font-size: 0.65rem; font-weight: 100;">Except:</label>
                            <div class="form-check form-group radio-group p-2 mb-0">
                                @foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="exceptions" id="{{ $day }}" value="{{ $day }}" {{ (isset($space->exceptions) && $space->exceptions == $day) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ $day }}" style="font-size: 0.65rem; font-weight: 100;">{{ ucfirst($day) }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-check">
                    <label for="operatingHours" class="form-label">Operating Hours</label>
                    {{-- <input type="date" class="form-control" id="operatingHours" /> --}}
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center">
                            <label for="operatingHoursFrom" class="form-label mb-0 me-2">From</label>
                            <input type="text" class="form-control" value="{{ $space->operating_hours_from ?? '' }}" id="operatingHoursFrom" name="operatingHoursFrom"/>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <label for="operatingHoursTo" class="form-label mb-0 me-2">To</label>
                            <input type="text" class="form-control" value="{{ $space->operating_hours_to ?? '' }}" id="operatingHoursTo" name="operatingHoursTo"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center">
                            <label for="operatingHoursFrom" class="form-label mb-0 ms-auto" style="font-size: 0.75rem; font-weight: 100;">What time do you open?</label>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <label for="operatingHoursTo" class="form-label mb-0 ms-auto" style="font-size: 0.75rem; font-weight: 100;">What time do you close?</label>
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
                    <input type="email" class="form-control" value="{{ $space->email ?? '' }}" id="email" name="email"/>
                </div>
                <div class="form-check">
                    <label for="facebook" class="form-label">Facebook</label>
                    <input type="text" class="form-control" value="{{ $space->facebook ?? '' }}" id="facebook" name="facebook"/>
                </div>
                
                <div class="form-check">
                    <label for="instagram" class="form-label">Instagram</label>
                    <input type="text" class="form-control" value="{{ $space->instagram ?? '' }}" id="instagram" name="instagram"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check">
                    <label for="phone" class="form-label">Telephone No.</label>
                    <input type="text" class="form-control" value="{{ $space->phone ?? '' }}" id="phone" name="phone"/>
                </div>
                <div class="form-check">
                    <label for="contactNo" class="form-label">Contact No.</label>
                    <input type="text" class="form-control" value="{{ $space->contact_no ?? '' }}" id="contactNo" name="contactNo"/>
                </div>
            </div>
        </div>
    </div>

    {{-- 3 --}}
    <div class="mt-3" id="step3">
        <h2>WHAT YOU SPACE OFFERS</h2>
        <hr class="separator-line" />
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6">
                <div class="section-box">
                    <!-- Basics -->
                    <div class="basic-container"> 
                        <p class="section-title">Basics</p>
                        <hr class="separator-line" />
                        <div class="row">
                            <div class="col-auto form-check">
                                <input class="form-check-input" type="checkbox" name="basics[]" value="Wifi" 
                                        {{ in_array('Wifi', $basics ?? []) ? 'checked' : '' }} />
                                <label class="form-check-label">Wifi</label>
                            </div>
                            <div class="col-auto form-check">
                                <input class="form-check-input" type="checkbox" name="basics[]" value="Air Conditioned" id="airConditioned" 
                                        {{ in_array('Air Conditioned', $basics ?? []) ? 'checked' : '' }} />
                                <label class="form-check-label" for="airConditioned">Air Conditioned</label>
                            </div>
                            <div class="col-auto form-check">
                                <input class="form-check-input" type="checkbox" name="basics[]" value="Power Backup" id="powerBackup" 
                                        {{ in_array('Power Backup', $basics ?? []) ? 'checked' : '' }} />
                                <label class="form-check-label" for="powerBackup">Power Backup</label>
                            </div>
                        </div>
                    </div>                                           
    
                    <!-- Seats -->
                    <div class="seat-container">
                        <p class="section-title mt-0">Seats</p>
                        <hr class="separator-line" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="seats[]" value="Couches" id="couches" 
                                            {{ in_array('Couches', $seats ?? []) ? 'checked' : '' }}/>
                                    <label class="form-check-label" for="couches">Couches</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="seats[]" value="Beanbag" id="beanbag"
                                            {{ in_array('Beanbag', $seats ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="beanbag">Beanbag</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="seats[]" value="Ergonomic Chairs" id="ergonomicChairs"
                                            {{ in_array('Ergonomic Chairs', $seats ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="ergonomicChairs">Ergonomic Chairs</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="seats[]" value="Counter Height Bar Stools" id="barStools"
                                            {{ in_array('Counter Height Bar Stools', $seats ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="barStools">Counter Height Bar Stools</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="seats[]" value="Modular Seating" id="modularSeating"
                                            {{ in_array('Modular Seating', $seats ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="modularSeating">Modular Seating</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="seats[]" value="Lounge Chairs" id="loungeChairs"
                                            {{ in_array('Lounge Chairs', $seats ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="loungeChairs">Lounge Chairs</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="seats[]" value="Floor Cushions" id="floorCushions"
                                            {{ in_array('Floor Cushions', $seats ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="floorCushions">Floor Cushions</label>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Equipment -->
                    <div class="equipment-container">
                        <p class="section-title mt-0">Equipment</p>
                        <hr class="separator-line" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="equipment[]" value="Printer" id="printer"
                                            {{ in_array('Printer', $equipment ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="printer">Printer</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="equipment[]" value="Projector" id="projector"
                                            {{ in_array('Projector', $equipment ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="projector">Projector</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="equipment[]" value="Whiteboards" id="whiteboards"
                                            {{ in_array('Whiteboards', $equipment ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="whiteboards">Whiteboards</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="equipment[]" value="Scanner" id="scanner"
                                            {{ in_array('Scanner', $equipment ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="scanner">Scanner</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="equipment[]" value="Photocopier" id="photocopier"
                                            {{ in_array('Photocopier', $equipment ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="photocopier">Photocopier</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="equipment[]" value="Computers" id="computers"
                                            {{ in_array('Computers', $equipment ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="computers">Computers</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="equipment[]" value="Laptops" id="laptops"
                                            {{ in_array('Laptops', $equipment ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="laptops">Laptops</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="equipment[]" value="Sockets" id="sockets"
                                            {{ in_array('Sockets', $equipment ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="sockets">Sockets</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Right Column -->
            <div class="col-md-6">
                <div class="section-box">
                    <!-- Facilities -->
                    <div class="facilities-container">
                        <p class="section-title">Facilities</p>
                        <hr class="separator-line" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="facilities[]" value="Kitchen" id="kitchen"
                                            {{ in_array('Kitchen', $facilities ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="kitchen">Kitchen</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="facilities[]" value="Personal Lockers" id="personalLockers"
                                            {{ in_array('Personal Lockers', $facilities ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="personalLockers">Personal Lockers</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="facilities[]" value="Shower Areas" id="showerAreas"
                                            {{ in_array('Shower Areas', $facilities ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="showerAreas">Shower Areas</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="facilities[]" value="Nap Room" id="napRoom"
                                            {{ in_array('Nap Room', $facilities ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="napRoom">Nap Room</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="facilities[]" value="Lounge Area" id="loungeArea"
                                            {{ in_array('Lounge Area', $facilities ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="loungeArea">Lounge Area</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="facilities[]" value="Quiet Room" id="quietRoom"
                                            {{ in_array('Quiet Room', $facilities ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="quietRoom">Quiet Room</label>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Accessibility -->
                    <div class="accessibility-container">
                        <p class="section-title mt-0">Accessibility</p>
                        <hr class="separator-line" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="accessibility[]" value="Parking" id="parking"
                                            {{ in_array('Parking', $accessibility ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="parking">Parking</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="accessibility[]" value="Restrooms" id="restrooms"
                                            {{ in_array('Restrooms', $accessibility ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="restrooms">Restrooms</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="accessibility[]" value="Accessible Workstations" id="accessibleWorkstations"
                                            {{ in_array('Accessible Workstations', $accessibility ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="accessibleWorkstations">Accessible
                                        Workstations</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="accessibility[]" value="Wide Doorways" id="wideDoorways"
                                            {{ in_array('Wide Doorways', $accessibility ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="wideDoorways">Wide Doorways</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="accessibility[]" value="Adjustable Lighting" id="adjustableLighting"
                                            {{ in_array('Adjustable Lighting', $accessibility ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="adjustableLighting">Adjustable Lighting</label>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Perks -->
                    <div class="perks-container">
                        <p class="section-title mt-0">Perks</p>
                        <hr class="separator-line" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="perks[]" value="Free Drinking Water" id="freeWater"
                                            {{ in_array('Free Drinking Water', $perks ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="freeWater">Free Drinking Water</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="perks[]" value="Free Snacks" id="freeSnacks"
                                            {{ in_array('Free Snacks', $perks ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="freeSnacks">Free Snacks</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="perks[]" value="Vending Machine" id="vendingMachine"
                                            {{ in_array('Vending Machine', $perks ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="vendingMachine">Vending Machine</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="perks[]" value="Snacks/Drinks Available for Purchase" id="snacksPurchase"
                                            {{ in_array('Snacks/Drinks Available for Purchase', $perks ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="snacksPurchase">Snacks/Drinks Available for
                                        Purchase</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="perks[]" value="Free Coffee" id="freeCoffee"
                                            {{ in_array('Free Coffee', $perks ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="freeCoffee">Free Coffee</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="perks[]" value="Free Tea" id="freeTea"
                                            {{ in_array('Free Tea', $perks ?? []) ? 'checked' : '' }} />
                                    <label class="form-check-label" for="freeTea">Free Tea</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    
    {{-- 4 --}}

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiYegG-lDsQcjOdCUirT6WBk-gTh6xT7Y&callback=initMap">
</script>

    <div class="mt-4" id="step4">
        <h2>LETS FIND YOUR SPACE</h2>
        <hr class="separator-line" />
        <div class="container mb-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-check">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="text" class="form-control mb-4" value="{{ $space->longitude ?? '' }}" id="longitude" name="longitude" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="text" class="form-control mb-2" value="{{ $space->latitude ?? '' }}" id="latitude"  name="latitude" readonly>
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
                    <input type="text" class="form-control" value="{{ $space->location ?? '' }}" id="location" name="location"/>
                </div>
                <div class="form-check mb-3">
                    <label for="telephone" class="form-label">Telephone No.</label>
                    <input type="text" class="form-control" value="{{ $space->telephone ?? '' }}" id="telephone" name="telephone"/>
                </div>
                <div class="form-check mb-3">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" class="form-control" value="{{ $space->country ?? '' }}" id="country" name="country"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check mb-3">
                    <label for="unit" class="form-label">Unit/Floor Number</label>
                    <input type="text" class="form-control" value="{{ $space->unit ?? '' }}" id="unit" name="unit"/>
                </div>
                <div class="form-check mb-3">
                    <label for="postal" class="form-label">Zip/Postal Code</label>
                    <input type="text" class="form-control" value="{{ $space->postal ?? '' }}" id="postal" name="postal"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" value="{{ $space->city ?? '' }}" id="city" name="city"/>
                </div>
            </div>
        </div>    
    </div>

    {{-- 5 --}}
    <div class="mt-4" id="step5">
    <h2>SPACE DIMENSIONS</h2>
    <hr class="separator-line" />
        <div class="row">
            <div class="col-md-6">
                <div class="form-check mb-3">
                    <label for="tables" class="form-label">No. of Desks/Tables</label>
                    <input type="number" class="form-control" value="{{ $space->tables ?? '' }}" id="tables" name="tables"/>
                </div>
                <div class="form-check mb-3">
                    <label for="capacity" class="form-label">Total Capacity</label>
                    <input type="number" class="form-control" value="{{ $space->capacity ?? '' }}" id="capacity" name="capacity"/>
                </div>
                <div class="form-check mb-3">
                    <label for="meetingRooms" class="form-label">Meeting Rooms</label>
                    <input type="number" class="form-control" value="{{ $space->meeting_rooms ?? '' }}" id="meetingRooms" name="meetingRooms"/>
                </div>
                <div class="form-check mb-3">
                    <label for="virtualOffices" class="form-label">Virtual Offices</label>
                    <input type="number" class="form-control" value="{{ $space->virtual_offices ?? '' }}" id="virtualOffices" name="virtualOffices"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check mb-3">
                    <label for="unit" class="form-label">Unit</label>
                </div>
                <div class="form-check form-group radio-group mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="measurementUnit" id="feet" value="feet" {{ $space->measurement_unit == 'feet' ? 'checked' : '' }}>
                        <label class="form-check-label" for="feet"><strong>Square Feet</strong></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="measurementUnit" id="meters" value="meters" {{ $space->measurement_unit == 'meters' ? 'checked' : '' }}>
                        <label class="form-check-label" for="meters"><strong>Square Meters</strong></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="measurementUnit" id="squareInches" value="inches" {{ $space->measurement_unit == 'inches' ? 'checked' : '' }}>
                        <label class="form-check-label" for="squareInches"><strong>Square Inches</strong></label>
                    </div>
                </div>
                <div class="form-check mb-3">
                    <label for="size" class="form-label">Size</label>
                    <input type="number" class="form-control" value="{{ $space->size ?? '' }}" id="size" placeholder="Size range of your space (ex. 1-15)" name="size"/>
                </div>
            </div>
        </div>
    </div> 
    
    {{-- 6 --}}
    <div class="mt-4" id="step6">
        <h2>INSIDE YOUR SPACE</h2>
        <hr class="separator-line" />
    
        <!-- Display stored Header Image -->
        @if(isset($space->header_image) && $space->header_image)
            <div class="mb-3">
                <label class="form-label">Header Image</label>
                <img src="{{ asset($space->header_image) }}" alt="Header Image" style="width: 150px; height: auto;"/>
            </div>
        @endif
    
        <!-- Display stored Additional Images -->
        @if(isset($space->additional_images) && $space->additional_images)
            @php
                $additionalImages = json_decode($space->additional_images, true);
            @endphp
            <div class="mb-3">
                <label class="form-label">Additional Images</label>
                <div id="storedadditionalImagesPreview">
                    @foreach($additionalImages as $image)
                        <img src="{{ asset($image) }}" style="width: 100px; height: auto; margin-right: 10px;" alt="Additional Image"/>
                    @endforeach
                </div>
            </div>
        @endif
    
        <!-- Form for uploading images -->
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
    </div>
    
    {{-- 7 --}}
    <div class="mt-4" id="step7">
    <h2>SPACE DIMENSIONS</h2>
    <hr class="separator-line" />
        <div class="row">
            <div class="col-md-6">
                <div class="form-check mb-3">
                    <label for="online" class="form-label">Can clients pay online</label>
                </div>
                <div class="form-check form-group radio-group mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="payOnline" id="yes" value="yes" {{ $space->pay_online == 'yes' ? 'checked' : '' }}>
                        <label class="form-check-label" for="yes"><strong>Yes</strong></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="payOnline" id="no" value="no" {{ $space->pay_online == 'no' ? 'checked' : '' }}>
                        <label class="form-check-label" for="no"><strong>No</strong></label>
                    </div>
                </div>
                <div class="form-check mb-3">
                    <label for="credit" class="form-label">Do you accept credit cards?</label>
                </div>
                <div class="form-check form-group radio-group mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="creditCards" id="yes" value="yes" {{ $space->credit_cards == 'yes' ? 'checked' : '' }}>
                        <label class="form-check-label" for="yes"><strong>Yes</strong></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="creditCards" id="no" value="no" {{ $space->credit_cards == 'no' ? 'checked' : '' }}>
                        <label class="form-check-label" for="no"><strong>No</strong></label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check mb-3">
                    <label for="ewal" class="form-label">Can client pay with E-wallets (Gcash, Maya, Paypal)</label>
                </div>
                <div class="form-check form-group radio-group mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="eWallet" id="yes" value="yes" {{ $space->eWallet == 'yes' ? 'checked' : '' }}>
                        <label class="form-check-label" for="yes"><strong>Yes</strong></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="eWallet" id="no" value="no" {{ $space->eWallet == 'no' ? 'checked' : '' }}>
                        <label class="form-check-label" for="no"><strong>No</strong></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- 8 --}}
    <div class="mt-4" id="step8">
    <h2>MANAGE PRICING</h2>
    <hr class="separator-line" />

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
            <h3 class="d-flex align-items-center">VIRTUAL OFFICES <input type="checkbox" class="ms-3" id="isvirtualCheck" onchange="toggleVirtualOfficeFields()"></h3>
        </div>
        <div class="virtual-section">
            <div class="row virtual-fields align-items-center mb-2">
                <div class="col-md-6">
                    <div class="form-check mb-3">
                        <label for="service" class="form-label">Do you offer virtual office services</label>
                    </div>
                    <div class="form-check form-group radio-group mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="virtualService" id="yes" value="yes" name="yes" {{ $space->virtual_service == 'yes' ? 'checked' : '' }}>
                            <label class="form-check-label" for="yes"><strong>Yes</strong></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="virtualService" id="no" value="no" name="no" {{ $space->virtual_service == 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="no"><strong>No</strong></label>
                        </div>
                    </div>
                    <div class="form-check mb-3">
                        <label for="memberships" class="form-label">Do you offer reduced rates for long-term memberships</label>
                    </div>
                    <div class="form-check form-group radio-group mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="membership" id="longTermYes" value="yes" name="yes" {{ $space->membership == 'yes' ? 'checked' : '' }}>
                            <label class="form-check-label" for="longTermYes"><strong>Yes</strong></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="membership" id="longTermNo" value="no" name="no" {{ $space->membership == 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="longTermNo"><strong>No</strong></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check mb-3">
                        <label for="membershipDuration" class="form-label">Duration</label>
                        <input type="text" class="form-control form-control-sm" id="membershipDuration" placeholder="Starting Price per Week" name="membershipDuration" value="{{ $space->membership_duration ?? '' }}"/>
                    </div>
                    <div class="form-check mb-3">
                        <label for="membershipPrice" class="form-label">Price</label>
                        <input type="text" class="form-control form-control-sm" id="membershipPrice" placeholder="PHP" name="membershipPrice" value="{{ $space->membership_price ?? '' }}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 9 --}}
    <div class="mt-4" id="step9">
    <h2>PROMOTIONS</h2>
    <hr class="separator-line" />
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="short" class="form-label"><strong>Short term reservation</strong></label>
                    </div>
                    <div class="col-md-3">
                        <input class="form-check-input" type="radio" name="shortTerm" id="shortEnable" value="enable" {{ $space->short_term == 'enable' ? 'checked' : '' }}>
                        <label class="form-check-label ms-2" for="shortEnable">Enable</label>
                    </div>
                    <div class="col-md-3">
                        <input class="form-check-input" type="radio" name="shortTerm" id="shortDisable" value="disable" {{ $space->short_term == 'disable' ? 'checked' : '' }}>
                        <label class="form-check-label ms-2" for="shortDisable">Disable</label>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="offer" class="form-label"><strong>Offer a Free Day Pass</strong></label>
                    </div>
                    <div class="col-md-3">
                        <input class="form-check-input" type="radio" name="freePass" id="offerEnable" value="enable" {{ $space->free_pass == 'disable' ? 'checked' : '' }}>
                        <label class="form-check-label ms-2" for="offerEnable">Enable</label>
                    </div>
                    <div class="col-md-3">
                        <input class="form-check-input" type="radio" name="freePass" id="offerDisable" value="disable" {{ $space->free_pass == 'disable' ? 'checked' : '' }}>
                        <label class="form-check-label ms-2" for="offerDisable">Disable</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row mb-3">
                    <input type="text" class="form-control" name="shortTermDetails" id="shortTermDetails" name="shortTermDetails" placeholder="Add detail" value="{{ $space->short_term_details ?? '' }}">
                </div>
                <div class="row mb-3">
                    <input type="text" class="form-control" name="freePassDetails" id="freePassDetails" name="freePassDetails" placeholder="Add detail" value="{{ $space->free_pass_details ?? '' }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="price" class="form-label">Price of your cozone</label>
                <input type="number" class="form-control" name="price" id="price" placeholder="Price of your space" value="{{ $space->price ?? '' }}">
            </div>
        </div>
    </div> 
    <div class="d-flex justify-content-end mt-4">
        <button type="submit" class="btn btn-dark ms-3">Save Changes</button>
    </div>     
</form>
<script>
    let map;
    let marker;

    function initMap() {
        const initialPosition = { lat: 14.587186, lng: -239.015398 };
        
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 8,
            center: initialPosition,
        });
        
        marker = new google.maps.Marker({
            position: initialPosition,
            map: map,
            draggable: true, 
        });

        google.maps.event.addListener(marker, 'dragend', function() {
            let position = marker.getPosition();
            document.getElementById('latitude').value = position.lat();
            document.getElementById('longitude').value = position.lng();
        });

        map.addListener("click", (e) => {
            placeMarkerAndPanTo(e.latLng, map);
        });
    }

    function placeMarkerAndPanTo(latLng, map) {
        marker.setPosition(latLng);
        map.panTo(latLng);
        document.getElementById('latitude').value = latLng.lat();
        document.getElementById('longitude').value = latLng.lng();
    }
</script>
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

@endsection
