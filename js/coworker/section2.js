$(() => {
  loadLocalStorageStep2();
});

function loadLocalStorageStep2() {
  if (localStorage.getItem("listSpace2") !== null) {
    let data = JSON.parse(localStorage.getItem("listSpace2"));
    $("#spaceName").val(data.spaceName);
    $("#description").val(data.description);
    $("#openingDate").val(data.openingDate);
    $("#availableDaysFrom").val(data.availableDaysFrom);
    $("#availableDaysTo").val(data.availableDaysTo);
    $("#operatingHoursFrom").val(data.operatingHoursFrom);
    $("#operatingHoursTo").val(data.operatingHoursTo);
    $("#email").val(data.email);
    $("#instagram").val(data.instagram);
    $("#facebook").val(data.facebook);
    $("#contactNo").val(data.contactNo);

    if (data.exceptions) {
      $(`input[name="exceptions"][value="${data.exception}"]`).prop(
        "checked",
        true
      );
    }
  }
}

function moveToNextStepFromStep2() {
  const spaceName = $("#spaceName").val();
  const description = $("#description").val();
  const openingDate = $("#openingDate").val();
  const availableDaysFrom = $("#availableDaysFrom").val();
  const availableDaysTo = $("#availableDaysTo").val();
  const operatingHoursFrom = $("#operatingHoursFrom").val();
  const operatingHoursTo = $("#operatingHoursTo").val();
  const email = $("#email").val();
  const instagram = $("#instagram").val();
  const facebook = $("#facebook").val();
  const contactNo = $("#contactNo").val();
  const exceptions = $('input[name="exceptions"]:checked').val();

  if (
    !spaceName ||
    !description ||
    !openingDate ||
    !availableDaysFrom ||
    !availableDaysTo ||
    !operatingHoursFrom ||
    !operatingHoursTo ||
    !email ||
    !instagram ||
    !facebook ||
    !contactNo
  ) {
    Swal.fire({
      icon: "error",
      title: "Incomplete Form",
      text: "Please fill out all required fields before proceeding!",
    });
    return;
  }

  localStorage.setItem(
    "listSpace2",
    JSON.stringify({
      spaceName,
      description,
      openingDate,
      availableDaysFrom,
      availableDaysTo,
      operatingHoursFrom,
      operatingHoursTo,
      email,
      instagram,
      facebook,
      contactNo,
      exceptions,
    })
  );

  $("#s2").hide();
  $("#s3").show();
}

function moveToPreviousStepFromStep2() {
  $("#s2").hide();
  $("#s1").show();
}
