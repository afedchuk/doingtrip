<?php 

/**
 * DBHttpSession
 *
 * Stores session data in database and transfer data when session is destroy.
 * Uses for get users online, user's last activity and last ip (and more information if needed)
 *
 *
 * Add this to component section in config/main.php
 *
 * 'session' => array (
 * 'class' => 'application.components.DbHttpSession',
 * 'connectionID' => 'db',
 * 'sessionTableName' => 'session',
 * 'userTableName' => 'user'
 * ),
 *
 * Session table will be created automatically
 *
 *
 * Add columns to your user table:
 * ALTER TABLE user ADD user_id INT(11) NOT NULL, ADD last_ip VARCHAR(100) NOT NULL, ADD last_activity DATETIME NOT NULL
 *
 */
class DbHttpSession extends CDbHttpSession
{
    public $userTableName = "ore_users";


    /**
     * Transfer data to user table when session is destroy or delete expired records
     *
     * @param        int user_id
     * @param string $last_activity
     */
    protected function transferData($user_id, $last_activity, $last_ip)
    {
        $last_activity = strtotime($last_activity);
        $db = $this->getDbConnection();
        $command = $db->createCommand(
            "UPDATE $this->userTableName SET lastvisit=\"$last_activity\", last_ip=\"$last_ip\" WHERE id=$user_id"
        );
        $command->execute();
        return true;
    }

    /**
     * Clear expired records from session table and transfer data to user table from the records
     */
    protected function clearOldSessions()
    {
        $db = $this->getDbConnection();
        $time = time();
        try {
            $command = $db->createCommand("SELECT * FROM $this->sessionTableName WHERE expire<\"$time\"");
            $result = $command->queryAll();
            foreach ($result as $item) {
                $id = $item["id"];
                $user_id = $item["user_id"];
                $last_activity = strtotime($item["last_activity"]);
                $last_ip = $item["last_ip"];

                $cmdUpd = $db->createCommand(
                    "UPDATE $this->userTableName SET lastvisit=\"$last_activity\", last_ip=\"$last_ip\"  WHERE id=$user_id"
                );
                $cmdDel = $db->createCommand("DELETE FROM $this->sessionTableName WHERE id=\"$id\"");
                $cmdDel->execute();
                
            }
        } catch (Exception $e) {
            //TODO write log
            $this->createSessionTable($db, $this->sessionTableName);
        }
    }

    protected function createSessionTable($db, $tableName)
    {
        parent::createSessionTable($db, $tableName);
        $db->createCommand()->addColumn($tableName, 'user_id', 'integer not null');
        $db->createCommand()->addColumn($tableName, 'last_activity', 'datetime not null');
        $db->createCommand()->addColumn($tableName, 'last_ip', 'string not null');
    }

    public function openSession($savePath, $sessionName)
    {
        $db = $this->getDbConnection();
        $db->setActive(true);
        $this->clearOldSessions();

        return true;
    }

    public function writeSession($id, $data)
    {
        try {
            $expire = time() + $this->getTimeout();
            $db = $this->getDbConnection();
            if ($db->getDriverName() == 'sqlsrv' || $db->getDriverName() == 'mssql'
                || $db->getDriverName() == 'dblib'
            ) {
                $data = new CDbExpression('CONVERT(VARBINARY(MAX), ' . $db->quoteValue($data) . ')');
            }
            if ($db->createCommand()->select('id')->from($this->sessionTableName)->where('id=:id', array(':id' => $id))
                    ->queryScalar() === false
            ) {
                //Add needed fields to the queries
                //$user=Yii::app()->getComponent('user',false);
                //$userId=empty($user)||is_null($user)||!isset($user)?null:$user->getId();
                $db->createCommand()->insert(
                    $this->sessionTableName, array(
                        'id'            => $id,
                        'data'          => $data,
                        'expire'        => $expire,
                        'user_id'       => Yii::app()->user->id !== null ? Yii::app()->user->id : 0,
                        'last_activity' => new CDbExpression('NOW()'),
                        'last_ip'       => CHttpRequest::getUserHostAddress(),
                    )
                );
            } else {
                $db->createCommand()->update(
                    $this->sessionTableName, array(
                        'data'          => $data,
                        'expire'        => $expire,
                        'user_id'       => Yii::app()->user->id !== null ? Yii::app()->user->id : 0,
                        'last_activity' => new CDbExpression('NOW()'),
                        'last_ip'       => CHttpRequest::getUserHostAddress(),
                    ), 'id=:id', array(':id' => $id)
                );
            }
        } catch (Exception $e) {
            //$this->createSessionTable($db, $this->sessionTableName);
            if (YII_DEBUG) {
                echo $e->getMessage();
            }
            return false;
        }
        return true;
    }


    public function destroySession($id)
    {

        $db = $this->getDbConnection();
        $command = $db->createCommand("SELECT user_id, last_activity, last_ip FROM $this->sessionTableName WHERE id=\"$id\"");
        $result = $command->queryRow();

        $this->transferData($result['user_id'], $result['last_activity'], $result['last_ip']);

        $db->createCommand()
            ->delete($this->sessionTableName, 'id=:id', array(':id' => $id));
        return true;
    }


    public function gcSession($maxLifetime)
    {
        $this->clearOldSessions();
        return true;
    }


} 

?>