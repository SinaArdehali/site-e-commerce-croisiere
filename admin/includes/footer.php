</div>

<footer class="text-center" id="footer">&copy; Copyright 2013-2017 Sina Boutique</footer>

<script>
	function updateSizes(){
		var sizeString = '';
		for (var i=1;i<=12;i++){
			if (jQuery('#size'+i).val() != '') {
				sizeString += jQuery('#size'+i).val()+':'+jQuery('#qty'+i).val()+',';
			}
		}
		jQuery('#sizes').val(sizeString);
	}







</script>






</body>

</html>