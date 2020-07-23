<?php

    function avatar_uploader(){
        echo do_shortcode('[avatar_upload]');

        add_action('wp_footer',function(){
?>
            <script>
                (function () {

                    $('#avatar-upload-button').on('click',function(event){
                        event.preventDefault();
                        $('#wpua-file-existing, #wpua-add-existing').click();
                    });


                    $(document.body).on('change','#wpua-file-existing',function(){
                        $(this).parents('form:first').find(':input[type=submit]').click();
                    });

                })()
            </script>
<?php
        }, 99999);

    }