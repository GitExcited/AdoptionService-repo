// Date and Time

 
const pTime = document.querySelector('#time');

function updateDate(){
    const today = new Date();
    const date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    const time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    const dateTime = date+' '+time;
    pTime.innerText=dateTime;
}
setInterval(updateDate, 1000);

//Client Validation of forms

    //Form find a dog or a  cat


const radioAnimal =document.querySelectorAll("input[name=animal]");
const breedInput = document.querySelector("input[name=breed]");
const radioGender = document.querySelectorAll("input[name=gender]");
const checkboxMatter = document.querySelectorAll("input[type=checkbox]");
 

function verifyFind(){
    if(radioAnimal[0].checked ==false && radioAnimal[1].checked==false){
        window.alert('please select your animal type');
        return;
    }
    else if (breedInput.value=='' && checkboxMatter[0].checked==false){
        window.alert('Please input a breed type');
        return;
    }
    else if(radioGender[0].checked ==false && radioGender[1].checked==false && checkboxMatter[2].checked==false){
        window.alert('please select animal gender');
        return;
    }
    validateForm();
}

const comments = document.querySelector("#comments");
const firstName = document.querySelector("#firstname");
const lastname = document.querySelector("#lastname");
const email = document.querySelector("#owneremail");

    //Form pet to give away
function verifyGiveaway(){
    
    if(radioAnimal[0].checked ==false && radioAnimal[1].checked==false){
        window.alert('please select your animal type');
        return false;
    }
    if (breedInput.value=='' && checkboxMatter[0].checked==false){
        window.alert('Please input a breed type');
        return false;
    }
     if(radioGender[0].checked ==false && radioGender[1].checked==false && checkboxMatter[2].checked==false){
        window.alert('please select animal gender');
        return false;
    }
     if(comments.value ==""){
        window.alert("Please provide a longer animal description ");
        return false;
    }
   
     if(firstName.value==""){
        window.alert("Please provide owner first name");
        return false;
    }
     if(lastname.value==""){
        window.alert("Please provide owner last name");
        return false;
    }
     if(!validateEmail(email.value)){
        window.alert("Please provide a correct email");
        return false;
    }
    validateForm();
    return true;
    
}
function validateForm() {
    const validatedField = document.querySelector('input[name="validated"]');
    validatedField.value = "true";
}
function validateEmail(email) {
   return /\S+@\S+\.\S+/.test(email);
}

function logoutFunction (){
    alert("YOU ARE NOW LOGED OUT! ");
    document.getElementById("logoutForm").submit();
}

