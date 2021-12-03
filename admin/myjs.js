var total_question = 1;
window.addEventListener("load",function(){
    document.getElementById("date").textContent = new Date().toLocaleDateString();
    var settime = setInterval(() => {document.getElementById("time").textContent = new Date().toLocaleTimeString();},1000);
});
function toggleLoginRegister(){
    document.getElementById("admin-login-div").classList.toggle("active");
    document.getElementById("admin-register-div").classList.toggle("active");
}
function add_question(){
    total_question++;
    var put_question = "";
    put_question+= "<div class='question-grid' style='text-align:left;'>";
    put_question+= "<div class='question-grid-1'>"+total_question+"</div>";
    put_question+= "<div class='question-grid-2' w-100>"+"<input type='text' class='w-100' placeholder='Enter question here' name='question"+total_question+"' required>"+"<br>";
    for(var j=1; j<=4 ;j++){
        put_question+="<br><input type='text' placeholder='Enter option here' name='question"+total_question+"-option"+j+"'>";
    }
    put_question+="<br><br><input type='text' placeholder='Enter correct answer' name='question"+total_question+"-answer'>";
    put_question+= "</div></div>";
    document.getElementById("question-set").insertAdjacentHTML("beforeend", put_question);
    document.cookie = "total="+total_question;
    document.getElementById("total_que").innerHTML=total_question;
}
function remove_question(){
    if(total_question > 1){
        var remove = document.getElementById("question-set");
        document.getElementById("question-set").removeChild(remove.lastChild);
        total_question--;
        document.cookie = "total="+total_question;
        document.getElementById("total_que").innerHTML=total_question;
    }
}
function make_assessment(){
    document.cookie = "total="+total_question;
}