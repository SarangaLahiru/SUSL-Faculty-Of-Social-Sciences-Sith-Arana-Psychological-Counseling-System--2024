
# 🌟 Sith Arana Psychological Counseling System 🌟

Welcome to the **Sith Arana Psychological Counseling System**! This web-based application is designed to enhance psychological counseling services at the Faculty of Social Sciences, Sabaragamuwa University of Sri Lanka (SUSL). Whether you're a student seeking support, a counselor offering guidance, or an admin overseeing operations, this system has everything you need to manage and streamline counseling services efficiently.

## 🚀 Features

### 🎓 Student View
- **Seamless Booking:** Discover available counselors, browse their profiles, and book counseling sessions with just a few clicks.
- **Manage Appointments:** Keep track of your upcoming and past counseling sessions effortlessly.
- **Provide Feedback:** Share your experience and help us improve our services by submitting feedback.

### 🩺 Counselor View
- **Profile Customization:** Update your profile with details about your specialties, contact information, and availability.
- **Time Slot Management:** Set and adjust your available time slots to accommodate students’ needs.
- **Session Tracking:** View and manage your scheduled counseling sessions.
- **Feedback Insights:** Review feedback from students to enhance your counseling approach.

### 🛠️ Admin View
- **User Oversight:** Manage student and counselor accounts with ease.
- **Counselor Monitoring:** Oversee counselor profiles and time slots to ensure smooth operations.
- **Generate Reports:** Create detailed reports on counseling activities, session statistics, and user feedback.
- **Feedback Management:** Review and address student feedback to continuously improve the counseling experience.

## 🛠️ Technologies Used
- **Backend:** Laravel 7
- **PHP Version:** 7.4
- **Frontend:** Bootstrap

## 🔧 Installation

Ready to get started? Follow these steps to set up the project locally:

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/SarangaLahiru/SUSL-Faculty-Of-Social-Sciences-Sith-Arana-Psychological-Counseling-System--2024.git
   
   ```
2. **Navigate to the Project Directory:**
   ```bash
   cd SUSL-Faculty-Of-Social-Sciences-Sith-Arana-Psychological-Counseling-System--2024
   ```
3. **Install Dependencies:**
   ```bash
   composer install
   ```
4. **Set Up Environment Variables:**
   - Copy `.env.example` to `.env` and configure your database and other settings:
   ```bash
   cp .env.example .env
   ```
5. **Generate the Application Key:**
   ```bash
   php artisan key:generate
   ```
6. **Run Migrations and Seed the Database:**
   ```bash
   php artisan migrate --seed
   ```

## 🕹️ Usage

- **Start the Development Server:**
  ```bash
  php artisan serve
  ```
  Visit `http://localhost:8000` to explore the application.

- **Explore the Views:**
  - **Student View:** Log in as a student to book sessions and manage your appointments.
  - **Counselor View:** Log in as a counselor to update your profile, manage time slots, and view sessions.
  - **Admin View:** Log in as an admin to manage users, oversee counselors, and generate reports.

## 🤝 Contributing

We welcome contributions from the community! To contribute:
1. Fork the repository.
2. Create a new branch for your feature or fix.
3. Commit your changes and push them to your fork.
4. Open a pull request and describe your changes.

## 📜 License

This project is licensed under the [MIT License](LICENSE).



