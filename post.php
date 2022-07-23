<?php

  if ($_POST['queryStatus'] == 'false') {
    $defaultValuesAlert = '<p style="max-width: 800px;width:80vw;margin-bottom:0px;margin-top:10px;color:white;">Note: You did not include any campus or term information in the direct URL. Default values were used.</p>';
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
    $CurrentClassTitle = "CRN: " . $crn;
    $CurrentClass = $crn;
  } else {
    $classNo = preg_replace('/[^0-9]/', '', $_POST['class']);
    $classDept = strtoupper(preg_replace('/[^a-zA-Z]/', '', $_POST['class']));
    $crn = null;
    $CurrentClassTitle = ucfirst($classDept) . ucfirst($classNo);
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

  $shareURL = $homeurl ."?". $CurrentClass ."&". $shareCampus ."&". $_POST['campus'];

?>
<html>
<head>
  <title><?php echo $CurrentClassTitle ?> - VT Easy Class Search</title>
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.8.2/css/all.css">
  <?php include 'googleAnalytics.php' ?>
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
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
  body {
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

  #data {
    top: 15px;
    position: relative;
    padding-left: 50px;
    padding-right: 50px;
  }

  #post_Data a {
    cursor: pointer;
    text-decoration: none;
  }

  #post_Data td, #post_Data p, #post_Data b, #post_Data font {
    font-size: 1em !important;
    margin: 0px !important;
    background-color: transparent !important;
  }

  #post_Data tr {
    text-align: center;
  }

  #post_Data td[header="false"] {
    white-space: -o-pre-wrap; 
    word-wrap: break-word;
    white-space: pre-wrap; 
    white-space: -moz-pre-wrap; 
    white-space: -pre-wrap; 
    text-align: left;
  }

  body, html {
    margin: 0px;
    padding: 0px;
    font-family: 'Roboto', 'Arial';
  }

  button {
    z-index: 1;
    cursor: pointer;
    background-color: maroon;
    color: white;
    border: 3px maroon solid;
    padding: 5px 8px;
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
    width: 100%;
    padding: 1%;
    top: 0;
    z-index: 1;
    position: sticky;
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
    window.open("https://apps.es.vt.edu/ssb/twbkwbis.p_idm_login",
      "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,width=400,height=400");
  }

  function copyLink() {
    var copyText = document.getElementById("link");
    copyText.select();
    document.execCommand("copy");
  }


  BASE_TIMETABLE_URL = "https://apps.es.vt.edu/ssb";
  function openWindow(link) {
    if (link.includes("http") || link[0] === '.' || link[0] === "/") {
      window.open(link);
    }
    window.open(`${BASE_TIMETABLE_URL}/${link}`, "Timetable",
      "menubar=yes,toolbar=no,scrollbars,resizable,width=600,height=650,left=25,top=25");
  }


  function loadDocument(isThisPrint = false) {
    var form = {
      "CAMPUS": "<?php echo $campus; ?>",
      "TERMYEAR": "<?php echo $year . $term; ?>",
      "CORE_CODE": "AR%",
      "subj_code": "<?php echo $classDept ?>",
      "SCHDTYPE": "%",
      "CRSE_NUMBER": "<?php echo $classNo ?>",
      "crn": "<?php echo $crn ?>",
      "open_only": "",
      "sess_code": "%",
      "BTN_PRESSED": "FIND class sections",
      "inst_name": "",
      "disp_comments_in": "Y",
      "PRINT_FRIEND": isThisPrint ? "Y" : "N"
    }

    <?php // To run on localhost add https://iamdhrumilshah.com/ to the front. SSL doesn't work on localhost ?>

    fetch(`/vt/proxy.php?url=${BASE_TIMETABLE_URL}/HZSKVTSC.P_ProcRequest`, {
  "headers": {
    "accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
    "accept-language": "en-US,en;q=0.9",
    "cache-control": "no-cache",
    "content-type": "application/x-www-form-urlencoded",
    "pragma": "no-cache",
    "sec-ch-ua": "\".Not/A)Brand\";v=\"99\", \"Google Chrome\";v=\"103\", \"Chromium\";v=\"103\"",
    "sec-ch-ua-mobile": "?0",
    "sec-ch-ua-platform": "\"macOS\"",
    "sec-fetch-dest": "document",
    "sec-fetch-mode": "navigate",
    "sec-fetch-site": "cross-site",
    "sec-fetch-user": "?1",
    "upgrade-insecure-requests": "1"
  },
  "referrerPolicy": "strict-origin-when-cross-origin",
  "body": new URLSearchParams(form).toString(),
  "method": "POST",
  "mode": "cors",
  "credentials": "omit"
  }).then(r => r.text()).then(res => {
    if (isThisPrint) {
      var w = window.open('about:blank#UVASucks', "print","width=1000,height=800,toolbar=0");
      w.document.open();
      w.document.write(res);
      w.document.close();
      return;
    }


    var parser = new DOMParser();
    var htmlDoc = parser.parseFromString(res, 'text/html');

    var dom = htmlDoc.getElementsByClassName("dataentrytable")[0];

    if (!dom || res.includes("NO SECTIONS FOUND")) {
      document.getElementById("post_Data").innerHTML = "No sections found for this query.";
      return;
    }

    // Remove all empty DOMs
    dom.innerHTML = dom.innerHTML.replace(/<[^>]*>\s*<\/[^>]*>/gs, "");

    // Replace all javascript:*() with javascript:openWindow()
    getAllInlineJavascriptFunctions(dom.innerHTML).forEach((funcs) => {
      dom.innerHTML = dom.innerHTML.replace(`javascript:${funcs}(`, "javascript:openWindow(");
    });

    dom.setAttribute("class", "table table-hover table-striped align-middle");
    document.getElementById("post_Data").innerHTML = "";
    document.getElementById("post_Data").appendChild(dom);

    // Make the comments columns span the whole table width
    const columns = [...document.getElementsByTagName("td")];
    // Skip the header
    for (var i = 13; i < columns.length; i++) {
      const col = columns[i];
      if (col.hasAttribute('colspan') && col.getAttribute('colspan') === "9") {
        col.setAttribute('colspan', "11");
        col.setAttribute('header', "false");
      } 
    }

    // Move the header (first row in tbody) into a thead
    const tbody = document.getElementsByTagName("tbody")[0];
    const thead = document.createElement("thead");
    thead.setAttribute("class", "table-light");
    thead.innerHTML = tbody.childNodes[0].innerHTML;
    tbody.removeChild(tbody.childNodes[0]);
    document.getElementById("post_Data").childNodes[0].appendChild(thead);
  });
  }

  function getAllInlineJavascriptFunctions(str) {
    functions = [];
    const regex = /\"javascript:([\S]*)\(/gsi;
    let m;
    while ((m = regex.exec(str)) !== null) {
        // This is necessary to avoid infinite loops with zero-width matches
        if (m.index === regex.lastIndex) {
            regex.lastIndex++;
        }
        
        // The result can be accessed through the `m`-variable.
        m.forEach((match, groupIndex) => {
            if (groupIndex) {
              functions.push(match);
            }
            // console.log(`Found match, group ${groupIndex}: ${match}`);
        });
    }
    return functions;
  }
  window.history.pushState("", "", "//<?php echo str_replace(" ","%20",$shareURL) ?>");
</script>

<body onload="loadDocument()">
      <div id="buttons">
        <center>
          <button onclick="Back()"><i class="fas fa-chevron-left"></i> Back to Search</button>
          <button onclick="HokieSPA()"><i class="fas fa-external-link-alt"></i> Login to HokieSPA</button>
          <button onclick="loadDocument()"><i class="fas fa-redo-alt"></i> Reload Frame</button>
          <button onclick="loadDocument(true)"><i class="fas fa-print"></i> Print</button>
          <button class="sharebtn" id="sharebtn"><i class="fas fa-share"></i> Share Link</button>

          <?php echo $Alert; ?>
          <?php echo $defaultValuesAlert; ?>

          <div class="shareBox" id="shareBox">
            <input style="outline: none;" id="link" value="http://<?php echo str_replace(" ","%20",$shareURL) ?>" readonly/>
            <a href="http://<?php echo str_replace(" ","%20",$shareURL) ?>" onclick="return false;">
              <button onclick="copyLink()"><i class="fas fa-clipboard"></i> Copy Link</button>
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

      if( /Android|webOS|iPhone|iPad|iPod|Opera Mini/i.test(navigator.userAgent) ) {
        document.getElementById("sharebtn").style.display = "none";
      }
</script>
  <div id="data">
  <h6>Sign into HokieSPA and click on the CRN to see the amount of space available in the class. I do not have access to anything you type on the HokieSPA login window.</h6>
  <div id="post_Data" class="table-responsive"></div>
  </div>
</body>
</html>
