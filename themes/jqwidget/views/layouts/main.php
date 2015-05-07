<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="ระบบควบคุมเงินกู้ (System Loan) : Softnetwork Co.,Ltd." name="description">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>ระบบควบคุมเงินกู้ (System Loan) : Softnetwork Co.,Ltd.</title>
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl ?>/images/favicon.ico" />
    <!-- add the Bootstrap styles -->
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/styles/bootstrap.min.css" type="text/css" />
    <!-- add one of the jQWidgets styles -->
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/jqwidgets/styles/jqx.base.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/jqwidgets/styles/jqx.ui-redmond.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/styles/style.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/styles/font-awesome.min.css" type="text/css" />
    <!-- add the jQuery script -->
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/script.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/demos.js"></script>
    <!-- add the Bootstrap script -->
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/bootstrap.min.js"></script>
    <!-- add the jQWidgets framework -->
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/jqwidgets/jqxcore.js"></script>
    <!-- add one or more widgets -->
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/jqwidgets/jqx-all.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/jqwidgets/globalization/globalize.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/jqwidgets/globalization/globalize.culture.th-TH.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="header">
        <div style="position: absolute; text-align: center; width: 100%; height: 50px; font-size: 22px; font-weight: bold; padding-top: 8px"> บริษัท ทดสอบ จำกัด </div>
        <img class="logo" src='<?php echo Yii::app()->theme->baseUrl; ?>/images/SN-LOGO-WEB.png' />
            <div class="navbar-right">
            <?php
            $this->widget('zii.widgets.CMenu', array(
                'htmlOptions' => array('class' => 'nav navbar-nav'),
                'encodeLabel' => FALSE,
                'items' => array(
                    array('label' => 'Home', 'url' => array('/')),
                    array('label' => '<i class="glyphicon glyphicon-user"></i> Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                    array('label' => '<i class="glyphicon glyphicon-off"></i> Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                )
            ));
            ?>
        </div>
    </div>
    <div class="content">
        <div id="mainSplitter">
            <div>
            <div style="visibility: hidden; border: none;" id='jqxTree'>
                <ul>
                <?php
                    $sql = "select a.systemcod,a.menucod,a.m_access,b.menudesc from menutrn a,menumst b
                            where a.menucod=b.menucod and a.userid='SETUP' and a.m_access='T'  and a.systemcod='LOAN'
                            group by a.systemcod,a.menucod,a.m_access,b.menudesc
                            order by a.menucod ";
                    $command = Yii::app()->db->createCommand($sql);
                    $dataReader = $command->query();
                    $i = 0;
                    $dataReader->bindColumn(2, $menucode);
                    $dataReader->bindColumn(4, $menudesc);
                    while ($dataReader->read() !== false) {
                        switch (trim($menucode)) {
                            case "A" : $icon = "fa-cog";
                                break;
                            case "B" : $icon = "fa-car";
                                break;
                            case "C" : $icon = "fa-money";
                                break;
                            case "D" : $icon = "fa-users";
                                break;
                            case "E" : $icon = "fa-tags";
                                break;
                            case "F" : $icon = "fa-print";
                                break;
                            default : $icon = "fa-home";
                                break;
                        }
                        echo '<li id="'.$menucode.'"><i class="fa '.$icon.' fa-lg"></i><span item-title="true"> '.$menudesc.'</span>';
                        $sql2 = "select idno,userid,systemcod,menucod,menutrncod,menudesc,
                            m_access,m_edit,m_delete,m_insert,stat
                            from menutrn where userid ='SETUP' and systemcod ='LOAN' and m_access='T'
                            and menucod ='" . $menucode . "' order by menutrncod";
                        $command2 = Yii::app()->db->createCommand($sql2);
                        $dataReader2 = $command2->query();
                        $dataReader2->bindColumn(5, $menucode2);
                        $dataReader2->bindColumn(6, $menudesc2);
                        echo '<ul>';
                        while ($dataReader2->read() !== false) {
                            switch (trim($menucode)) {
                                case "F" : $icon2 = '';
                                    break;
                                default : $icon2 = '<i class="fa fa-angle-double-right"></i>';
                                    break;
                            }
                            echo '<li id="'.$menucode2.'"></i>'.$icon2.'<span item-title="true"> '.$menudesc2.'</span>';
                            $sql3 = "select idno,menucod,menutrncod,submenutrncod,menudesc,m_access
                                     m_edit,m_delete,m_insert,stat
                                     from submenutrn where menucod ='".$menucode."' and menutrncod ='".$menucode2."' and
                                     userid ='SETUP' and m_access='T' order by submenutrncod ";
                            $command3 = Yii::app()->db->createCommand($sql3);
                            $dataReader3 = $command3->query();
                            $dataReader3->bindColumn(4, $menucode3);
                            $dataReader3->bindColumn(5, $menudesc3);
                            echo '<ul>';
                            while ($dataReader3->read() !== false) {
                                echo '<li id="'.$menucode3.'"><i class="fa fa-file-text-o"></i><span item-title="true"> '.$menudesc3.'</span></li>';
                            }
                            echo '</ul>';
                            echo '</li>';
                        }
                        echo '</ul>';
                        echo '</li>';
                    }
                ?>
                </ul>
            </div>
            </div>
            <div>
                <div id="jqxTabs">
                    <ul style='margin-left: 10px;'>
                        <li>หน้าแรก</li>
                    </ul>
                    <div style='background-image: url("<?php echo Yii::app()->request->baseUrl ?>/images/BG-LOAN3.jpg"); background-size: 100% 100%;'>
                        <div id='jqxWidget'>
                            <div class="showform" id="showform">
                                <?php echo $content; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <?php
            $userid = Yii::app()->user->name;
            $sql9 = "select a.userid, a.locatcd, a.officecod, b.name, b.surname, c.locatnm from passwrd a left join officer b on a.officecod = b.code left join invlocat c on a.locatcd = c.locatcd where a.userid='".$userid."' ";
            $command9 = Yii::app()->db->createCommand($sql9);
            $dataReader9 = $command9->query();
            $dataReader9->bindColumn(2, $locatcd);
            $dataReader9->bindColumn(3, $officecod);
            $dataReader9->bindColumn(4, $name);
            $dataReader9->bindColumn(5, $surname);
            $dataReader9->bindColumn(6, $locatnm);
            while ($dataReader9->read() !== false) {
                echo '<div id="status1" class="statusbar">ผู้ใช้งานระบบ : ('.Yii::app()->user->name.') '.$name.$surname.'</div>';
                echo '<div id="status2" class="statusbar">สาขา : ('.$locatcd.') '.$locatnm.'</div>';
            }
        ?>
        <div id="status3" class="statusbar"></div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            var theme = 'ui-redmond';
            var width = $(window).width();
            var height = $(window).height();
            $('#mainSplitter').jqxSplitter({ width: '100%', height: '100%', panels: [{ size: '15%' }, { size: '85%' }], theme: theme });
            $('#jqxTree').jqxTree({  height: '100%', width: '100%', theme: theme });
            $('#jqxTree').css('visibility', 'visible');
            $('#jqxTree').on('select', function (event) {
                var item = $('#jqxTree').jqxTree('getItem', event.args.element);
                var menucod = '';
                var menudesc = item.label;
                switch (item.id) {
                    case 'SET01': menucod = 'invlocat'; break;
                    case 'SET06': menucod = 'setgroup'; break;
                    case 'SET07': menucod = 'payfor';   break;
                    case 'SET08': menucod = 'paytyp';   break;
                    case 'SET09': menucod = 'setgrade'; break;
                    case 'SET10': menucod = 'settumb';  break;
                    case 'SET11': menucod = 'setaump';  break;
                    case 'SET12': menucod = 'setprov';  break;
                    case 'SET13': menucod = 'typecont'; break;
                    case 'SET14': menucod = 'vatmast';  break;
                    case 'SET15': menucod = 'intrmast'; break;
                    case 'SET16': menucod = 'table1';   break;
                    case 'SET17': menucod = 'setzone';  break;
                    case 'SET18': menucod = 'condpay';  break;
                    case 'SET19': menucod = 'officer';  break;
                    case 'SET20': menucod = 'garmast';  break;
                    case 'SET21': menucod = 'appdate';  break;
                    case 'SET22': menucod = 'dbconfig';  break;
                    case 'SET23': menucod = 'setarlost';  break;
                    case 'SET24': menucod = 'setargroup';  break;
                    case 'SET25': menucod = 'setlocatamt'; break;
                    case 'SET26': menucod = 'payforlocat'; break;
                    case 'SET27': menucod = 'setoccup';  break;
                    case 'SALE01': menucod = 'customer';  break;
                }
                if (menucod !== '') {
                    var length = $('#jqxTabs').jqxTabs('length');
                    var j = 0;
                    var k = 0;
                    //console.log('Tab Open : '+length);
                    for (var i = 0; i < length; i++) {
                        var title = $('#jqxTabs').jqxTabs('getTitleAt', i);
                        if (menudesc == title) {
                            k = i;
                            j++;
                        }
                        //console.log(menudesc+' == '+title);
                    };
                    //console.log(j);
                    if (j == 0) {
                        $.ajax({
                            url: menucod,
                            data: { menucod: menucod },
                            type: 'get',
                            success: function(data) {
                                $('#jqxTabs').jqxTabs('addLast', menudesc, '<div class="showform" id="'+menucod+'">'+data+'</div>');
                                $('#jqxTabs').jqxTabs('ensureVisible', -1);
                            },
                            error: function (error) {
                                document.location.href = '';
                            }
                        });
                    } else {
                        $('#jqxTabs').jqxTabs({ selectedItem: k });
                    }
                    $('#jqxTree').jqxTree('selectItem', null);
                }
            });
            //$("#jqxWidget").jqxPanel({ width: '100%', height: '100%', autoUpdate: true, theme: theme});
            //(width-570);
            $('#jqxTabs').jqxTabs({ height: '100%', width: '100%',  showCloseButtons: true, scrollable:false, theme: theme, reorder: true });
            $("#status1").jqxPanel({ width: '320', height: '18', theme: theme});
            $("#status2").jqxPanel({ width: '250', height: '18', theme: theme});
            $("#status3").jqxPanel({ width: width-589, height: '18', theme: theme});
        });
    </script>
</body>
</html>
