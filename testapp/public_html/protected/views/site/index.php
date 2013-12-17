<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<h1>Test task for vacation yii developer</h1>


<div><a href="#" id="testbtn" data-toggle="modal" class="btn"><i class="icon-plus"></i></a></div>
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div id="test"></div>
</div>
<?php
echo "<table class='table table-bordered' style='margin-top:10px'>";
foreach ($model as $dp)
{
	echo "<tr>";
		echo "<td>";
			echo "Test data";
		echo "</td>";
	echo "<td>";
	echo $dp->input;
	echo "</td>";
	echo "</tr>";
}
echo "<table>";
?>
<script>
	$(document).ready(function(){
		$("#testbtn").click(function(){
			$.ajax({
				'url': '/site/testajax/', 
				'type':'post', 
				'dataType':'html',
			    
				success: function(data) {
					$('#myModal').html(data);
					$('#myModal').modal("show");
				},
				'cache': false
			});
		});
	});

</script>
