<?php

class MainController extends ModuleUserController{
	public $modelName = 'Apartment';

	public function actionUpload($id, $tmp = false){
		if(!$tmp)
			$model = $this->checkOwner($id);
		else {
			$model = new $this->modelName();
			$model->id = $id;
			$model->user_id = 0;
		}

		Yii::import("ext.EAjaxUpload.qqFileUploader");

		$allowedExtensions = param('allowedImgExtensions', array('jpg', 'jpeg', 'gif', 'png'));

		//$sizeLimit = param('maxImgFileSize', 8 * 1024 * 1024);
		$sizeLimit = Images::getMaxSizeLimit();

		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);

		$path = Yii::getPathOfAlias('webroot.uploads.objects.'.$model->id.'.'.Images::ORIGINAL_IMG_DIR);
		$pathMod = Yii::getPathOfAlias('webroot.uploads.objects.'.$model->id.'.'.Images::MODIFIED_IMG_DIR);

		$oldUMask = umask(0);
		if(!is_dir($path)){
			@mkdir($path, 0777, true);
		}
		if(!is_dir($pathMod)){
			@mkdir($pathMod, 0777, true);
		}
		umask($oldUMask);

		if(is_writable($path) && is_writable($pathMod)){
			touch($path.DIRECTORY_SEPARATOR.'index.htm');
			touch($pathMod.DIRECTORY_SEPARATOR.'index.htm');

			$result = $uploader->handleUpload($path.DIRECTORY_SEPARATOR, false, uniqid());

			if(isset($result['success']) && $result['success']){
				$resize = new CImageHandler();
				if($resize->load($path.DIRECTORY_SEPARATOR.$result['filename'])){
					$resize->thumb(param('maxImageWidth', 1024), param('maxImageHeight', 768), Images::KEEP_PHOTO_PROPORTIONAL)
						->save();

					$image = new Images();
					$image->id_object = $model->id;
					$image->id_owner = $model->user_id;
					$image->file_name = $result['filename'];

					$image->save();
				} else {
					$result['error'] = 'Wrong image type.';
					@unlink($path.DIRECTORY_SEPARATOR.$result['filename']);
				}
			}
		} else {
			$result['error'] = 'Access denied.';
		}


		// to pass data through iframe you will need to encode all html tags
		$result = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		echo $result;
	}

	public function	checkOwner($id){
		$model = $this->loadModel($id);
		if(!$model || (!Yii::app()->user->getState('isAdmin') && Yii::app()->user->id != $model->user_id)){
			throw new CHttpException(301,'The requested page does not exist.');
		}
		return $model;
	}

	public function	checkOwnerImage($id){
		$this->modelName = 'Images';
		$model = $this->loadModel($id);
		if(!$model || (!Yii::app()->user->getState('isAdmin') && Yii::app()->user->id != $model->id_owner)){
			throw new CHttpException(301,'The requested page does not exist.');
		}
		return $model;
	}

	public function actionGetImagesForAdmin($id, $tmp = false){
		if(!$tmp)
			$model = $this->checkOwner($id);
		else {
			$model = new $this->modelName();
			$model->id = $id;
		}

		$this->widget('application.modules.images.components.AdminViewImagesWidget', array(
			'objectId' => $model->id,
		));
	}

	public function actionSetMainImage($id){
        if(isset($id) && $id) { 
			$model = $this->checkOwnerImage($id);

			$sql = 'UPDATE {{images}} SET is_main=0 WHERE id_object=:id';
			Yii::app()->db->createCommand($sql)->execute(array(':id' => $model->id_object));

			$model->is_main = 1;
			$model->update('is_main');
		} else
			throw new CHttpException(301,'The requested page does not exist.');
	}

	public function actionDeleteImage($id){
		if(isset($id) && $id) { 
			$model = $this->checkOwnerImage($id);

			$model->delete();
			if($model->is_main){
				$sql = 'SELECT id FROM {{images}} WHERE is_main=1 AND id_object=:id';
				echo Yii::app()->db->createCommand($sql)->queryScalar(array(':id' => $model->id_object));
			}
		} else
			throw new CHttpException(301,'The requested page does not exist.');
	}

	public function actionSort($id){
		if(isset($id) && $id) {
			$model = $this->checkOwner($id);
			
			$ids = Yii::app()->request->getPost('image');
			if($ids){
				$sorter = 0;
				foreach($ids as $id){
					$sql = 'UPDATE {{images}} SET sorter=:sorter WHERE id=:id AND id_object=:idObject';
					Yii::app()->db->createCommand($sql)->execute(array(
						':sorter' => $sorter,
						':id' => $id,
						':idObject' => $model->id,
					));
					$sorter++;
				}
			}
		} else
			throw new CHttpException(301,'The requested page does not exist.');
	}

	/*public function actionSaveComments($id){
		$model = $this->checkOwner($id);

		$comments = Yii::app()->request->getPost('photo_comment');
		if($comments){
			foreach($comments as $id => $comment){
				$sql = 'UPDATE {{images}} SET comment=:comment WHERE id=:id AND id_object=:idObject';
				Yii::app()->db->createCommand($sql)->execute(array(
					':id' => $id,
					':comment' => $comment,
					':idObject' => $model->id,
				));
			}
		}
	}*/

}