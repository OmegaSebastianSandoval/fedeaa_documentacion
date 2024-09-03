<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title><?= $this->_titlepage ?></title>

	<!-- Jquery -->
	<script src="/components/jquery/jquery-3.6.0.min.js"></script>

	<link rel="stylesheet" type="text/css" href="/scripts/carousel/carousel.css">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="/components/bootstrap/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" href="/components/bootstrap/dist/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="/skins/page/css/global.css">
	<link rel="stylesheet" href="/skins/page/css/archivos.css">
	<link rel="stylesheet" href="/skins/page/css/estiloseditor.css">
	<link rel="stylesheet" href="/components/bootstrap-tagsinput/src/bootstrap-tagsinput.css">
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="stylesheet" href="/components/select2/dist/css/select2.min.css">
	<link rel="stylesheet" href="/components/dropzone/dist/min/dropzone.min.css">
	<link rel="stylesheet" href="/components/bootstrap-fileinput/css/fileinput.css">
	<link rel="stylesheet" href="/components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css">
	<link rel="stylesheet" href="/components/bootstrap-fileinput/themes/explorer/theme.css">
	<link rel="stylesheet" href="/components/jstree/dist/themes/default/style.css">

	<!-- <script src="/components/jquery/dist/jquery.min.js"></script> -->
	<script src="/skins/page/js/main.js?v=1.00"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="/components/select2/dist/js/select2.full.min.js"></script>
	
	<!-- <script src="/scripts/popper.min.js"></script> -->
	  <!-- Popper -->
	  <script src="https://unpkg.com/@popperjs/core@2"></script>
	<!-- <script src="/components/bootstrap/dist/js/bootstrap.min.js"></script> -->
	<script src="/components/bootstrap-tagsinput/src/bootstrap-tagsinput.js"></script>
	<script type="text/javascript" src="/scripts/carousel/carousel.js"></script>
	<script src="/components/bootstrap-validator/dist/validator.min.js"></script>
	<script src="/components/dropzone/dist/min/dropzone.min.js"></script>
	<script type="text/javascript" id="www-widgetapi-script" src="https://s.ytimg.com/yts/jsbin/www-widgetapi-vflS50iB-/www-widgetapi.js" async=""></script>
	<script src="https://www.youtube.com/player_api"></script>
	<script src="/components/bootstrap-fileinput/js/fileinput.js"></script>
	<script src="/components/bootstrap-fileinput/themes/explorer/theme.js"></script>
	<script src="/components/bootstrap-switch/dist/js/bootstrap-switch.js"></script>
	<script src="/components/jstree/dist/jstree.min.js"></script>
	<!-- FontAwesome -->
	<link rel="stylesheet" href="/components/Font-Awesome/css/all.css">

</head>

<body>
	<header>
		<?= $this->_data['header']; ?>
	</header>
	<div><?= $this->_content ?></div>
	<footer>
		<?= $this->_data['footer']; ?>
	</footer>

	<!-- Bootstrap Js -->
	<script src="/components/bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="/components/bootstrap-fileinput/css/fileinput.css">
	<script src="/components/bootstrap-fileinput/js/fileinput.min.js"></script>
	<div class="modal fade" id="modaleditor" tabindex="-1" role="dialog" aria-labelledby="modaleditorLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content"></div>
		</div>
	</div>
	<script>
		$('.ls-modal').on('click', function(e) {
			e.preventDefault();
			$('#modaleditor').modal('show').find('.modal-content').load($(this).attr('href'));
		});
	</script>
</body>

</html>