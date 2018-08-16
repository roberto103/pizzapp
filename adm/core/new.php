<?php 
require_once '../../core/sessao.php';
require_once '../../core/conexao.php';
require_once '../../core/funcoes.php';

setcookie('userLogado','monstro-marinho');

$tbCategorias = new table($db, 'categorias');
$RowsCategorias = $tbCategorias->findMany('WHERE 1=1',"ORDER BY nome ASC");

if(isset($_GET['id'])) {
	$tbNoticias = new table($db, 'noticias');
	$tbNoticias->find(filter_var($_GET['id'], FILTER_VALIDATE_INT));	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <!-- Title and other stuffs -->
<title>Gerencidor de Sites</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">


  <!-- Stylesheets -->
  <link href="../includes/style/bootstrap.css" rel="stylesheet">
  <!-- Font awesome icon -->
  <link rel="stylesheet" href="../includes/style/font-awesome.css">  
  <!-- Main stylesheet -->
  <link href="../includes/style/style.css" rel="stylesheet">  
  <!-- Responsive style (from Bootstrap) -->
  <link href="../includes/style/bootstrap-responsive.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="../includes/style/jquery-ui.css">
  <script src="../includes/js/jquery.js"></script> <!-- jQuery -->
  <script src="../includes/js/jquery-ui-1.10.2.custom.min.js"></script> 
  
  <!-- HTML5 Support for IE -->
  <!--[if lt IE 9]>
  <script src="../includes/js/html5shim.js"></script>
  <![endif]-->

  <!-- Favicon -->
  <link rel="shortcut icon" href="../includes/img/favicon/favicon.png">
  
  <script>
  $(function() {
    $("#txtData").datepicker({ dateFormat: 'dd/mm/yy', dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'], dayNamesMin: ['D','S','T','Q','Q','S','S','D'], dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'], monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'], monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'], nextText: 'Próximo', prevText: 'Anterior' });

  });
  </script>
  
    <!-- Editor de Texto -->
    <style type="text/css">
    	#txtCorpo {
    		height: 200px;
    	}
    </style>    
    <script type="text/javascript" src="../includes/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
		
	tinymce.init({
		selector: "textarea",
		theme: "modern",
		language : 'pt_BR',
		width: '100%',
		height: 300,
		plugins: [
			 "advlist autolink link lists charmap hr anchor",
			 "searchreplace wordcount code insertdatetime",
			 "table contextmenu directionality paste textcolor"
	   ],	   
	   content_css: "css/content.css",
	   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | foto | pdf | bullist numlist | link image | print preview media fullpage | forecolor backcolor emoticons", 
	   style_formats: [
			{title: 'Cabeçalho 1', block: 'h1'},
			{title: 'Cabeçalho 2', block: 'h2'},
			{title: 'Cabeçalho 3', block: 'h3'},
			{title: 'Parágrafo', inline: 'p'},			
		],
	
   setup : function(ed) {

      ed.addButton('foto', {
         title : 'Adicionar Foto',
         image : '../includes/js/tinymce/skins/lightgray/img/cam.gif',
         onclick : function() {
			 	$( "#dialog" ).dialog( "open" );			
				$( "#resultado-foto-popup" ).empty();
				loadFotoPopup();           
         }
		 
	  });
		 
	  	ed.addButton('pdf', {
         title : 'Adicionar Arquivo PDF',
         image : '../includes/js/tinymce/skins/lightgray/img/pdf.gif',
         onclick : function() {
			 	$( "#dialogPdf" ).dialog( "open" );			
				$( "#resultado-pdf-popup" ).empty();
				loadPdfPopup();           
         }		 
		 
      });
	  

    		  
   }
   
   		
	 }); 	
	
	
    </script> 
    <!-- FIM Editor de Texto -->
    
 <?php $pasta = md5(time()); ?>   
<!-- Galeria de Foto -->
<link rel="stylesheet" type="text/css" href="../includes/uploadify/uploadify.css">
<link rel="stylesheet" type="text/css" href="../includes/prettyphoto/css/prettyPhoto.css">
<link rel="stylesheet" type="text/css" href="../galeria-fotos/galeria-layout.css">
<script src="../includes/uploadify/jquery.uploadify.min.js?ver=<?php echo rand(0,9999);?>" type="text/javascript"></script>
<script src="../includes/prettyphoto/js/jquery.prettyPhoto.js"></script>
<script src="../includes/js/jquery.form.js"></script>
<script type="text/javascript" charset="utf-8">
//Foto destaque
function loadFotoDestaque() {
	
	var nomeFotoDestaque = $('#txtFotoDestaque').val();
	
	$.ajax({
		  type: 'get',
		  data: 'pasta=<?php if(isset($tbNoticias)) { echo htmlentities($tbNoticias->pasta,ENT_QUOTES,'UTF-8'); } else echo $pasta; ?>&foto='+nomeFotoDestaque,
		  url:'loadFotoDestaque.php',
		  success: function(data){
			$('#resultado-foto-destaque').append(data);			  
		  }
		})	
}
//FIM foto Destaque


function loadFotoPopup() {
	$.ajax({
		  type: 'get',
		  data: 'pasta=<?php if(isset($tbNoticias)) { echo htmlentities($tbNoticias->pasta,ENT_QUOTES,'UTF-8'); } else echo $pasta; ?>',
		  url:'loadFotoPopup.php',
		  success: function(data){
			$('#resultado-foto-popup').append(data);			  
		  }
		})	
}


function loadPdfPopup() {
	$.ajax({
		  type: 'get',
		  data: 'pasta=<?php if(isset($tbNoticias)) { echo htmlentities($tbNoticias->pasta,ENT_QUOTES,'UTF-8'); } else echo $pasta; ?>',
		  url:'loadPdfPopup.php',
		  success: function(data){
			$('#resultado-pdf-popup').append(data);			  
		  }
		})	
}



function loadFoto(pasta,foto) {
	$.ajax({
		  type: 'get',
		  data: {'pasta':pasta,'foto':foto},
		  url:'../galeria-fotos/loadFoto.php',
		  success: function(data){
			$('#galeria-resultado-fotos').append(data);
			
			$("area[rel^='prettyPhoto']").prettyPhoto();
			
			$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false});			  
		  }
		})
	}
	
	
function excluiFoto(ids,dir,file) {
if(confirm('Deseja Excluir a Foto?')) {
	$.ajax({
		  type: 'get',
		  data: 'pasta='+dir+'&file='+file,
		  url:'../galeria-fotos/excluiFoto.php',
		  success: function(data){
			if(data == 'ok') {
				var id = '#'+ids;
				$(id).hide("slow",function() {
					$(id).remove();
				});					
			}					
		  }
		});
}
};


function excluiFotoDestaque(ids,dir,file) {
if(confirm('Deseja Excluir a Foto?')) {
	$.ajax({
		  type: 'get',
		  data: 'pasta='+dir+'&file='+file,
		  url:'../galeria-fotos/excluiFoto.php',
		  success: function(data){
			if(data == 'ok') {
				var id = '#'+ids;
				$(id).hide("slow",function() {
					$(id).remove();
					$('#txtFotoDestaque').val('0');
				});					
			}					
		  }
		});
}
};


function enviarForm() {
	document.getElementById("frmNoticia").submit();	
}


$(function($) {
$("#frmNoticia").submit(function() {
	
	var id = $("#txtId").val();
	var data2 = $("#txtData").val(); 
	var	hora = $("#txtHora").val();
	var	idCategoria = $("#cboCategoria").val();
	//var	idSecretaria = $("#cboSecretaria").val();
	var	topico = $("#txtTopico").val();
	var	titulo = $("#txtTitulo").val();
	var	corpo = $("#txtCorpo").val();
	var	pasta = $("#txtPasta").val();
	var	statis = $("#cboStatus").val();
	var fotoDestaque = $('#txtFotoDestaque').val();
	
if (titulo != '') {	


if($('#txtId').val() == 0) {	
	$.ajax({
		  type: 'post',
		  data: {  
		  	txtData: data2, 
			txtHora: hora,
			cboCategoria: idCategoria,
			//cboSecretaria: idSecretaria,
			txtTitulo: titulo,
			txtTopico: topico,
			txtCorpo: corpo,
			txtPasta: pasta,
			txtStatus: statis,
			txtFotoDest: fotoDestaque
		  },
		  url:'doSave.php',
		  beforeSend: function(){
			$('#btoPublicar').css('visibility','hidden');
			$('#loader').css('width','auto');
			$('#loader').css('height','auto');
			$('#loader').css('visibility','visible');
		  },		  
		  success: function(data){
				$('#btoPublicar').css('visibility','visible');
				$('#loader').css('visibility','hidden');
				$('#loader').css('width','0');
				$('#loader').css('height','0');							  
			  
				$('#txtId').val(data);
				$('#btoPublicar').html(' Salvar ');
				var id = '#aviso';
				$(id).hide();
				$(id).css('visibility','visible');
				$(id).show("fast","linear",function() {
					setTimeout( "jQuery('#aviso').hide('fast','linear');",3000 );
				});				
		  }
		});
} else { //else if txtId
	$.ajax({
		  type: 'post',
		  data: {
			txtId: id, 
		  	txtData: data2, 
			txtHora: hora,
			cboCategoria: idCategoria,
			//cboSecretaria: idSecretaria,			
			txtTitulo: titulo,
			txtTopico: topico,
			txtCorpo: corpo,
			txtPasta: pasta,
			txtStatus: statis,
			txtFotoDest: fotoDestaque
		  },
		  url:'doEdit.php',
		  beforeSend: function(){
			$('#btoPublicar').css('visibility','hidden');
			$('#loader').css('width','auto');
			$('#loader').css('height','auto');
			$('#loader').css('visibility','visible');
		  },		  
		  success: function(data){
				$('#btoPublicar').css('visibility','visible');
				$('#loader').css('visibility','hidden');
				$('#loader').css('width','0');
				$('#loader').css('height','0');				  
			  
				$('#txtId').val(data);
				
				var id = '#aviso';
				$(id).hide();
				$(id).css('visibility','visible');
				$(id).show("fast","linear",function() {
					setTimeout( "jQuery('#aviso').hide('fast','linear');",3000 );
				});				
		  }
		});
}// fim if txtId
} else { //if titulo != '' 
	alert ('Digite o Título da Notícia!');
}//if titulo != '' 
	});
});

<?php if (isset($tbNoticias)) { ?>
function loadFotos() {
		$.ajax({
			  type: 'get',
			  data: 'pasta=<?php if(isset($tbNoticias)) { echo htmlentities($tbNoticias->pasta,ENT_QUOTES,'UTF-8'); } ?>',
			  url:'../galeria-fotos/loadTodasFotos.php',
			  success: function(data){
					$('#galeria-resultado-fotos').append(data);
					
					$("area[rel^='prettyPhoto']").prettyPhoto();
					
					$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false});	 
			  }
			})
}




$( document ).ready(function() {
	<?php if(isset($tbNoticias)) { echo 'loadFotos();'; } ?>
	<?php if(isset($tbNoticias)) { echo 'loadFotoDestaque();'; } ?>	
});

<?php } ?>

function enviaFotoDestaque() {	
	var ext = $('#btoLocalizarFoto').val().split('.').pop().toLowerCase();
	//if($.inArray(ext, ['pdf,jpg,jpeg']) == -1) {
	if ((ext != 'jpg') && (ext != 'jpeg') && (ext != 'png') && (ext != 'gif')) {
		alert('Arquivo em formato inválido! Só são permitidos arquivos JPEG, PNG ou GIF.');
		Exit();
	}		
        $("#frmFotoDestaque").ajaxForm({
            url: 'doUploadFotoDestaque.php',
			type: "POST",
            uploadProgress: function(event, position, total, percentComplete) {      
				//barra.css('visibility', 'visible');
                //barra.css('color', '#fff');
                //barra.width(percentComplete*5);
                //barra.html(percentComplete+'%');
            },
			  beforeSend: function(){
				$("#resultado-foto-destaque").html("<img id='loader_gif' src='../images/loader.gif'>");
			  },			
            success: function(data) {
				$('#txtFotoDestaque').val(data);
				 loadFotoDestaque();
				 $("#loader_gif").remove();
            },
            error: function(){

            }

        }).submit();	
	} 
	


function uploadFotoPopup() {	
	var ext = $('#btoLocalizarFotoPopup').val().split('.').pop().toLowerCase();

	if ((ext != 'jpg') && (ext != 'jpeg') && (ext != 'png') && (ext != 'gif')) {
		alert('Arquivo em formato inválido! Só são permitidos arquivos JPEG, PNG ou GIF.');
		Exit();
	}		
        
	$("#frmFotoPopup").ajaxForm({
		url: 'doUploadFotoPopup.php',
		type: "POST",
		
		beforeSend: function(){
			$("#resultado-foto-popup").html("<img id='loader_gif_popup' src='../images/loader.gif'>");
		  },			
		
		success: function(data) {
			 loadFotoPopup();
			 $("#loader_gif_popup").remove();
		}

	}).submit();	
} 	



function uploadPdfPopup() {	
	var ext = $('#btoLocalizarPdfPopup').val().split('.').pop().toLowerCase();

	if ((ext != 'pdf')) {
		alert('Arquivo em formato inválido! Só são permitidos arquivos PDF.');
		Exit();
	}		
        
	$("#frmPdfPopup").ajaxForm({
		url: 'doUploadPdfPopup.php',
		type: "POST",
		
		beforeSend: function(){
			$("#resultado-pdf-popup").html("<img id='loader_gif_popup' src='../images/loader.gif'>");
		  },			
		
		success: function(data) {
			 loadPdfPopup();
			 $("#loader_gif_popup").remove();
		}

	}).submit();	
} 	
</script> 
<!-- FIM Galeria de Foto -->  
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">

  <script>
  $(function() {

    $( "#dialog" ).dialog({
      autoOpen: false,
	  title: "Adicionar Foto",
	  height: '580',
	  width: '600',
      modal: true
    });
	
	$('.ui-dialog-titlebar-close').html('X');
	$('.ui-dialog-titlebar-close').css('width','40px');
	$('.ui-dialog-titlebar-close').css('height','25px');

  });
  
  $(function() {

    $( "#dialogPdf" ).dialog({
      autoOpen: false,
	  title: "Adicionar Arquivo PDF",
	  height: '580',
	  width: '600',
      modal: true
    });
	
	$('.ui-dialog-titlebar-close').html('X');
	$('.ui-dialog-titlebar-close').css('width','40px');
	$('.ui-dialog-titlebar-close').css('height','25px');

  });  
  
  
  function inserirNoTexto(foto) {
		tinyMCE.execCommand('mceInsertContent',false, '<img src="'+foto+'" width="500" style="padding-right:15px;padding-bottom:15px;float:left;">');
		$( "#dialog" ).dialog( "close" );		
  }
  
  function inserirPdfTexto(linke,pdf) {
	  
		var nome=prompt("Digite um nome para o arquivo");
		
		if (nome!=null)
		  {
			tinyMCE.execCommand('mceInsertContent',false, '<a href="'+linke+'" target="_blank">'+nome+'</a>');
			$( "#dialogPdf" ).dialog( "close" );
		  }	  		
  }  
  </script>  

</head>

<body>

<?php require_once '../includes/php/top.bar.php'; ?>

<div class="content">


	<?php require_once '../includes/php/navegacao.php'; ?>

  	<div class="mainbar">
      
      	<!-- CABECALHO PAGINA -->
	    <div class="page-head">

            <h2 class="pull-left"> <i class="icon-file-alt"></i> Editar Notícia</h2>
            
            <a href="new.php" style="margin-left:25px;float:left;">
            	<button type="submit" class="btn btn-toolbar">Nova Notícia</button>
            </a>                        
             
            
            <div id="aviso" style="float:left; font:18px Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif;color:#000;width:300px;padding:8px;margin-left:30px;background-color:#FF9;text-align:center;visibility:hidden;">Notícia salva com sucesso!</div>
        	<div class="clearfix"></div>

	    </div>
        <!-- FIM CABECALHO PAGINA -->

<!-- MATTER -->
<div class="matter">
<!-- container-fluid -->
<div class="container-fluid">


<div class="row-fluid">

            <div class="span9">

              <div class="widget wblue">

                <div class="widget-content" style="border:none !important; margin-top:-25px !important;">
                  <div class="padd">
                    <form action="javascript:func()" method="post" id="frmNoticia">
                    
                    <input type="text" class="span8 titlePost" placeholder="Digite o título aqui..." name="txtTitulo" style="width:100%;" value="<?php if (isset($tbNoticias)) { echo htmlentities($tbNoticias->titulo,ENT_QUOTES,'UTF-8'); } ?>" id="txtTitulo">
                    <br />                   
                    <div class="text-area">
                    
                        <textarea rows="4" name="txtCorpo" id="txtCorpo"><?php if (isset($tbNoticias)) { echo $tbNoticias->corpo; } ?></textarea>
                    </div>
					<!-- FIM text-area--> 
            	  </div>
                  <!-- FIM padd -->
               
               </div>
               <!-- FIM widget-content -->

            </div>
            <!-- widget wblue -->
          
          </div>
          <!--span8-->
       


           <div class="span3">

              <div class="widget wblue">
                <div class="widget-head">
                  <div class="pull-left">Detalhes</div>
                  <div class="widget-icons pull-right"></div>
                  <div class="clearfix"></div>
                </div>

                <!-- widget-content-->
                <div class="widget-content">
                  <div class="padd">
                  
                  	  <h6>Status</h6>                      
						<select name="cboStatus" id="cboStatus">
                        	<?php if (isset($tbNoticias)) { ?>
                                <?php if ($tbNoticias->publicado == 1) { ?>
                                	<option value="1" selected="selected">Publicado</option>
                                    <option value="0">Despublicado</option>
                                <?php } ?>
                                <?php if ($tbNoticias->publicado == 0) { ?>
                                    <option value="1">Publicado</option>
                                	<option value="0" selected="selected">Despublicado</option>
                                <?php } ?>
                            <?php }  else { ?>
								<option value="1" selected="selected">Publicado</option>                            
	                            <option value="0">Despublicado</option>
                            <?php } ?>
                        </select>

					  <br />
					  <h6>Data</h6>
                      <input type="text" id="txtData" value="<?php if (isset($tbNoticias)) { echo desinverteData(htmlentities($tbNoticias->data,ENT_QUOTES,'UTF-8')); } else { echo date('d/m/Y'); } ?>" name="txtData">
                     
                      <!-- <h6>Tópico</h6> -->
                      <!-- <input type="text" id="txtTopico" value="<?php //if (isset($tbNoticias)) { echo htmlentities($tbNoticias->topico,ENT_QUOTES,'UTF-8'); } ?>" name="txtTopico"> -->

                      <!-- <h6>Hora</h6> -->
                      <input type="hidden" placeholder="00:00" value="<?php if (isset($tbNoticias)) { echo htmlentities($tbNoticias->hora,ENT_QUOTES,'UTF-8'); } else { echo date('H:i:s'); } ?>" name="txtHora" id="txtHora">
                      <br />
                      <h6>Categorias</h6>                    
                        <select name="cboCategoria" id="cboCategoria">
							<option value="0" selected="selected">Escolha uma Categoria</option>
                            <?php 
                            if ($RowsCategorias) {
                                
                                foreach($RowsCategorias as $categoria) {
                                
									
									
if ($tbNoticias->idCategoria == $categoria->id) {
										echo '<option value="'.htmlentities($categoria->id,ENT_QUOTES,'UTF-8').'" selected="selected">'.htmlentities($categoria->nome,ENT_QUOTES,'UTF-8').'</option>';
									} else {
										echo '<option value="'.htmlentities($categoria->id,ENT_QUOTES,'UTF-8').'">'.htmlentities($categoria->nome,ENT_QUOTES,'UTF-8').'</option>';
									}									
									    
 			
                                }
                                
                            } 
                            ?> 	
                        <!--</select>-->
                        
                        
                      <!--<br />-->
                                              
                        
                        									                                         
                      <hr />
                      <input type="hidden" value="<?php if (isset($tbNoticias)) { echo htmlentities($tbNoticias->pasta,ENT_QUOTES,'UTF-8'); } else { echo $pasta; } ?>" name="txtPasta" id="txtPasta">
                      <input type="hidden" value="<?php if (isset($tbNoticias)) { echo htmlentities($tbNoticias->id,ENT_QUOTES,'UTF-8'); } else { echo 0; } ?>" name="txtId" id="txtId">
                      <input type="hidden" id="txtFotoDestaque" name="txtFotoDestaque" value="<?php if (isset($tbNoticias)) { echo htmlentities($tbNoticias->fotoDestaque,ENT_QUOTES,'UTF-8'); } else { echo 0; } ?>">
                      
                      <div id="loader" style="visibility:hidden;width:0;height:0;">
                      	<img src="../images/loader.gif">
                      </div>
                      <?php if (isset($tbNoticias)) {  ?>
					  	<button class="btn btn-primary" onClick="javascript:enviarForm();" id="btoPublicar">Salvar</button>
					  <?php } else { ?>
						<button class="btn btn-primary" onClick="javascript:enviarForm();" id="btoPublicar">Publicar</button>  
					  <?php } ?>
                      
                      <!-- <button class="btn btn-danger" id="btoExcluir" type="button">Excluir</button> -->
                     </form>
				  </div>
                  <!-- FIM padd -->
                </div>
                <!-- FIM widget-content-->
              </div>
              <!-- FIM widget wblue--> 
              
              <!-- FOTO DESTAQUE-->
              <div class="widget wblue">
                <div class="widget-head">
                  <div class="pull-left">Foto Destaque</div>
                  <div class="widget-icons pull-right"></div>
                  <div class="clearfix"></div>
                </div>
                
                <!-- widget-content-->
                <div class="widget-content">
                  <div class="padd">
                    <form enctype="multipart/form-data" action="" method="post" id="frmFotoDestaque">
                    	<input type="file" id="btoLocalizarFoto" name="btoLocalizarFoto" onChange="javascript:enviaFotoDestaque();" accept="image/*" style="width:100%;">
                         <input name="txtPasta" type="hidden" value="<?php if (isset($tbNoticias)) { echo htmlentities($tbNoticias->pasta,ENT_QUOTES,'UTF-8'); } else { echo $pasta; } ?>" />
                    </form>
                    
                    <div id="resultado-foto-destaque">
                    
                    </div>
                  </div>
                  <!-- FIM padd-->
                  
                </div>
                <!-- FIM widget-content-->
                  
                
             </div>
             <!-- FIM FOTO DESTAQUE-->              
              
            </div>
            <!-- FIM span4--> 
            
</div>
<!-- row-fluid --> 


<!-- Galeria de Foto -->
<div id="galeria-container">
	
    <div id="galeria-topo">
    	<h1>Galeria de Fotos</h1>
        <span class="galeria-aviso-info"><p></p></span>
    </div><!-- galeria-topo -->
    
    <div id="galeria-corpo">

        <div id="galeria-area-upload">
        	<form>
                <div id="queue_fotos"></div>
                <input id="file_upload" name="file_upload" type="file" multiple>
			</form>
        </div><!-- galeria-area-upload -->
        
        <div id="galeria-area-fotos">
        
			<ul class="gallery clearfix" id="galeria-resultado-fotos">
				
                                               

			</ul>   	
                                                           
            
        </div><!-- galeria-area-fotos -->
      
    </div><!-- galeria-corpo -->

</div><!-- galeria-container -->
<!-- FIM Galeria de Foto -->
            
            
</div>            
<!-- FIM container-fluid -->

</div>
<!-- FIM MATTER -->                           			    
 
<!-- JS -->

<!-- Galeria de Foto -->
<script type="text/javascript">
<?php 
			$timestamp = time();
		?>

		setTimeout(function () { //corrigir crash uploadify no google chrome

		$(function() {
			$('#file_upload').uploadify({
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('marshaxa' . $timestamp);?>',
					'pasta'		: '<?php if (isset($tbNoticias)) { echo htmlentities($tbNoticias->pasta,ENT_QUOTES,'UTF-8'); } else { echo $pasta; } ?>'
				},
				'swf'      : '../includes/uploadify/uploadify.swf',
				'uploader' : '../galeria-fotos/carregaFoto.php',
				'buttonClass' : 'botao',
				'buttonText'   : 'Carregar Fotos',
				'fileTypeExts' : '*.gif; *.jpg; *.jpeg; *.png; *.zip',
				'requeueErrors' : true,
				'queueId' : 'queue_fotos',
				'onUploadSuccess' : function(file, data, response) {
					loadFoto('<?php if (isset($tbNoticias)) { echo htmlentities($tbNoticias->pasta,ENT_QUOTES,'UTF-8'); } else { echo $pasta; } ?>',data);
				}									
			});
		});

		}, 0); //corrigir crash uploadify no google chrome
</script>
<!-- FIM Galeria de Foto -->

<div id="dialog" title="Basic modal dialog">
	<div id="popup-form">
        <form enctype="multipart/form-data" action="" method="post" id="frmFotoPopup" name="frmFotoPopup">
            <input type="file" id="btoLocalizarFotoPopup" name="btoLocalizarFotoPopup" onChange="javascript:uploadFotoPopup();" accept="image/*" style="width:100%;">
             <input name="txtPastaPopup" type="hidden" value="<?php if (isset($tbNoticias)) { echo htmlentities($tbNoticias->pasta,ENT_QUOTES,'UTF-8'); } else { echo $pasta; } ?>" />            
        </form>    	
    </div><!--popup-form-->
    
    <div id="popup-fotos-existentes">
    
        <div id="resultado-foto-popup">
        
        </div>    
    
    </div><!--popup-fotos-existentes-->
</div>




<div id="dialogPdf" title="Basic modal dialog">
	<div id="popup-pdf">
        <form enctype="multipart/form-data" action="" method="post" id="frmPdfPopup" name="frmPdfPopup">
            <input type="file" id="btoLocalizarPdfPopup" name="btoLocalizarPdfPopup" onChange="javascript:uploadPdfPopup();" accept="application/pdf" style="width:100%;">
             <input name="txtPastaPopup" type="hidden" value="<?php if (isset($tbNoticias)) { echo htmlentities($tbNoticias->pasta,ENT_QUOTES,'UTF-8'); } else { echo $pasta; } ?>" />            
        </form>    	
    </div><!--popup-form-->
    
    <div id="popup-pdf-existentes">
    
        <div id="resultado-pdf-popup">
        
        </div>    
    
    </div><!--popup-pdf-existentes-->
</div>



<script src="../includes/js/bootstrap.js"></script> <!-- Bootstrap -->
<script src="../includes/js/custom.js"></script> <!-- Custom codes -->	 
<?php require_once '../includes/php/footer.php'; ?>