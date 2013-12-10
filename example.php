<?php

class example
{

	private function createExercise($training, $copy)
	{
		$user = User::model()->findByPk(Yii::app()->user->id);
		$model = new TrainingExercise;
		$userId = NavigationHelper::getUserIdValue();
		$model->attributes = $_POST['TrainingExercise'];
		$model->trainingId = $training->id;
		if ($user->status == User::TRAINER && Yii::app()->user->id != $userId)
			$model->trainerId = Yii::app()->user->id;
		$model->sortOrder = Training::getExercisesCount($model->trainingId) + 1;

		if (!$model->save())
			throw new Exception("Error saving exercise: "
					. CVarDumper::dumpAsString($model->getErrors())
			);
		$exId = $model->exerciseId;
		$trainingExId = TrainingExercise::lastExercise($exId, $userId);
		$ctrainingExId = TrainingExercise::lastCardioExercise($exId, $userId);
		if ($copy == true) {
			$sets = TrainingExercise::getSets($trainingExId);
			$csets = TrainingExercise::getCardioSets($ctrainingExId);

			if ($csets != null) {
				foreach ($csets as $cs)
				{
					$newcSets = new TrainingCardioSet;
					$newcSets->trainingExId = $model->id;
					$newcSets->distance = $cs->distance;
					$newcSets->time = $cs->time;
					Yii::log(CVarDumper::dumpAsString($cs->distance, 'warning'));
					$newcSets->save();
				}
			} else {
				foreach ($sets as $s)
				{
					$newSets = new TrainingSet;
					$newSets->trainingExId = $model->id;
					$newSets->weight = $s->weight;
					$newSets->restTime = $s->restTime;
					$newSets->rep = $s->rep;
					$newSets->save();
					Yii::log(CVarDumper::dumpAsString($s->weight), 'warning');
				}
			}
		}
		return $model;
	}

	public function actionUpdateExercise($id)
	{
		$model = Exercise::model()->findByPk($id);
		$userId = Yii::app()->user->id;
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');

		Yii::app()->getClientScript()->registerCoreScript('jquery');

		if (isset($_POST['Exercise'])) {
			$model->attributes = $_POST['Exercise'];
			if ($model->systemId === NULL) {
				$userExercise = new Exercise;
				$userExercise->exerciseName = $model->exerciseName;
				$userExercise->exerciseNameru = $model->exerciseNameru;
				$userExercise->exerciseTypeId = $model->exerciseTypeId;
				$userExercise->userId = $userId;
				$userExercise->systemId = $model->id;
				$userExercise->groupId = $model->groupId;
				$userExercise->save();
			}
			if ($model->systemId != NULL)
				$model->save();
			$this->redirect(array('view', 'id' => $model->groupId));
		}

		if (Yii::app()->request->isAjaxRequest)
			$this->renderPartial('/exercise/update', array('model' => $model,));
	}

}
?>