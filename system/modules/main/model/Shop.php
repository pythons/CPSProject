<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015-11-19
 * Time: 17:01
 */

namespace application\modules\main\model;


use cloud\core\model\Model;

class Shop extends Model {

    public static $status = array("0"=>"合作中","1"=>"暂停","2"=>"流失");
    public static $saleTypes = array(
        "直钻业务"=>"直钻业务",
        "直通车业务"=>"直通车业务",
        "钻展业务"=>"钻展业务",
        "其它业务"=>"其它业务"
    );

    public static $searchSaleTypes = array(
        ""=>"所有业务",
        "直钻业务"=>"直钻业务",
        "直通车业务"=>"直通车业务",
        "钻展业务"=>"钻展业务",
        "其它业务"=>"其它业务"
    );

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
        return '{{shop}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(

            array('userid,nick,usernumid','unique'),
            array('shopid,shopname,shopcatname,shopurl,login_nick, login_password,pic,zuanshi_pic,bigdata_pic,ztc_pic,sub_pic,status,shoptype,create_date,open_date,stop_date,off_date', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('userid,nick,usernumid,shopid,shopname,shopcatname,shopurl,login_nick, login_password,pic,zuanshi_pic,bigdata_pic,ztc_pic,sub_pic,status,shoptype,create_date,open_date,stop_date,off_date', 'safe', 'on'=>'search'),
        );
    }


    public static function summary(){
        $sql = <<<EOT
select count(*) as total,
    sum(if(status=0,1,0)) as opentotal,
    sum(if(status=1,1,0)) as stoptotal,
    sum(if(status=2,1,0)) as offtotal,
    sum(if(shoptype="直通车业务" && status=0,1,0)) as ztc_total,
    sum(if(shoptype="钻展业务" && status=0,1,0)) as zuanshi_total,
    sum(if(shoptype="直钻业务" && status=0,1,0)) as ztc_zuanshi_total
from `cps_shop`;

EOT;

        /**
         * @var \CDbCommand $command
         */
        $command = \Yii::app()->db->createCommand($sql);
        return $command->queryRow();
    }

    public static function summaryByZtc(){
        $sql = <<<EOT
    select ztc_pic AS pic,sum(if(status=0,1,0)) as opentotal,
sum(if(status=1,1,0)) as stoptotal,
sum(if(status=2,1,0)) as offtotal,
sum(if(shoptype="直钻业务" && status=0,1,0)) as typetotal1,
sum(if(shoptype="直通车业务" && status=0,1,0)) as typetotal2,
sum(if(shoptype="钻展业务" && status=0,1,0)) as typetotal3,
sum(if(zuanshi_pic!="" && status=0,1,0)) as typetotal4 ,
count(*) as total
 from `cps_shop` group by `ztc_pic` having opentotal>0
EOT;
        /**
         * @var \CDbCommand $command
         */
        $command = \Yii::app()->db->createCommand($sql);
        $list = $command->queryAll();
        $result = array();
        foreach($list as $row){
            if(!empty($row["pic"]) && strtoupper($row["pic"]) != "NULL"){
                $result[] = $row;
            }
        }
        return $result;
    }

    public static function summaryByZuanshi(){
        $sql = <<<EOT
    select zuanshi_pic as pic ,sum(if(status=0,1,0)) as opentotal,
sum(if(status=1,1,0)) as stoptotal,
sum(if(status=2,1,0)) as offtotal,
sum(if(shoptype="直钻业务" && status=0,1,0)) as typetotal1,
sum(if(shoptype="直通车业务" && status=0,1,0)) as typetotal2,
sum(if(shoptype="钻展业务" && status=0,1,0)) as typetotal3,
sum(if(ztc_pic!="" && status=0,1,0)) as typetotal4 ,
count(*) as total
 from `cps_shop` group by `zuanshi_pic` having opentotal>0
EOT;
        /**
         * @var \CDbCommand $command
         */
        $command = \Yii::app()->db->createCommand($sql);
        $list = $command->queryAll();
        $result = array();
        foreach($list as $row){
            if(!empty($row["pic"]) && strtoupper($row["pic"]) != "NULL"){
                $result[] = $row;
            }
        }
        return $result;
    }


}