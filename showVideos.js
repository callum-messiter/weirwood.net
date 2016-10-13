$(document).ready(function(){

    // Load video thumbnail and play button once the server has sent a response to the POST request 
    function loadThumbnail(id){
        return '<img class="youtube-thumb" src="//i.ytimg.com/vi/' + id + '/hqdefault.jpg"><div class="play-button"></div>';
    }

    // Load the video itself once the play button is clicked
    function loadVideo(){
        var iframe = document.createElement("iframe"); // Create an iFrame with autoplay set to true
        var startTime = $(this).parent().attr('start-time');
        var video_id = $(this).parent().attr('data-id');
        iframe.setAttribute("src", "//www.youtube.com/embed/" + video_id + "?start=" + startTime + "&autoplay=1&autohide=2&border=0&wmode=opaque&enablejsapi=1&controls=1&showinfo=0&rel=0"); // Grab the video_id and startTime parameters from the response to the POST request
        iframe.setAttribute("frameborder", "0");
        iframe.setAttribute("id", "youtube-iframe");
        this.parentNode.replaceChild(iframe, this); // Replace the YouTube thumbnail with YouTube HTML5 Player
    }

    // Turn all embedded videos in on-demand videos; a responsive and lightwight video-embed method
    function createOnDemandVideos(){
        var v = document.getElementsByClassName("youtube-player"); // Find all the youtube videos embedded on the page
        for (var n = 0; n < v.length; n++) { // For each video... 
            var p = document.createElement("div"); // 1) Create a div
            p.innerHTML = loadThumbnail(v[n].dataset.id); // 2) Call the function to load the video's thumbnail into the div
            p.onclick = loadVideo; // 3) Call the function to load the video itself when this div is clicked
            v[n].appendChild(p); // 4) Append the new div to the original youtube-player div
            $(p).click(); // 5) Autoplay video (post request returns a single video now that character search is gone and quote search has autocomplete)
        }
    }

    // Send the post request to the server and display the response
    function showVideos(searchString, postData){
        if(searchString != ""){ 
            $.post("getVideos.php", postData, function(searchResults){
                if(searchResults != "nothing"){ 
                    $("#searchResults").html(searchResults); // Embed the videos returned by the server on the page
                    createOnDemandVideos(); // Transform all embedded videos into on-demand videos
                }else{
                    // Play the audio error message when the server finds zero search matches
                    $("#searchResults").html("<audio id='nothing' src='resources/audio/nothing.mp3' autoplay type='audio/mpeg'></audio>");
                    document.getElementById("nothing").volume = 0.1;
                }
            });
        }
    }

    // Set the post data dynamically, depending on the search category selected, send the post request to the server, and display the responsive, on-demand videos
    $("#SearchBtn").click(function(){
        var postData          = { }; // Create associatve array
        var searchString      = $("#searchInput").val(); // Grab the search string from the #searchInput field
        var postVarName       = $("#searchInput").attr('class').split(' ')[1]; // The post variable name = the table column we want to query = the class of #searchInput
        postData[postVarName] = searchString; // E.G. postData[character] = 'Tyrion Lannister'
        var postData          = $.param(postData); // Parameterise the array
        showVideos(searchString, postData); // Show the results: light and responsive video embeds
    });

});