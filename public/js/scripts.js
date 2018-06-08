window.onload = function() {
	var html = document.documentElement;
	var body = document.body;

    window.onscroll = function() {
        var menu = document.getElementById('header_flow');
        var scrolled = window.pageYOffset || document.documentElement.scrollTop;
        if(scrolled > 105){
            menu.style.display = 'block';
        }else{
            menu.style.display = 'none';
        }
    }

 }
 var menuOpen = false;
 function GetMenu(){
 	menuOpen = Change();
 	var menu = document.getElementsByClassName('side')[0];
 	if(menuOpen){
 	menu.style.display = "block";
 	}else{
 		menu.style.display = "none";
 	}
 }
 function Change(){
 	if(menuOpen) return false;
 	return true;
 }
