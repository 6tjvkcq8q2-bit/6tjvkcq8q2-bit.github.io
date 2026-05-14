// 图片渐显
document.querySelectorAll("img").forEach(img => {
    if (img.complete) {
        img.classList.add("loaded");
    } else {
        img.onload = () => img.classList.add("loaded");
    }
});

// 导航栏滚动毛玻璃增强
const nav = document.querySelector(".navbar-glass");
if (nav) {
    window.addEventListener("scroll", () => {
        if (window.scrollY > 20) nav.classList.add("scrolled");
        else nav.classList.remove("scrolled");
    });
}

// 列表项进入动画（依次延迟）
const fadeItems = document.querySelectorAll(".fade-up");
fadeItems.forEach((el, i) => {
    el.style.animationDelay = `${i * 0.08}s`;
});
