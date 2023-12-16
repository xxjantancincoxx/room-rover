$(document).ready(function () {
  const BASE_URL = 'http://localhost/room_rover/';
 // Initialize FormData at a higher scope
 var formData = new FormData();

  // listing table
  const tbl_r = $('#example3').DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [
          [15, 25, 50, -1],
          [15, 25, 50, "All"]
      ],
      searchable: true,
      responsive: true,
      language: {
          search: "_INPUT_",
          info: "Showing _START_ to _END_ of _TOTAL_ Listings",
          loadingRecords: "Loading Listings.....",
          searchPlaceholder: "Search Listings....",
          infoFiltered: "(filtered from _MAX_ total Listings)",
          zeroRecords: "No Listings found",
      },
      columnDefs: [
          {  // set default column settings
              searchable: false,
              orderable: false,
              targets: 0
          }
      ]
  });

  

  // end listing table

  // add listing
$("#save_listing").click(function () {


     // Check if any of the required fields are empty
     if (!$('#li_name').val() || !$('#li_wal').val() || !$('#li_loc').val() || !$('#price').val() || !$('#rooms').val() || !$('#listingpic').val() || !$('#ewallet_qr_code').val() || !$('#we').val() || !$('#aircon').val() || !$('#wifi').val() || !$('#own_cr').val()) {
        Swal.fire({
            title: 'All fields are required!',
            icon: 'error',
            timer: 2000
        });
        return; // Exit the function if any field is empty
    }

    Swal.fire({
        title: `Are you sure to save the listing?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Save listing!',
        allowOutsideClick: false
    }).then((result) => {
        if (result.value) {
            let li_name = $('#li_name').val();
            let li_wal = $('#li_wal').val();
            let li_loc = $('#li_loc').val();
            let price = $('#price').val();
            let rooms = $('#rooms').val();
            let pic = $('#listingpic').prop('files')[0];
            let ewalletQrCode = $('#ewallet_qr_code').prop('files')[0];
            let we = $('#we').val();
            let aircon = $('#aircon').val();
            let wifi = $('#wifi').val();
            let own_cr = $('#own_cr').val();

            formData.append('li_name', li_name);
            formData.append('li_wal', li_wal);
            formData.append('li_loc', li_loc);
            formData.append('price', price);
            formData.append('rooms', rooms);
            formData.append('listingpic', pic);
            formData.append('ewallet_qr_code', ewalletQrCode);
            formData.append('we', we);
            formData.append('aircon', aircon);
            formData.append('wifi', wifi);
            formData.append('own_cr', own_cr);

            try {
                fetch(
                    `${BASE_URL}backend/api/add_listing.php`,
                    {
                        method: 'POST',
                        body: formData,
                    },
                ).then(res => res.json())
                    .then(data => {
                        if (data.error == 0) {
                            Swal.fire({
                                title: `Listing Saved!`,
                                icon: "success",
                                timer: 2000
                            }).then(function () {
                                $('#li_name').val('');
                                $('#price').val('');
                            });
                        } else {
                            // Display an error message using Swal
                            Swal.fire({
                                title: 'Error',
                                text: data.message, // Assuming the server sends an error message
                                icon: 'error',
                            });
                        }
                    })
                    .catch(error => {
                        // Handle network or other errors
                        console.log(error);
                        Swal.fire({
                            title: 'Error',
                            text: 'Failed to communicate with the server.',
                            icon: 'error',
                        });
                    });
            } catch (error) {
                // Handle unexpected errors
                console.log(error);
                Swal.fire({
                    title: 'Error',
                    text: 'An unexpected error occurred.',
                    icon: 'error',
                });
            }
        } // if statement
    });
});


  // end add listing

  // load students
  var loadListings = function () {
      // load
      var a = 1;
      $.get(BASE_URL + 'backend/api/getlistings.php', function (response) {
          console.log(response)
          tbl_r.clear();
          $.each(JSON.parse(response), function (i, key) {
            tbl_r.row.add([a, key.name,key.e_wallet,`<img  width="50" height="50" src="${BASE_URL}backend/api/uploads/OWNER${key.owner_id}/${key.qr_pic}" alt="">`,key.location, key.price, key.rooms_Available, key.is_aircon == 1 ? 'Yes' : 'No', key.free_water_electric == 1 ? 'Yes' : 'No', key.free_wifi == 1 ? 'Yes' : 'No', key.own_cr == 1 ? 'Yes' : 'No', key.date_added, `<img  width="50" height="50" src="${BASE_URL}backend/api/uploads/OWNER${key.owner_id}/${key.pic}" alt="">`, `
    <div class="d-flex">
    <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1 edit-btn" id="edit-btn" data-listing-id="${key.listing_id}">
        <i class="fa fa-pencil"></i>
    </a>
    <button type="button" class="btn delete btn-danger shadow btn-xs sharp" data-listing-id="${key.listing_id}">
        <i class="fa fa-trash"></i>
    </button>
</div>`]);

              a++;
          });
          tbl_r.draw();
          $("#listing_count").text(a);
          // Add event listener for delete buttons
          $('.delete').on('click', function () {
              var listingId = $(this).data('listing-id');
              deleteListing(listingId);
          });
      });
      // end load
  };

  loadListings();

  // end get employees
  
  $('#example3').on('click', '.delete', function () {
    var listingId = $(this).data('listing-id');
    deleteListing(listingId);
});

  function deleteListing(listingId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) { // Use result.value instead of result.isConfirmed
            $.ajax({
                type: 'POST',
                url: `${BASE_URL}backend/api/delete_listing.php`,
                data: { listingId: listingId },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Listing Deleted!',
                            text: 'The listing has been deleted.',
                        }).then(() => {
                            loadListings();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to delete the listing.',
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to delete the listing.',
                    });
                }
            });
        }
    });
}


// edit listing
$('#example3').on('click', '.edit-btn', function () {
    console.log('Edit button clicked');
    // Get the listing_id from the button's data-listing-id attribute
    var listingId = $(this).data('listing-id');
    console.log('Listing ID:', listingId);

     // Set the data-listing-id attribute on the edit modal
     $('#editListingModal').data('listing-id', listingId);
    // Fetch the details for the selected listing
    $.get(`${BASE_URL}backend/api/get_listing_details.php?listingId=${listingId}`, function (response) {
        console.log('Response from server:', response);

        // Populate the edit modal with the listing details
        if (response.error) {
            // Handle error
            console.error(response.error);
            return;
        }
// Assuming you have input fields in your modal with IDs like 'editLiName', 'editPrice', etc.
$('#editLiName').val(response.name);
$('#editLiWal').val(response.e_wallet);
$('#editLiLoc').val(response.location);
$('#editPrice').val(response.price);
$('#editRooms').val(response.rooms_Available);

// Update the 'src' attribute for the image preview
$('#editListingPicPreview').attr('src', `${BASE_URL}backend/api/uploads/OWNER${sessionId}/${response.pic}`);

// Set the value of the file input display field to the file name (response.pic)
$('#editListingPic').val(response.pic);

$('#editWe').val(response.free_water_electric);
$('#editAircon').val(response.is_aircon);
$('#editWifi').val(response.free_wifi);
$('#editOwnCr').val(response.own_cr);

 // Listen for changes in the file input
$('#editListingPicInput').on('change', function () {
    // Check if a file is selected
    if (this.files.length > 0) {
        // Display the preview
        const reader = new FileReader();
        reader.onload = function (e) {
            $('#editListingPicPreview').attr('src', e.target.result);
        };
        reader.readAsDataURL(this.files[0]);

        // Append the file to the FormData object
        formData.append('editListingPic', this.files[0]);
    }
});






        // Open the edit modal
        $('#editListingModal').modal('show');
    });
});
// Add event listener for saveEditListingBtn
$('#saveEditListingBtn').on('click', function () {
    // Get the listing_id from the button's data-listing-id attribute
    var listingId = $('#editListingModal').data('listing-id');

    // Get the edited values from the input fields
    var newLiName = $('#editLiName').val();
    var newLiWal = $('#editLiWal').val();
    var newLiLoc = $('#editLiLoc').val();
    var newPrice = $('#editPrice').val();
    var newRooms = $('#editRooms').val();
    var newWe = $('#editWe').val();
    var newAircon = $('#editAircon').val();
    var newWifi = $('#editWifi').val();
    var newOwnCr = $('#editOwnCr').val();

    // Append the rest of the form data to FormData
    formData.append('listingId', listingId);
    formData.append('newLiName', newLiName);
    formData.append('newLiWal', newLiWal);
    formData.append('newLiLoc', newLiLoc);
    formData.append('newPrice', newPrice);
    formData.append('newRooms', newRooms);
    formData.append('newWe', newWe);
    formData.append('newAircon', newAircon);
    formData.append('newWifi', newWifi);
    formData.append('newOwnCr', newOwnCr);

    try {
        fetch(`${BASE_URL}backend/api/edit_listing.php`, {
            method: 'POST',
            body: formData,
        })
            .then((res) => res.json())
            .then((response) => {
                if (response.success) {
                    // If the listing is successfully edited, show a success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Listing Edited!',
                        text: 'The listing has been edited.',
                    }).then(() => {
                        // Close the edit modal
                        $('#editListingModal').modal('hide');
                        // Reload the page or update the table
                        loadListings();
                    });
                } else {
                    // If an error occurs, show an error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to edit the listing.',
                    });
                }
            })
            .catch((error) => {
                console.log(error);
            });
    } catch (error) {
        console.log(error);
    }
});


});
