//Passes search-task input information to search.php
$('form.ajax').on('submit', function(){
    var that = $(this),
        url = that.attr('action'),
        method = that.attr('method'),
        data = {};
        
        that.find('[name]').each(function(index, value){
            var that = $(this),
            name = that.attr('name'),
            value = that.val();
            
            data[name] = value;
        });

        $.ajax({
            url: url,
            type: type,
            data: data,
            success: function(response){
                console.log(response);
            }
            
        });
        
    return false;
})

jQuery(document).ready(function () {
    $(".reset").click(function () {

        $(".reset").attr("value", $(this).attr('reset'));
    });
});


