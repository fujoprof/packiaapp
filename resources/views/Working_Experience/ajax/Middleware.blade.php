<script type="text/javascript" src="{{ asset('assets/ajax/libs/jquery/1.12.4/jquery.min.js') }}"></script>
<script>

    // Start Bind data to the edit working experience
    $(document).ready(function(e) {
        $(document).on('click','#edit_working_experience',function(e) {
            var id=$(this).attr("data-id");
            var start_year_val=$(this).attr("data-startyear");
            var end_year_val=$(this).attr("data-endyear");
            var organization_val=$(this).attr("data-organization");
            $('#id_experience').val(id);
            $('#start_year_experience').val(start_year_val);
            $('#end_year_experience').val(end_year_val);
            $('#working_experience').val(organization_val);
        });
    });
    // End Bind data to the edit working experience

    // Start to softdelete working experience
    $(document).on('click', '#trash_working_experience', function() {
    var trashid = $(this).data('trashid');
        swal({
            title: "Are you sure you want to trash it?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#EF5350",
            confirmButtonText: "Yes, trash it!",
            cancelButtonText: "No, cancel pls!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('Destroy-Working-Experience', ['trashid' => ':trashid']) }}'.replace(':trashid', trashid),
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        swal({
                            title: "Trashed!",
                            text: response.message,
                            confirmButtonColor: "#66BB6A",
                            type: "success"
                        });

                        // Redirect to the working experience route after a brief delay
                        setTimeout(function() {
                            window.location.href = '{{ route('View-Working-Experience') }}';
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
    // End to softdelete working experience

    // Start to restore working experience
    $(document).on('click', '#undo_working_experience', function() {
    var restoreid = $(this).data('restoreid');
        swal({
            title: "Are you sure you want to restote?",
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
                    url: '{{ route('Restore-Working-Experience', ['restoreid' => ':restoreid']) }}'.replace(':restoreid', restoreid),
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
                            window.location.href = '{{ route('View-Working-Experience') }}';
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
    // End to restore working experience
    
    // Start delete working experience
    $(document).on('click', '#delete_working_experience', function() {
    var deleteid = $(this).data('deleteid');
        swal({
            title: "Are you sure you want to delete this data permanent?",
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
                    url: '{{ route('Delete-Working-Experience', ['deleteid' => ':deleteid']) }}'.replace(':deleteid', deleteid),
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
                            window.location.href = '{{ route('View-Working-Experience') }}';
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
    // End delete working experience

</script>
