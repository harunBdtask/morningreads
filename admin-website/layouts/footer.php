 	</div><!-- End of content-biginer -->
 </div><!-- End of container-fluid -->
 <script src="../js/jquery-2.1.4.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.cycle2.min.js"></script>
<script src="../js/jquery.cycle2.flip.min.js"></script>
<script src="../js/jquery.cycle2.tile.min.js"></script>
<script src="../js/jquery.cycle2.swipe.min.js"></script>
<script src="../js/jquery.functionality.js"></script>
<script src="../js/jquery.tosrus.min.all.js"></script>
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-printme.js"></script>
<script src="../js/jquery.tosrus.functionality.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  $(window).load(function(){
      $("#loader").fadeOut("slow");
  });
  $( "#datepicker" ).datepicker();
</script>
<script type="text/javascript">
     function click(){
      $("#values").show().printMe();
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    });
</script>
<!--tinyMCE-->
<script src='../js/tinymce.min.js'></script>
<script>
    tinymce.init({
    selector: '#mytextarea'
  });
</script>
</body>
</html>