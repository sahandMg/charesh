<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body style="background-color: #E6E6E6;">
  <div class="container3">
      <h3>تایید ایمیل</h3>
      <h4>با تشکر. ایمیل شما تایید شد</h4>
      <p>برای ورود به سایت <a href="{{route('login')}}"> کلیک </a> کنید </p>
      <br>
      <br>
  </div>
  <br>
  <style type="text/css">
      .container3 {
          width: 80%;
          margin: auto;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
          direction: rtl;
          background-color: white;
          display: block;
      }
      .container3 h3 {
           background-color: #42CBC8;
           color: white;
           /*width: 100%;*/
           display: block;
           padding: 2%;
          font-size: 150%;
          font-weight: 200;
       }
      .container3 h4 {
          text-align: center;
      }
      .container3 p {
          text-align: center;
      }
      .container3 a {
          text-decoration: none;
      }
  </style>
</body>
</html>