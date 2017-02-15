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
        iframe.setAttribute("src", "//www.youtube.com/embed/" + video_id + "?start=" + startTime + "&autoplay=1&autohide=2&border=0&wmode=opaque&enablejsapi=1&controls=1&showinfo=0&rel=0"); // Grab the video_id and startTime parameters from the server's (getVideos.php) response to the POST request
        iframe.setAttribute("frameborder", "0");
        iframe.setAttribute("id", "youtube-iframe");
        this.parentNode.replaceChild(iframe, this); // Replace the YouTube thumbnail with YouTube HTML5 Player
    }

    // Turn all embedded videos into on-demand videos; a responsive and lightwight video-embed method
    function createOnDemandVideos(){
        var v = document.getElementsByClassName("youtube-player"); // Find all the youtube videos embedded on the page
        for (var n = 0; n < v.length; n++) { // For each video... 
            var p = document.createElement("div");
            p.innerHTML = loadThumbnail(v[n].dataset.id); // Load the video's thumbnail into the div
            p.onclick = loadVideo; // Load the video itself when this div is clicked
            v[n].appendChild(p); // Append the new div to the original youtube-player div
            // Autoclick when there is only one video result: $(p).click();
        }
    }

    // Send the post request to the server and display the response
    function showVideos(searchString, postData){
        if(searchString != ""){ 
            $.post("core/getVideos.php", postData, function(searchResults){
                if(searchResults != "nothing"){ 
                    $("#searchResults").html(searchResults); 
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
        var postData          = { };
        var searchString      = $("#searchInput").val();
        var postVarName       = $("#searchInput").attr('class').split(' ')[1]; // The element's second class name = the current search category
        postData[postVarName] = searchString; // E.G. postData[character] = 'Tyrion Lannister'
        var postData          = $.param(postData); // E.G. postData = {character : Tyrion Lannister}
        showVideos(searchString, postData);
    });

});