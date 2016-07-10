<nav class="navbar navbar-inverse" role="navigation" style="margin-left:-15px;margin-right:-15px;">
	<div class="navbar-header">
		
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		
		<div class="navbar-brand visible-xs" style="padding:0;float:none;">
			<img src="/_common/menu_banner.png" width="80%"></div>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="divider-vertical">
					<a target="_self"  href="/_removecookie.php" title="Logout"><span class="glyphicon glyphicon-new-window"></span></a>
				</li>
				<li class="divider-vertical">
					<a target="_self"  href="javascript:change_window('/home/');" class="active"><span class="glyphicon glyphicon-home glyphicon-white"></span></a>
				</li>
				<li class="divider-vertical">
					<a target="_self"  href="javascript:void(0)" title="" class="dropdown-toggle active" data-toggle="dropdown">1. APOSTAS <b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li class="text-center"><a target="_self"  href="javascript:change_window('/apostas/jogos/');" title=""><span class="pull-left">1.1.&nbsp;&nbsp;</span> Jogos &nbsp; &nbsp;</a></li>
						<li class="text-center"><a target="_self"  href="javascript:change_window('/apostas/podio/');" title=""><span class="pull-left">1.2.&nbsp;&nbsp;</span> Pódio &amp; Melhor Marcador &nbsp; &nbsp;</a></li>
					</ul>
				</li>
				<li class="divider-vertical"><a target="_self"  href="javascript:change_window('/classificacao/');" title="">2. CLASSIFICAÇÃO</a></li>
				<li class="divider-vertical"><a target="_self"  href="javascript:change_window('/regulamento/');" title="Regulamento">3. REGULAMENTO</a></li>
				<li class="divider-vertical"><a target="_self"  href="javascript:change_window('/edicoes-anteriores/');">4. EDIÇÕES ANTERIORES</a></li>
			</ul>
		</div>
</nav>

<script>
function change_window(url)
{
	if (url == '/home/')
		window.location = url;
	else
		$.ajax({url:url,success:function(html_data){
			// Load the page
			$('#ajax_page_content').html(html_data);
			// Hide the menu bar
			$('.navbar-collapse').collapse('hide');
			}});
	
}
</script>

