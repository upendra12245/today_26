

<div class="slideshow-container">
 {foreach $testimonial as $testi}

<div class="mySlides">
<div>
<img id="tesimag" src="../modules/ps_1767_testimonials/images/{trim($testi.image)}" alt="Avatar" /> 
</div>
<br/>
<div style="padding:20px;width:100%;height:45px">
  <q>{trim($testi.content)}</q>
  </div>
  <p class="author" style="width:100%;height:45px;position:absolute; margin:20px 0px 0px 0px;">- {trim($testi.author)}</p>
</div>
{/foreach}


<a class="prev" onclick="plusSlides(-1)">❮</a>
<a class="next" onclick="plusSlides(1)">❯</a>

</div>

<div class="dot-container">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>
