<script type="text/javascript" src="{{ asset('assets/ajax/libs/jquery/1.12.4/jquery.min.js') }}"></script>
<script>
    // Start Bind data to the edit working experience
    $(document).ready(function(e) {
        $(document).on('click','#change_account_password',function(e) {
            var id=$(this).attr("data-passid");
            $('#id_change_password').val(id);
        });
    });
    // End Bind data to the edit working experience

    // Start suspend alumni account
    $(document).on('click', '#suspend_alumni_account', function() {
    var trashid = $(this).data('trashid');
        swal({
            title: "Are you sure you want to suspend this account ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#EF5350",
            confirmButtonText: "Yes, suspend it!",
            cancelButtonText: "No, cancel pls!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('Suspend-Alumni-Account', ['trashid' => ':trashid']) }}'.replace(':trashid', trashid),
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        swal({
                            title: "Suspended!",
                            text: response.message,
                            confirmButtonColor: "#66BB6A",
                            type: "success"
                        });

                        // Redirect to the working experience route after a brief delay
                        setTimeout(function() {
                            window.location.href = '{{ route('User-Management') }}';
                        }, 2000); 
                        // Delay in milliseconds (2 seconds in this example)
                    },
                    error: function(response) {
                        swal({
                            title: "Error",
                            text: response.responseJSON.message,
                            confirmButtonColor: "#2196F3",
                            type: "error"
                        });
                    }
                });
            } else {
                swal({
                    title: "Cancelled",
                    text: "Your record is safe :)",
                    confirmButtonColor: "#2196F3",
                    type: "error"
                });
            }
        });
    });
    // End suspend alumni account

    // Start activate alumni account
    $(document).on('click', '#activate_alumni_account', function() {
    var restoreid = $(this).data('restoreid');
        swal({
            title: "Are you sure you want to restore ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#EF5350",
            confirmButtonText: "Yes, restore it!",
            cancelButtonText: "No, cancel pls!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('Activate-Alumni-Account', ['restoreid' => ':restoreid']) }}'.replace(':restoreid', restoreid),
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        swal({
                            title: "Restored!",
                            text: response.message,
                            confirmButtonColor: "#66BB6A",
                            type: "success"
                        });

                        // Redirect to the working experience route after a brief delay
                        setTimeout(function() {
                            window.location.href = '{{ route('User-Management') }}';
                        }, 2000); 
                        // Delay in milliseconds (2 seconds in this example)
                    },
                    error: function(response) {
                        swal({
                            title: "Error",
                            text: response.responseJSON.message,
                            confirmButtonColor: "#2196F3",
                            type: "error"
                        });
                    }
                });
            } else {
                swal({
                    title: "Cancelled",
                    text: "Your record is safe :)",
                    confirmButtonColor: "#2196F3",
                    type: "error"
                });
            }
        });
    });
    // End activate alumni account

     // Start delete alumni account
     $(document).on('click', '#delete_alumni_account', function() {
    var deleteid = $(this).data('deleteid');
        swal({
            title: "Are you sure you want to delete this account permanent?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#EF5350",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel pls!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('Delete-Alumni-Account', ['deleteid' => ':deleteid']) }}'.replace(':deleteid', deleteid),
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        swal({
                            title: "Deleted!",
                            text: response.message,
                            confirmButtonColor: "#66BB6A",
                            type: "success"
                        });

                        // Redirect to the working experience route after a brief delay
                        setTimeout(function() {
                            window.location.href = '{{ route('User-Management') }}';
                        }, 2000); 
                        // Delay in milliseconds (2 seconds in this example)
                    },
                    error: function(response) {
                        swal({
                            title: "Error",
                            text: response.responseJSON.message,
                            confirmButtonColor: "#2196F3",
                            type: "error"
                        });
                    }
                });
            } else {
                swal({
                    title: "Cancelled",
                    text: "Your record is safe :)",
                    confirmButtonColor: "#2196F3",
                    type: "error"
                });
            }
        });
    });
    // End delete alumni account
</script>