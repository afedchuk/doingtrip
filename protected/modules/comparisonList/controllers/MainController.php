<?php


class MainController extends ModuleUserController {
	public $modelName = 'ComparisonList';
	public $defaultAction = 'index';


	public function actionIndex() {
		Yii::import('application.modules.apartments.helpers.apartmentsHelper');
		Yii::app()->getModule('referencecategories');

		$criteria= new CDbCriteria;
		$criteria->addInCondition(Apartment::model()->getTableAlias().'.id', Yii::app()->controller->apInComparison);
		$apartments = Apartment::model()
            ->cache(param('cachingTime', 1209600), Apartment::getDependency())
            ->with(array( 'description', 'services', 'images', 'city', 'avalibility'))
            ->findAll($criteria);

        if(!$apartments) {
        	Yii::app()->user->setFlash('warning', ComparisonListModule::t('List empty'));
        	$this->redirect(Yii::app()->createAbsoluteUrl('apartments'));
        }
        
		$this->render('index', array('apartments' => $apartments));
	}

	public function actionAdd() {
		// удаляем старые
		$this->deleteOld();

		if(Yii::app()->request->isAjaxRequest){
			$userId = $apartmentId = $sessionId = '';

			if (!Yii::app()->user->isGuest)
				$userId = Yii::app()->user->id;

			$apartmentId = (int) Yii::app()->request->getParam('apId');
			$sessionId = Yii::app()->session->sessionId;

			if (Yii::app()->user->isGuest) {
				$currCount = ComparisonList::getCountListingsGuest($sessionId);
			}
			else {
				$currCount = ComparisonList::getCountListingsUser($userId);
			}

			if ($currCount >= param('countListingsInComparisonList', 6)) {
				echo 'max_limit';
				Yii::app()->end();
			}

			if ($apartmentId && $sessionId) {
				$model = new ComparisonList;
				$model->user_id = $userId;
				$model->apartment_id = $apartmentId;
				$model->session_id = $sessionId;

				if ($model->validate()) {
					if ($model->save(false)) {
						echo 'ok';
					}
				}
				else {
					echo 'no_valid';
				}
			}
			else {
				echo 'no_data';
			}
			Yii::app()->end();
		}
		else
			$this->redirect(Yii::app()->createAbsoluteUrl('/apartments'));
	}


	public function actionDel() {
		$userId = $apartmentId = $sessionId = '';

		if (!Yii::app()->user->isGuest)
			$userId = Yii::app()->user->id;

		$apartmentId = (int) Yii::app()->request->getParam('apId');
		$sessionId = Yii::app()->session->sessionId;

		if ($apartmentId) {
			if ($userId) {
				$result = ComparisonList::model()->findAllByAttributes(
					array(
						'apartment_id' => $apartmentId,
						'user_id' => $userId,
					)
				);
			}
			else {
				$result = ComparisonList::model()->findAllByAttributes(
					array(
						'apartment_id' => $apartmentId,
						'session_id' => $sessionId,
					)
				);
			}

			if ($result) {
				foreach ($result as $item) {
					$model = ComparisonList::model()->findByPk($item->id);
					$model->delete();
				}
			}

			if(Yii::app()->request->isAjaxRequest){
				echo 'ok';
			}
			else {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
			}
		}
		Yii::app()->end();
	}


	public function deleteOld() {
		# удаляем старые только "у гостей".
		$sql = 'DELETE FROM {{comparison_list}} WHERE (date_updated + INTERVAL 10 DAY) < NOW() AND user_id = 0';
		Yii::app()->db->createCommand($sql)->execute();
	}
}