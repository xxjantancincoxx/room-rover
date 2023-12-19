<?php include('layouts/header.php') ?>

<style>
	.main {
		background-color: #656C74;
		height: 88vh;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
	}

	.box {
		position: absolute;
		margin-top: 2.5rem;
		top: 50%;
		left: 50%;
		height: 530px;
		width: 90%;
		padding: 0 50px;
		transform: translate(-50%, -50%);
		background: #656C78;
		box-sizing: border-box;
		box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
		border-radius: 10px;
	}

	.main .signup-label {
		padding: 2rem;
		margin-bottom: 1rem;
	}

	.main .signup-label h3 {
		font-weight: bold;
		text-align: center;
	}


	.button {
		margin-top: 30px;
		display: flex;
		justify-content: space-between;
		align-items: center;
		width: 100%;
		/* border: 1px solid red; */
	}

	button {
		display: flex;
		align-items: center;
		justify-content: center;
		outline: none;
		cursor: pointer;
		width: 120px;
		height: 40px;
		background-image: linear-gradient(to top, #D8D9DB 0%, #fff 80%, #FDFDFD 100%);
		border-radius: 30px;
		border: 1px solid #8F9092;
		transition: all 0.2s ease;
		font-family: "Source Sans Pro", sans-serif;
		font-size: 14px;
		font-weight: 600;
		color: #606060;
		text-shadow: 0 1px #fff;
	}

	button:hover {
		box-shadow: 0 6px 5px 3px #656C74, 0 9px 11px #656C74, 0 -1px 7px #656C74, 0 -3px 7px #656C74, inset 0 0 6px 6px #CECFD1;
	}

	button:active {
		box-shadow: 0 6px 5px 3px #656C74, 0 9px 11px #656C74, 0 -1px 7px #656C74, 0 -3px 7px #656C74, inset 0 0 6px 6px #999, inset 0 0 30px #aaa;
	}

	button:focus {
		box-shadow: 0 6px 5px 3px #656C74, 0 9px 11px #656C74, 0 -1px 7px #656C74, 0 -3px 7px #656C74, inset 0 0 6px 6px #999, inset 0 0 30px #aaa;
	}

	.signup p {
		color: #FFFFFF;
	}

	.signup p a {
		color: #2A2A2A;
		font-weight: bold;
	}

	.next-show {
		position: relative;
		display: flex;
		flex-direction: column;
		justify-content: center;
		top: 15rem;
		transform: translateX(-50%);
		color: black;
		font-weight: bold;
		font-size: 18px;
		animation: move-up-down 3s infinite;
	}

	.next-show i {
		font-size: 12px;
		text-align: center;
	}

	.next-show span {
		display: block;
		font-size: 14px;
		font-weight: bold;
	}
</style>

<body>
	<?php include('layouts/navigation.php') ?>

	<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Welcome to Room Rover, your go-to platform for room listings and accommodations. By using our services, you agree to the following terms and conditions:</p>

					<h6>1. Account Registration</h6>
					<p>You must create an account to list a room or book accommodations. Ensure that the information provided is accurate and up-to-date. You are responsible for maintaining the confidentiality of your account credentials.</p>

					<h6>2. Room Listings</h6>
					<p>Individuals listing rooms on Room Rover must provide accurate and detailed information about the property. Misleading or false information is strictly prohibited. Room Rover reserves the right to remove any listing that violates these terms.</p>

					<h6>3. User Conduct</h6>
					<p>Users are expected to engage respectfully and professionally on the platform. Any form of harassment, discrimination, or harmful behavior towards others will result in the immediate suspension of the user's account.</p>

					<h6>4. Payments and Transactions</h6>
					<p>All financial transactions conducted on Room Rover are subject to our payment policies. Users must adhere to the agreed-upon terms and complete transactions promptly and honestly.</p>

					<h6>5. Privacy and Data Security</h6>
					<p>Room Rover takes user privacy seriously. Personal information provided during registration and transactions is handled in accordance with our privacy policy. Users are encouraged to review our privacy policy for more details.</p>

					<h6>6. Termination of Account</h6>
					<p>Room Rover reserves the right to terminate or suspend user accounts that violate our terms and conditions. Users will be notified of any actions taken, and appeals can be submitted for review.</p>

					<p>By continuing to use Room Rover, you acknowledge that you have read and agree to these terms and conditions. Room Rover may update these terms periodically, and it is your responsibility to stay informed of any changes.</p>
				</div>
			</div>
		</div>
	</div>

	<div class="main">
		<div class="box">
			<div class="signup-label">
				<h3>Signup your account</h3>
			</div>
			<div class="signup">
				<form class="row g-3" action="backend/signup.php" method="post">

					<?php
					// Retrieve the user type from the URL parameter
					$userType = isset($_GET['type']) ? $_GET['type'] : '';

					// Display additional fields based on the user type
					if ($userType) {
						if ($userType == 'owner') {
							include('layouts/signup_owner.php');
						} else if ($userType == 'boarder') {
							include('layouts/signup_boarder.php');
						}
					} else {
						echo "<script>location.replace('select_user_type.php')</script>";
						exit();
					}
					?>


					<input type="hidden" name="user_type" value="<?php echo $userType; ?>">


					<div class="button">

						<p>By signing up, you agree to our <a href="#" data-toggle="modal" data-target="#termsModal">Terms and Conditions</a>.</p>
						<button type="submit" onclick="return validateForm()">Sign up</button>
					</div>

				</form>
			</div>
		</div>


	</div>

	<!-- Terms and Conditions Modal -->
	<div id="termsModal" class="modal">
		<div class="modal-content">
			<span class="close" onclick="closeModal()">&times;</span>
			<h3>Terms and Conditions</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. ...</p>
			<!-- Add your terms and conditions content here -->
		</div>
	</div>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var userTypeQueryParam = "<?php echo $userType; ?>";

			// Set the value of the user_type hidden input field based on the URL parameter
			var userTypeHiddenInput = document.querySelector('input[name="user_type"]');
			if (userTypeQueryParam && userTypeHiddenInput) {
				userTypeHiddenInput.value = userTypeQueryParam;
			}
		});

		function validateForm() {
			// Retrieve the user type from the URL parameter
			var userType = "<?php echo $userType; ?>";

			// Validate each required field based on user type
			if (userType === 'owner') {
				var requiredFields = ["lastname", "middlename", "firstname", "age", "gender", "contact_no", "email", "username", "password", "user_type"];
			} else if (userType === 'boarder') {
				var requiredFields = ["g_lastname", "g_middlename", "g_firstname", "g_address", "lastname", "middlename", "firstname", "age", "gender", "contact_no", "email", "username", "password", "user_type"];
			}

			for (var i = 0; i < requiredFields.length; i++) {
				var field = document.getElementById(requiredFields[i]);
				if (field.value === "" || field.value === null) {
					alert("Please fill in all fields.");
					return false; // Prevent form submission
				}
			}

			// If all fields are filled, allow form submission
			return true;
		}
	</script>


	<?php include('layouts/footer.php') ?>

</body>