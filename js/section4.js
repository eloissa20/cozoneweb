$(() => {
  loadLocalStorageStep4();
});

function loadLocalStorageStep4() {
  if (localStorage.getItem("listSpace4") !== null) {
    let data = JSON.parse(localStorage.getItem("listSpace4"));
    $("#location").val(data.location);
    $("#telephone").val(data.telephone);
    $("#country").val(data.country);
    $("#unit").val(data.unit);
    $("#postal").val(data.postal);
    $("#city").val(data.city);
  }
}

function moveToNextStepFromStep4() {
  const location = $("#location").val();
  const telephone = $("#telephone").val();
  const country = $("#country").val();
  const unit = $("#unit").val();
  const postal = $("#postal").val();
  const city = $("#city").val();

  if (!location || !telephone || !country || !unit || !postal || !city) {
    Swal.fire({
      icon: "error",
      title: "Incomplete Form",
      text: "Please fill out all required fields before proceeding!",
    });
    return;
  }

  localStorage.setItem(
    "listSpace4",
    JSON.stringify({
      location,
      telephone,
      country,
      unit,
      postal,
      city,
    })
  );

  $("#s4").hide();
  $("#s5").show();
}

function moveToPreviousStepFromStep4() {
  $("#s4").hide();
  $("#s3").show();
}
