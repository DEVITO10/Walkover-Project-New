window.addEventListener("load",function(){
    document.getElementById("date").textContent = new Date().toLocaleDateString();
    var settime = setInterval(() => {document.getElementById("time").textContent = new Date().toLocaleTimeString();},1000);

    function validateCredentials(){
        let cname = document.getElementById("name").value;
        let cemail = document.getElementById("email").value;
        if(cname.length>4 && cemail.length>9 && (cemail.includes("@gmail.com") || cemail.includes("@yahoo.com") || cemail.includes("@outlook.com")))
        {
            document.getElementById("submit-cred").disabled=false;
            document.getElementById("submit-cred").style.cursor="pointer";
        }
        else
        {
            document.getElementById("submit-cred").disabled=true;
            document.getElementById("submit-cred").style.cursor="no-drop";
        }
    }

    document.getElementById("name").addEventListener("input",validateCredentials);
    document.getElementById("email").addEventListener("input",validateCredentials);
});

const myDivs = ["candidate-credentials","question","instruction","final-result"];

function acceptInstruction(){
    document.getElementById("question").style.display="flex";
    document.getElementById("instruction").style.display="none";
    initialiseTime();
    timer = setInterval(countdown,1000);
}

var timer;
var start, end;
function initialiseTime(){
    var test_details;
    var cookies = document.cookie.split("; ");
    cookies.forEach(element => {
        if(element.includes('testdetails')){
            test_details=(element.split("=")[1]).split("%7C");
        }
    });
    start = new Date();
    end = new Date(start.getTime() + parseInt(test_details[2])*60*1000);
    countdown();
}
function countdown(){
    const curr = new Date();
    var diff = end.getTime() - curr.getTime();
    var hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((diff % (1000 * 60)) / 1000);
    document.getElementById("timer").innerHTML = hours+":"+minutes+":"+seconds;
    if(diff <= 0){
        
        clearInterval(timer);
        document.getElementById("timer").innerHTML = "00:00:00";
        document.getElementById("timer").innerHTML = "00:00:00";
        document.testform.submit();
    }
}