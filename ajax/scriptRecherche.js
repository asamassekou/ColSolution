$(document).ready(function() {
    $('#searc').keyup(function(){
     $('#result').html("");
         var utilisateur = $(this).val();
         if(utilisateur != ""){
             $.ajax({
                 type: 'GET',
                 url: 'rechercheAjax.php',
                 data: 'user=' + encodeURIComponent(utilisateur),
                 success: function(data) {
                     if(data != ""){
                         $('#result').append(data);
                     }else{
                         document.getElementById('result').innerHTML = "<div style = 'font-size: 20px; text-align: center; margin-top: 10px'> Aucun Utilisateur </div>";
                     }
                 }
                // console.log(utilisateur);
             });
         }
    });
})(jQuery);



