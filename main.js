// Navbar
const menu = document.getElementById("menu");
const close = document.getElementById("close");
const navbar = document.getElementById("navbar");

menu.addEventListener("click", () => {
    menu.classList.add("hidden");
    menu.classList.remove("block");

    close.classList.add("block");
    close.classList.remove("hidden");

    navbar.classList.add("open");
})
close.addEventListener("click", () => {
    close.classList.add("hidden");
    close.classList.remove("block");

    menu.classList.add("block");
    menu.classList.remove("hidden");

    navbar.classList.remove("open");
})

// lan-bar

// const lanMenu = document.getElementById("lan");
// const lanBar = document.getElementById("lan-bar");

// lanMenu.addEventListener("click",()=>{
//     lanBar.classList.toggle('open');
// })

// Question/Sign Animation

if (document.getElementById("indicator")) {
    const indicator = document.getElementById("indicator");

    const queBtn = document.getElementById("queBtn");
    const sinBtn = document.getElementById("sinBtn");

    const que = document.getElementById("questions");
    const sin = document.getElementById("sign");

    queBtn.addEventListener("click", () => {
        que.style.display = "block";
        sin.style.display = "none";

        indicator.classList.add("left-0");
        indicator.classList.remove("left-[50%]");

        sinBtn.classList.remove("border-x");
        sinBtn.classList.add("border-b");
        queBtn.classList.add("border-x");
        queBtn.classList.remove("border-b");
    });

    sinBtn.addEventListener("click", () => {
        sin.style.display = "block";
        que.style.display = "none";

        indicator.classList.remove("left-0");
        indicator.classList.add("left-[50%]");

        queBtn.classList.remove("border-x");
        queBtn.classList.add("border-b");
        sinBtn.classList.add("border-x");
        sinBtn.classList.remove("border-b");
    });

}

// scroll

document.getElementById("scroll-top").addEventListener("click", () => {
    window.scrollTo({
        top: 0,
        behavior: "smooth" // Optional: smooth scrolling animation
    });
})

function handleScroll() {
    if (window.scrollY > 200) {
        document.getElementById("scroll-top").classList.remove("opacity-0");
    } else {
        document.getElementById("scroll-top").classList.add("opacity-0");
    }
}
// Attach the event listener to the window object
window.addEventListener("scroll", handleScroll);

// settings
// Buttons sidebar

const formBtns = document.querySelectorAll(".formBtns");
const mainForm = document.querySelectorAll(".mainFormClass");

formBtns.forEach((b, index) => {
    b.addEventListener('click', () => {
        // First, remove the class from all elements
        formBtns.forEach((btn) => {
            btn.classList.remove('settingBtnSelected');
        });
        mainForm.forEach((m) => {
            m.classList.remove("flex");
            m.classList.add("hidden");
        })
        b.classList.add('settingBtnSelected');
        mainForm[index].classList.add("flex");
        mainForm[index].classList.remove("hidden");
    })
})


// Device Width Change

const formsClass = document.querySelectorAll(".formsClass");

function handleResize() {
    if (window.innerWidth < 1024) {
        formsClass.forEach((f) => {
            f.nextElementSibling.classList.add("closed");
            f.firstElementChild.classList.remove("hidden");
        })
        mainForm.forEach((m) => {
            m.classList.remove("hidden");
            m.classList.add("flex");
        })
    } else {
        formsClass.forEach((f) => {
            f.firstElementChild.classList.add("hidden");
            f.nextElementSibling.classList.remove("closed");
        })
        mainForm.forEach((m) => {
            m.classList.add("hidden");
            m.classList.remove("flex");
        })
        formBtns.forEach((b, index) => {
            if (b.classList.contains("settingBtnSelected")) {
                mainForm[index].classList.add("flex");
                mainForm[index].classList.remove("hidden");
            }
        })
    }
}
handleResize();
window.addEventListener("resize", handleResize);

formsClass.forEach((f) => {
    f.addEventListener("click", () => {
        f.nextElementSibling.classList.toggle("animate");
    })
})


// setting form

const forms = document.querySelectorAll(".forms");

forms.forEach((f) => {
    f.addEventListener("click", (e) => {
        e.target.nextElementSibling.classList.toggle("animate");
        e.target.firstChild.nextElementSibling.classList.toggle("rotate-0");
        e.target.firstChild.nextElementSibling.classList.toggle("rotate-90");
    })
})