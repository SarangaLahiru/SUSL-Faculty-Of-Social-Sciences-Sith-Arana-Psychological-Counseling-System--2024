@extends('layout')

@section('title', 'Sith Arana | Contact us')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    /* General Styling */
    .box {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        font-family: 'Poppins', sans-serif;
        font-size: 18px;
    }

    .calendar-container {
        width: 100%;
        max-width: 1200px;
        background: #ffffff79;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        padding: 20px;
    }

    /* Header Styling */
    .calendar-header {
        background-color: #811786;
        color: #fff;
        padding: 1rem;
        font-weight: 600;
        font-size: 2rem;
        text-align: center;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
    }

    .calendar-header i {
        cursor: pointer;
        color: #fff;
        font-size: 1.2rem;
    }

    .calendar-body {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 10px;
        padding-top: 1rem;
    }

    .day {
        font-weight: 600;
        color: #bebebe;
        text-transform: uppercase;
        text-align: center;
        font-size: 1.2rem;
    }

    .date {
        position: relative;
        height: 80px;
        border-radius: 15px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        background-color: #ffffff;
        cursor: pointer;
        padding: 10px;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .date.highlight {
        background-color: rgba(130, 220, 130, 0.662);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Avatar Stacking in Date Cell */
    .avatar-stack {
        display: flex;
        align-items: center;
        margin-top: 5px;
        position: relative;
    }

    .avatar-stack img.avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 2px solid #fff;
        margin-left: -10px;
        transition: transform 0.3s;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
    }

    .avatar-stack img.avatar:hover {
        transform: scale(1.2);
        z-index: 2;
        box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.2);
    }

    .avatar-stack .more-avatars {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #9c27b0;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        margin-left: -10px;
        border: 2px solid #fff;
        font-weight: 600;
        animation: fadeIn 0.3s ease;
    }

    /* Tooltip Styling */
    .profile-tooltip {
        display: none;
        position: absolute;
        top: -140px;
        left: -80%;
        {{--  transform: translateX(-50%);  --}}
        width: 250px;
        background: #fff;
        border-radius: 15px;
        padding: 10px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        text-align: left;
        font-size: 0.9rem;
        animation: fadeIn 0.3s ease;
        z-index: 10000;
    }

    .date:hover .profile-tooltip {
        display: block;
        z-index: 10000;
    }

    .profile-tooltip .counselor-info {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        font-size: 20px;
    }

    .profile-tooltip .counselor-info img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
        border: 2px solid #6a1b9a;
    }

    .profile-tooltip .name {
        font-weight: 600;
        font-size: 1rem;
        color: #333;
    }

    .profile-tooltip .time {
        color: #9c27b0;
        font-size: 0.85rem;
        margin-top: 3px;
    }

    .date:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }
</style>

<div class="box"   data-aos="fade-up" >
    <div class="calendar-container">
        <div class="calendar-header">
            <i class="bi bi-chevron-left" onclick="changeMonth(-1)"></i>
            <span id="monthYearDisplay">November 2024</span>
            <i class="bi bi-chevron-right" onclick="changeMonth(1)"></i>
        </div>
        <div class="calendar-body">
            <div class="day">Su</div>
            <div class="day">Mo</div>
            <div class="day">Tu</div>
            <div class="day">We</div>
            <div class="day">Th</div>
            <div class="day">Fr</div>
            <div class="day">Sa</div>
        </div>
        <div class="calendar-body" id="datesContainer">
            <!-- Dates will be generated here by JavaScript -->
        </div>
    </div>
</div>

<script>
    const eventsData = @json($eventsData);
    const monthYearDisplay = document.getElementById("monthYearDisplay");
    const datesContainer = document.getElementById("datesContainer");

    let currentDate = new Date();

    function generateCalendar() {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();

        monthYearDisplay.innerText = `${currentDate.toLocaleString("default", { month: "long" })} ${year}`;
        datesContainer.innerHTML = "";

        const firstDayOfMonth = new Date(year, month, 1).getDay();
        const lastDateOfMonth = new Date(year, month + 1, 0).getDate();

        for (let i = 0; i < firstDayOfMonth; i++) {
            const emptyDiv = document.createElement("div");
            datesContainer.appendChild(emptyDiv);
        }

        for (let day = 1; day <= lastDateOfMonth; day++) {
            const dateDiv = document.createElement("div");
            dateDiv.classList.add("date");
            dateDiv.innerHTML = `<span>${day}</span>`;

            // Format the date to 'YYYY-MM-DD'
            const dateKey = `${year}-${(month + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;

            if (eventsData[dateKey]) {
                dateDiv.classList.add("highlight");

                const avatarStack = document.createElement("div");
                avatarStack.classList.add("avatar-stack");

                const tooltipDiv = document.createElement("div");
                tooltipDiv.classList.add("profile-tooltip");

                const maxAvatars = 3;
                eventsData[dateKey].forEach((event, index) => {
                    if (index < maxAvatars) {
                        const avatarImg = document.createElement("img");
                        avatarImg.src = event.avatar;
                        avatarImg.classList.add("avatar");
                        avatarStack.appendChild(avatarImg);
                    } else if (index === maxAvatars) {
                        const moreAvatars = document.createElement("div");
                        moreAvatars.classList.add("more-avatars");
                        moreAvatars.innerText = `+${eventsData[dateKey].length - maxAvatars}`;
                        avatarStack.appendChild(moreAvatars);
                    }

                    const counselorInfo = document.createElement("div");
                    counselorInfo.classList.add("counselor-info");
                    counselorInfo.innerHTML = `
                        <img src="${event.avatar}" alt="${event.name}">
                        <div>
                            <div class="name"><i class="bi bi-user"></i> ${event.name}</div>
                            <div class="time"><i class="bi bi-clock"></i> ${event.time}</div>
                            <div class="time"><i class="bi bi-clock"></i> ${event.status}</div>
                        </div>
                    `;
                    tooltipDiv.appendChild(counselorInfo);
                });

                dateDiv.appendChild(avatarStack);
                dateDiv.appendChild(tooltipDiv);
            }

            datesContainer.appendChild(dateDiv);
        }
    }

    function changeMonth(direction) {
        currentDate.setMonth(currentDate.getMonth() + direction);
        generateCalendar();
    }

    generateCalendar();

</script>

@endsection
