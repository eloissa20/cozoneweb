$(() => {
  loadLocalStorageStep2();
});

function loadLocalStorageStep2() {
  if (localStorage.getItem("listSpace2") !== null) {
    let data = JSON.parse(localStorage.getItem("listSpace2"));
    $("#spaceName").val(data.spaceName);
    $("#typeOfSpace").val(data.typeOfSpace);
    $("#description").val(data.description);
    $("#openingDate").val(data.openingDate);
    $("#availableDays").val(data.availableDays);
    $("#operatingHours").val(data.operatingHours);
    $("#email").val(data.email);
    $("#phone").val(data.phone);
    $("#instagram").val(data.instagram);
    $("#facebook").val(data.facebook);
    $("#contactNo").val(data.contactNo);
  }
}

function moveToNextStepFromStep2() {
  const spaceName = $("#spaceName").val();
  const typeOfSpace = $("#typeOfSpace").val();
  const description = $("#description").val();
  const openingDate = $("#openingDate").val();
  const availableDays = $("#availableDays").val();
  const operatingHours = $("#operatingHours").val();
  const email = $("#email").val();
  const phone = $("#phone").val();
  const instagram = $("#instagram").val();
  const facebook = $("#facebook").val();
  const contactNo = $("#contactNo").val();

  if (
    !spaceName ||
    !typeOfSpace ||
    !description ||
    !openingDate ||
    !availableDays ||
    !operatingHours ||
    !email ||
    !phone ||
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
      typeOfSpace,
      description,
      openingDate,
      availableDays,
      operatingHours,
      email,
      phone,
      instagram,
      facebook,
      contactNo,
    })
  );

  $("#s2").hide();
  $("#s3").show();
}

function moveToPreviousStepFromStep2() {
  $("#s2").hide();
  $("#s1").show();
}
