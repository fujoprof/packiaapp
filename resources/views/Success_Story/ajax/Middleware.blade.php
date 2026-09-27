<script type="text/javascript" src="{{ asset('assets/ajax/libs/jquery/1.12.4/jquery.min.js') }}"></script>
<script>

    // Start Bind data to the edit success story
    $(document).ready(function(e) {
        $(document).on('click','#edit_success_story',function(e) {
            var id=$(this).attr("data-id");
            var title_val=$(this).attr("data-title");
            var content_val=$(this).attr("data-content");
            $('#id_edit_story').val(id);
            $('#title_edit').val(title_val);
            $('#content_edit').val(content_val);
        });
    });
    // End Bind data to the edit success story

    // Start Bind data to the edit image profile
    $(document).ready(function(e) {
        $(document).on('click','#edit_profile_image',function(e) {
            var id=$(this).attr("data-id");
            var title=$(this).attr("data-title");
            var image_path=$(this).attr("data-image");
            var image_val = "{{ asset('') }}" + image_path; // Use asset to generate the complete image URL
            $('#id_image').val(id);
            $('#post_title').text(title);
            $('#post_image').attr('src', image_val);
            $('#post_image_link').attr('href', image_val);
        });
    });
    // End Bind data to the edit image profile

    // Start to softdelete success story
    $(document).on('click', '#trash_success_story', function() {
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
                    url: '{{ route('Destroy-Success-Story', ['trashid' => ':trashid']) }}'.replace(':trashid', trashid),
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
                            window.location.href = '{{ route('View-Success-Story') }}';
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
    // End to softdelete success story

    // Start to restore success story
    $(document).on('click', '#undo_success_story', function() {
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
                    url: '{{ route('Restore-Success-Story', ['restoreid' => ':restoreid']) }}'.replace(':restoreid', restoreid),
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
                            window.location.href = '{{ route('View-Success-Story') }}';
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
    // End to restore success story
    
    // Start delete success story
    $(document).on('click', '#delete_success_story', function() {
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
                    url: '{{ route('Delete-Success-Story', ['deleteid' => ':deleteid']) }}'.replace(':deleteid', deleteid),
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
                            window.location.href = '{{ route('View-Success-Story') }}';
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
    // End delete success story

</script>