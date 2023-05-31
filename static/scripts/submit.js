const userDataForm = document.querySelector("#user-data")

userDataForm.addEventListener("submit", (e) => {
    e.preventDefault()
    console.log(userData.isValid())
    if (userData.isValid())
        e.target.submit()
    else
        //TODO: alert
        return;
})