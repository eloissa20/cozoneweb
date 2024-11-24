$(document).ready(() => {
  loadLocalStorageStep7();
});

function loadLocalStorageStep7() {
  if (localStorage.getItem("listSpace7") !== null) {
      let data = JSON.parse(localStorage.getItem("listSpace7"));

      if (data.payOnline) {
          $(`input[name="payOnline"][value="${data.payOnline}"]`).prop('checked', true);
      }

      if (data.creditCards) {
          $(`input[name="creditCards"][value="${data.creditCards}"]`).prop('checked', true);
      }

      if (data.eWallet) {
          $(`input[name="eWallet"][value="${data.eWallet}"]`).prop('checked', true);
      }
  }
}

function moveToNextStepFromStep7() {
  const payOnline = $('input[name="payOnline"]:checked').val();
  const creditCards = $('input[name="creditCards"]:checked').val();
  const eWallet = $('input[name="eWallet"]:checked').val();

  // if (!payOnline || !creditCards || !eWallet) {
  //     Swal.fire({
  //         icon: "error",
  //         title: "Incomplete Form",
  //         text: "Please fill out all required fields before proceeding!"
  //     });
  //     return;
  // }

  localStorage.setItem('listSpace7', JSON.stringify({
      payOnline,
      creditCards,
      eWallet
  }));

  $('#s7').hide();
  $('#s8').show();
}

function moveToPreviousStepFromStep7() {
  $('#s7').hide();
  $('#s6').show();
}