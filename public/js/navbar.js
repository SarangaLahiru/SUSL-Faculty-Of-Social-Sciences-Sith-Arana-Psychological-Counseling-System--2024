const mobileNav = document.querySelector(".hamburger");
const navbar1 = document.querySelector(".menubar");
console.log ("fsdf")

const toggleNav = () => {
    navbar1.classList.toggle("active");
    mobileNav.classList.toggle("hamburger-active");
    console.log("fsd")
};
mobileNav.addEventListener("click", () => toggleNav());







