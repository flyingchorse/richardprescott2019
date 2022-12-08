jQuery(document).ready(function(){
	
	var url = window.location.href;
	var slide = url.substring(url.lastIndexOf('/')+2); // 4
	var hamburger = document.getElementById("cookiemodal")
	
	// Remove the trailing slash if necessary
	if( slide.indexOf("/") > -1 ) { 
	    var slideRmvSlash = slide.replace('/','');
	    slide = parseInt(slideRmvSlash);
	}
	slide = parseInt(slide);
	if (slide) {
	goToSlide(slide);
	}
	
	jQuery('[data-toggle="tooltip"]').tooltip();

	
	
});


function goToSlide(number) {
	
   jQuery("#carouselExampleControls").carousel(number);
}

jQuery('.thumbnail-image').on('click' , function () {
	
	var slidemove = 0;
	slidemove = this.getAttribute('change-slide-to');
	   jQuery("#wrapper-hero").collapse('show');
	   jQuery("#multic-2").collapse('hide');
	 jQuery("#carouselExampleControls").carousel(Number(slidemove));
	 
	 });

jQuery('#multic-2').on('hidden.bs.collapse', function () {
  // do something…
  
  jQuery("#wrapper-hero").collapse('show');
});

jQuery('#multic-2').on('show.bs.collapse', function () {
  // do something…
  
  jQuery("#wrapper-hero").collapse('hide');
});

document.body.classList.add('js-loading');

window.addEventListener("load", showPage);

function showPage() {
  document.body.classList.remove('js-loading');
}

//document.oncontextmenu =new Function("return false;")
//document.onselectstart =new Function("return false;")

const mainNode = document.getElementById('eu-cookie-law')
var hamburg = document.getElementById("eu_cookie_law_widget-2")

function callback(mutationsList, observer) {
    console.log('Mutations:', mutationsList)
    console.log('Observer:', observer)
    mutationsList.forEach(mutation => {
        if (mutation.attributeName === 'class') {
			hamburg.classList.add("cookiemodal-accepted");
        }
    })
}

const mutationObserver = new MutationObserver(callback)

mutationObserver.observe(mainNode, { attributes: true })