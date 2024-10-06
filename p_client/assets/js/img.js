$(document).ready(function(){
    $(document).on('change','#fileToUpload',function(){
        var property = document.getElementById("fileToUpload").files[0];
        var image_name = property.name;
        var image_extension = image_name.split('.').pop().toLowerCase();
        var image_size = property.size;
        if (jQuery.inArray(image_extension,['gif','png','jpg','jpeg']) == -1) {
            // alert("invalid image file");
            $('#upload_image').html("<label class='text-danger'>invalid image file</label");
        }
        
        else if (image_size > 2000000) {
            // alert("image file is very big");
            $('#upload_image').html("<label class='text-danger'>image file is very big</label");
        }
        else
        {
            var form_data = new FormData();
            form_data.append("fileToUpload",property);
            $.ajax({
                url:"upload.php",
                method:"POST",
                data:form_data,
                contentType:false,
                cache:false,
                processData:false,
                beforeSend:function(){
                    $('#upload_image').html("<label class='text-success'>Uploding...</label");
                },
                success:function(data)
                {
                    $('#upload_image').html(data);
                }
            })
        }
    });
});