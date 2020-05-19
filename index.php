<?php

  $query = rawurldecode($_SERVER['QUERY_STRING']);
  $query = explode('&', $query);

  if (sizeof($query) < 3 && sizeof($query) > 1){
    header("Location: /vt/", true, 301);
    exit();
  }

  if ($query[1] == '' Or $query[2] == '') {
    $queryStatus = "false";
  } else {
    $queryStatus = "true";
  }

  if ($_SERVER['QUERY_STRING'] !== "") {
    $classDValue = 'value="' . $query[0] . '"';
    $submitHTML = '<div class="loader"></div>';
  } else {
    $submitHTML = '<input type="submit" name="submit" value="Submit" />';
    $queryStatus = "true";
  }

  $termCheckmarkFall = null;
  $termCheckmarkSpring = null;
  $termCheckmarkSM1 = null;
  $termCheckmarkSM2 = null;
  $termCheckmarkWinter = null;

  if ($query[1] == "Fall") {
    $termCheckmarkFall = "selected";
  } elseif ($query[1] == "Spring") {
    $termCheckmarkSpring = "selected";
  } elseif ($query[1] == "SM1") {
    $termCheckmarkSM1 = "selected";
  } elseif ($query[1] == "SM2") {
    $termCheckmarkSM2 = "selected";
  } elseif ($query[1] == "Winter") {
    $termCheckmarkWinter = "selected";
  } elseif (date('m') > 02 && date('m') < 10) {
    $termCheckmarkFall = "selected";
  } else {
    $termCheckmarkSpring = "selected";
  }

  if ($query[2] == "Blacksburg") {
    $campusCheckmark[0] = "selected";
  } elseif ($query[2] == "Virtual") {
      $campusCheckmark[1] = "selected";
  } elseif ($query[2] == "VTCSOM") {
      $campusCheckmark[2] = "selected";
  } elseif ($query[2] == "Western") {
      $campusCheckmark[3] = "selected";
  } elseif ($query[2] == "Valley") {
      $campusCheckmark[4] = "selected";
  } elseif ($query[2] == "National Capital Region") {
      $campusCheckmark[5] = "selected";
  } elseif ($query[2] == "Central") {
      $campusCheckmark[6] = "selected";
  } elseif ($query[2] == "Hampton Roads Center") {
      $campusCheckmark[7] = "selected";
  } elseif ($query[2] == "Capital") {
      $campusCheckmark[8] = "selected";
  } elseif ($query[2] == "Other") {
      $campusCheckmark[9] = "selected";
  }

?>

<html>
<head>
  <title>VT Easy Class Search</title>
  <meta name = "viewport" content = "width = device-width">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
  <?php include 'googleAnalytics.php' ?>
  <script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "WebSite",
	"url": "https://iamdhrumilshah.com/vt/",
	"potentialAction": {
		"@type": "SearchAction",
		"target": "https://iamdhrumilshah.com/vt?{search_term_string}",
		"query-input": "required name=search_term_string"
	}
}
</script>
</head>

<!--

since you're here i might as well let you know who made this:

dhrumil shah
iamdhrumilshah.com

@vt if there is a problem with this site let me know.

////

<?php include 'LICENSE' ?>

-->

<style>

  /* START to keep animation seperate START */

  body {
    opacity: 0;
    -webkit-transition: opacity .7s ease-in;
    -moz-transition: opacity .7s ease-in;
    -o-transition: opacity .7s ease-in;
    -ms-transition: opacity .7s ease-in;
    transition: opacity .7s ease-in;
  }

  body.load {
    opacity: 1;
  }

  /* END to keep animation seperate END */

  body {

    /* tara bap ni gand prod. saved code */

    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  body, html {
    font-family: 'Roboto', 'Arial';
    margin: 0;
    padding: 0;
  }

  footer {
    bottom: 0px;
    position: absolute;
    text-align: center;
    width: 100vw;
    padding: 10px 5px;
    margin: 0px;
    box-sizing: border-box;
    color: lightgray;
    z-index: 2;
    transition: 1s ease;
    font-size: 50%;
  }

  footer:hover {
    background-color: white;
    transition: 1s ease;
  }

  .dot {
      height: 105vw;
      width: 105vw;
      max-height: 500px;
      max-width: 500px;
      background-color: #ff6600;
      border-radius: 50%;
      display: inline-block;
      position: fixed;
      top: 48%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: -1;
  }

  form {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  input {
    text-align: center;
    cursor: pointer;
    background-color: maroon;
    color: white;
    border: 1.5px maroon solid;
    padding: 8px;
    border-radius: 2px;
    -webkit-appearance: none;
  }

  #classInput {
    width: 80vw;
    max-width: 400px;
    font-size: 100%;
    height: 50px;
    border-radius: 40px;
    border-color: maroon;
    cursor: text;
    transition: .7s;
    transition-timing-function: ease;
  }

  *:focus {
    outline: none;
  }

  #classInput:hover, #classInput:focus {
    box-shadow: 5px 5px 23px 0px rgba(0, 0, 0, 0.35);
    transition: .7s;
    transition-timing-function: ease;
    max-width: 600px;
    transform: scale(1.2);
  }

  ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
      color: white;
      opacity: .5; /* Firefox */
  }

  :-ms-input-placeholder { /* Internet Explorer 10-11 */
      color: white;
  }

  ::-ms-input-placeholder { /* Microsoft Edge */
      color: white;
  }

  .loader {
      border: 10px solid #fff;
      border-radius: 50%;
      border-top: 10px solid #800000;
      width: 30px;
      height: 30px;
      -webkit-animation: spin 2s linear infinite;
      animation: spin .8s linear infinite;
  }

  /* Safari */
  @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
</style>

<script type="text/javascript">
  $(window).load(function(){
  $("body").addClass("load");
    });
</script>


<!--- THIS IS POPUP FOR WHEN VT DISABLED THE TIMETABLE PAGE -->
<?php include 'popup.php'; ?>
<!-- END POPUP -->

<body onload="document.vt.submit()">
<center>
<form autocomplete="off" action="post.php" name="vt" id="VTForm" method="post">
  <input placeholder="Enter Class or CRN" <?php echo $classDValue ?> id="classInput" type="text" name="class" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required>
  <br>
  <br>
  <select name="term">
    <option style="-webkit-appearance: checkbox;" value="Fall" <?php echo $termCheckmarkFall; ?>>Fall</option>
    <option style="-webkit-appearance: checkbox;" value="Summer 1" <?php echo $termCheckmarkSM1; ?>>Summer 1</option>
    <option style="-webkit-appearance: checkbox;" value="Summer 2" <?php echo $termCheckmarkSM2; ?>>Summer 2</option>
    <option style="-webkit-appearance: checkbox;" value="Winter" <?php echo $termCheckmarkWinter; ?>>Winter</option>
    <option style="-webkit-appearance: checkbox;" value="Spring" <?php echo $termCheckmarkSpring; ?>>Spring</option>
  </select>
  <br>
  <br>
   <select name="campus">
     <option value="Blacksburg" <?php echo $campusCheckmark[0] ?>>Blacksburg</option>
     <option value="Virtual" <?php echo $campusCheckmark[1] ?>>Virtual</option>
     <option value="VTCSOM" <?php echo $campusCheckmark[2] ?>>VTCSOM</option>
     <option value="Western" <?php echo $campusCheckmark[3] ?>>Western</option>
     <option value="Valley" <?php echo $campusCheckmark[4] ?>>Valley</option>
     <option value="National Capital Region" <?php echo $campusCheckmark[5] ?>>National Capital Region</option>
     <option value="Central" <?php echo $campusCheckmark[6] ?>>Central</option>
     <option value="Hampton Roads Center" <?php echo $campusCheckmark[7] ?>>Hampton Roads Center</option>
     <option value="Capital" <?php echo $campusCheckmark[8] ?>>Capital</option>
     <option value="Other" <?php echo $campusCheckmark[9] ?>>Other</option>
   </select>
   <input type="hidden" name="queryStatus" value="<?php echo $queryStatus; ?>">
   <br>
   <br>
   <?php echo $submitHTML; ?>
</form>

  <span class="dot"></span>

<footer>
  <p>This page is not affiliated with Virginia Tech. Just a tool to help myself and others out.</p>
</footer>

</center>
</body>
</html>
