<?php
echo "HEllo";
if (isset($_GET['name'])) {
  // Get parameters
     $file = urldecode($_REQUEST["name"]); // Decode URL-encoded string

     /* Test whether the file name contains illegal characters
     such as "../" using the regular expression */


         $filepath = "uploads/" . $file;

         // Process download
         if(file_exists($filepath)) {
             header('Content-Description: File Transfer');
             header('Content-Type: application/octet-stream');
             header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
             header('Expires: 0');
             header('Cache-Control: must-revalidate');
             header('Pragma: public');
             header('Content-Length: ' . filesize($filepath));
             flush(); // Flush system output buffer
             readfile($filepath);
             die();
         } else {
             http_response_code(404);
 	        die();
         }
     
 }

?>
