var myVar;

function myFunction() {
  myVar = setTimeout(showPage, 3000);
}

function showPage() {
  document.getElementById("preloder").style.display = "none";
  document.getElementById("contentContent").style.display = "block";
}