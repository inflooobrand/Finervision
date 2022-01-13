<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="/bootstrap.min.css">



</head>
<body>
<div></div>
<button class="accordion">Step 1:Your details</button>

<div class="panel" id="panel_one">
    <form action="" method="POST">
      <div class="row">
        <div class="col-md-3">
       <label class="control-label">First Name:</label>
          <input type="text" name="first_name" id="first_name" autocomplete="nope" class="form-control">
        </div>
        <div class="col-md-3">
          <label class="control-label">Surname:</label>
          <input type="text" name="surname" id="surname" autocomplete="nope"  class="form-control" >
        </div>
      </div>
      <div class="row">
        <input id="token_value" type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="col-md-3">
          <label class="control-label">Email Address:</label>
          <input type="email" name="email" id="email"  autocomplete="nope" class="form-control">
        </div>
      </div>
      <button id="mg-tp-dt" onclick="buttonone()" class="accordion_id" type="button">Next ></button>


</div>

<button class="accordion">Step 2:More comments</button>
<div class="panel" id="panel_two">
      <div class="row">
        <div class="col-md-3">
       <label class="control-label">Telephone number</label>
          <input type="number"  name="number" id="number" class="form-control" >
        </div>
        <div class="col-md-2">
          <label class="control-label">Gender</label>
          <select class="form-control" name="gender" id="gender" >
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
      </div>
      <div class="row" id="date_span">
          <label class="control-label mg-lt">Date of birth</label>
        <div class="col-md-6">
            <select name="day" id="day"></select>
            <select name="month" id="month"></select>
            <select name="year" id="year">Year:</select>
        </div>
      </div>
      <button id="mg-tp-dt" onclick="buttontwo()"  class="accordion_id" type="button">Next ></button>

</div>

<button class="accordion">Section 3</button>
<div class="panel" id="panel_three">
      <div class="row">
        <div class="col-md-3">
        <label>Comments:</label>
      <textarea id="comments" name="comments" rows="5" cols="400" required></textarea>
        </div>
      </div>
      <button id="mg-tp-dt" onclick="buttonthree()"  class="accordion_id" type="submit">Next ></button>
</div>
  </form>
</body>
</html>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>

<script type="text/javascript">
function buttonone(){
  var name = $("#first_name").val();
  if (name=='') {
    alert("Please Enter the Name");
    return false;
  }
  var surname = $("#surname").val();
  if (surname=='') {
    alert("Please Enter the Surname");
    return false;
  }
  var email = $("#email").val();
  if (email=='') {
    alert("Please Enter the Email");
    return false;
  }

  document.getElementById("panel_two").style.display = "block";
  document.getElementById("panel_three").style.display = "none";

}
function buttontwo(){
  var number = $("#number").val();
  if (number=='') {
    alert("Please Enter Telephone Number");
    return false;
  }
  var gender = $("#gender").val();
  if (gender=='') {
    alert("Please Select Gender");
    return false;
  }

 document.getElementById("panel_one").style.display = "none";
document.getElementById("panel_three").style.display = "block";
document.getElementById("panel_two").style.display = "none";
}
</script>
<script>
var acc = document.getElementsByClassName("accordion_id");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });

}
</script>

<script type="text/javascript">
  $(document).ready(function () {
  $("form").submit(function (event) {
    var formData = {
      name :$("#first_name").val(),
      surname :  $("#surname").val(),
      email : $("#email").val(),
      number : $("#number").val(),
      gender : $("#gender").val(),
      comments : $("#comments").val(),
      day : $("#day").val(),
      month : $("#month").val(),
      year : $("#year").val(),
    };
    $.ajax({
      type: "POST",
      url: "/user/save",
      data: formData,
      _token:"{{ csrf_token() }}",
      encode: true,
    }).done(function (data) {
      console.log(data.status);
      if (data.status){
        alert("Data Saved Successfully");
        window.location = '/user/getUsers';
      }else{
        alert("Something Went Wrong");
      }
    });

    event.preventDefault();
  });
});


  //Create references to the dropdown's
const yearSelect = document.getElementById("year");
const monthSelect = document.getElementById("month");
const daySelect = document.getElementById("day");

const months = ['January', 'February', 'March', 'April', 
'May', 'June', 'July', 'August', 'September', 'October',
'November', 'December'];

//Months are always the same
(function populateMonths(){
    for(let i = 0; i < months.length; i++){
        const option = document.createElement('option');
        option.textContent = months[i];
        monthSelect.appendChild(option);
    }
    monthSelect.value = "January";
})();

let previousDay;

function populateDays(month){
    //Delete all of the children of the day dropdown
    //if they do exist
    while(daySelect.firstChild){
        daySelect.removeChild(daySelect.firstChild);
    }
    //Holds the number of days in the month
    let dayNum;
    //Get the current year
    let year = yearSelect.value;

    if(month === 'January' || month === 'March' || 
    month === 'May' || month === 'July' || month === 'August' 
    || month === 'October' || month === 'December') {
        dayNum = 31;
    } else if(month === 'April' || month === 'June' 
    || month === 'September' || month === 'November') {
        dayNum = 30;
    }else{
        //Check for a leap year
        if(new Date(year, 1, 29).getMonth() === 1){
            dayNum = 29;
        }else{
            dayNum = 28;
        }
    }
    //Insert the correct days into the day <select>
    for(let i = 1; i <= dayNum; i++){
        const option = document.createElement("option");
        option.textContent = i;
        daySelect.appendChild(option);
    }
    if(previousDay){
        daySelect.value = previousDay;
        if(daySelect.value === ""){
            daySelect.value = previousDay - 1;
        }
        if(daySelect.value === ""){
            daySelect.value = previousDay - 2;
        }
        if(daySelect.value === ""){
            daySelect.value = previousDay - 3;
        }
    }
}

function populateYears(){
    //Get the current year as a number
    let year = new Date().getFullYear();
    //Make the previous 100 years be an option
    for(let i = 0; i < 101; i++){
        const option = document.createElement("option");
        option.textContent = year - i;
        yearSelect.appendChild(option);
    }
}

populateDays(monthSelect.value);
populateYears();

yearSelect.onchange = function() {
    populateDays(monthSelect.value);
}
monthSelect.onchange = function() {
    populateDays(monthSelect.value);
}
daySelect.onchange = function() {
    previousDay = daySelect.value;
}

</script>


