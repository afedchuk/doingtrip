<?php 
/**
 * ERecentlyViewedBehavior is a behavior for managing recently viewed model items.
 */
class ERecentlyViewedBehavior extends CBehavior
{

        /**
         * @param integer the limit to the number of items in the recently viewed list.
         */
        var $limit = 0; // 0 = no limit.

        /**
         * Adds an item id to a 'recently viewed items' session object.
         * @var string the modelClass of the item to store
         * @param integer the id of the item to store
         */
        protected function setRecentlyViewed($modelClass, $id)
        {
                // Create the session index
                $index = $modelClass.'_recently_viewed';

                // Check if the session index exists
                if (!isset(Yii::app()->session[$index]))
                {
                        $recentlyViewed = new CList();
                }
                else
                {
                        $recentlyViewed = Yii::app()->session[$index];
                        // Remove the id if it is already in the list
                        if ($recentlyViewed->contains($id))
                        {
                                $recentlyViewed->remove($id);
                        }
                        // If a limit is set, and the list is at (or over) the limit, remove oldest item(s)
                        if ($this->limit > 0 && $recentlyViewed->count() >= $this->limit)
                        {
                                $count = $recentlyViewed->count() - $this->limit;
                                for ($i = 0; $i <= $count; $i++)
                                {
                                        $recentlyViewed->removeAt(0);
                                }
                        }
                }

                // Add the current item id to the end of the array
                $recentlyViewed->add($id);

                // Update the session
                Yii::app()->session[$index] = $recentlyViewed;
        }

        /**
         * Retrieves model records from a 'recently viewed items' session object.
         * @var string the modelClass of the items to retrieve
         */
        protected function getRecentlyViewed($modelClass, $with = array())
        {
                // Create the session index
                $index = $modelClass.'_recently_viewed';

                $models = array();

                // Check if the session index exists
                if (isset(Yii::app()->session[$index]))
                {
                        $recentlyViewed = Yii::app()->session[$index];

                        // Check if a limit is set, and if the list is at (or over) the limit
                        if ($this->limit > 0 && $recentlyViewed->count() >= $this->limit)
                        {
                                $count = $recentlyViewed->count() - $this->limit;
                                // Remove the oldest item(s) (always an index of 0 after each removal)
                                for ($i = 0; $i < $count; $i++)
                                {
                                        $recentlyViewed->removeAt(0);
                                }
                        }

                        // Convert the CList object stored in the session to an array
                        $recentlyViewed = $recentlyViewed->toArray();

                        // Reverse the array so the most recently added item is first
                        $recentlyViewed = array_reverse($recentlyViewed);

                        // Create a comma separated list for the db order property
                        $recentlyViewedCommaSeparated = implode(',', $recentlyViewed);

                        // Find all of the models with the array of ids recently viewed
                        // and order the results in the same order as the array
                        $criteria = new CDbCriteria;
                        $criteria->order = "FIELD(t.id, $recentlyViewedCommaSeparated)"; // MySQL function
                        if(!empty($with))
                            $models = CActiveRecord::model($modelClass)->with($with)->findAllByPk($recentlyViewed, $criteria);
                        else 
                            $models = CActiveRecord::model($modelClass)->findAllByPk($recentlyViewed, $criteria);
                }

                return $models;
        }

}
?>