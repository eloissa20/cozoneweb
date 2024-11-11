$(document).ready(() => {
  loadLocalStorageStep6();
});

// Function to load saved data from localStorage
function loadLocalStorageStep6() {
  if (localStorage.getItem("listSpace6") !== null) {
    let data = JSON.parse(localStorage.getItem("listSpace6"));

    if (data.headerImage) {
      // Set the preview image if it exists in localStorage
      $("#imagePreview").attr("src", data.headerImage).show(); // Show the preview
    }
  }
}

// Handle the file input change
$('input[name="headerImage"]').on("change", function (event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      // Set the image preview to the FileReader result
      $("#imagePreview").attr("src", e.target.result).show(); // Show the image preview
    };
    reader.readAsDataURL(file); // Read the file as a Data URL
  }
});

// Function to save data and move to the next step
function moveToNextStepFromStep6() {
  const fileInput = $('input[name="headerImage"]')[0];
  const headerImage = fileInput.files.length > 0 ? fileInput.files[0] : null;

  if (!headerImage) {
    Swal.fire({
      icon: "error",
      title: "Incomplete Form",
      text: "Please upload a header image before proceeding!",
    });
    return;
  }

  const reader = new FileReader();
  reader.onload = function (e) {
    // Save the image data URL to local storage
    localStorage.setItem(
      "listSpace6",
      JSON.stringify({
        headerImage: e.target.result, // Store the Data URL
      })
    );

    // Move to the next step
    $("#s6").hide();
    $("#s7").show();
  };
  reader.readAsDataURL(headerImage); // Read the file as a Data URL
}

// Function to move to the previous step
function moveToPreviousStepFromStep6() {
  $("#s6").hide();
  $("#s5").show();
}
