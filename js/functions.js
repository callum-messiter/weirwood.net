$(document).ready(function(){  

    // The autocomplete function can be applied to different search categories. As a default, apply it to quote search 
    $(".quote").autocomplete({
        source: "core/autocomplete.php",
        minLength: 2
    });

    // Allow the "Enter" key to act as the submit button
    $("#searchInput").keyup(function(event){
        if(event.keyCode == 13){
            $("#SearchBtn").click();
        }
    });

    // Load autocomplete suggestions asynchronously. targetInput accounts for search category, e.g. .quote or .character
    function getAutocomplete(targetInput){
        $(targetInput).autocomplete({
            source: "core/getVideos.php",
            minLength: 2
        });
    }

    // Remove autocomplete from the search input when the search category is changed
    function removeAutocomplete(){
        $("#searchInput").autocomplete("destroy");
        $("#searchInput").removeData('autocomplete');
    }

    // Change the search field according to the selected search category
    function changeSearchOption(placeholder, classToRemove, classToAdd){
        $("#searchInput").removeAttr("placeholder");
        $("#searchInput").attr("placeholder", placeholder);
        $("#searchInput").removeClass(classToRemove);
        $("#searchInput").addClass(classToAdd);
        $("#searchInput").val("");
    }

});
