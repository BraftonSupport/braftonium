/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y };
}
// setting the viewport width
var viewport = updateViewportDimensions();

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/
function loadGravatars() {
  viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars, rotate buttons and show the menu button
  if (viewport.width >= 768) {
  // set the viewport using the function above
    jQuery('.comment img[data-gravatar]').each(function(){
      jQuery(this).attr('src',jQuery(this).attr('data-gravatar'));
    });
  }
} // end function

function rotateButtons() {
  viewport = updateViewportDimensions();
  if (viewport.width <= 768) {
    buttons = document.querySelectorAll('#inner-header nav button');
    buttons.forEach(function(button) {
      if (button.classList){
        button.classList.add('rotate');
      }
    });
  } else {
    navButtons = document.querySelectorAll('header nav button');
    navButtons.forEach(function(navButton) {
      navButton.addEventListener('click',function() {
        if (navButton.classList) {
          navButton.classList.toggle('rotate');
        } else {
          var navClasses = navButton.className.split(' ');
          var navExistingIndex = classes.indexOf('rotate');
        
          if (navExistingIndex >= 0)
            navClasses.splice(navExistingIndex, 1);
          else
            navClasses.push('rotate');
        
          navButton.className = navClasses.join(' ');
        }
        subMenu = navButton.nextElementSibling;
        if (subMenu) {
          subMenu.classList.toggle('toggleon');
        } else {
          var subMenuClasses = subMenu.className.split(' ');
          var subMenuExistingIndex = classes.indexOf('toggleon');
          
          if (subMenuExistingIndex >= 0){
            subMenuClasses.splice(subMenuExistingIndex, 1);
          } else {
            subMenuClasses.push('toggleon');
          }
        subMenu.className = subMenuClasses.join(' ');
        }
      });
    });
  }
}

function menuToggle() {
  viewport = updateViewportDimensions();
  if (viewport.width <= 768) {
    //The menu button in the mobile version
    menuToggleButton = document.getElementById('menu-toggle');
    //when clicked toggles class "toggledon" on the nav
    menuToggleButton.addEventListener('click',function() {
      nav = document.querySelector('nav');
      if (nav.classList) {
        nav.classList.toggle('toggleon');
      } else {
        var classes = nav.className.split(' ');
        var existingIndex = classes.indexOf('toggleon');
      
        if (existingIndex >= 0)
          classes.splice(existingIndex, 1);
        else
          classes.push('toggleon');
      
        el.className = classes.join(' ');
      }

      //also switches the svg from menu to close
      svgs = document.querySelectorAll('#menu-toggle svg');
      svgs.forEach(function(x) {
        if (x.style.display === "inline") {
          x.style.display = "none";
        } else if (x.style.display === "none"){
          x.style.display = "inline";
        }
      });

    });
  }
}

document.addEventListener("DOMContentLoaded", function(event) {
  loadGravatars();
  rotateButtons();
  document.querySelector('#menu-toggle .icon-close').style.display = "none";
  document.querySelector('#menu-toggle .icon-bars').style.display = "inline";
  menuToggle();
}); /* end of as page load scripts */