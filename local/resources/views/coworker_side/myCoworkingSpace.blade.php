@extends('coworker_side.side')

@section('content')
<style>
    .card{
        border: 1px solid #000000;
    }
    .modal-body {
        max-height: 70vh;
        overflow-y: auto;
    }

    .modal-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e0e0e0;
    }

    .modal-title {
        font-weight: 600;
    }

    .carousel-inner img {
        max-height: 400px;
        object-fit: cover;
    }

    .list-unstyled {
        padding-left: 0;
    }

    .list-unstyled li {
        margin-bottom: 0.5rem;
    }

    .fw-bold {
        font-weight: 600;
    }

    .btn-close {
        background-color: transparent;
        border: none;
    }
    .separator-line {
        border: none;
        height: 2px;
        background-color: #1f1f1f;
        margin: 10px 0;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="card shadow-xl">
    <div class="card-header">
        <h5 class="card-title">Space Table</h5>
        <h6 class="card-subtitle text-muted">List of spaces in the database</h6>
    </div>
    <div class="card-body">
        <table id="data-table" class="table table-hover" style="width: 100%;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Space Name</th>
                    <th>City</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal for Viewing Space Details -->
<div class="modal fade" id="viewSpaceModal" tabindex="-1" aria-labelledby="viewSpaceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewSpaceModalLabel">Space Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Space Image -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <img id="headerImage" src="" class="img-fluid rounded shadow-sm" alt="Space image" style="object-fit: cover; height: 300px;">
                    </div>
                    <div class="col-md-4">
                        <p id="role" class="fs-5 text-muted"></p>
                        <p id="coworkingSpaceName" class="fs-4 fw-bold"></p>
                        <p id="coworkingSpaceAddress" class="text-muted"></p>
                    </div>
                </div>

                <!-- Space Details -->
                <div class="space-details">
                    <hr class="separator-line"/>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Space Name:</strong> <span id="spaceName"></span></p>
                            <p><strong>Type of Space:</strong> <span id="typeofSpace"></span></p>
                            <p><strong>Description:</strong> <span id="spaceDescription"></span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Opening Date:</strong> <span id="openingDate"></span></p>
                            <p><strong>Available From:</strong> <span id="availableDaysFrom"></span> - <span id="availableDaysTo"></span></p>
                            <p><strong>Operating Hours:</strong> <span id="operatingHoursFrom"></span> - <span id="operatingHoursTo"></span></p>
                        </div>
                    </div>
                    
                    <hr class="separator-line"/>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Email:</strong> <span id="email"></span></p>
                            <p><strong>Facebook:</strong> <span id="facebook"></span></p>
                            <p><strong>Instagram:</strong> <span id="instagram"></span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Phone:</strong> <span id="phone"></span></p>
                            <p><strong>Contact No:</strong> <span id="contact_no"></span></p>
                        </div>
                    </div>
                    
                    <hr class="separator-line"/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="">
                                <h6 class="fw-bold">Basics:</h6>
                                <ul id="basics" class="list-unstyled"></ul>
            
                                <h6 class="fw-bold mt-3">Seats:</h6>
                                <ul id="seats" class="list-unstyled"></ul>
            
                                <h6 class="fw-bold mt-3">Equipments:</h6>
                                <ul id="equipment" class="list-unstyled"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold mt-3">Facilities:</h6>
                            <ul id="facilities" class="list-unstyled"></ul>
        
                            <h6 class="fw-bold mt-3">Accessibility:</h6>
                            <ul id="accessibility" class="list-unstyled"></ul>
        
                            <h6 class="fw-bold mt-3">Perks:</h6>
                            <ul id="perks" class="list-unstyled"></ul>
                        </div>
                    </div>
                    
                    <hr class="separator-line"/>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Latitude:</strong> <span id="latitude"></span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Longitude:</strong> <span id="longitude"></span></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Location:</strong> <span id="location"></span></p>
                            <p><strong>Location:</strong> <span id="telephone"></span></p>
                            <p><strong>Country:</strong> <span id="country"></span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Unit:</strong> <span id="unit"></span></p>
                            <p><strong>Postal Code:</strong> <span id="postal"></span></p>
                            <p><strong>City:</strong> <span id="city"></span></p>
                        </div>
                    </div>
                    
                    <hr class="separator-line"/>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Tables:</strong> <span id="tables"></span></p>
                            <p><strong>Capacity:</strong> <span id="capacity"></span></p>
                            <p><strong>Meeting Rooms:</strong> <span id="meeting_rooms"></span></p>
                            <p><strong>Virtual Offices:</strong> <span id="virtual_offices"></span></p>
                        </div>
                        <div class="col-md-6">
                            {{-- <p><strong>Measurement Unit:</strong> <span id="measurement_unit"></span></p> --}}
                            <p><strong>Size:</strong> <span id="size"></span> <span id="measurement_unit"></span></p>
                        </div>
                    </div>
                </div>

                <hr class="separator-line"/>
                <!-- Image Carousel -->
                <p><strong>Additional Images:</strong></p>
                <div id="additionalImagesCarousel" class="carousel slide mt-3" data-bs-ride="carousel">
                    <div class="carousel-inner" id="carouselItemsContainer"></div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#additionalImagesCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon text-bg-dark" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#additionalImagesCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon text-bg-dark" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <!-- Desks and Meetings -->
                <div class="mt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="fw-bold">Available Desks:</h6>
                            <div id="desk_fields" class="ms-3"></div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold">Available Meetings:</h6>
                            <div id="meeting_fields" class="ms-3"></div>
                        </div>
                    </div>
                </div>

                <hr class="separator-line"/>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Short term:</strong> <span id="short_term"></span></p>
                        <p><strong>Free pass:</strong> <span id="free_pass"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Short term details:</strong> <span id="short_term_details"></span></p>
                        <p><strong>Free pass details:</strong> <span id="free_pass_details"></span></p>
                    </div>
                </div>

                <hr class="separator-line"/>
                {{-- <div class="row">
                    <p><strong>Price:</strong> <span id="price"></span></p>
                </div> --}}

                <div id="map" class="map-container d-flex align-items-center justify-content-center" 
                    style="border: 1px solid #000000; height: 300px; width: 80%; border-radius: 5px; margin: 0 auto;">
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    // Load DataTables
    $(document).ready(function () {
        loadtableData();
    })
    const loadtableData = () => {
            $('#data-table').DataTable({
                'scrollX': true,
            
                'serverSide': true,
                'ajax': {
                    'headers': {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    'url': './myCoworkingSpace',
                    'type': 'GET',
                },
                order: [
                    [0, "asc"],
                ],
                'columns': [
                    {data: 'id'},
                    {data: 'coworking_space_name'},
                    {data: 'coworking_space_address'},
                    {data: 'actions'}
                    
                ]
            });
        }

    // View Space
    let map = null;
let marker = null;

    function viewSpaceDetails(id) {
    // console.log('Fetching details for space ID:', id);
        $.ajax({
            url: './viewSpaceDetails/' + id,
            type: 'GET',
            success: function (response) {
                // console.log(response);
                $('#role').text(response.role);
                $('#coworkingSpaceName').text(response.coworking_space_name);
                $('#coworkingSpaceAddress').text(response.coworking_space_address);
                $('#spaceName').text(response.space_name);
                $('#typeofSpace').text(response.type_of_space);
                $('#spaceDescription').text(response.description);
                $('#openingDate').text(response.opening_date);
                $('#availableDaysFrom').text(response.available_days_from);
                $('#except').text(response.exceptions);
                $('#availableDaysFrom').text(response.available_days_from);
                $('#availableDaysTo').text(response.available_days_to);
                $('#operatingHoursFrom').text(response.operating_hours_from);
                $('#operatingHoursTo').text(response.operating_hours_to);
                $('#email').text(response.email);
                $('#phone').text(response.phone);
                $('#instagram').text(response.instagram);
                $('#facebook').text(response.facebook);
                $('#contact_no').text(response.contact_no);
                $('#location').text(response.location);
                $('#telephone').text(response.telephone);
                $('#country').text(response.country);
                $('#unit').text(response.unit);
                $('#postal').text(response.postal);
                $('#city').text(response.city);
                $('#latitude').text(response.latitude);
                $('#longitude').text(response.longitude);
                $('#tables').text(response.tables);
                $('#capacity').text(response.capacity);
                $('#meeting_rooms').text(response.meeting_rooms);
                $('#virtual_offices').text(response.virtual_offices);
                $('#measurement_unit').text(response.measurement_unit);
                $('#size').text(response.size);
                $('#headerImage').attr('src', response.header_image);
                $('#short_term').text(response.short_term);
                $('#free_pass').text(response.free_pass);
                $('#short_term_details').text(response.short_term_details);
                $('#free_pass_details').text(response.free_pass_details);
                // $('#price').text(response.price);
                const carouselContainer = $('#carouselItemsContainer');
                carouselContainer.empty();

                if (response.additional_images && response.additional_images.length > 0) {
                    response.additional_images.forEach(function(imageUrl, index) {
                        const carouselItem = $('<div>')
                            .addClass('carousel-item')
                            .toggleClass('active', index === 0);

                        const imgElement = $('<img>')
                            .attr('src', imageUrl)
                            .addClass('d-block w-100')
                            .css({ height: '400px', objectFit: 'cover' });

                        carouselItem.append(imgElement);
                        carouselContainer.append(carouselItem);
                    });
                } else {
                    carouselContainer.append('<p>No additional images available.</p>');
                }
                const basics = response.basics || [];
                $('#basics').empty();
                if (basics.length > 0) {
                    basics.forEach(function(basic) {
                        console.log(basic);
                        $('#basics').append('<li>' + basic + '</li>');
                    });
                } else {
                    $('#basics').append('<li>No basics available</li>');
                }

                const seats = response.seats || [];
                $('#seats').empty(); 
                if (seats.length > 0) {
                    seats.forEach(function(seat) {
                        console.log(seat);
                        $('#seats').append('<li>' + seat + '</li>');
                    });
                } else {
                    $('#seats').append('<li>No seats available</li>');
                }

                const equipment = response.equipment || [];
                $('#equipment').empty(); 
                if (equipment.length > 0) {
                    equipment.forEach(function(item) {
                        console.log(item);
                        $('#equipment').append('<li>' + item + '</li>');
                    });
                } else {
                    $('#equipment').append('<li>No equipment available</li>');
                }

                const facilities = response.facilities || [];
                $('#facilities').empty();
                if (facilities.length > 0) {
                    facilities.forEach(function(facility) {
                        console.log(facility);
                        $('#facilities').append('<li>' + facility + '</li>');
                    });
                } else {
                    $('#facilities').append('<li>No facilities available</li>');
                }

                const accessibility = response.accessibility || [];
                $('#accessibility').empty();
                if (accessibility.length > 0) {
                    accessibility.forEach(function(item) {
                        console.log(item);
                        $('#accessibility').append('<li>' + item + '</li>');
                    });
                } else {
                    $('#accessibility').append('<li>No accessibility options available</li>');
                }

                const perks = response.perks || [];
                $('#perks').empty();
                if (perks.length > 0) {
                    perks.forEach(function(perk) {
                        console.log(perk);
                        $('#perks').append('<li>' + perk + '</li>');
                    });
                } else {
                    $('#perks').append('<li>No perks available</li>');
                }
                
                const deskFields = response.desk_fields || [];

                $('#desk_fields').empty();

                if (Array.isArray(deskFields) && deskFields.length > 0) {
                    deskFields.forEach(function(field, index) {
                        const duration = field.duration || "N/A";
                        const price = field.price || "N/A";
                        const hours = field.hours || "N/A";

                        $('#desk_fields').append(`
                            <div class="desk-field">
                                <p><strong>Desk ${index + 1}:</strong></p>
                                <p>Duration: ${duration}</p>
                                <p>Price: ${price}</p>
                                <p>Hours: ${hours}</p>
                            </div>
                        `);
                    });
                } else {
                    $('#desk_fields').append('<p>No desk fields available</p>');
                }

                const meetingFields = response.meeting_fields || [];

                $('#meeting_fields').empty();

                if (Array.isArray(meetingFields) && meetingFields.length > 0) {
                    meetingFields.forEach(function(field, index) {
                        const numPeople = field.num_people || "N/A";
                        const price = field.price || "N/A";
                        const hours = field.hours || "N/A";

                        $('#meeting_fields').append(`
                            <div class="meeting-field">
                                <p><strong>Meeting ${index + 1}:</strong></p>
                                <p>Number of People: ${numPeople}</p>
                                <p>Price: ${price}</p>
                                <p>Hours: ${hours}</p>
                            </div>
                        `);
                    });
                } else {
                    $('#meeting_fields').append('<p>No meeting rooms available</p>');
                }

                const latitude = parseFloat(response.latitude) || 14.587186; // Default latitude
                const longitude = parseFloat(response.longitude) || -239.015398; // Default longitude

                if (map) {
                    map.remove();
                    map = null;
                }

                map = L.map('map').setView([latitude, longitude], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                L.marker([latitude, longitude])
                    .addTo(map)
                    .bindPopup(`<b>${response.space_name}</b><br>${response.coworking_space_address}`)
                    .openPopup();

                $('#viewSpaceModal').on('shown.bs.modal', function () {
                    if (map) {
                        map.invalidateSize();
                    }
                });

                $('#viewSpaceModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching space details:', xhr.responseText);
                alert('Failed to fetch space details. Please try again later.');
            }
        });
    }

    //Delete space
    function deleteSpace(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: './deleteSpace/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        );
                        $('#data-table').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        console.error('Error deleting space:', xhr.responseText);
                        Swal.fire(
                            'Error!',
                            'Failed to delete space. Please try again later.',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>

@endsection