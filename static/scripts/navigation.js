let sidebar = document.querySelector(".sidebar")
let closeBtn = document.querySelector("#btn")
//
closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open")
    menuBtnChange()
});

function menuBtnChange() {
    closeBtn.classList.toggle("bx-menu")
    closeBtn.classList.toggle("bx-menu-alt-right")
}

function setActive(navOption) {
    document
        .querySelector(navOption)
        .classList.add("active")
}