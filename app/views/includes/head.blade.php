<!DOCTYPE html>
<html>



<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GAS Express  </title>
    <link rel="shortcut icon" href="images/logo.png" />

    <!-- <img src="{{asset('images/ourlogo.png')}}"> -->

    <!-- Core CSS - Include with every page -->

    {{ HTML::style('jquery-ui-1.11.4.custom/jquery-ui.css') }}

    {{ HTML::style('css/bootstrap.min.css') }}
    
   
   {{ HTML::style('font-awesome/css/font-awesome.css') }}
  

    <!-- Page-Level Plugin CSS - Blank -->

    <!-- SB Admin CSS - Include with every page -->
   
    {{ HTML::style('css/sb-admin.css') }}



    <!-- datatables css -->

    {{ HTML::style('media/css/jquery.dataTables.min.css') }}

    {{ HTML::style('datepicker/css/bootstrap-datepicker.css') }}

    <style type="text/css">

   .right-inner-addon {
    position: relative;
   }
   .right-inner-addon input {
    padding-right: 30px;    
   }
   .right-inner-addon i {
    position: absolute;
    right: 0px;
    padding: 10px 12px;
    pointer-events: none;
   }

   .ui-datepicker {
    padding: 0.2em 0.2em 0;
    width: 550px;
   }
   </style>


    <!-- jquery scripts with datatable scripts -->

    
    {{ HTML::script('media/js/jquery.js') }}

    {{ HTML::script('media/js/jquery.dataTables.js') }}

    {{ HTML::script('datepicker/js/bootstrap-datepicker.js') }}

    
  <script type="text/javascript">

    $(document).ready(function() {
    $('#users').DataTable({"sDom": '<"H"lfrp>t<"F"ip>'}) ;
    $('.users').DataTable({"sDom": '<"H"lfrp>t<"F"ip>'}) ;
    $('#mobile').DataTable({"sDom": '<"H"lfrp>t<"F"ip>'});
    $('#rejected').DataTable({"sDom": '<"H"lfrp>t<"F"ip>'});
    $('#app').DataTable({"sDom": '<"H"lfrp>t<"F"ip>'});
    $('#disbursed').DataTable({"sDom": '<"H"lfrp>t<"F"ip>'});
    $('#amended').DataTable({"sDom": '<"H"lfrp>t<"F"ip>'});

    } );

</script>

<script type="text/javascript">

$(function(){
$('.datepicker').datepicker({
    format: 'dd-M-yyyy',
    startDate: '-60y',
    endDate: '+0d',
    autoclose: true
});
});

</script>

<script type="text/javascript">
$(function(){
$('.datepicker1').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-60y',
    endDate: '-18y',
    autoclose: true
});
});
</script>

<script type="text/javascript">
$(function(){
$('.datepicker2').datepicker({
    format: "mm-yyyy",
    startView: "months", 
    minViewMode: "months",
    autoclose: true
});
});
</script>

<script type="text/javascript">
$(function(){
$('.datepicker23').datepicker({
    format: "M-yyyy",
    startView: "months", 
    minViewMode: "months",
    autoclose: true
});
});
</script>



<script type="text/javascript">
$(function(){
$('.datepicker21').datepicker({
    format: "yyyy-mm-dd",
   
    autoclose: true
});
});
</script>



<script language="javascript" type="text/javascript"> 
var timer = 0;
function set_interval() {
  // the interval 'timer' is set as soon as the page loads
  timer = setInterval("auto_logout()", 1800000);
  // the figure '10000' above indicates how many milliseconds the timer be set to.
  // Eg: to set it to 5 mins, calculate 5min = 5x60 = 300 sec = 300,000 millisec.
  // So set it to 300000
}

function reset_interval() {
  //resets the timer. The timer is reset on each of the below events:
  // 1. mousemove   2. mouseclick   3. key press 4. scrolling
  //first step: clear the existing timer

  if (timer != 0) {
    clearInterval(timer);
    timer = 0;
    // second step: implement the timer again
    timer = setInterval("auto_logout()", 1800000);
    // completed the reset of the timer
  }
}

function auto_logout() {
  // this function will redirect the user to the logout script
  window.location = "{{ URL::to('users/logout') }}";
}
</script>


</head>