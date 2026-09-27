<script type="text/javascript" src="{{ asset('assets/ajax/libs/jquery/1.12.4/jquery.min.js') }}"></script>
<script>

    // Start Bind data to the edit education background
    $(document).ready(function(e) {
        $(document).on('click','#edit_education_background',function(e) {
            var id=$(this).attr("data-id");
            var start_year_val=$(this).attr("data-startyear");
            var end_year_val=$(this).attr("data-endyear");
            var qualification_val=$(this).attr("data-qualification");
            $('#id_education').val(id);
            $('#start_year_education').val(start_year_val);
            $('#end_year_education').val(end_year_val);
            $('#qualification_education').val(qualification_val);
        });
    });
    // End Bind data to the edit education background

    // Start to softdelete education background
    $(document).on('click', '#trash_education_background', function() {
    var trashid = $(this).data('trashid');
        swal({
            title: "Are you sure you want to delete?",
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
                    url: '{{ route('Destroy-Education-Background', ['trashid' => ':trashid']) }}'.replace(':trashid', trashid),
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

                        // Redirect to the education route after a brief delay
                        setTimeout(function() {
                            window.location.href = '{{ route('Education-Background') }}';
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
    // End to softdelete education background

    // Start to restore education background
    $(document).on('click', '#undo_education_background', function() {
    var restoreid = $(this).data('restoreid');
        swal({
            title: "Are you sure you want to restore?",
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
                    url: '{{ route('Restore-Education-Background', ['restoreid' => ':restoreid']) }}'.replace(':restoreid', restoreid),
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

                        // Redirect to the education route after a brief delay
                        setTimeout(function() {
                            window.location.href = '{{ route('Education-Background') }}';
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
    // End to restore education background
    
    // Start delete education background
    $(document).on('click', '#delete_education_background', function() {
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
                    url: '{{ route('Delete-Education-Background', ['deleteid' => ':deleteid']) }}'.replace(':deleteid', deleteid),
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

                        // Redirect to the education route after a brief delay
                        setTimeout(function() {
                            window.location.href = '{{ route('Education-Background') }}';
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
    // End delete education background

</script>
