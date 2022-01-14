$ (document).ready(function(){

    $ ('#languageSwitcher').change(function(){
        var locale = $(this).val();

        $.ajax({
            url: "/language",
            type: 'POST',
            data: {locale: locale},
            datatype: 'json',
            success: function (data) {

            },
            error: function (data) {

            },
            beforeSend: function () {

            },
            complete: function (data) {
                window.location.reload(true);
            }
        });
    });
});