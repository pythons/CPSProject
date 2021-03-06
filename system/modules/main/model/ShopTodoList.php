<?php
/**
 * @file ShopTodoList.php
 * @author ouyangjunqiu
 * @version Created by 16/5/16 16:34
 */

namespace application\modules\main\model;


use application\modules\main\utils\StringUtil;
use cloud\core\model\Model;
use cloud\core\utils\String;

class ShopTodoList extends Model
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Shop the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{shop_todolist}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(

            array('logdate,nick,priority,pic,content,status,creator,create_time,updator,update_time', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('logdate,nick,priority,pic,content,status,creator,create_time,updator,update_time', 'safe', 'on'=>'search'),
        );
    }

    public static function fetchHistoryListByNick($nick){
        $startDate = date("Y-m-d",strtotime("-7 days"));
        $endDate =  date("Y-m-d",strtotime("-1 days"));

        $history = self::model()->fetchAll("logdate>=? AND logdate<=? AND nick=? AND status!=? ORDER BY logdate ASC",array($startDate,$endDate,$nick,2));
        foreach($history as &$row){
            $row["title"] = String::ireplaceUrl($row["content"],"<small>[链接]</small>");
            $row["md5"] = md5($row["nick"]);
            $row["days"] = ceil((strtotime($row["logdate"])-strtotime(date("Y-m-d")))/3600/24);

            $row["daysStr"] = StringUtil::daysFormat($row["days"]);
        }
        return $history;
    }

    public static function fetchCurrentListByNick($nick){
        $startDate = date("Y-m-d");
        $endDate =  date("Y-m-d",strtotime("+7 days"));
        $result = self::model()->fetchAll("logdate>=? AND logdate<=? AND nick=? AND status!=? ORDER BY logdate ASC",array($startDate,$endDate,$nick,2));
        $todolist = array();

        foreach($result as $row){
            if(strtotime($row["logdate"])>=strtotime("+1 days")){
                $key = date("Ymd",strtotime("+1 days"));
            }else{
                $key = date("Ymd",strtotime($row["logdate"]));
            }

            $row["title"] = String::ireplaceUrl($row["content"],"<small>[链接]</small>");
            $row["days"] = ceil((strtotime($row["logdate"])-strtotime(date("Y-m-d")))/3600/24);

            $row["md5"] = md5($row["nick"]);
            $row["daysStr"] = StringUtil::daysFormat($row["days"]);


            $todolist[$key][] = $row;

        }

        $list = array();
        for($i=0;$i<=1;$i++){
            $key = date("Ymd",strtotime("$i days"));
            if(isset($todolist[$key])){
                $list[] = $todolist[$key];
            }else{
                $list[] = array();
            }
        }
        return $list;
    }

    public static function fetchRangeListByNick($nick,$start,$end){

        $result = self::model()->fetchAll("logdate>=? AND logdate<=? AND nick=? AND status!=? ORDER BY logdate ASC",array($start,$end,$nick,2));
        $list = array();

        foreach($result as $row){
            $row["title"] = String::ireplaceUrl($row["content"],"<small>[链接]</small>");
            $row["days"] = ceil((strtotime($row["logdate"])-strtotime(date("Y-m-d")))/3600/24);

            $row["md5"] = md5($row["nick"]);
            $row["daysStr"] = StringUtil::daysFormat($row["days"]);

            $list[] = $row;
        }

        return $list;

    }

    public static function fetchListByPic($pic){
        $startDate = date("Y-m-d",strtotime("-7 days"));
        $endDate =  date("Y-m-d");
        $result = self::model()->fetchAll("logdate>=? AND logdate<=? AND pic=? AND status=? ORDER BY logdate ASC",array($startDate,$endDate,$pic,0));
        foreach($result as &$row){
            $row["title"] = String::ireplaceUrl($row["content"],"<small>[链接]</small>");
            $row["days"] = ceil((strtotime($row["logdate"])-strtotime(date("Y-m-d")))/3600/24);

            $row["md5"] = md5($row["nick"]);
            $row["daysStr"] = StringUtil::daysFormat($row["days"]);
        }
        return $result;

    }

    public static function fetchGroupByPic($pic){
        $list = self::fetchListByPic($pic);

        $ret = array();
        foreach($list as $row){
            $ret[$row["nick"]][] = $row;
        }
        return $ret;
    }

    public static function fetchListByCreator($pic){
        $startDate = date("Y-m-d",strtotime("-7 days"));
        $endDate =  date("Y-m-d");
        $result = self::model()->fetchAll("logdate>=? AND logdate<=? AND creator=? AND status!=?",array($startDate,$endDate,$pic,2));
        foreach($result as &$row){
            $row["title"] = String::ireplaceUrl($row["content"],"<small>[链接]</small>");
            $row["days"] = ceil((strtotime($row["logdate"])-strtotime(date("Y-m-d")))/3600/24);

            $row["md5"] = md5($row["nick"]);
            $row["daysStr"] = StringUtil::daysFormat($row["days"]);
        }
        return $result;

    }

    public static function fetchGroupByCreator($pic){
        $list = self::fetchListByCreator($pic);

        $ret = array();
        foreach($list as $row){
            $ret[$row["nick"]][] = $row;
        }
        return $ret;
    }



}