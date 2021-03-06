<!DOCTYPE html>
<script>
var list;
var gcode;
var gname;
</script>
<div onload="check()">
<h2>Course Details</h2>
<form action="dept" method="post">
<label>Course Code:</label>
<input type="text" name="code" id="code" required />
<label>Course Title:</label>
<input type="text" name="name" id="name" required />
<br/><br/>
<label>Credit:</label>
<input type="text" name="credit" id="credit" required />
<label>Category:</label>
<select name="category" id="category">
  <option value="OE">Open Elective</option>
  <!--<option value="C">Compulsory Course</option>-->
</select><br/><br/>
<label>Program:</label>
<select name="program" id="program">
</select><br/><br/>
<label>Course Scale:</label>
<label>(Out of 10)</label>
<input type="Grading" name="Grading" id="Grading" placeholder="Grading" style="width:50px;" required />
<input type="CourseLoad" name="CourseLoad" id="CourseLoad" placeholder="CourseLoad" style="width:70px;" required />
<input type="Attendance" name="Attendance" id="Attendance" placeholder="Attendance" style="width:70px;" required />
<input type="Practicality" name="Practicality" id="Practicality" placeholder="Practicality" style="width:70px;" required />
<input type="Interactivity" name="Interactivity" id="Interactivity" placeholder="Interactivity" style="width:70px;" required />
<br/><br/>
<label>Rating</label>
<input type="text" name="rating" id="rating" required />
<br/><br/>
<label>Total Votes</label>
<input type="text" name="votes" id="votes" required />
<br/><br/>
<label>Description</label>
<br/>
<textarea rows = "3" type="text" name="description" id="description" style="height:100px;width:500px;" required ></textarea>
<br/><br/>
<input type="button" name="submit" value="Add Entry" onclick="addcourse()"/>
<!--<input type="button" name="submit1" value="Edit Entry" onclick="editcourse()"/> -->
<br/><br/>
</form>
<b><label id="error" style="color:red;"></label></b>
</div>
<div>
<h2>List of Courses</h2>
<div id="coursecontent"></div>
</div>
<script>
check();
loadoptions();
function check(){
	var xhttp = new XMLHttpRequest();
	var htmlcontent="";
     xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
	list=JSON.parse(xhttp.responseText);
	htmlcontent="<table><tr><th>Course Code</th><th>Course Title</th><th>Program</th><th>Action</th></tr>";
	for(var i=0;i<list.courses.length;i++){
		
		var counter=list.courses[i];
		console.log(counter);
		
		htmlcontent=htmlcontent+"<tr><td>"+counter["CourseCode"]+"</td><td>"+counter["CourseTitle"]+"</td><td>"+counter["Program"]+"</td>";
		htmlcontent=htmlcontent+"<td><button onclick=deletecourse('"+counter['CourseCode']+"')>Delete</button></td></tr>";
		//<button onclick=\"fill('"+counter["CourseCode"]+"','"+counter["CourseTitle"]+"')\">Edit</button>
	}
	htmlcontent=htmlcontent+"</table>"
	document.getElementById("coursecontent").innerHTML=htmlcontent;
	}
	 }
  xhttp.open("GET", "listofcourse", true);
  xhttp.send(null);
}
function loadoptions(){
	var xhttp = new XMLHttpRequest();
	var htmlcontent="";
     xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
	list=JSON.parse(xhttp.responseText);
	for(var i=0;i<list.departments.length;i++){
		var counter=list.departments[i];
		htmlcontent=htmlcontent+"<option value='"+counter['deptid']+"'>"+counter["deptname"]+"</option>";
	}
	document.getElementById("program").innerHTML=htmlcontent;
	}
	 }
  xhttp.open("GET", "listofdept", true);
  xhttp.send(null);
}
function addcourse(){
	var xhttp = new XMLHttpRequest();
	var htmlcontent="";
     xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		console.log(xhttp.responseText);
	msg=JSON.parse(xhttp.responseText);
	if(msg.error){
		alert("Something went wrong. Check the code");
	}else{
		alert("New entry added.");
		document.getElementById("code").value="";
		document.getElementById("name").value="";
		document.getElementById("credit").value="";
		document.getElementById("category").value="";
		document.getElementById("program").value="";
		document.getElementById("Grading").value="";
		document.getElementById("CourseLoad").value="";
		document.getElementById("Attendance").value="";
		document.getElementById("Practicality").value="";
		document.getElementById("Interactivity").value="";
		document.getElementById("rating").value="";
		document.getElementById("votes").value="";
		document.getElementById("description").value="";
		
		
		check();
	}
	}
	 }
	 var code=document.getElementById("code").value;
	 var name=document.getElementById("name").value;
	 var credit=document.getElementById("credit").value;
	 var category=document.getElementById("category").value;
	 var program="B.Tech";
	 var Grading=document.getElementById("Grading").value;
	 var CourseLoad=document.getElementById("CourseLoad").value;
	 var Attendance=document.getElementById("Attendance").value;
	 var Practicality=document.getElementById("Practicality").value;
	 var Interactivity=document.getElementById("Interactivity").value;
	 var rating=document.getElementById("rating").value;
	 var votes=document.getElementById("votes").value;
	 var description=document.getElementById("description").value;
	 
	 if(code.length>0 && name.length>0 && credit.length>0 &&  rating.length>0 && votes.length>0 && description.length>0){
	document.getElementById("error").innerHTML="";
	
	
	xhttp.open("GET", "addcourse?code="+code+"&name="+name+"&credit="+credit+"&category="+category+"&program="+program+"&Grading="+Grading+"&CourseLoad="+
	CourseLoad+"&Attendance="+Attendance+"&Practicality="+Practicality+"&Interactivity="+Interactivity+"&rating="+rating+"&votes="+votes+"&description="+description, true);
	

	xhttp.send(null);
	 }else{
		 document.getElementById("error").innerHTML="Input Fields can't be empty";
	 }
}
function fill(code,name){
	
	document.getElementById('code').value=code;
	document.getElementById('name').value=name;
	//document.getElementById('code').value=counter["Credit"];
	//document.getElementById('name').value=name;
	
	gcode=code;
	gname=name;
}
function editdept(){
	var xhttp = new XMLHttpRequest();
	var htmlcontent="";
     xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
	msg=JSON.parse(xhttp.responseText);
	if(msg.error){
		alert("Something went wrong. Check the code");
	}else{
		alert("Entry edited.");
		document.getElementById("code").value="";
		document.getElementById("name").value="";
		check();
	}
	}
	 }
	 var code=document.getElementById("code").value;
	 var name=document.getElementById("name").value;
	 if(name!==gname || code!==gcode){
	document.getElementById("error").innerHTML="";
	xhttp.open("GET", "editdept?code="+code+"&name="+name+"&gcode="+gcode, true);
	 xhttp.send(null);
	 }else{
		 document.getElementById("error").innerHTML="No changes to be saved";
	 }
}
function deletecourse(code){
	if (confirm("Delete the  Entry?") == true) {
    var xhttp = new XMLHttpRequest();
     xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		console.log(xhttp.responseText);
	msg=JSON.parse(xhttp.responseText);
	if(msg.error){
		alert("Something went wrong.");
	}else{
		alert("Entry Deleted successfully.");
		document.getElementById("code").value="";
		document.getElementById("name").value="";
		location.reload();
		check();
	}
	}
	 }
	document.getElementById("error").innerHTML="";
	xhttp.open("GET", "delcourse?code="+code, true);
	 xhttp.send(null);

} else {
    txt = "You pressed Cancel!";
}
}
</script>
