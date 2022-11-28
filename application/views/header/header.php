<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>SIPEG Villa Kancil</title>
    <!-- Favicon -->
    <link rel="icon" href="<?php echo base_url(); ?>assets/img/brand/villakancil.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Page plugins -->
    
    <link rel="stylesheet" href="<?= base_url(); ?>assets/jquery-ui/jquery-ui.min.css"/> <!-- Load file css jquery-ui -->
    
    <script src="<?= base_url(); ?>assets/jquery.min.js"></script> <!-- Load file jquery -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/argon.css?v=1.2.0" type="text/css">
    <script type="text/javascript">
    function Validation() {
            var fileInput = 
                document.getElementById('foto');
              
            var filePath = fileInput.value;
          var filesize = fileInput.files[0].size;
            // Allowing file type
            var allowedExtensions = 
                    /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            
              
            if (!allowedExtensions.exec(filePath)) {
                alert('File Harus JPG/PNG');
                fileInput.value = '';
                return false;
            } else if(filesize>2098576){
                alert('Ukuran File Maks. 2 MB');
                fileInput.value = '';
                return false;
            }
            else 
            {
              
                // Image preview
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById(
                            'imagePreview').innerHTML = 
                            '<img src="' + e.target.result
                            + '"/>';
                    };
                      
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        }
</script>

</head>