$("#theSelect").change(function(){          
    var value = $("#theSelect option:selected").val();
    var theDiv = $(".is_" + value);
    
    theDiv.siblings('[class*=is]').addClass("hidden");
    theDiv.removeClass("hidden");
});

$(document).ready(function(){
	var value = $("#theSelect option:selected").val();
    var theDiv = $(".is_" + value);
    
    theDiv.siblings('[class*=is]').addClass("hidden");
    theDiv.removeClass("hidden");
});