function update(url, c, s){
  $('#load').html('<img src="/npi/img/load.gif">');
   $.get("/npi/update.php", { categoria: c, site: s }, function(data){ noticia_novas(c, s); $('#load').empty(); } );
}

function update2(c, s){
   $.get("/npi/update.php", { categoria: c, site: s } );
}

function noticia_mais(c, s){
  $('#load2').html('<img src="/npi/img/load.gif">');
  var idlast = $('.media').last().attr('id');
  $.get("/npi/noticia-mais.php", { id: idlast, categoria: c, site: s }, function(data){
	if (data != "") {
	  $(".noticias-body").append(data);
	}
     $('#load2').empty();
     get_images();
  });
}

function noticia_novas(c, s){
  $('#load').html('<img src="/npi/img/load.gif">');
  var idlast = $('.media').first().attr('id');
  $.get("/npi/noticia-novas.php", { id: idlast, categoria: c, site: s }, function(data){
	if (data != "") {
	  $(".noticias-body").prepend(data);
	}
     $('#load').empty();
     get_images();
  });
}

function del(id){
  aux = confirm('Deseja excluir?');
  if(aux){
    $.get("/npi/noticias-actions.php", { id: id, acao:'excluir', r:'nao' }, function(data){
     $('#'+id).fadeOut(500).remover();
    });
  }
  return false;
}

function status(id){
  var s;
  row = $('#'+id);
  a = $('#'+id+'bt');
  st = $('.'+id+'st');

  st.html('<img src="/npi/img/load.gif">');

  if( a.attr('rel') == 'disable' ){
    row.attr('class', 'warning');
    a.attr('rel', 'enable').html('<span class="glyphicon glyphicon-ok-circle"></span>');
    s = 2;
  }else{
    row.attr('class', '');
    a.attr('rel', 'disable').html('<span class="glyphicon glyphicon-remove-circle"></span>');
    s = 1;
  }

  $.get("/npi/noticias-actions.php", { id: id, acao: 'status', status:s, r:'nao' }, function(data){
    st.html(s);
  });

  return false;
}

function get_images(){

  $(".media-object").each(function( index ) {
    this.src = this.alt;
  });

}

$( window ).load(function() {
   get_images();
});