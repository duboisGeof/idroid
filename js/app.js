(function($){  
    $('.action').on('click', function(e){
        e.preventDefault();
        var $a = $(this);
        var url = $a.attr("href");
        $a.text("Chargement");
            
        $.ajax(url)
            .done(function(data, text, jqxhr){
                $a.parents('tr').remove();
                var count = $("#count").html();
                var count2 = count-1;
                $("#count").html(count2);
                
                if ($('#table_new_user > tbody > tr').length === 0){
                    $("#tbody").append("<tr><td colspan='12'>Aucun Résultat</td><tr>");
                }
                
            })
            .fail(function(jqxhr){
                alert(jqxhr.responseText);
            })
            .always(function(){
                $a.text("Supprimer");
            });
    });
    
    $("#search").keyup(function(){
       $field = $(this);
       $("#result").html('');
     
           $.ajax({
              type : "GET",
              url : 'search.php',
              data : "motclef="+$(this).val(),
              success : function(data){
                  $("#table_list_user").hide();
                  $("#result").html(data);
              }
           });
    });
})(jQuery);