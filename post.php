<?php

  if ($_POST['queryStatus'] == 'false') {
    $defaultValuesAlert = '<p style="max-width: 800px;width:80vw;margin-bottom:0px;margin-top:10px;color:white;display:<?php echo $SpringTermAlert; ?>">Note: You did not include any campus or term information in the direct URL. Default values were used.</p>';
  }

  $data = $_POST['class'];
  $data = preg_replace('/\s+/', '', $data);

  if ($_POST['term'] == "Summer 1") {
    $shareCampus = "SM1";
  } else if ($_POST['term'] == "Summer 2") {
    $shareCampus = "SM2";
  } else {
    $shareCampus = $_POST['term'];
  }

  $shareURL = $data ."&". $shareCampus ."&". $_POST['campus'];

  if ($_POST['term'] == "Fall") {
    $term = "09";
  } else if ($_POST['term'] == "Summer 1") {
    $term = "06";
  } else if ($_POST['term'] == "Summer 2") {
    $term = "07";
  } else if ($_POST['term'] == "Winter") {
    $term = "12";
  } else if ($_POST['term'] == "Spring") {
    $term = "01";
  }

  if ($_POST['campus'] == "Blacksburg") {
    $campus = "0";
  } else if ($_POST['campus'] == "Virtual") {
    $campus = "10";
  } else if ($_POST['campus'] == "VTCSOM") {
    $campus = "14";
  } else if ($_POST['campus'] == "Western") {
    $campus = "2";
  } else if ($_POST['campus'] == "Valley") {
    $campus = "3";
  } else if ($_POST['campus'] == "National Capital Region") {
    $campus = "4";
  } else if ($_POST['campus'] == "Central") {
    $campus = "6";
  } else if ($_POST['campus'] == "Hampton Roads Center") {
    $campus = "7";
  } else if ($_POST['campus'] == "Capital") {
    $campus = "8";
  } else if ($_POST['campus'] == "Other") {
    $campus = "9";
  }

  $year = date('Y');


  if (is_numeric ($data)) {
    $classNo = null;
    $classDept = null;
    $crn = $data;
    $CurrentClass = "CRN: " . $crn;
  } else {
    $classNo = preg_replace('/[^0-9]/', '', $_POST['class']);
    $classDept = strtoupper(preg_replace('/[^a-zA-Z]/', '', $_POST['class']));
    $crn = null;
    $CurrentClass = ucfirst($classDept) . ucfirst($classNo);
  }

  if ($data == null){
    header("Location: /vt/", true, 301);
    exit();
  }

  if (date('m') > 05 && date('m') < 13) {
    if ($term == 01) {
      $year = date('Y') + 1;
    }
  }

  if (date('m') > 02 && date('m') < 10) {
    if ($term == 01) {
      $Alert = '<p style="margin-bottom:0px;margin-top:10px;color:white;">Note: The schedule for the Spring '.$year.' semester may not be available yet.</p>';
    }
  }

  if (date('m') < 02 || date('m') > 10) {
    if ($term == "09") {
      $Alert = '<p style="margin-bottom:0px;margin-top:10px;color:white;">Note: The schedule for the Fall '.$year.' semester may not be available yet.</p>';
    }
  }

  $full_link = "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
  $homeurl = explode('/', $full_link);
  array_pop($homeurl);
  $homeurl = implode('/', $homeurl);

?>
<html>
<head>
  <title><?php echo $CurrentClass ?> - VT Easy Class Search</title>
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.8.2/css/all.css">
  <?php include 'googleAnalytics.php' ?>
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
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
  body{
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  * {
  cursor: inherit;
  }

  p {
  cursor: default;
  }

  /* */

  iframe {
    width: 99vw;
    height: calc(99% + 400px);
    top: -400px;
    position: absolute;
  }

  body, html {
    margin: 0px;
    padding: 0px;
    font-family: 'Roboto', 'Arial';
  }

  body {
    overflow: hidden;
  }

  button {
    z-index: 1;
    cursor: pointer;
    background-color: maroon;
    color: white;
    border: 3px maroon solid;
    padding: 0.5% 0.7%;
    border-radius: 100px;
    -webkit-appearance: none;
    transition: 2s;
    outline: none;
  }

  i {
    transition: .3s ease;
  }

  input[type="button"]::-moz-focus-inner {
       border: 0;
  }

  #buttons {
    width: 100vw;
    padding: 1%;
    z-index: 1;
    position: absolute;
    background-color: #ff6600;
    box-shadow: 4px 4px 15px 1px #00000024;
  }

  button:hover i {
    margin-right: 5px;
  }

  .shareBox {
    margin: 15px 0px 8px 0px;
    display:none;
  }

  .shareBox > #link {
    border: none;
    padding: 10px;
    border-radius: 25px;
  }

</style>

<script>
  function Back() {
    window.location.href = "/vt/";
  }

  function HokieSPA() {
    window.open("https://apps.es.vt.edu/ssomgr_prod/c/SSB" , "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,width=400,height=400");
  }

  function ReloadIframe() {
    document.class.submit()
  }

  function copyLink() {
    var copyText = document.getElementById("link");
    copyText.select();
    document.execCommand("copy");
  }
</script>

<body onload="document.class.submit()">
      <form target="post_Data" action="https://banweb.banner.vt.edu/ssb/prod/HZSKVTSC.P_ProcRequest" id="VTForm2" name="class" method="post">
        <input type="hidden" name="CAMPUS" value="<?php echo $campus; ?>">
        <input type="hidden" name="TERMYEAR" value="<?php echo $year . $term; ?>">
        <input type="hidden" name="CORE_CODE" value="AR%">
        <input type="hidden" name="subj_code" value="<?php echo $classDept ?>">
        <input type="hidden" name="SCHDTYPE" value="%">
        <input type="hidden" name="CRSE_NUMBER" value="<?php echo $classNo ?>">
        <input type="hidden" name="crn" value="<?php echo $crn ?>">
        <input type="hidden" name="open_only">
        <input type="hidden" name="disp_comments_in" value="Y">
        <input type="hidden" name="BTN_PRESSED" value="FIND class sections">
        <input type="hidden" name="inst_name">
      </form>

      <div id="buttons">
        <center>
          <button onclick="Back()"><i class="fas fa-chevron-left"></i> Back to Search</button>
          <button onclick="HokieSPA()"><i class="fas fa-external-link-alt"></i> Login to HokieSPA</button>
          <button onclick="ReloadIframe()"><i class="fas fa-redo-alt"></i> Reload Frame</button>
          <button class="sharebtn" id="sharebtn"><i class="fas fa-share"></i> Share Link</button>

          <?php echo $Alert; ?>
          <?php echo $defaultValuesAlert; ?>

          <div class="shareBox" id="shareBox">
            <input style="outline: none;" id="link" value="http://<?php echo $homeurl. "?" . str_replace(" ","%20",$shareURL) ?>" readonly/>
            <a href="http://<?php echo $homeurl. "?" . str_replace(" ","%20",$shareURL) ?>" onclick="return false;">
              <button onclick="copyLink()" class="btn"><i class="fas fa-clipboard"></i> Copy Link</button>
            </a>
          </div>
        </center>
      </div>

<script>
      $(".sharebtn").click(function(){
        $(".shareBox").fadeToggle('fast')
      });

      $('#link').on('click', function(){
        $(this)[0].setSelectionRange(0, 9999);
      });

      var input = document.getElementById('link');
      input.focus();
      input.select();

      window.history.pushState("object or string", "Title", "//<?php echo $homeurl. "?" . str_replace(" ","%20",$shareURL) ?>");

      if( /Android|webOS|iPhone|iPad|iPod|Opera Mini/i.test(navigator.userAgent) ) {
        document.getElementById("sharebtn").style.display = "none";
      }
</script>

  <iframe style="width:1px;height:1px;z-index:-1;" src="https://apps.es.vt.edu/ssomgr_prod/c/SSB"></iframe>
  <iframe id="post_Data" name="post_Data"></iframe>
</body>
</html>
