 <nav class="navbar custom-navbar navbar-expand-lg py-2">
     <div class="container-fluid px-0">
         <a href="javascript:void(0);" class="menu_toggle"><i class="fa fa-align-left"></i></a>
         <a href="<?= base_url('/dashboard') ?>" class="navbar-brand"><img
                 src="<?= base_url('assets/images/brand/instarentlogopng.png') ?>" alt="BigBucket" />
             <strong>INSTA</strong>RENT</a>
         <div id="navbar_main">
             <ul class="navbar-nav ml-auto">
                 <li class="nav-item dropdown">
                     <a class="nav-link nav-link-icon" href="javascript:void(0);" id="navbar_1_dropdown_3" role="button"
                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                             class="fa fa-user"></i></a>
                     <div class="dropdown-menu dropdown-menu-right">
                         <h6 class="dropdown-header">User menu</h6>
                         <a class="dropdown-item" href="<?= base_url('logout') ?>"><i
                                 class="fa fa-sign-out text-primary"></i>Sign out</a>
                         <h6 class="dropdown-header">Admin Login</h6>
                         <h6 class="dropdown-item">- <?= session()->get('username'); ?> -</h6>
                     </div>
                 </li>
             </ul>
         </div>
     </div>
 </nav>