<?php
	require_once('sesion.php');
	include('accesodatos/user.php');
	//include('accesodatos/customer.php');
	include('accesodatos/dbcontrols.php');
	//include('accesodatos/status.php');
	include('accesodatos/project.php');
	include('accesodatos/userType.php');
	include('accesodatos/department.php');
	$registrosPorPagina=12;
	$pagina=1;
	$admin=listadoUsuario($usuario);
	$date=getFechaProject();
	
	
	if($_POST)
	{

		$directorio1 = 'user/'; 
		$photo='';	 
		if(isset($_FILES['archivo1'])){
		
			foreach ($_FILES['archivo1']['error'] as $key => $error) 
			{
				if (@$error == UPLOAD_ERR_OK) 
			   {
					$name = $_FILES["archivo1"]["name"][$key];
					$nombreImagen1=$name;
					$photo=$name;
					$nameImagen = strtok($nombreImagen1,".");
					//actulizarImagen1($name,$nameImagen);
					move_uploaded_file($_FILES["archivo1"]["tmp_name"][$key],$directorio1.$_FILES["archivo1"]["name"][$key]);
					require_once('SimpleImage.php'); 
					$image = new SimpleImage();
					$image->load('uploads/'. $nombreImagen1); 
					$image->resize(1100,350);  
					$img=split("\.",$nombreImagen1);
					$image->save('uploads/slider/'.$nombreImagen1);
					//$image->output();
				}
			}
		}

		//if($photo=='')$photo='gansmx.png';

		$user=$_POST['txtUser'];
		$pass=$_POST['txtPassword'];
		$email=$_POST['txtEmail'];
		$name=$_POST['txtName'];
		$department=$_POST['selDepartment'];
		$userType=$_POST['selUserType'];
		//if($photo)
		
		if($name!='' && $email!='')
		{
			if(updateUser($user,$userType,$department,$name,$email,$photo))
			{
				header('location: adduser.php');
			}
		}

	}
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
	<title>SMK | New Products</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->        
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
	<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/style-metro.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL PLUGIN STYLES --> 
	<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
	<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
	<link href="assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" media="screen"/>
	<link href="assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
	<!-- END PAGE LEVEL PLUGIN STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES --> 
	<link href="assets/css/pages/tasks.css" rel="stylesheet" type="text/css" media="screen"/>
    	<link href="assets/css/pages/blog.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL STYLES -->
    <link rel='shortcut icon' href='assets/img/iconosmk.ico' type='imagenes/iconosmk.ico'/>
    
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.MultiFile.js" type="text/javascript"></script>
    
    <script type="text/javascript">
		function validar() {
			var department=document.getElementsByName('selDepartment')[0].value;
			var userType=document.getElementsByName('selUserType')[0].value;
			var user=document.getElementsByName('txtUser')[0].value;
			var pass=document.getElementsByName('txtPassword')[0].value;
			var email=document.getElementsByName('txtEmail')[0].value;
			var name=document.getElementsByName('txtName')[0].value;
			
			if(name=='')
			{
				alert('Enter Name');
				frmUser.txtName.focus();
				return false;
			}

			if(user=='')
			{
				alert('Enter User')
				frmUser.txtUser.focus();
				return false;
			}
			
			if(pass=='')
			{
				alert('Enter Password');
				frmUser.txtPassword.focus();
				return false;
			}

			if(email=='')
			{
				alert('Enter Email')
				frmUser.txtEmail.focus();
				return false;
			}
			
			if(department=='')
			{
				alert('Enter Department');
				frmUser.selDepartment.focus();
				return false;
			}

			if(userType=='')
			{
				alert('Enter User Type')
				frmUser.selUserType.focus();
				return false;
			}
			
		}
	</script>
    

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed  page-footer-fixed page-sidebar-fixed ">
	<!-- BEGIN HEADER -->   
	<div class="header navbar navbar-inverse navbar-fixed-top">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<div class="navbar-inner">
			<div class="container-fluid">
				<!-- BEGIN LOGO -->
				<a class="brand" href="home.php">
				<img src="assets/img/logo3.png" alt="logo" />
				</a>
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
				<img src="assets/img/menu-toggler.png" alt="" />
				</a>          
				<!-- END RESPONSIVE MENU TOGGLER -->            
				<!-- BEGIN TOP NAVIGATION MENU -->              
				<ul class="nav pull-right">       
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<img alt="" src="user/<?php echo $photo;?>" style="height:29px; width:29px;" />
						<span class="username"><?php echo $nombre;?></span>
						<i class="icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="profile.php"><i class="icon-user"></i> My Profile</a></li>
							<!--<li><a href="page_calendar.html"><i class="icon-calendar"></i> My Calendar</a></li>
							<li><a href="inbox.html"><i class="icon-envelope"></i> My Inbox <span class="badge badge-important">3</span></a></li>
							<li><a href="#"><i class="icon-tasks"></i> My Tasks <span class="badge badge-success">8</span></a></li>-->
							<li class="divider"></li>
							<li><a href="javascript:;" id="trigger_fullscreen"><i class="icon-move"></i> Full Screen</a></li>
							<!--<li><a href="extra_lock.php"><i class="icon-lock"></i> Lock Screen</a></li>-->
							<li><a href="logout.php"><i class="icon-key"></i> Log Out</a></li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
				<!-- END TOP NAVIGATION MENU --> 
			</div>
		</div>
		<!-- END TOP NAVIGATION BAR -->
	</div>
	<!-- END HEADER -->
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
		<!-- BEGIN SIDEBAR -->
<div class="page-sidebar nav-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->        
			<ul class="page-sidebar-menu">
				<li>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone"></div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>

				<li >
					<a href="home.php">
					<i class="icon-home"></i> 
					<span class="title">Home</span>
					</a>
				</li>
                
                <li class="active">
					<a href="javascript:;">
					<i class="icon-user"></i> 
					<span class="title">Users</span>
                    <span class="arrow "></span>
                    <span class="selected"></span>
					</a>
				</li>
                
                <li>
					<a href="<?php if($admin['idUserType']==1) echo 'addcustomer.php'; else echo 'javascript:;'; ?>">
					<i class="icon-list"></i> 
					<span class="title">Customer</span>
                    <span class="arrow "></span>
					</a>
				</li>
                
                <li>
					<a href="<?php if($admin['idUserType']==1) echo 'addsalesperson.php'; else echo 'javascript:;'; ?>">
					<i class="icon-credit-card"></i> 
					<span class="title">SalesPerson</span>
                    <span class="arrow "></span>
					</a>
				</li>
                
                <li>
					<a href="<?php if($admin['idUserType']==1) echo 'addclasscode.php'; else echo 'javascript:;'; ?>">
					<i class="icon-qrcode"></i> 
					<span class="title">Class Code</span>
                    <span class="arrow "></span>
					</a>
				</li>
                 
                <li>
					<a href="<?php if($admin['idUserType']==1) echo 'configuration.php'; else echo 'javascript:;'; ?>">
					<i class="icon-cogs"></i> 
					<span class="title">Configurations</span>
                    <span class="arrow "></span>
					</a>
				</li>

             
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
			</div>
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE CONTAINER-->
			<div class="row-fluid">
					
						<!-- END BEGIN STYLE CUSTOMIZER -->    
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="home.php">Home</a> 
								<i class="icon-angle-right"></i>
                                
                                                            <li>
								<i class="icon-user"></i>
								<a href="adduser.php">Users</a> 
								<i class="icon-angle-right"></i>
							</li>
							</li>
							<li><a href="#"></a></li>
                            
                            <li><a href="#"></a></li>
							<li class="pull-right no-text-shadow">
								<div >
									<i class="icon-calendar"></i>
									<!-- #BeginDate format:fcAm1a -->Sunday, April 20, 2014 9:11 AM<!-- #EndDate -->
								  	
                                </div>
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				<!-- END PAGE HEADER-->
                <div style="float:right;">	
                    <form>
                      <a href="<?php if($admin['idUserType']==1) echo 'newuser.php'; else echo '#';?> " class="btn blue">
                        <span class="icon-file"> Add User </span>
                        <br/><em></em>
                        </a>
                    </form>    
                </div>
				<div id="dashboard">
					<!-- BEGIN DASHBOARD STATS -->
				
						<!--Blog <small>New Product 'Customer'</small>-->	
					
				<h3 class="page-title">
                
				</h3>
				
                     <!-- BEGIN DASHBOARD STATS -->   
                   <div class="row-fluid">
                   
					<div class="span12">
						<div class="tabbable tabbable-custom boxless">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab_1" data-toggle="tab">Users</a></li>
                                
							</ul>
                            
							<div class="tab-content">
                            
								<div class="tab-pane active" id="tab_1">
									<div class="portlet box blue">
										<div class="portlet-title">
											<div class="caption"><i class="icon-user"></i>All Users</div>
												
											</div>
										</div>
										<div class="portlet-body form">
											      <div class="portlet-body">
								<table class="table  table-striped  table-advance table-condensed  table-hover table-bordered" >
									<thead>
										<tr>
											<th><i class="icon-user"></i> User</th>
											<th><i class="icon-play"></i> Name</th>
                                            <th><i class="icon-inbox"></i> Email</th>
                                            <th><i class="icon-plus-sign"></i> Department</th>
                                            <th><i class="icon-user-md"></i> User Type</th>
                                            <th><i class="icon-globe"></i> Website url</th>
										</tr>
									</thead>
							<tbody>  
						<?php 
						if($_GET["pagina"]) //Si hay pagina por ?pagina=valor, lo asigna
            				$pagina = $_GET["pagina"];
							
							$listadoDeUsuarios=listadoDeUsuarios($pagina,$registrosPorPagina);
							//$listadoDeUsuarios=listadoDeUsuarios();
                            if(mysql_num_rows($listadoDeUsuarios)>0)
                            {
                                while($regLU=mysql_fetch_assoc($listadoDeUsuarios))
                                {
                        ?>
                                    <tr>
                                        <td class="highlight"  width="150px">
                                            <!-- BEGIN FORM-->
										<form enctype="multipart/form-data" action="adduser.php" name="frmUser" method="post" class="form-horizontal" onSubmit="return validar()">
											<div class="control-group" >
												
												<div class="success">
													<a href="#form_modal10<?php echo 'id'.$regLU['user']; ?>" data-toggle="modal">
														<?php echo $regLU['user']; ?>
													</a>   
												</div>
											</div>
										
                                        
										<div id="form_modal10<?php echo 'id'.$regLU['user']; ?>" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">
										
                                        	<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
												<h3 id="myModalLabel10"><i class="icon-key"></i> Update User <?php echo $regLU['user']; ?> </h3>
											</div>
											<div class="modal-body" style="margin-left:0px;">
												<div class="row-fluid">
                                                
											<table>
                                            <tr><input type="hidden" value="<?php echo $regLU['user']; ?>" name="txtUser"/></tr>
                                            	<tr>
                                                <td rowspan="7" >
                                                   <img src="user/<?php echo $regLU['photo']; ?>" width="150" height="150" alt="" style="margin-top:0px;" /> 
                                                                        <!--<a href="#" class="profile-edit">edit</a>-->
                                                                       
                                                                     <label class="cargar">
                                                                        <img src="assets/img/attach1.png" width="25"  height="25">
                                                                     <span>
                                                                        <input name="archivo1[]"  class="multi" type="file" size="16" maxlength="1" style="z-index: 0; line-height: 0px; font-size: 0px;  opacity:-1; width:29px;margin: 0; padding:0; left:0; margin-top:-25px; height:50px; background-image:url(assets/img/attach1.png); background-repeat: repeat-x;" />
                                                                       </span>
                                                                    </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <label>User :</label>
                                                    </td>
                                                    <td>
                                                        <label> <?php echo $regLU['user']; ?> </label>
                                                    </td>
                                                    
                                                </tr>
                                                
                                                <tr>
                                                <td></td>
                                                    <td><label>Name : </label>
                                                                </td>
                                                    <td><input type="text" value="<?php echo $regLU['name']; ?>" name="txtName"></td>
                                                </tr>
                                                
                                                <tr>
                                                <td></td>
                                                    <td><label>Email : </label>
                                                                </td>
                                                    <td><input type="text" value="<?php echo $regLU['email']; ?>" name="txtEmail" <?php if($admin['idUserType']!=1) echo 'readonly'; ?>></td>
                                                </tr>
                                                
                                                <tr>
                                                <td></td>
                                                    <td><label>Department : </label>
                                                                </td>
                                                    <td> <?php cmbAgregar('selDepartment',listadoDepartment(),'iddepartment','description',$regLU['idDepartment']);?></td>
                                                </tr>
                                                
                                                <tr>
                                                <td></td>
                                                    <td> <label>User Type : </label>
                                                                </td>
                                                    <td> <?php cmbAgregar('selUserType',listadoUserType(),'iduserType','description',$regLU['idUserType']);?></td>
                                                </tr>
                                                
                                                <tr>
                                                <td></td>
                                                    <td><label>Website url : </label>
                                                                </td>
                                                    <td><a href="http://www.smkusa.com">http://www.smkusa.com</a></td>
                                                </tr>
                        
                                            
                                        </table> 
												</div>
                                                <div id="respuesta" style="background-color:#F7BC44; color:#FFF; width:auto" ></div>
											</div>
											<div class="modal-footer">
                                            	
                                                <button type="submit" id="btn_enviar" class="btn blue" >Save</button>
												<button class="btn" data-dismiss="modal" aria-hidden="false">Close</button>
											</div>
                                           </form>
										</div>
                                        
										<!-- END FORM-->
                                            
                                            
                                            
                                            
                                        </td>
                                        <td>
                                            <div class="success"></div>
                                            <a><?php echo $regLU['name']; ?></a>
                                        </td>
                                        <td>
                                            <div class="success"></div>
                                            <a><?php echo $regLU['email']; ?></a>
                                        </td>
                                        <td>
                                            <div class="success"></div>
                                            <a><?php echo $regLU['depto']; ?></a>
                                        </td>
                                        <td>
                                            <div class="success"></div>
                                            <a><?php echo $regLU['type']; ?></a>
                                        </td>
                                        <td>
                                            <div class="success"></div>
                                            <a href="http://www.smkusa.com">http://www.smkusa.com</a>
                                        </td>
                                    </tr>

						<?php 
                                }
                            }
                        ?>
									</tbody>
                                   
								</table>
                                
                           <?php	
								$totalRegistros = totalRegistros();//Almaceno el total en una variable
								echo "<center>";
								echo "<span class='azul'>";
								echo "page: ";
								$noPaginas = $totalRegistros/$registrosPorPagina; //Determino la cantidad de paginas
								for($i=1; $i<$noPaginas+1; $i++)
								{ //Imprimo las paginas
									if($i == $pagina)
									echo "$i "; //A la pagina actual no le pongo link
									else
									echo "<a href=\"?pagina=".$i."\">".$i."</a> ";
									echo '<input type="hidden" value="'.$i.'" name="pagina">';
								}
								echo "</span></center>";
								?>    
                                
							</div>         
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>


					<!-- END DASHBOARD STATS -->
                   
						
					<!-- END DASHBOARD STATS -->
				</div>

			</div>
            
			<!-- END PAGE CONTAINER-->    
		</div>
		<!-- END PAGE -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="footer">
		<div class="footer-inner">
			SMK Electr&oacute;nica S.A. de C.V. 2014 &copy; New Products By MIS MX.
		</div>
		<div class="footer-tools">
			<span class="go-top">
			<i class="icon-angle-up"></i>
			</span>
		</div>
	</div>
<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->   <script src="assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
	<script src="assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
	<!--[if lt IE 9]>
	<script src="assets/plugins/excanvas.min.js"></script>
	<script src="assets/plugins/respond.min.js"></script>  
	<![endif]-->   
	<script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
	<script src="assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
	<script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="assets/plugins/fancybox/source/jquery.fancybox.pack.js"></script>   
	<script type="text/javascript" src="assets/plugins/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="assets/scripts/app.js"></script>   
	<script src="assets/scripts/gallery.js"></script>  
	<!-- END PAGE LEVEL SCRIPTS -->
	<script>
		jQuery(document).ready(function() {       
		   // initiate layout and plugins
		   App.init();
		   Gallery.init();
		   $('.fancybox-video').fancybox({type: 'iframe'});
		});
	</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>