// document.addEventListener("DOMContentLoaded", function () {
//   var userTypeQueryParam = "<?php echo $userType; ?>";

//   // Set the value of the user_type hidden input field based on the URL parameter
//   var userTypeHiddenInput = document.querySelector('input[name="user_type"]');
//   if (userTypeQueryParam && userTypeHiddenInput) {
//     userTypeHiddenInput.value = userTypeQueryParam;
//   }
// });

$(document).ready(function () {

  (function validateForm() {

    // Retrieve the user type from the URL parameter
    var userType = "<?php echo $userType; ?>";

    // Validate each required field based on user type
    // if (userType === 'owner') {
    //   var requiredFields = ["lastname", "middlename", "firstname", "age", "gender", "contact_no", "email", "username", "password"];
    // } else if (userType === 'boarder') {
    //   var requiredFields = ["g_fullname", "g_address", "g_contact_no", "fullname", "age", "gender", "contact_no", "email", "username", "password"];
    // }

    // for (var i = 0; i < requiredFields.length; i++) {
    //   var field = document.getElementById(requiredFields[i]);
    //   if (field.value === "" || field.value === null) {
    //     alert("Please fill in all fields.");
    //     return false; // Prevent form submission
    //   }
    // }

    // if ($("#password").value != $("#retypepassword").value) {
    //   $(".password-error").show();
    //   return false;
    // }

    var pass = $('input[name=password]').val();
    var repass = $('input[name=retypepassword]').val();
    if (($('input[name=password]').val().length == 0) || ($('input[name=retypepassword]').val().length == 0)) {
      $('.password-error').show();
      return false;
    }
    else if (pass != repass) {
      $('.password-error').show();
      return false;
    }
    else {
      $('.password-error').hide();
    }

    // If all fields are filled, allow form submission
    return true;
  })();
});
