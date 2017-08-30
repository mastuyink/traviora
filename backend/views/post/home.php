<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'SELAMAT DATANG DI ISTANA TRAVEL';
?>
<style type="text/css">
    
    #jalan {
  background-color:#ce3635;
  text-align: center;
  color:#fff;
  padding-top:2em;
  padding-bottom:2em;
}

</style>

<script type="text/javascript">
    //made by vipul mirajkar thevipulm.appspot.com
var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) { delta /= 2; }

        if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
        }

        setTimeout(function() {
        that.tick();
        }, delta);
    };

    window.onload = function() {
        var elements = document.getElementsByClassName('typewrite');
        for (var i=0; i<elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
              new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
        document.body.appendChild(css);
    };
</script>

<!--made by vipul mirajkar thevipulm.appspot.com-->
<div class="jumbotron" id="jalan" >
  <p href="#content" class="typewrite" data-period="2000" data-type='[ "Selamat Datang Di Istana Travel","You have successfully created your Yii-powered application."]'></p>
   <!-- <span class="wrap"></span>-->
  </a>

</div>
<div class="site-index">

    <div class="body-content">

        <div class="row">
       
        <?php 
 
        foreach ($dataProvider as $konten) {
             echo "<div class='col-md-4'>
                <h4>'".$konten->judul_content."'</h4>

              

                <p>".Html::a('DETAIL',['view','id'=>$konten->id],['class'=>'btn btn-info glyphicon glyphicon-arrow-right'])."</p>
            </div>";
        }

       ?> 

                      
        </div>

    </div>
</div>
