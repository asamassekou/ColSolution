(function($) {

    $('#sup').on('click', function(e) {
        e.preventDefault();
        var $a = $(this);
        var url = $a.attr('href');
        var test = 0;
        $.ajax(url)
            .done(function(data, text, jqxhr) {
                $a.parents('div').fadeOut();
             })
            .fail(function(jqxhr) {
                alert(jqxhr.responseText);
            })
            .always(function() {
                $a.text('supprimer');
        });  
    });

    $('#supCom').on('click', function(e) {
        e.preventDefault();
        var $a = $(this);
        var url = $a.attr('href');
        var test = 0;
        $.ajax(url)
            .done(function(data, text, jqxhr) {
                $a.parents('div').fadeOut();
             })
            .fail(function(jqxhr) {
                alert(jqxhr.responseText);
            })
            .always(function() {
                $a.text('supprimer');
        });  
    });

})(jQuery);