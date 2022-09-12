function navigationButton(){
    $('#nav-button').click(function(){
        $("#sm-nav-list-wrapper").slideToggle(400);
    });
}

function styling(){

    let window_width = window.outerWidth;
    let window_height = window.outerHeight;
	let section = document.getElementById("hero-section");
    if(window_height <= 568){
        section.style.height ="190vh";
    }
   
}
navigationButton();
//styling();
