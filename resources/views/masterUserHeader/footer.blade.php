<style type="text/css">
    * {
        margin: 0;
    }
    html, body {
        height: 100%;
    }
    .footer {
        /*position: absolute;*/
        direction: rtl;
        /* right: 0;
         bottom: 0;
         left: 0;*/
        padding: 1rem;
        background-color: #000000;
        /*padding: 15px;*/
        text-align: center;
        height: 100px;
        /* margin-top: 1000px;*/
    }

    #mainDiv {
        min-height: 100%;
        /* equal to footer height */
        margin-bottom: -100px;

    }
    #mainDiv:after {
        content: "";
        display: block;
    }
    .footer, #mainDiv:after {
        height: 100px;
    }

</style>
<br>
<div class="footer">
    <div>
        <a href="https://www.instagram.com/gameinja/" style="padding: 10px;"><i class="fa fa-instagram fa-lg"></i></a>
        <a href="https://t.me/GameInja" style="padding: 10px;"><i class="fa fa-telegram fa-lg"></i></a>
    </div>
    <p style="font-size: 20px;color: white;">تمام حقوق مادی و معنوی این سایت متعلق به سایت    <span style="color:#61892F; ">Chaleshjo.com</span> می باشد.</p>
</div>