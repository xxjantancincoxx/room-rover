<div class="container">
  <div class="row">
    <div class="col-md right-border">
      <div class="d-flex justify-content-center border-bottom">
        <div>
          <h5>Guardian's Information</h5>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-6 mt-3">
          <label for="validationFullname">Full name:<span class="text-danger"> *</span></label>
          <input type="text" class="form-control" name="g_fullname" id="g_fullname"required>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-6 mt-3">
          <label for="validationAddress">Address:<span class="text-danger"> *</span></label>
          <input type="text" class="form-control" name="g_address" id="g_address" required>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-6 mt-3">
          <label for="validationGcontact">Contact Number:<span class="text-danger"> *</span></label>
          <input type="number" class="form-control" name="g_contact_no" id="g_contact_no" required>
        </div>
      </div>
    </div>
    <div class="vl"></div>
    <div class="col-md left-border">
      <div class="d-flex justify-content-center border-bottom">
        <div>
          <h5>Boarder's Information</h5>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-6 mt-3">
          <label for="validationfullname">Full name:<span class="text-danger"> *</span></label>
          <input type="text" class="form-control" name="fullname" id="fullname" required>
        </div>
        <div class="col-md-6 mt-3">
          <label for="validationage">Age:<span class="text-danger"> *</span></label>
          <input type="number" class="form-control" name="age" id="age" value="" required>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-6 mt-3">
          <label for="validationGender">Gender:<span class="text-danger"> *</span></label>
          <select class="form-control" name="gender" id="gender">
            <option>Male</option>
            <option>Female</option>
          </select>
        </div>
        <div class="col-md-6 mt-3">
          <label for="validationemail">Email:<span class="text-danger"> *</span></label>
          <input type="email" class="form-control" name="email" id="email" required>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-6 mt-3">
          <label for="validationcontactnumber">Contact Number:<span class="text-danger"> *</span></label>
          <input type="number" class="form-control" name="contact_no" id="contact_no" required>
        </div>
        <div class="col-md-6 mt-3">
          <label for="validationusername">Username:<span class="text-danger"> *</span></label>
          <input type="text" class="form-control" name="username" id="username" required>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-6 mt-3">
          <label for="validationtpassword">Password:<span class="text-danger"> *</span></label>
          <input type="password" class="form-control password" name="password" id="password" required>
          <span class="password-error text-danger">Password do not match!</span>
        </div>
        <div class="col-md-6 mt-3">
          <label for="validationretypepassword">Re-type Password:<span class="text-danger"> *</span></label>
          <input type="password" class="form-control retypepassword" name="retypepassword" id="retypepassword" required>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-5">
    <div class="button w-100 mt-5">
      <div class="d-flex justify-content-between mt-4">
        <p class="text-dark mt-2">By signing up, you agree to our <a href="#" data-toggle="modal" data-target="#termsModal">Terms and Conditions</a>.</p>
        <button type="submit" class="btn btn-secondary" onclick="return validateForm()">Sign up</button>
      </div>
    </div>
  </div>



  <!-- <div class="division" style="display:flex; width:100%; justify-content:center; align-items:center; gap:10px; padding:5px 0">
  <span style="width:40%; background-color:white; height:1px"></span>
  <p style="color:black; font-weight:bold">Your Guardian</p> <span style="width:40%; background-color:white; height:1px"></span>
</div>
<div class="col-md-3">
  <label for="g_lastname" class="form-label">Lastname</label>
  <input type="text" class="form-control" id="g_lastname" name="g_lastname" placeholder="">
</div>
<div class="col-md-3">
  <label for="g_middlename" class="form-label">Middlename</label>
  <input type="text" class="form-control" id="g_middlename" name="g_middlename" placeholder="">
</div>
<div class="col-md-3">
  <label for="g_firstname" class="form-label">Firstname</label>
  <input type="text" class="form-control" id="g_firstname" name="g_firstname" placeholder="">
</div>
<div class="col-md-3">
  <label for="g_address" class="form-label">Address</label>
  <input type="text" class="form-control" id="g_address" name="g_address" placeholder="">
</div>
<div class="division mt-3" style="display:flex; width:100%; justify-content:center; align-items:center; gap:10px; padding:5px 0">
  <span style="width:40%; background-color:white; height:1px"></span>
  <p style="color:black; font-weight:bold">Boarder Information</p> <span style="width:40%; background-color:white; height:1px"></span>
</div>
<div class="col-md-3">
  <label for="lastname" class="form-label">Lastname</label>
  <input type="text" class="form-control" id="lastname" name="lastname" placeholder="">
</div>
<div class="col-md-3">
  <label for="middlename" class="form-label">Middlename</label>
  <input type="text" class="form-control" id="middlename" name="middlename" placeholder="">
</div>
<div class="col-md-3">
  <label for="firstname" class="form-label">Firstname</label>
  <input type="text" class="form-control" id="firstname" name="firstname" placeholder="">
</div>
<div class="col-md-1">
  <label for="age" class="form-label">Age</label>
  <input type="number" class="form-control" id="age" name="age" placeholder="">
</div>
<div class="col-md-2">
  <label for="gender" class="form-label">Gender</label>
  <select class="form-control" name="gender" id="gender">
    <option selected>Choose...</option>
    <option value="male">Male</option>
    <option value="female">Female</option>
  </select>
</div>
<div class="col-md-3 mt-3">
  <label for="contact_no" class="form-label">Contact No.</label>
  <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="example@gmail.com">
</div>
<div class="col-md-3 mt-3">
  <label for="email" class="form-label">Email</label>
  <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com">
</div>
<div class="col-md-2 mt-3">
  <label for="username" class="form-label">Username</label>
  <input type="text" class="form-control" id="username" name="username" placeholder="Username">
</div>
<div class="col-md-2 mt-3">
  <label for="password" class="form-label">Password</label>
  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
</div> -->