function exUp(trainingId,ExId) {
	$.ajax({
		'url': '/training/exup/id/'+trainingId+'/ExId/'+ExId, 
		'type':'post', 
		'dataType':'html',
		data: {
			'trainingId':trainingId,
			'ExId':ExId
		},
		success: function(ok) {
		},
		'cache': false
	});

	curr = $('#exid'+ExId);
	prev = curr.prev();
	curr.insertBefore(prev);
	return false;
}


function hightLightTraining (date) {
	var day=date.getDate();
	var month = date.getMonth();
	var isTrainingDay = false;
	var isPastDay = false;
	var isComplete = false;
	
	curDate= new Date();
	{
		for (i in mdates) {
			if ((parseInt(mdates[i]["date"], 10)==day ) && (parseInt(mdates[i]["month"], 10)-1==month ))  {
				isTrainingDay = true;
				isPastDay = date.getTime() < curDate.getTime();
				isComplete = mdates[i]["isComplete"] == 1;
				break;
			}
		}
	}
        
	return [true, isTrainingDay ? (isPastDay ? 'pastTrain' : 'train') + (isComplete ? ' trainComplete' : '') : '', ''];
        
}



function actionTraining(date, fromDate, copy){
	action = copy?'copytraining':'movetraining';
	divId = copy?'overwriteOnCopy':'overwriteOnMove';
	$.ajax({
		'url': '/training/isExistTraining/dateTo/'+date+'/overwrite/'+($("#"+divId).is(':checked')?1:0), 
		'type':'post', 
		'dataType':'html',
		'success':function(data){
			window.location.href = "/training/"+action+"/dateFrom/"+fromDate+"/dateTo/"
			+date+"/overwrite/"+($("#"+divId).is(':checked')?1:0);
		},
		'error': function(jqXHR) {
			if (jqXHR.status === 0) {
				alert('Not connect.\n Verify Network.');
			} 
			else {
				alert(jqXHR.responseText);
			}
		},
		'cache': false
	});