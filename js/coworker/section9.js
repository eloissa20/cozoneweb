$("#submitBtn").click((e) => {
  e.preventDefault();

  const formData = new FormData();

  // Collect Desk Data
  $(".desk-fields").each(function () {
    const duration = $(this).find("#duration").val();
    const price = $(this).find("#deskPrice").val();
    const hours = $(this).find("#deskHours").val();

    if (duration && price && hours) {
      formData.append("desks[]", JSON.stringify({ duration, price, hours }));
    }
  });

  // Collect Meeting Room Data
  $(".meeting-fields").each(function () {
    const numPeople = $(this).find("#numPeople").val();
    const price = $(this).find("#meetingPrice").val();
    const hours = $(this).find("#meetingHours").val();

    if (numPeople && price && hours) {
      formData.append(
        "meetingRooms[]",
        JSON.stringify({ numPeople, price, hours })
      );
    }
  });

  // Section 8
  const virtualService = $('input[name="virtualService"]:checked').val();
  const membership = $('input[name="membership"]:checked').val();
  const membershipDuration = $("#membershipDuration").val();
  const membershipPrice = $("#membershipPrice").val();

  formData.append("virtualService", virtualService);
  formData.append("membership", membership);
  formData.append("membershipDuration", membershipDuration);
  formData.append("membershipPrice", membershipPrice);

  // Section 1
  const role = $('input[name="role"]:checked').val();
  const coworkingSpaceName = $("#coworkingSpaceName").val();
  const coworkingSpaceAddress = $("#coworkingSpaceAddress").val();

  formData.append("role", role);
  formData.append("coworkingSpaceName", coworkingSpaceName);
  formData.append("coworkingSpaceAddress", coworkingSpaceAddress);

  // Section 2
  const spaceName = $("#spaceName").val();
  const typeOfSpace = $("#typeOfSpace").val();
  const description = $("#description").val();
  const openingDate = $("#openingDate").val();
  const availableDaysFrom = $("#availableDaysFrom").val();
  const availableDaysTo = $("#availableDaysTo").val();
  const exceptions = $('input[name="exceptions"]:checked').val();
  const operatingHoursFrom = $("#operatingHoursFrom").val();
  const operatingHoursTo = $("#operatingHoursTo").val();
  const email = $("#email").val();
  const phone = $("#phone").val();
  const instagram = $("#instagram").val();
  const facebook = $("#facebook").val();
  const contactNo = $("#contactNo").val();

  formData.append("spaceName", spaceName);
  formData.append("typeOfSpace", typeOfSpace);
  formData.append("description", description);
  formData.append("openingDate", openingDate);
  formData.append("availableDaysFrom", availableDaysFrom);
  formData.append("availableDaysTo", availableDaysTo);
  formData.append("exceptions", exceptions);
  formData.append("operatingHoursFrom", operatingHoursFrom);
  formData.append("operatingHoursTo", operatingHoursTo);
  formData.append("email", email);
  formData.append("phone", phone);
  formData.append("instagram", instagram);
  formData.append("facebook", facebook);
  formData.append("contactNo", contactNo);

  // Section 3 Data
  const basics = [];
  $('input[name="basics"]:checked').each(function () {
    basics.push($(this).val());
  });
  formData.append("basics", JSON.stringify(basics));

  const seats = [];
  $('input[name="seats"]:checked').each(function () {
    seats.push($(this).val());
  });
  formData.append("seats", JSON.stringify(seats));

  const equipment = [];
  $('input[name="equipment"]:checked').each(function () {
    equipment.push($(this).val());
  });
  formData.append("equipment", JSON.stringify(equipment));

  const facilities = [];
  $('input[name="facilities"]:checked').each(function () {
    facilities.push($(this).val());
  });
  formData.append("facilities", JSON.stringify(facilities));

  const accessibility = [];
  $('input[name="accessibility"]:checked').each(function () {
    accessibility.push($(this).val());
  });
  formData.append("accessibility", JSON.stringify(accessibility));

  const perks = [];
  $('input[name="perks"]:checked').each(function () {
    perks.push($(this).val());
  });
  formData.append("perks", JSON.stringify(perks));

  // Section 4
  const location = $("#location").val();
  const telephone = $("#telephone").val();
  const country = $("#country").val();
  const unit = $("#unit").val();
  const postal = $("#postal").val();
  const city = $("#city").val();
  const latitude = $("#latitude").val();
  const longitude = $("#longitude").val();

  formData.append("location", location);
  formData.append("telephone", telephone);
  formData.append("country", country);
  formData.append("unit", unit);
  formData.append("postal", postal);
  formData.append("city", city);
  formData.append("latitude", latitude);
  formData.append("longitude", longitude);

  // Section 5
  const tables = $("#tables").val();
  const capacity = $("#capacity").val();
  const meetingRoomsCount = $("#meetingRooms").val();
  const virtualOffices = $("#virtualOffices").val();
  const size = $("#size").val();
  const measurementUnit = $('input[name="measurementUnit"]:checked').val();

  formData.append("tables", tables);
  formData.append("capacity", capacity);
  formData.append("meetingRoomsCount", meetingRoomsCount);
  formData.append("virtualOffices", virtualOffices);
  formData.append("size", size);
  formData.append("measurementUnit", measurementUnit);

  // Section 6
  const headerImage = $('input[name="headerImage"]')[0].files[0];
  if (headerImage) {
    formData.append("headerImage", headerImage);
  }
  const additionalImages = $('input[name="additionalImages[]"]')[0].files;
  if (additionalImages.length > 0) {
    for (let i = 0; i < additionalImages.length; i++) {
      formData.append("additionalImages[]", additionalImages[i]);
    }
  }

  // Section 7
  const payOnline = $('input[name="payOnline"]:checked').val();
  const creditCards = $('input[name="creditCards"]:checked').val();
  const eWallet = $('input[name="eWallet"]:checked').val();

  formData.append("payOnline", payOnline);
  formData.append("creditCards", creditCards);
  formData.append("eWallet", eWallet);

  // Section 9
  const shortTerm = $('input[name="shortTerm"]:checked').val();
  const shortTermDetails = $("#shortTermDetails").val();
  const freePass = $('input[name="freePass"]:checked').val();
  const freePassDetails = $("#freePassDetails").val();
  const price = $("#price").val();

  formData.append("shortTerm", shortTerm);
  formData.append("shortTermDetails", shortTermDetails);
  formData.append("freePass", freePass);
  formData.append("freePassDetails", freePassDetails);
  formData.append("price", price);

  // AJAX Call
  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    type: "POST",
    url: "./listSpace",
    data: formData,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (response) {
      console.log(response);
      Swal.fire({
        icon: "success",
        title: "Success",
        text: "Your request has been submitted successfully!",
      }).then(() => {
        localStorage.clear();
        window.location.href = "listSpace";
      });
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error("Error:", textStatus, errorThrown);
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "There was an error submitting your request.",
      });
    },
  });
});

function moveToPreviousStepFromStep9() {
  $("#s9").hide();
  $("#s8").show();
}
