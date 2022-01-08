<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>result_query</title>
    <style>
    .bg-primary, .bg-success, .bg-info, .bg-warning, .bg-danger {
    text-align: center;
    padding: 0.5rem;
    font-weight: bold;

    -webkit-animation: seconds 1.0s forwards;
    -webkit-animation-iteration-count: 1;
    -webkit-animation-delay: 5s;
    animation: seconds 1.0s forwards;
    animation-iteration-count: 1;
    animation-delay: 3s;
    position: relative;

    }
    @-webkit-keyframes seconds {
    0% {
      opacity: 1;
    }
    100% {
      opacity: 0;
      left: -9999px;
      position: absolute;
    }
    }
    @keyframes seconds {
    0% {
      opacity: 1;
    }
    100% {
      opacity: 0;
      left: -9999px;
      position: absolute;
    }
    }
    </style>
  </head>
  <body>
    <?php
    // $title="";
    function showResult($text, $success)
    {
      $c='';
      if($success=="info"){
        $c="bg-information";
      }
      if($success=='warn'){
        $c='bg-warning';
      }
      else if($success=="true"){
        $c='bg-success';
      }
      else{
        $c='bg-danger';
      }

      return "<p id='query_res' class='".$c."'>" . htmlspecialchars($text) . "</p>";
    }

     ?>
  </body>
</html>
