<?php


class BookingModule extends Module{

    public static function t($str='',$params=array(),$dic='booking') {
            return Yii::t("BookingModule.".$dic, $str, $params);
    }

    public function getCountUnreadedBookings($userId) {
		return Booking::model()->getCountUnreaded($userId);
	}
}