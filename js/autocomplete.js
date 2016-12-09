$(document).ready(function(){  

    // Allow the "Enter" key to act as the submit button
    $("#searchInput").keyup(function(event){
        if(event.keyCode == 13){
            $("#SearchBtn").click();
        }
    });

    // The autocomplete function can be applied to different search categories
    function initAutocomplete(){
        $("#searchInput").autocomplete({
          source: function(request, response) {
              var postData = { };
              var searchString = request.term;
              var postVarName = $("#searchInput").attr('class').split(' ')[1]; // The second class name of the element is the current search-category selection
              postData[postVarName] = searchString; // E.G. postData[character] = 'Tyrion Lannister'
              var postData = $.param(postData); // E.G. postData = {character: Tyrion Lannister}
              $.getJSON("core/autocomplete.php", postData, response);
          },

          minLength: 4
        });
    }

    // Initialise autocomplete on #searchInput as a default setting
    initAutocomplete();

    // Destroy current instance of autocomplete
    function destroyAutocomplete(){
        $("#searchInput").autocomplete("destroy");
        $("#searchInput").removeData('autocomplete');
    }

    // Change search category
    $(".searchCategoryLi").click(function(){
        // Destroy current instance of autocomplete
        $("#searchInput").autocomplete("destroy");
        $("#searchInput").removeData('autocomplete');
        // Change search category
        var newCategoryClass = $(this).attr('id');
        var placeholder = "Search by " + newCategoryClass;
        var currentCategoryClass = $("#searchInput").attr('class').split(' ')[1];
        $("#searchInput").attr("placeholder", placeholder);
        $("#searchInput").removeClass(currentCategoryClass);
        $("#searchInput").addClass(newCategoryClass);
        $("#searchInput").val("");
        // Re-initialise autocomplete with updated post variable name, corresponding with the selected search cateory
        initAutocomplete();
    });

});