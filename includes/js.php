<div class="scroll-progress d-none d-xxl-block"> 
<a href="#" class="scroll-top" aria-label="scroll"> 
<span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span>
</span> </a> </div>
<!-- Js -->
<script src="<?php echo $Domain; ?>js/jquery.js"></script> 
<script src="<?php echo $Domain; ?>js/vendors.min.js"></script> 
<script src="<?php echo $Domain; ?>js/main.js"></script>

<!-- Js End -->
<script>

$(document).ready(function () {
 //called when key is pressed in textbox
 $(".numeric").keypress(function (e) {
    //if the letter is not digit then display error and don't type anything
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
       //display error message
       $("#errmsg").html("Digits Only").show().fadeOut("slow");
              return false;
   }
  });
});
</script>
<script>
    function AddReadMore() {
      
        var carLmt = 160;
        // Text to show when text is collapsed
        var readMoreTxt = " ... Read More";
        // Text to show when text is expanded
        var readLessTxt = " Read Less";


        //Traverse all selectors with this class and manupulate HTML part to show Read More
        $(".addReadMore").each(function() {
            if ($(this).find(".firstSec").length)
                return;

            var allstr = $(this).text();
            if (allstr.length > carLmt) {
                var firstSet = allstr.substring(0, carLmt);
                var secdHalf = allstr.substring(carLmt, allstr.length);
                var strtoadd = firstSet + "<span class='SecSec'>" + secdHalf + "</span><span class='readMore'  title='Click to Show More'>" + readMoreTxt + "</span><span class='readLess' title='Click to Show Less'>" + readLessTxt + "</span>";
                $(this).html(strtoadd);
            }

        });
        //Read More and Read Less Click Event binding
        $(document).on("click", ".readMore,.readLess", function() {
            $(this).closest(".addReadMore").toggleClass("showlesscontent showmorecontent");
        });
    }
    $(function() {
        //Calling function after Page Load
        AddReadMore();
    });
    </script>