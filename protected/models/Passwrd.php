<?php

/**
 * This is the model class for table "passwrd".
 *
 * The followings are the available columns in table 'passwrd':
 * @property integer $idno
 * @property string $userid
 * @property string $passwd
 * @property string $officecod
 * @property string $locatcd
 * @property string $level
 * @property string $chglocat
 * @property string $backdt
 * @property string $keydisc
 * @property string $block
 * @property string $design
 * @property string $rprint
 * @property string $group
 * @property string $expire
 * @property string $endcode
 * @property string $c_approv
 * @property string $c_paid
 * @property string $cuscod
 * @property string $deprt
 * @property string $srhactv
 * @property string $rprn
 * @property string $bprn
 * @property string $editprn
 * @property string $chgloc
 * @property string $chgdate
 * @property string $update1
 * @property string $editgl
 * @property string $overyear
 * @property string $flagid
 * @property string $editcust
 * @property string $approve
 * @property string $approve_amnt
 * @property string $ytypdisct
 * @property string $keycost
 * @property string $keypay
 * @property string $editpaytyp
 * @property string $prntax
 * @property string $chgpaytyp
 *
 * The followings are the available model relations:
 * @property Invlocat $locatcd0
 * @property Hdimporttemp $officecod0
 */
class Passwrd extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'passwrd';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('userid, passwd', 'required'),
            array('userid, passwd', 'length', 'max' => 15),
            array('officecod, locatcd, cuscod, srhactv', 'length', 'max' => 8),
            array('level, chglocat, backdt, keydisc, block, design, rprint, c_approv, c_paid, rprn, bprn, editprn, chgloc, chgdate, editgl, overyear, flagid, editcust, approve, keycost, keypay, editpaytyp, prntax, chgpaytyp', 'length', 'max' => 1),
            array('group, deprt', 'length', 'max' => 2),
            array('endcode', 'length', 'max' => 80),
            array('approve_amnt', 'length', 'max' => 12),
            array('ytypdisct', 'length', 'max' => 50),
            array('expire, update1', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idno, userid, passwd, officecod, locatcd, level, chglocat, backdt, keydisc, block, design, rprint, group, expire, endcode, c_approv, c_paid, cuscod, deprt, srhactv, rprn, bprn, editprn, chgloc, chgdate, update1, editgl, overyear, flagid, editcust, approve, approve_amnt, ytypdisct, keycost, keypay, editpaytyp, prntax, chgpaytyp', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'locatcd0' => array(self::BELONGS_TO, 'Invlocat', 'locatcd'),
            'officecod0' => array(self::BELONGS_TO, 'Officer', 'officecod'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idno' => 'Idno',
            'userid' => 'รหัสผู้ใช้',
            'passwd' => 'รหัสผ่าน',
            'officecod' => 'รหัสพนักงาน',
            'locatcd' => 'สาขาที่ทำงาน',
            'level' => 'ระดับการทำงาน',
            'chglocat' => 'ทำงานข้ามสาขา',
            'backdt' => 'คีย์วันที่ย้อนหลัง',
            'keydisc' => 'ให้ส่วนลดลูกค้า',
            'block' => 'ระงับการใช้งาน',
            'design' => 'แก้ไขรายงาน',
            'rprint' => 'ปริ้นย้อนหลัง',
            'group' => 'Group',
            'expire' => 'Expire',
            'endcode' => 'Endcode',
            'c_approv' => 'C Approv',
            'c_paid' => 'C Paid',
            'cuscod' => 'Cuscod',
            'deprt' => 'Deprt',
            'srhactv' => 'Srhactv',
            'rprn' => 'Rprn',
            'bprn' => 'Bprn',
            'editprn' => 'Editprn',
            'chgloc' => 'Chgloc',
            'chgdate' => 'Chgdate',
            'update1' => 'Update1',
            'editgl' => 'Editgl',
            'overyear' => 'Overyear',
            'flagid' => 'Flagid',
            'editcust' => 'Editcust',
            'approve' => 'Approve',
            'approve_amnt' => 'Approve Amnt',
            'ytypdisct' => 'Ytypdisct',
            'keycost' => 'Keycost',
            'keypay' => 'Keypay',
            'editpaytyp' => 'Editpaytyp',
            'prntax' => 'Prntax',
            'chgpaytyp' => 'Chgpaytyp',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('idno', $this->idno);
        $criteria->compare('userid', $this->userid, true);
        $criteria->compare('passwd', $this->passwd, true);
        $criteria->compare('officecod', $this->officecod, true);
        $criteria->compare('locatcd', $this->locatcd, true);
        $criteria->compare('level', $this->level, true);
        $criteria->compare('chglocat', $this->chglocat, true);
        $criteria->compare('backdt', $this->backdt, true);
        $criteria->compare('keydisc', $this->keydisc, true);
        $criteria->compare('block', $this->block, true);
        $criteria->compare('design', $this->design, true);
        $criteria->compare('rprint', $this->rprint, true);
        $criteria->compare('group', $this->group, true);
        $criteria->compare('expire', $this->expire, true);
        $criteria->compare('endcode', $this->endcode, true);
        $criteria->compare('c_approv', $this->c_approv, true);
        $criteria->compare('c_paid', $this->c_paid, true);
        $criteria->compare('cuscod', $this->cuscod, true);
        $criteria->compare('deprt', $this->deprt, true);
        $criteria->compare('srhactv', $this->srhactv, true);
        $criteria->compare('rprn', $this->rprn, true);
        $criteria->compare('bprn', $this->bprn, true);
        $criteria->compare('editprn', $this->editprn, true);
        $criteria->compare('chgloc', $this->chgloc, true);
        $criteria->compare('chgdate', $this->chgdate, true);
        $criteria->compare('update1', $this->update1, true);
        $criteria->compare('editgl', $this->editgl, true);
        $criteria->compare('overyear', $this->overyear, true);
        $criteria->compare('flagid', $this->flagid, true);
        $criteria->compare('editcust', $this->editcust, true);
        $criteria->compare('approve', $this->approve, true);
        $criteria->compare('approve_amnt', $this->approve_amnt, true);
        $criteria->compare('ytypdisct', $this->ytypdisct, true);
        $criteria->compare('keycost', $this->keycost, true);
        $criteria->compare('keypay', $this->keypay, true);
        $criteria->compare('editpaytyp', $this->editpaytyp, true);
        $criteria->compare('prntax', $this->prntax, true);
        $criteria->compare('chgpaytyp', $this->chgpaytyp, true);
        
        $criteria->addCondition("level = '1'");

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Passwrd the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    // ฟังก์ชั่น ตรวจสอบข้อมูลรหัสผ่านเหมือนกันหรือไม่
    public function validatePassword2($username, $password) {
        return $this->hashPassword($username, $password) === $this->endcode;
    }

    public function hashPassword($username, $password) {
        $xascii = chr(127);
        $userLength = strlen($username);
        $length = $userLength;
        for ($i = 0; $i < $length; $i++) {
            $userLength = $userLength + ord($username[$i]) * ($i + 1) + (strlen($username));
        }
        $passLength = strlen($password);
        $pslength = $passLength;
        $strpass = "";
        for ($j = 0; $j < $pslength; $j++) {
            $passLength = $userLength + ord($password[$j]) + ($j + 1);
            $strpass = $strpass . $passLength . chr(127);
        }
        //$strpass = ereg_replace(chr(127),"",$strpass);
        $endcode = chr(127) . $strpass;

        return $endcode;
        //return $password;
    }
    
    public function viewSearch($level){
        $criteria = new CDbCriteria();
        $criteria->condition = 'level=:id';
        $criteria->params = array(':id'=>$level);
        $model = Passwrd::model()->find($criteria);
    }

}
