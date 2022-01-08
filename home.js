var ajax = new XMLHttpRequest();
ajax.open("POST", "home.php", true);
ajax.send();

ajax.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {

    var obj = JSON.parse(this.responseText);

    if (this.responseText != null) {

      var d1 = new Date(obj[0].start_date.substring(0, 10));
      var d2 = new Date(obj[1].start_date.substring(0, 10));
      var d3 = new Date(obj[2].start_date.substring(0, 10));




      document.querySelector("  div.event_li1  div.left_event div.date1 h3").innerHTML = obj[0].start_date.substring(8, 10);
      document.querySelector("  div.event_li1  div.left_event div.mon_year1").innerHTML = d1.toLocaleString('en-us', {
        month: 'short'
      }) + " " + obj[0].start_date.substring(0, 4);
      document.querySelector(" div.event_li1   div.Right_event p.event1").innerHTML = obj[0].title;

      document.querySelector(" div.event_li2  div.left_event div.date2 h3").innerHTML = obj[1].start_date.substring(8, 10);
      document.querySelector("  div.event_li2  div.left_event div.mon_year2").innerHTML = d2.toLocaleString('en-us', {
        month: 'short'
      }) + " " + obj[1].start_date.substring(0, 4);
      document.querySelector(" div.event_li2  div.Right_event p.event2").innerHTML = obj[1].title;

      document.querySelector("  div.event_li3  div.left_event div.date3 h3").innerHTML = obj[2].start_date.substring(8, 10);
      document.querySelector("  div.event_li3  div.left_event div.mon_year3").innerHTML = d3.toLocaleString('en-us', {
        month: 'short'
      }) + " " + obj[2].start_date.substring(0, 4);
      document.querySelector(" div.event_li3  div.Right_event p.event3").innerHTML = obj[2].title;


    }
  }
}

var ajax = new XMLHttpRequest();
ajax.open("POST", "home2.php", true);
ajax.send();

ajax.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {


    console.log(this.responseText);
    var obj = JSON.parse(this.responseText);



    if (this.responseText != null) {
      document.querySelector("  div.notice_li1  div.notice_head1 h5").innerHTML = obj[0].Title;
      document.querySelector("  div.notice_li1  div.notice_date1 ").innerHTML = obj[0].Date;

      document.querySelector("  div.notice_li2  div.notice_head2 h5").innerHTML = obj[1].Title;
      document.querySelector("  div.notice_li2  div.notice_date2 ").innerHTML = obj[1].Date;

      document.querySelector("  div.notice_li3  div.notice_head3 h5").innerHTML = obj[2].Title;
      document.querySelector("  div.notice_li3  div.notice_date3 ").innerHTML = obj[2].Date;

    }
  }
};
