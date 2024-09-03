var videos = [];
$(document).ready(function(){
    // $('.dropdown-toggle').dropdown();
    $('.selec-multiple').select2();
    $(".carouselsection").carousel({
        quantity : 4,
        sizes : {
          '900' : 3,
          '500' : 1
        }
    });
  $('[data-bs-toggle="tooltip"]').tooltip();
  $('[data-toggle="tooltip"]').tooltip();




    $(".visualizar").on("click",function(){
		var id = $(this).attr("data_archivo");
		var ruta = $(this).attr("data_ruta");
		window.open("http://docs.google.com/viewer?url="+ruta+"/documentos/"+id,"_blank");
		//window.open("/documentos/"+id,"_blank");
    });

    $(".abrir").on("click",function(){
        var id = $(this).attr("data_archivo");
        var ruta = $(this).attr("data_ruta");
        window.open("/documentos/"+id,"_blank");
    });

    /*$(".enviar").on("click",function(){
		var dataBusqueda = document.getElementById("buscar").value;
		$.post("/page/documentos/index",{"dataBusqueda":dataBusqueda},function(){
        })
    });*/

    $(".enviarpermiso").on("click",function(){
		var amigo = $(this).attr("data_user");
        $("#btn-opciones-permiso-"+amigo).hide();
        $("#btn-cancelar-permiso-"+amigo).show();
		$("#div-"+amigo).show();
    });

    $(".cancelarpermiso").on("click",function(){
		var amigo = $(this).attr("data_user");
		$("#btn-cancelar-permiso-"+amigo).hide();
		$("#div-"+amigo).hide();
        $("#btn-opciones-permiso-"+amigo).show();
    });

    $(".file-document").fileinput({
      maxFileSize: 20480,
      showUpload: false,
      showRemove: false,
      previewFileIcon: '<i class="fas fa-file"></i>',
      browseIcon: "<i class=\"glyphicon glyphicon-picture\"></i> ",
 
      browseLabel: 'Seleccionar',
      overwriteInitial: false,
      initialPreviewAsData: true,
      maxFilePreviewSize: 10240,
      allowedFileExtensions: ["pdf", "xls", "xlsx", "doc","docx","png","jpg","jpeg"],
      previewFileIconSettings: { // configure your icon file extensions
        'doc': '<i class="fas fa-file-word text-primary"></i>',
        'xls': '<i class="fas fa-file-excel text-success"></i>',
        'pdf': '<i class="fas fa-file-pdf text-danger"></i>',
        'jpg': '<i class="fas fa-file-image text-danger"></i>', 
        'gif': '<i class="fas fa-file-image text-muted"></i>', 
        'png': '<i class="fas fa-file-image text-primary"></i>'    
      },
      previewFileExtSettings: { // configure the logic for determining icon file extensions
        'doc': function(ext) {
          return ext.match(/(doc|docx)$/i);
        },
        'xls': function(ext) {
          return ext.match(/(xls|xlsx)$/i);
        },
      }
      
    });
    
    $('#eliminarModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('New message to ' + recipient)
        modal.find('.modal-body input').val(recipient)
    });

    $('#crearModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Crear Permiso')
        modal.find('.modal-body input').val(recipient)
    });

    $('#modificarModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Modificar Permiso')
        modal.find('.modal-body input').val(recipient)
    });

    $(".banner-video-youtube").each(function(){
        console.log($(this).attr("data-video"));
        var datavideo = $(this).attr("data-video");
        var idvideo = $(this).attr("id");
        var playerDefaults = {autoplay: 0, autohide: 1, modestbranding: 0, rel: 0, showinfo: 0, controls: 0, disablekb: 1, enablejsapi: 0, iv_load_policy: 3};
        var video = {'videoId':datavideo, 'suggestedQuality': 'hd720'};
        videos[videos.length] = new YT.Player(idvideo,{ 'videoId':datavideo, playerVars: playerDefaults,events: {
          'onReady': onAutoPlay,
          'onStateChange': onFinish
        }});
    });

    function onAutoPlay(event){
        event.target.playVideo();
        event.target.mute();
    }

    function onFinish(event) {        
        if(event.data === 0) {            
            event.target.playVideo();
        }
    }

    $(".selectpagination").change(function(){
        var route = $("#page-route").val();
        var pages = $(this).val();
        $.post(route,{'pages': pages },function(){
            location.reload();
        });
    });

    $(".switch-form").bootstrapSwitch({
        "onText" : "Si",
        "offText" : "No"
    });

    $(".botonera ul li a").on("click",function(){
        if($(this).siblings("ul").is(":visible")){
            $(this).siblings("ul").hide(300);
        } else {
            $(this).siblings("ul").show(300);
            $(this).siblings("a").css({ "padding": "10px 25px", "margin-top": "2px", "font-size": "15px" });
        }
    });

}); 




