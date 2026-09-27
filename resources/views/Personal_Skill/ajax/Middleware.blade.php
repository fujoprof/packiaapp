<script type="text/javascript" src="{{ asset('assets/ajax/libs/jquery/1.12.4/jquery.min.js') }}"></script>
<script>

    // Start Bind data to the edit personal skill
    $(document).ready(function(e) {
        $(document).on('click','#edit_personal_skill',function(e) {
            var id=$(this).attr("data-id");
            var skill_val=$(this).attr("data-skill");
            $('#id_skill').val(id);
            $('#personal_skill').val(skill_val);
        });
    });
    // End Bind data to the edit personal skill

    // Start to softdelete personal skill
    $(document).on('click', '#trash_personal_skill', function() {
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
                    url: '{{ route('Destroy-Personal-Skill', ['trashid' => ':trashid']) }}'.replace(':trashid', trashid),
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
                            window.location.href = '{{ route('View-Personal-Skill') }}';
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
    // End to softdelete personal skill

    // Start to restore personal skill
    $(document).on('click', '#undo_personal_skill', function() {
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
                    url: '{{ route('Restore-Personal-Skill', ['restoreid' => ':restoreid']) }}'.replace(':restoreid', restoreid),
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

                        // Redirect to the personal skill route after a brief delay
                        setTimeout(function() {
                            window.location.href = '{{ route('View-Personal-Skill') }}';
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
    // End to restore personal skill
    
    // Start delete personal skill
    $(document).on('click', '#delete_personal_skill', function() {
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
                    url: '{{ route('Delete-Personal-Skill', ['deleteid' => ':deleteid']) }}'.replace(':deleteid', deleteid),
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
                            window.location.href = '{{ route('View-Personal-Skill') }}';
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