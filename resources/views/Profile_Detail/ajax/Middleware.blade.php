<script type="text/javascript" src="{{ asset('assets/ajax/libs/jquery/1.12.4/jquery.min.js') }}"></script>
<script>

    // Start Bind data to the edit success story
    $(document).ready(function(e) {
        $(document).on('click','#edit_profile_image_data',function(e) {
            var id=$(this).attr("data-profileid");
            $('#id_profile_image').val(id);
        });
    });
    // End Bind data to the edit success story

    // Start Bind data to the edit image profile
    $(document).ready(function(e) {
        $(document).on('click','#edit_personal_profile_data',function(e) {
            var id=$(this).attr("data-profileid");
            var edit_address=$(this).attr("data-address");
            var edit_phonenumber=$(this).attr("data-phonenumber");
            $('#id_edit_personal_profile_data').val(id);
            $('#edit_address').val(edit_address);
            $('#phone_number').val(edit_phonenumber);
        });
    });
    // End Bind data to the edit image profile

    // Start Bind data to the edit biography
    $(document).ready(function(e) {
        $(document).on('click','#edit_biography_data',function(e) {
            var id=$(this).attr("data-profileid");
            var biography_val=$(this).attr("data-biography");
            $('#id_edit_biography_data').val(id);
            $('#biography_data').val(biography_val);
        });
    });
    // End Bind data to the edit biography

</script>