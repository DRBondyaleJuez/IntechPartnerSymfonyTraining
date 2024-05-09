//import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
//import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

// Elements in the view with js interaction

// Buttons
let registerButton = document.querySelector('.registration-section__register-button');

//Inputs
let formInputList = document.querySelectorAll('.form-section__input');

//Checkboxes
let gdprCheckbox = document.querySelector('.check-conditions-section__checkbox');

//Error Messages
let formErrorMessageSection = document.querySelector('.form-error-message-section__error-message');
let registrationErrorMessageSection = document.querySelector('.registration-section__error-message');

//Events
registerButton.addEventListener("click",function () {
    registerButtonClicked()}
);


//Functions
function registerButtonClicked(){

    let userInfoValidityState = validateFormInformation();
    console.log('User InfoValidity: ' + userInfoValidityState + '###############');

    if(!validateFormInformation()){
        displayFormErrorMessage();
    }else if (!gdprCheckbox.checked){
        displayUncheckedGDPRErrorMessage();
    } else {
        sendRegisteredUserInformation();
    }
}

//Validate Form Information
function validateFormInformation() {

    const mandatoryInputIndexes = [0,1,5];

    for(let i=0; i<mandatoryInputIndexes.length; i++){
        if(!formInputList[mandatoryInputIndexes[i]].value){
        return false;
        }
    }
    return true;
}

function displayFormErrorMessage() {
    formErrorMessageSection.innerHTML = 'Registration Information with an * are mandatory. <br /> PLEASE FILL UP ALL SECTIONS WITH AN *';
}

function displayUncheckedGDPRErrorMessage(){
    formErrorMessageSection.innerHTML = 'Please agree with the GDPR terms and conditions by checking the checkbox above';
}

//Send User Information
function sendRegisteredUserInformation(){
    let userInfoDetails = buildUserInfoBody();

    fetch("http://localhost:8000/userRegistration",{
    method: "POST",
    body: JSON.stringify(userInfoDetails),
    headers: {
      "Content-type": "application/json; charset=UTF-8"
    }

    });




}

function buildUserInfoBody(){
const userInfoDetailKeys = ['username','password','firstName','lastName','telephone','email'];

let newUserInfoDetails = {};
let formInputList = document.querySelectorAll('.form-section__input');

for(let i=0; i<userInfoDetailKeys.length; i++){
    newUserInfoDetails[userInfoDetailKeys[i]] = formInputList[i].value;
}

return newUserInfoDetails;
}