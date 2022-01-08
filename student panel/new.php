<script type="text/javascript">
var d1 = new Date("2012-11-01");
var d2 = new Date("2012-11-04");
d1.setHours(0,0,0,0);
d2.setHours(0,0,0,0);
if (d2.valueOf() == d1.valueOf()) {
  console.log(d1+"  "+d2);
}
</script>
