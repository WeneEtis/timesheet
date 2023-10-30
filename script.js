const navtab=document.getElementById("nav-tab");

navtab.addEventListener('click',tabclick);

function tabclick(event){
  //Get all The active Tabs
  const activeTabs=document.querySelectorAll('.active');

  activeTabs.forEach((tab)=>{
    tab.classList.remove('active');
  });
  
  const pages=document.querySelectorAll('.page');

  pages.forEach((page)=>{
    page.classList.remove('page-active');
  });

 //event.target.parentElement.classList.add('active');
 event.target.parentElement.className+='active';


 let id=event.target.href.split("#")[1];
 const page=document.getElementById(id);
 page.classList.add('page-active');
}

let timeDiff = 9; // One more to also output 16:00
let minutesToAdd = 60;
let currentDate = new Date("2023-09-10 09:00:00");
let currentDate1 = new Date("2023-08-11 10:00:00");


function fromTime(){
 
  for (let i = 0; i < 9; i++) {    
   
    let res = document.getElementsByName('from_time[]')[i].value = formatAMPM(currentDate);
    currentDate.setMinutes(currentDate.getMinutes() + minutesToAdd);
    //console.log(res);
    toTime();
  }

};

function toTime(){
 
  for (let j= 0; j < 9; j++) {    
   
    let res1  = document.getElementsByName('to_time[]')[j].value = formatAMPM(currentDate1);
    currentDate1.setMinutes(currentDate1.getMinutes() + minutesToAdd);
   // console.log(res1);
   describe();

  }

};

function describe(){
 
  for (let j= 0; j < 9; j++) {    
   
    document.getElementsByName('description[]')[j].value;
   // currentDate1.setMinutes(currentDate1.getMinutes() + minutesToAdd);
   // console.log(res1);

  }

};


function formatAMPM(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = "";

  if(hours <12){
    ampm = "AM";
  }else{
    ampm = "PM";
  }

  if(hours == 0){
    hours = 12;
  }
  /*if(hours > 12){
    hours = hours - 12;
  } change to 12 hrs*/

  hours=hours.toString().length==1? 0+hours.toString() : hours;

  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime;
}

/*var items = 0;
    function addItem() {
        items++;
 
        var html = "<tr>";
            html += "<td>" + items + "</td>";
            html += "<td><input type='text' name='from_time[]'></td>";
            html += "<td><input type='text' name='to_time[]'></td>";
            html += "<td><input type='text' name='description[]'></td>";
        html += "</tr>";
 
        var row = document.getElementById("tbody").insertRow();
        row.innerHTML = html;
    }

function myFunction() {
  var from_time = document.sample.from_time.value;
  var to_time = document.sample.to_time.value;
  var description = document.sample.description.value;
  var tr = document.createElement('tr');

  var td1 = tr.appendChild(document.createElement('td'));
  var td2 = tr.appendChild(document.createElement('td'));
  var td3 = tr.appendChild(document.createElement('td'));

  td1.innerHTML='<input type="hidden" name="from_time[]" value="'+from_time+'"+from_time';
  td2.innerHTML='<input type="hidden" name="to_time[]" value="'+to_time+'"+to_time';
  td3.innerHTML='<input type="hidden" name="description[]" value="'+description+'"+description';

  document.getElementById("tb1").appendChild(tr);

}

function save_data(){
  var form_element = document.getElementsByClassName('form_data');
  var form_data = new FormData();
  for(var count = 0; count < form_element.length; count++){
    form_data.append(form_element[count].name, form_element[count].value);
  }
  document.getElementById('submit').disabled = true;

  var ajax_request = new XMLHttpRequest();
  ajax_request.open('POST', 'process_data.php');
  ajax_request.send(form_data);

  ajax_request.onreadystatechange = function(){
    if(ajax_request.readyState == 4 && ajax_request.status == 200){
      document.getElementById('submit').disabled = false;
      document.getElementById('someform').reset();
      document.getElementById('message').innerHTML = ajax_request.responseText;

      setTimeout(function(){
        document.getElementById('message').innerHTML = '';
      }, 2000);
    }
  }
}*/