var ajax = new XMLHttpRequest();
ajax.open("POST", "notice_link.php", true);
ajax.send();

ajax.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {

    var obj = JSON.parse(this.responseText);

    document.getElementById("notice_link1").href ="Downloads.php?name="+encodeURIComponent(obj[0])+".pdf";
    document.getElementById("notice_link2").href ="Downloads.php?name="+encodeURIComponent(obj[1])+".pdf";
    document.getElementById("notice_link3").href ="Downloads.php?name="+encodeURIComponent(obj[2])+".pdf";
    // download.php?filename=

  }
}
