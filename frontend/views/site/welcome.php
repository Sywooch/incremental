<?php
use app\models\Game;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = '10 Billion Bottles Of Beer';

$colorClass = 'red-haze';

$this->registerCssFile('css/jquery.simplyscroll.css');
$this->registerJsFile(Yii::getAlias("@web") . "/js/jquery.simplyscroll.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="site-index">
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-bar-chart font-dark hide"></i>
            <span class="caption-subject font-dark bold uppercase">Ten Billion Bottles of Beer</span>
            <span class="caption-helper">10b3.com</span>
        </div>
    </div>
    <div class="portlet-body">

                                
<!--CALL TO ACTION------------------------------------------------------------->
<div class="portlet light col-md-6 colx-xs-12">
        <div class="portlet-body">
            <div class="text-left col-xs-12">
                <p>
                    <h2>Header</h2>
                </p>
                <p class="lead">
                    Little blurb.
                </p>
                <p>
                    <?= Html::a('Signup!','site/signup', ['class' => 'btn btn-success']) ?>
                    <img class='col-md-6 col-xs-4' src='img/button/success.png' />
                </p>
            </div>
        </div>
</div>
<!--END CALL TO ACTION--------------------------------------------------------->

<!--AD VIDEO------------------------------------------------------------------->
<div class="portlet light col-md-6 col-xs-12">
        <div class="portlet-body">
            <div class="text-center col-md-12 col-xs-12">
                <div class="videoWrapper">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/qvBX9VgPGSg" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
</div>
<!--END AD VIDEO--------------------------------------------------------------->

<!--SCREENSHOTS------------------------------------------------------------------->
<div class="portlet light">
        <div class="portlet-body">
            <div class='col-md-12 col-xs-12'>
                <ul id="scroller">
                    <li><img src="img/header-pattern.jpg" width="290" height="200"></li>
                    <li><img src="img/header-pattern.jpg" width="290" height="200"></li>
                    <li><img src="img/header-pattern.jpg" width="290" height="200"></li>
                    <li><img src="img/header-pattern.jpg" width="290" height="200"></li>
                    <li><img src="img/header-pattern.jpg" width="290" height="200"></li>
                    <li><img src="img/header-pattern.jpg" width="290" height="200"></li>
                    <li><img src="img/header-pattern.jpg" width="290" height="200"></li>
                </ul>     
                <script type="text/javascript">
                    <?php
                    $script = '$("#scroller").simplyScroll();';
                    $this->registerJs($script);
                    ?>
                </script>
            </div>
        </div>
</div>
<!--END SCREENSHOTS--------------------------------------------------------------->

<!--FEATURES------------------------------------------------------------------->
<div class="portlet light">
        <div class="portlet-body">
            <div class='col-md-12 col-xs-12'>
                <div class="row widget-row">
                        <div class="col-md-4">
                            <!-- BEGIN WIDGET THUMB -->
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                <div class="widget-thumb-wrap">
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle">Recruit</span>
                                        <span class="widget-thumb-body-stat">Dwarves</span>
                                    </div>
                                    Image here.
                                </div>
                            </div>
                            <!-- END WIDGET THUMB -->
                        </div>
                        <div class="col-md-4">
                            <!-- BEGIN WIDGET THUMB -->
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                <div class="widget-thumb-wrap">
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle">Brew</span>
                                        <span class="widget-thumb-body-stat">Beer</span>
                                    </div>
                                    Image here.
                                </div>
                            </div>
                            <!-- END WIDGET THUMB -->
                        </div>
                        <div class="col-md-4">
                            <!-- BEGIN WIDGET THUMB -->
                            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                                <div class="widget-thumb-wrap">
                                    <div class="widget-thumb-body">
                                        <span class="widget-thumb-subtitle">Conquer</span>
                                        <span class="widget-thumb-body-stat">The World</span>
                                    </div>
                                    Image here.
                                </div>
                            </div>
                            <!-- END WIDGET THUMB -->
                        </div>
                    </div>
                    
            </div>
        </div>
</div>
<!--END FEATURES--------------------------------------------------------------->

<!--REVIEWS------------------------------------------------------------------->
    <div class="portlet light">
        <div class="portlet-body">
            <div class='col-md-12 col-xs-12'>
                <div class='col-md-12 col-xs-12'>
                    <div class="mt-comments">
                        <div class="mt-comment col-md-6 col-xs-12">
                            <div class="mt-comment-img">
                                <img src="../assets/pages/media/users/avatar1.jpg"> </div>
                            <div class="mt-comment-body">
                                <div class="mt-comment-info">
                                    <span class="mt-comment-author">Michael Baker</span>
                                    <span class="mt-comment-date"></span>
                                </div>
                                <div class="mt-comment-text"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy. </div>
                                <div class="mt-comment-details">
                                    <span class="mt-comment-status mt-comment-status-pending">Pending</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-comment col-md-6 col-xs-12">
                            <div class="mt-comment-img">
                                <img src="../assets/pages/media/users/avatar6.jpg"> </div>
                            <div class="mt-comment-body">
                                <div class="mt-comment-info">
                                    <span class="mt-comment-author">Larisa Maskalyova</span>
                                    <span class="mt-comment-date"></span>
                                </div>
                                <div class="mt-comment-text"> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </div>
                                <div class="mt-comment-details">
                                    <span class="mt-comment-status mt-comment-status-rejected">Rejected</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--END REVIEWS--------------------------------------------------------------->

<!--NEWSLETTER------------------------------------------------------------------->
<div class="portlet light">
        <div class="portlet-body">
            <div class='col-md-12 col-xs-12'>
                <p class="lead">
                    Newsletter here.
                </p>
            </div>
        </div>
</div>
<!--END NEWSLETTER--------------------------------------------------------------->

</div>
                            </div>
</div>
