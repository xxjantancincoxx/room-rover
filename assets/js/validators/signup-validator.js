$(document).ready(function(){var r;$("#form-sign-up").on("submit",function(r){var a=!0,n=$("#password").val(),o=$("#retypepassword").val();if(n!=o&&(alert("Password do not match!"),a=!1),!a){r.preventDefault();return}})});