<div class="col-md-3 left_col">
	<div class="left_col scroll-view">
	    <div class="navbar nav_title" style="border: 0;">
	      <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Trang Quản Trị</span></a>
	    </div>
	    <div class="clearfix"></div>

	    <!-- menu profile quick info -->
	    <div class="profile">
	      <div class="profile_pic">
	        <img src="images/avatar_default.png" alt="..." class="img-circle profile_img">
	      </div>
	      <div class="profile_info">
	        <span>Xin chào,</span>
	        <h2>{{\Auth::user()->name}}</h2>
	      </div>
	    </div>
	    <!-- /menu profile quick info -->
	    <br />

	    <!-- sidebar menu -->
		<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
		  <div class="menu_section">
		    <ul class="nav side-menu">
		    	<li>
		    		<a href="/users">
		    			<i class="fa fa-user"></i> &nbsp;
		    			Tài khoản
		    		</a>
		    	</li>

		    	<li>
		    		<a href="/roles">
		    			<i class="fa fa-key"></i> &nbsp;
		    			Quyền
		    		</a>
		    	</li>

		    	<li>
		    		<a href="/assets">
		    			<i class="fa fa-laptop"></i> &nbsp;
		    			Tài Sản
		    		</a>
		    	</li>

		    	<!-- Asset Type -->
		    	<li>
		    		<a href="/asset-types">
		    			<i class="fa fa-puzzle-piece"></i> &nbsp;
		    			Loại Tài Sản
		    		</a>
		    	</li>

		    	<!-- Department -->
		    	<li>
		    		<a href="/departments">
		    			<i class="fa fa-users"></i> &nbsp;
		    			Phòng ban
		    		</a>
		    	</li>

		    	<!-- Producers -->
		    	<li>
		    		<a href="/producers">
		    			<i class="fa fa-paper-plane"></i> &nbsp;
		    			Xuất xứ
		    		</a>
		    	</li>		    	
		    </ul>
		  </div>

		</div>
		<!-- /sidebar menu -->

	    <!-- /menu footer buttons -->
	    <div class="sidebar-footer hidden-small">
	      <a data-toggle="tooltip" data-placement="top" title="Settings">
	        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
	      </a>
	      <a data-toggle="tooltip" data-placement="top" title="FullScreen">
	        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
	      </a>
	      <a data-toggle="tooltip" data-placement="top" title="Lock">
	        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
	      </a>
	      <a data-toggle="tooltip" data-placement="top" title="Logout">
	        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
	      </a>
	    </div>
	    <!-- /menu footer buttons -->
	  </div>
  </div>