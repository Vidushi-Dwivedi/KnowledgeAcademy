<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>KnowledgeAcademy-EventPortal</title>
    <?php include 'css_jslinks.php'; ?>
    <?php include "header.php"; ?>
    <link rel="stylesheet" href="eventportal.css">
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid head">
    <a class="navbar-brand" href="#">
    <i class="fas fa-calendar-alt"></i><span class="event_heading">EVENTS</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
       <div class="d-flex flex-row-reverse bd-highlight">
         <a class="btn btn-light add_event" href="add_event.php"><i class="fa fa-plus-square fa-2x"><span class="icon_text"> Add Event</span></i> </a>
       </div>
   </div>
  </nav>
  <?php include 'event_index.php'; ?>
  <script type="text/javascript">
  $(document).ready(function(){

  // Delete
  $('.delete').click(function(){
   var el = this;

   // Delete id
   var deleteid = $(this).data('id');
  var delname=$(this).data('name');
   var confirmalert = confirm("Are you sure?");
   if (confirmalert == true) {
      // AJAX Request
      $.ajax({
        url: 'event_delete.php',
        type: 'POST',
        data: { id: deleteid, name: delname  },
        success: function(response){
          console.log(response);
          if(response == 1){
      // Remove row from HTML Table
      $(el).closest('tr').children('td, th').css('background','#dd8d8d');
      $(el).closest('tr').children('td, th').fadeOut(800,function(){
         $(this).remove();
      });
      window.location.reload(true);
          }else{
      alert('Invalid ID.');

          }

        }
      });
   }

  });

  });
  </script>

  </body>
</html>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
