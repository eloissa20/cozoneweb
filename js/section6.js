$(document).ready(() => {
  loadLocalStorageStep6();
});

function loadLocalStorageStep6() {
  if (localStorage.getItem("listSpace6") !== null) {
    let data = JSON.parse(localStorage.getItem("listSpace6"));

    if (data.headerImage) {
      $("#imagePreview").attr("src", data.headerImage).show();
    }
  }
}

// Preview header image
$('input[name="headerImage"]').on("change", function (event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      $("#imagePreview").attr("src", e.target.result).show();
    };
    reader.readAsDataURL(file);
  }
});

// Preview additional images
$('input[name="additionalImages[]"]').on('change', function (event) {
  $('#additionalImagesPreview').html(''); // Clear previous previews
  const files = event.target.files;
  if (files.length > 0) {
      Array.from(files).forEach(file => {
          const reader = new FileReader();
          reader.onload = function (e) {
              $('#additionalImagesPreview').append(
                  `<img src="${e.target.result}" style="width: 100px; height: auto; margin-right: 10px;" alt="Image Preview" />`
              );
          };
          reader.readAsDataURL(file);
      });
  }
});

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
    localStorage.setItem(
      "listSpace6",
      JSON.stringify({
        headerImage: e.target.result,
      })
    );

    $("#s6").hide();
    $("#s7").show();
  };
  reader.readAsDataURL(headerImage);
}

function moveToPreviousStepFromStep6() {
  $("#s6").hide();
  $("#s5").show();
}
