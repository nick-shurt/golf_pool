$("#theSelect").change(function(){          
    var value = $("#theSelect option:selected").val();
    var theDiv = $(value);
    
    theDiv.slideDown().removeClass("hidden");
    theDiv.siblings('[class*=week]').slideUp(function() { $(this).addClass("hidden"); });
});