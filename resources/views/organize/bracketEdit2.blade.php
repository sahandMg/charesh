<!DOCTYPE html>
<html lang="fa">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
  <title>mController</title>
  <link rel="stylesheet" type="text/css" href="CSS/bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="CSS/main.css">
  <link rel="stylesheet" type="text/css" href="CSS/bracket.css">
 
</head>
<body style="padding: 0px;margin: 0px;width: 100%;">

<div class="container" style="width: 100%;padding: 0px;">

  <div class="filler one">
      
  </div>
  <nav id="navbar" class="topNav">
    <ul>
        <li>
          <div class="dropdown">
            <a onclick="myFunction()" href="">
               Mohammad Vatandoost <img src="images/LOLBack.jpg" class="rounded" height="40" width="40" style="margin-bottom: 3px;">
            </a>
             <div class="dropdown-content">
                <a href="UsersChalesh.html">چالش های من</a>
                <a href="mosabegheController.html">مسابقات من</a>
                <a href="etebar.html">اعتبار 5000 تومان</a>
                <a href="setting.html">اطلاعات من</a>
                <a href="#">خروج</a>
             </div>
          </div>
        </li>
       <li><a href="aboutUs.html">درباره ما</a></li>
       <li><a href="contact.html">ارتباط با ما</a></li>
       <li><a href="index.html"><i class="fa fa-home fa-lg"></i></a></li>
    </ul>
  </nav>

  <div class="row" style=" direction: rtl;">
    <!-- right menu -->
  <div>
   <div class="Vnav">
    <ul>
      <li><a href="mosabegheController.html">پنل مدیریت</a></li>
      <li><a href="makeTournoment1.html">مسابقه جدید</a></li>
      <li><a href="makeOrganize1.html">اطلاعات من</a></li>
      <li><a href="mosabegheAccount.html">حساب من</a></li>
    </ul>
   </div>
   
    <button type="submit" class="btn btn-warning" style="margin-right: 40px;margin-top: 40px;margin-bottom: 5px;">تغییر نوع برگزاری براکت</button>
    <p style="width: 200px;margin-right: 50px;">در صورت تغییر نوع برگزاری براکت ، تمام اطلاعات براکت قبلی شما پاک می شود ، باید از ابتدا به دسته بندی مسابقه دهندگان بپردازید.</p>
  
 </div>
  <!-- content -->
   <div class="container">
    <br>
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link" href="mosabeghePanel.html">اطلاعات مسابقه</a>
      </li>
      <li class="nav-item">
         <a class="nav-link  active" href="mosabegheBrackets2GٍٍٍٍEdit.html">براکت مسابقه</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" href="mosabeghePanelTime.html">زمان بندی مسابقه</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="mosabeghePanelMessage.html">اطلاعیه دادن</a>
       </li>
    </ul>
    <br>
    <br>


  <nav class="nav nav-pills nav-fill" style="padding: 30px;">
    <a class="nav-item nav-link" href="mosabegheBrackets2GEdit.html">گروهی</a>
    <a class="nav-item nav-link active" href="mosabegheBrackets2HEdit.html">حذفی</a>
  </nav>

<!-- Brackets -->
  <div class="row" style="padding: 30px;direction: ltr;">
      <div style="padding: 5px;">
        <img class="rounded" src="images/LOLBack.jpg" height="30" > Tigers
      </div>
      <div style="padding: 5px;">
        <img class="rounded" src="images/LOLBack.jpg" height="30" > Tigers
      </div>
  </div>
  
  <hr>
  <h4 style="direction: rtl;padding-top: 10px;">نام تیم ها و نتایج مسابقات را داخل براکت بنویسید.</h4>
  <br>

  

 
 
   </div>
  </div> 
  <div id="customHandlers" style="direction: ltr;margin-left: 20px;"></div>
   <br>
    <br>
    <br>
</div>  

<style>
    .Vnav {
      margin-top: 20px;
      margin-right: 40px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
      background-color: #f1f1f1;
      max-height: 200px;
    }

    .Vnav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 200px;
        background-color: #f1f1f1;
        
    }

    .Vnav li a {
        display: block;
        color: #000;
        padding: 8px 16px;
        text-decoration: none;
    }

    .Vnav li a.active {
        background-color: #008CBA;
        color: white;
    }

    .Vnav li a:hover:not(.active) {
        background-color: #555;
        color: white;
    }
  </style>




<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
<script type="text/javascript" src="js/jquery.bracket.min.js"></script>
<script type="text/javascript">
  


/* Custom data objects passed as teams */
var customData = {
    teams : [
      [{name: "Team1", flag: 'Team1'}, null],
      [{name: "Team3", flag: 'Team3'}, {name: "Team4", flag: 'Team4'}]
    ],
    results : []
  }
 
/* Edit function is called when team label is clicked */
function edit_fn(container, data, doneCb) {
  var input = $('<input type="text">')
  // input.val(data ? data.name + ':' + data.name : '')
  input.val(data ?   data.name : '')
  container.html(input)
  input.focus()
  input.blur(function() {
    var inputValue = input.val()
    if (inputValue.length === 0) {
      doneCb(null); // Drop the team and replace with BYE
    } else {
      // var flagAndName = inputValue.split(':') // Expects correct input
      var flagAndName = inputValue
      doneCb({flag: flagAndName, name: flagAndName})
    }
  })

}
 
/* Render function is called for each team label when data is changed, data
 * contains the data object given in init and belonging to this slot.
 *
 * 'state' is one of the following strings:
 * - empty-bye: No data or score and there won't team advancing to this place
 * - empty-tbd: No data or score yet. A team will advance here later
 * - entry-no-score: Data available, but no score given yet
 * - entry-default-win: Data available, score will never be given as opponent is BYE
 * - entry-complete: Data and score available
 */
function render_fn(container, data, score, state) {
  switch(state) {
    case "empty-bye":
      container.append("No team")
      return;
    case "empty-tbd":
      container.append("Upcoming")
      return;
 
    case "entry-no-score":
    case "entry-default-win":
    case "entry-complete":
      container.append('<img src="images/'+data.flag+'.jpg" /> ').append(data.name)
      return;
  }
}
 

/* Called whenever bracket is modified
 *
 * data:     changed bracket object in format given to init
 * userData: optional data given when bracket is created.
 */
function saveFn(data, userData) {
   str = JSON.stringify(data);
   console.log(str);
   str = JSON.stringify(userData);
   console.log(str);
   console.log("test");
  // console.log(json);
  // $('#saveOutput').text('POST '+userData+' '+json)
  /* You probably want to do something like this
  jQuery.ajax("rest/"+userData, {contentType: 'application/json',
                                dataType: 'json',
                                type: 'post',
                                data: json})
  */
}

$(function() {
  $('div#customHandlers').bracket({
    init: customData,
    save: saveFn, /* without save() labels are disabled */
    decorator: {edit: edit_fn,
                render: render_fn}})
  })


function test(data)
{
  str = JSON.stringify(data);
  console.log(str);
}

</script>


</body>
</html>


