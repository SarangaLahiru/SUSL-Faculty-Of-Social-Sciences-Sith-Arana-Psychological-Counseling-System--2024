const testimonials = [
    {
        review: "This platform has been a game-changer for me! I used to struggle with finding the time and courage to seek counselling, but now, with just a few clicks, I can book an appointment that fits my schedule. The counsellors are supportive and understanding, and I've seen a significant improvement in my mental well-being since using the platform.",
    },
    {
        review: "I was hesitant to try counseling at first, but this platform made it so easy and accessible. Being able to filter counselors based on availability and gender preferences helped me find someone I felt comfortable talking to. The feedback mechanism is also great; it shows that they really care about improving the user experience. Overall, I highly recommend this platform to any student in need of support.",
    },
    {
        review: "As an introverted student, I often found it challenging to reach out for help, but this platform changed everything. It's so convenient to book appointments online, and the counsellors are compassionate and non-judgmental. Thanks to this platform, I've been able to overcome some of my biggest hurdles and focus on my academic and personal growth.",
    },
];

let slideIndex = 0;

function renderTestimonials() {
    const sliderContent = document.getElementById("testimonial-content");
    testimonials.forEach((testimonial, index) => {
        const slide = document.createElement("div");
        slide.classList.add("testimonial-slide");
        if (index === 0) slide.classList.add("active");
        slide.innerHTML = `
            <p class="testimonial-text">"${testimonial.review}"</p>
        `;
        sliderContent.appendChild(slide);
    });
}

function showSlide(n) {
    const slides = document.getElementsByClassName("testimonial-slide");
    for (let slide of slides) {
        slide.classList.remove("active");
    }
    slides[n].classList.add("active");
}

function moveSlide(n) {
    slideIndex += n;
    if (slideIndex >= testimonials.length) {
        slideIndex = 0;
    } else if (slideIndex < 0) {
        slideIndex = testimonials.length - 1;
    }
    showSlide(slideIndex);
}

document.addEventListener("DOMContentLoaded", () => {
    renderTestimonials();
    showSlide(slideIndex);
    setInterval(() => {
        moveSlide(1);
    }, 5000);
});
