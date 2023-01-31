
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "flex") {
    dropdownContent.style.display = "none";
    } else {
    dropdownContent.style.display = "flex";
    }
});
}

var isOpen = true;
function openSidebar() {
   if(isOpen == true){
    document.getElementsByClassName("sidebar")[0].style.position = "relative";
    document.getElementsByClassName("sidebar")[0].style.left = "0";
    isOpen = false;
   }else if(isOpen == false){
    document.getElementsByClassName("sidebar")[0].style.position = "fixed";
    document.getElementsByClassName("sidebar")[0].style.left = "-250px";
    isOpen = true;
   }
   
  
  }