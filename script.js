function setDateAndTime() {
    setInterval(setDateAndTime, 1000);
    document.getElementsByClassName('date-time').item(0).innerHTML = "<b><p>" + getDateAndTime() + "</p></b>";
}

function validateGiveawayForm() {
    const form = document.forms[0];
    if(!form) return false;
    let validated;
    // Validate the values from the find form
    validated = validateFindForm();
    // Validate age
    if(form.petAge.value === '' || form.petAge.value.search(/\D+/) !== -1) {
        validated = false;
        form.petAge.classList.add('error');
        form.petAge.focus();
        form.petAge.select();
        alert('Please enter a valid age (enter only an integer value).');
    }

    // Validate owner information
    if(form.ownerName.value.search(/^[A-Za-z]+\s[A-Za-z]+/) === -1) {
        validated = false;
        form.ownerName.classList.add('error');
        alert('Please enter a valid full name (may only contain characters and must include both first name & last name).');
        form.ownerName.focus();
        form.ownerName.select();
    }
    else {
        form.ownerName.classList.remove('error');
    }
    if(form.email.value.search(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/) === -1) {
        validated = false;
        form.email.classList.add('error');
        alert('Please enter a valid email address.\nValid emails look like this:\n  \'example@domain.ext\'');
        form.email.focus();
        form.email.select();
    }
    else {
        form.email.classList.remove('error');
    }
    return validated;
}
function validateRegisterForm() {
    // Get the form fields
    var username = document.forms[0]['username'].value;
    var password = document.forms[0]['password'].value;
    var confirm_password = document.forms[0]['confirm_password'].value;

    // Check if all fields are filled
    if (username == '' || password == '' || confirm_password == '') {
    alert("All fields are required.");
    return false;
    }

    // Regular expression for username: only digits and letters, no special chars
    var username_regex = /^[a-zA-Z0-9]+$/;

    // Regular expression for password: only digits and letters, minimum length of 4
    var password_regex = /^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z0-9]{4,}$/;

    // Check if the passwords match
    if (password != confirm_password) {
    alert("Passwords do not match.");
    return false;
    }

    // Check if the username is valid
    if (!username_regex.test(username)) {
    alert("Username must contain only letters and digits (no special chars).");
    return false;
    }

    // Check if the password is valid
    if (!password_regex.test(password)) {
    alert("Password must contain only letters and digits, have at least 1 digit and 1 letter, and be at least 4 characters long.");
    return false;
    }

    // If all checks pass, return true to submit the form
    return true;
    }
function validateFindForm() {
    const form = document.forms[0];
    if(!form) return false;
    let validated = true;

    // Validate a petType was chosen
    if(form.petType.value === '') {
        form.petType.forEach(element => {
            element.parentElement.classList.add('error');
        })
        alert("Please select either a dog or a cat.");
        validated = false;
    } else {
        form.petType.forEach(element => {
            element.parentElement.classList.remove('error');
        })
    }

    // Validate breed
    if(form.breeds.value === '') {
        form.breeds.classList.add('error');
        alert("Please select a breed from the breed menu.");
        validated = false;
    } else {
        form.breeds.classList.remove('error');
    }

    // Validate gender
    if(form.gender.value === '') {
        form.gender.forEach(element => {
            element.parentElement.classList.add('error');
        })
        alert("Please select one of the options for gender");
        validated = false;
    } else {
        form.gender.forEach(element => {
            element.parentElement.classList.remove('error');
        })
    }
    return validated;
}

function getDateAndTime() {
    const date = new Date();
    const day = date.getDay();
    const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const month = date.getMonth();
    const year = date.getFullYear();
    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    const hours = date.getHours().toLocaleString('en-US', {
        minimumIntegerDigits: 2,
        useGrouping: false
    });
    const mins = date.getMinutes().toLocaleString('en-US', {
        minimumIntegerDigits: 2,
        useGrouping: false
    });
    const secs = date.getSeconds().toLocaleString('en-US', {
        minimumIntegerDigits: 2,
        useGrouping: false
    });
    return `${days[day]}, ${months[month]} ${date.getDate()}, ${year}<br>${hours}:${mins}:${secs}`;
}

function privacyAlert() {
    alert("PRIVACY POLICY (as of February 2023):\n\nYour information is your own. PAWS does not sell or otherwise misuse the information provided to us by our users. It is exclusively used to help current and future pet owners find themselves the perfect pet.\n\nAdditionally, PAWS is not responsible for any misleading or otherwise incorrect information posted by other users.");   
}
function goBack() {
    window.history.back();
}
function toHome() {
    window.location.href = "./";
}

function goTo(link) {
    window.location.href = link;
}

function validateLoginForm() {
    // Get the username and password input fields
    var username = document.forms[0]["username"].value;
    var password = document.forms[0]["password"].value;

    // Create a regular expression to match alphanumeric characters only
    var alphanumeric = /^[a-zA-Z0-9]+$/;

    // Validate the username
    if (!alphanumeric.test(username)) {
        alert("Username must contain only alphanumeric characters");
        return false;
    }

    // Validate the password
    if (password.length < 4 || !alphanumeric.test(password)) {
        alert("Password must be at least 4 characters and contain only alphanumeric characters");
        return false;
    }
}

function setupForm() {
    const defaultOption = document.querySelector('#placeholderBreeds');
    document.getElementById('cat').addEventListener('click', function(){
        document.querySelectorAll('.dog-breed').forEach(option => {
            option.hidden = true;
        });
        document.querySelectorAll('.cat-breed').forEach(option => {
            option.hidden = false;
        });
        defaultOption.selected = false;
        defaultOption.hidden = true;
        const placeholderDogs = document.querySelector('#placeholderDogBreeds');
        const placeholderCats = document.querySelector('#placeholderCatBreeds');
        if(placeholderDogs) placeholderDogs.selected = false;
        if(placeholderCats) placeholderCats.selected = true;
    });

    document.getElementById('dog').addEventListener('click', function(){
        document.querySelectorAll('.cat-breed').forEach(option => {
            option.hidden = true;
        });
        document.querySelectorAll('.dog-breed').forEach(option => {
            option.hidden = false;
        });
        defaultOption.selected = false;
        defaultOption.hidden = true;
        document.querySelector('#placeholderBreeds').selected = false;
        const placeholderDogs = document.querySelector('#placeholderDogBreeds');
        const placeholderCats = document.querySelector('#placeholderCatBreeds');
        if(placeholderDogs) placeholderDogs.selected = true;
        if(placeholderCats) placeholderCats.selected = false;
    });
}
