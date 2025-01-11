$(() => {
  loadLocalStorageStep3();
});

function loadLocalStorageStep3() {
  const data = JSON.parse(localStorage.getItem("listSpace3"));

  if (data) {
    loadCheckboxes(data.basics, ".basic-container");
    loadCheckboxes(data.seats, ".seat-container");
    loadCheckboxes(data.equipment, ".equipment-container");
    loadCheckboxes(data.facilities, ".facilities-container");
    loadCheckboxes(data.accessibility, ".accessibility-container");
    loadCheckboxes(data.perks, ".perks-container");
  }
}

function loadCheckboxes(items, container) {
  if (Array.isArray(items)) {
    $(`${container} input[type="checkbox"]`).prop("checked", false);
    items.forEach((item) => {
      $(`${container} input[type="checkbox"][value="${item}"]`).prop(
        "checked",
        true
      );
    });
  }
}

function moveToNextStepFromStep3() {
  const formData = {
    basics: [],
    seats: [],
    equipment: [],
    facilities: [],
    accessibility: [],
    perks: [],
  };

  $('input[type="checkbox"]').each(function () {
    const name = $(this).attr("name");
    if (name && $(this).is(":checked")) {
      formData[name].push($(this).val());
    }
  });

  // if (formData.basics.length === 0) {
  //     Swal.fire({
  //         icon: "error",
  //         title: "Incomplete Form",
  //         text: "Please select at least one option in the Basics section!"
  //     });
  //     return;
  // }

  localStorage.setItem("listSpace3", JSON.stringify(formData));

  $("#s3").hide();
  $("#s4").show();
}

function moveToPreviousStepFromStep3() {
  $("#s3").hide();
  $("#s2").show();
}
