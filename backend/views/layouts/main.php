<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
    .user-img {
        border-radius: 50%;
        height: 25px;
        width: 25px;
        object-fit: cover;
    }
  </style>

</head>
<body>
<?php $this->beginBody() ?>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-primary navbar-dark ">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
        <?php if(isset(Yii::$app->user->identity->no)): ?>
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
        </li>
            <?php endif; ?>
        <li>
            <a class="nav-link text-white"  href="/" role="button"> <large><b><?php echo Yii::$app->user->identity->no?></b></large></a>
        </li>
        </ul>

        <ul class="navbar-nav ml-auto">
        
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
                <a class="nav-link"  data-toggle="dropdown" aria-expanded="true" href="javascript:void(0)">
                <span>
                    <div class="d-felx badge-pill">
                    <!-- <span class=""><img src="assets/uploads/>" alt="" class="user-img border "></span> -->
                    <span><b><?php echo ucwords(Yii::$app->user->identity->no) ?></b></span>
                    <span class="fa fa-angle-down ml-2"></span>
                    </div>
                </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
                <a class="dropdown-item" href="javascript:void(0)" id="manage_account"><i class="fa fa-cog"></i> Manage Account</a>
                <a class="dropdown-item" href="/site/logout"><i class="fa fa-power-off">
                </i> Logout
              </a>
                </div>
        </li>
        </ul>
    </nav>
    <!-- /.navbar -->

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="dropdown">
   	<a href="./" class="brand-link">
        <h3 class="text-center p-0 m-0"><b>ADMIN</b></h3>
        <!-- <h3 class="text-center p-0 m-0"><b>Evaluator</b></h3>
        <h3 class="text-center p-0 m-0"><b>Employee</b></h3> -->

    </a>
      
    </div>
    <div class="sidebar pb-4 mb-4">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
         <li class="nav-item dropdown">
            <a href="./" class="nav-link nav-home">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li> 

          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-users"></i>
              <p>
                SetUps
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="/strategic-plan-periods/" class="nav-link nav-new_user tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Startegic Plan Periods</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/strategic-objectives" class="nav-link nav-user_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Startegic Objectives</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/target-types" class="nav-link nav-user_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Targets Types</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/targets" class="nav-link nav-user_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Targets</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/navision-job-groups" class="nav-link nav-user_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Job Groups </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/appraisal-periods" class="nav-link nav-user_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Appraisal Periods </p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Corporate Work Plans
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/corporate-work-plan/" class="nav-link nav-new_user tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p> Open Corporate Work Plans</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/corporate-work-plan/submitted" class="nav-link nav-user_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p> Submitted Corporate Work Plans</p>
                </a>
              </li>
            </ul>
          </li>

        <?php //endif; ?>
          <?php //if($_SESSION['login_type'] == 2): ?>
        
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_employee">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Departmental Work Plans
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/department-work-plans/" class="nav-link nav-new_employee tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Open  Work Plans</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/department-work-plans/submitted" class="nav-link nav-employee_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Submitted  Work Plans</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_evaluator">
              <i class="nav-icon fas fa-user-secret"></i>
              <p>
                Employee WorkPlans
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/individual-work-plan/submitted" class="nav-link nav-new_evaluator tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Submitted Work Plans</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Employee Evalauations
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/evaluations/submitted" class="nav-link nav-new_user tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p> Submitted Employee Evaluations </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/corporate-work-plan/submitted" class="nav-link nav-user_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p> Submitted Corporate Work Plans</p>
                </a>
              </li>
            </ul>
          </li>
         
        <?//php endif; ?>
        </ul>
      </nav>
    </div>
  </aside>

  <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">



        <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body text-white">
            </div>
        </div>
        <div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?php echo $this->title ?></h1>
            </div><!-- /.col -->

            </div><!-- /.row -->
                <hr class="border-primary">
        </div><!-- /.container-fluid -->
        </div>
       <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">
                          <!-- // display success message -->
           <?php if (Yii::$app->session->hasFlash('success')): ?>
              <div class="alert alert-success alert-dismissable">
                  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                  <h4><i class="icon fa fa-check"></i>Saved!</h4>
                  <?= Yii::$app->session->getFlash('success') ?>
              </div>
          <?php endif; ?>

            <!-- // display error message -->
            <?php if (Yii::$app->session->hasFlash('error')): ?>
                <div class="alert alert-danger alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <h4><i class="icon fa fa-check"></i>Error!</h4>
                    <?= Yii::$app->session->getFlash('error') ?>
                </div>
            <?php endif; ?>

            <?php echo $content ?>
        </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
        <div class="modal fade" id="confirm_modal" role='dialog'>
            <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
            </div>
            <div class="modal-body">
                <div id="delete_content"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
        </div>

        <div class="modal fade" id="uni_modal" role='dialog'>
            <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
            </div>
            </div>
        </div>

        <div class="modal fade" id="uni_modal_right" role='dialog'>
            <div class="modal-dialog modal-full-height  modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="fa fa-arrow-right"></span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            </div>
            </div>
        </div>

        <div class="modal fade" id="viewer_modal" role='dialog'>
            <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                    <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
                    <img src="" alt="">
            </div>
            </div>
        </div>
  </div>
  <!-- /.content-wrapper -->
      <?php
          yii\bootstrap\Modal::begin([
              'headerOptions' => ['id' => 'modalHeader'],
              'id' => 'modal',
              'size' => 'modal-lg',
              'closeButton' => [
                  'id'=>'close-button',
                  'class'=>'close',
                  'data-dismiss' =>'modal',
                  ],
              //keeps from closing modal with esc key or by clicking out of the modal.
              // user must click cancel or X to close
              'clientOptions' => [
                  'backdrop' => false, 'keyboard' => true
                  ]
          ]);
          echo "<div id='modalContent'><div style='text-align:center'>" . Html::img('@web/img/radio.gif')  . "</div></div>";
          yii\bootstrap\Modal::end();
    ?>
 

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<script>
  	$(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
  		var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
      if(s!='')
        page = page+'_'+s;
  		if($('.nav-link.nav-'+page).length > 0){
             $('.nav-link.nav-'+page).addClass('active')
  			if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
            $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
  				$('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
  			}
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

  		}
     
  	})
  </script>
  
  <script>
     $('#manage_account').click(function(){
        uni_modal('Manage Account','manage_user.php?id=<?php echo Yii::$app->user->identity->no ?>')
      })
  </script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
