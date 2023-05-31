const xRadioList = document.querySelectorAll("input[type=radio][name=x]")
const yInput = document.querySelector("input[type=text][name=y]")
const radiusButtons = document.querySelectorAll("input[type=button][name=r]")
const radiusValue = document.querySelector("input[type=hidden][name=radius]")

xRadioList.forEach((radio) => {
    radio.addEventListener("click", (e) => {
        userData.x = e.target.value
        if (userData.isXValid()) {
            document.querySelector(".x-group")
                .classList.add("valid");
            document.querySelector(".x-group")
                .classList.remove("invalid");
        }
        else {
            document.querySelector(".x-group")
                .classList.add("invalid");
            document.querySelector(".x-group")
                .classList.remove("valid");
        }
        console.log(userData)
    })
})

yInput.addEventListener("focus", (e) => {
    document.querySelector(".y-group")
        .classList.remove("valid", "invalid")
})
yInput.addEventListener("change", (e) => {
    userData.y = e.target.value
    if (userData.isYValid()) {
        document.querySelector(".y-group")
            .classList.add("valid");
        document.querySelector(".y-group")
            .classList.remove("invalid");
    } else {
        document.querySelector(".y-group")
            .classList.add("invalid");
        document.querySelector(".y-group")
            .classList.remove("valid");
    }
    console.log(userData)
})

radiusButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
        radiusButtons.forEach((__radius) => {
            __radius.classList.remove("current-radius")
        })
        button.classList.toggle("current-radius")
        userData.radius = e.target.value
        radiusValue.setAttribute("value", e.target.value)
        if (userData.isRadiusValid()) {
            document.querySelector(".radius-group")
                .classList.add("valid");
            document.querySelector(".radius-group")
                .classList.remove("invalid");
        } else {
            document.querySelector(".radius-group")
                .classList.add("invalid");
            document.querySelector(".radius-group")
                .classList.remove("valid");
        }

        console.log(userData)
    })
})