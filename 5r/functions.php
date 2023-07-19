<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it

window.onclick = function(event) {
  if (!event.target('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

function next1() {
    location.replace("detail.php?menu_id=1")
}

function next2() {
    location.replace("detail.php?menu_id=2")
}

function next3() {
    location.replace("detail.php?menu_id=3")
}

function next4() {
    location.replace("tindakan.php?menu_id=4")
}

function next5() {
    location.replace("hasil-audit.php")
}
</script>