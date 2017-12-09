<!DOCTYPE html>
<html lang="fa">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
  <title>mController</title>
  <link rel="stylesheet" type="text/css" href="CSS/bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="CSS/main.css">

 
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
    <a class="nav-item nav-link active" href="mosabegheBrackets2GٍٍٍٍEdit.html">گروهی</a>
    <a class="nav-item nav-link" href="mosabegheBrackets2HEdit.html">حذفی</a>
  </nav>
  <br>
  <h4 style="direction: rtl;">با استفاده از drag & drop ، تیم ها را گروه بندی کنید. </h4>
  <br> 

  <div class="row" id="allTeams"  ondrop="drop(event)" ondragover="allowDrop(event)" style="padding: 30px;direction: ltr;">
    <div style="padding: 5px;" ondrop="notAllowDrop(event)" draggable="true" ondragstart="drag(event)" id="team1">
      <img class="rounded" draggable="false" src="images/LOLBack.jpg" height="30" > Tigers
    </div>
    <div style="padding: 5px;" draggable="true" ondragstart="drag(event)" id="team2">
      <img class="rounded" draggable="false" src="images/LOLBack.jpg" height="30"> Tigers
    </div>
    <div style="padding: 5px;" draggable="true" ondragstart="drag(event)" id="team3">
      <img class="rounded" draggable="false" src="images/LOLBack.jpg" height="30"> Tigers
    </div>
    <div style="padding: 5px;" draggable="true" ondragstart="drag(event)" id="team4">
      <img class="rounded" draggable="false" src="images/LOLBack.jpg" height="30"> Tigers
    </div>
    <div style="padding: 5px;" draggable="true" ondragstart="drag(event)" id="team5">
      <img class="rounded" draggable="false" src="images/LOLBack.jpg" height="30"> Tigers
    </div>
    <div style="padding: 5px;" draggable="true" ondragstart="drag(event)" id="team6">
      <img class="rounded" draggable="false" src="images/LOLBack.jpg" height="30"> Tigers
    </div>
  </div>

  <!-- َََAll Group -->
   <div class="row" id="Groups">
    <!-- Group A -->
     

  <br>
    <br>
    <br>
   </div>

  
  </div> 

</div>  
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


 <style type="text/css">
   *[draggable=true] {
    -moz-user-select: none;
    -khtml-user-drag: element;
    cursor: move;
   }
 </style>

 <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
 <script type="text/javascript" src="js/main.js"></script>
 <script type="text/javascript" src="js/bootstrap.js"></script>



<script type="text/javascript">
   //  $(document).ready(function() {  
   //    $('#selectGNum').change(function(){
   //      $('#Groups div').empty();
   //      $('#Groups').append('<div class="col-sm-6 col-md-3 col-lg-3"><table class="table table-striped"><thead><tr><th></th><th>Group A</th><th>Point</th></tr></thead><tbody><tr><th scope="row">1</th><td id="G11" ondrop="drop(event)" ondragover="allowDrop(event)"></td><td>0</td></tr><tr><th scope="row">2</th><td id="G12" ondrop="drop(event)" ondragover="allowDrop(event)"></td><td>0</td></tr><tr><th scope="row">3</th><td id="G13" ondrop="drop(event)" ondragover="allowDrop(event)"></td><td>0</td></tr><tr><th scope="row">4</th><td id="G14" ondrop="drop(event)" ondragover="allowDrop(event)"></td><td>0</td></tr></tbody></table></div>');
   //    });
   // });
</script>


<script type="text/javascript">
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
    ev.dataTransfer.setData("parentId", ev.target.parent.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
}

function notAllowDrop(ev) {

  ev.preventDefault(); 
  var data = ev.dataTransfer.getData("text");
  var parentId = ev.dataTransfer.getData("parentId");
  document.getElementById("test").innerHTML = "sadfasdfs" ;
  parentId.appendChild(document.getElementById(data));
}
</script>

</body>
</html>


<!-- <div class="col-sm-6 col-md-3 col-lg-3"><table class="table table-striped"><thead><tr><th></th><th>Group A</th><th>Point</th></tr></thead><tbody><tr><th scope="row">1</th><td id="G11" ondrop="drop(event)" ondragover="allowDrop(event)"></td><td>0</td></tr><tr><th scope="row">2</th><td id="G12" ondrop="drop(event)" ondragover="allowDrop(event)"></td><td>0</td></tr><tr><th scope="row">3</th><td id="G13" ondrop="drop(event)" ondragover="allowDrop(event)"></td><td>0</td></tr><tr><th scope="row">4</th><td id="G14" ondrop="drop(event)" ondragover="allowDrop(event)"></td><td>0</td></tr></tbody></table></div> -->