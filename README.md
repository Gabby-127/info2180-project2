# Dolphin CRM

A customer relationship management (CRM) system built with PHP, MySQL, and AJAX for managing contacts, users, and notes without page refreshes.

## Features

- **User Authentication**: Secure login system with session management
- **User Management**: Create and manage CRM users with role-based access
- **Contact Management**: Create, view, and manage customer contacts
- **Contact Assignment**: Assign contacts to team members
- **Contact Classification**: Switch between Sales Lead and Support contact types
- **Notes System**: Add and view notes for each contact in real-time
- **Responsive Design**: Modern UI with smooth AJAX-based interactions
- **No Page Refreshes**: All content updates dynamically using AJAX

## Technology Stack

- **Backend**: PHP 7.0+
- **Database**: MySQL 5.7+
- **Frontend**: HTML5, CSS3, JavaScript (jQuery)
- **Server**: XAMPP/Apache

## Installation & Setup

### Prerequisites

- XAMPP (or similar Apache/MySQL setup)
- PHP 7.0 or higher
- MySQL database

### Deploy

1. Upload all files to your XAMPP htdocs folder:
   `bash
   c:\xampp\htdocs\dolphin_crm\
   `

### Initialize Database

1. Import schema.sql into your MySQL database:
   - Open phpMyAdmin
   - Create a new database named dolphin_crm
   - Import the schema.sql file

2. Initialize the admin user:
   - Visit http://localhost/dolphin_crm/setup_admin.php
   - You should see: "Admin password set to 'password123'"

## Testing Guide

### 1. Login

- Go to http://localhost/dolphin_crm/index.php
- Login with:
  - **Email**: admin@project2.com
  - **Password**: password123

### 2. Test User Creation

1. Click **Users**  **+ Add User**
2. Enter valid user information:
   - First Name: Jane
   - Last Name: Doe
   - Email: jane@example.com
   - Password: Must contain 1 uppercase, 1 lowercase, 1 number (e.g., Password123)
   - Role: Select a role
3. Click **Save**
4. Verify the new user appears in the users list instantly

### 3. Test Contact Creation

1. Click **New Contact**
2. Fill out the contact form:
   - Title: Mr/Mrs/Ms/Dr
   - First Name: John
   - Last Name: Smith
   - Email: john@example.com
   - Telephone: (optional)
   - Company: Company Name
   - Type: Sales Lead or Support
   - Assigned To: Select a user
3. Click **Save**
4. You should be redirected to the Dashboard and the new contact appears instantly

### 4. Test Contact Interactions

1. Click **View** on any contact
2. Test the following features:
   - **Assign to me**: Click the button and verify the "Assigned To" field updates instantly
   - **Add Note**: 
     - Enter text in the note textarea
     - Click **Add Note**
     - The note should appear at the top of the notes list immediately
     - A success message appears in the bottom-right corner
   - **Switch Type**: 
     - Click the "Switch to [Type]" button
     - The page refreshes with the updated contact type
     - A success message confirms the change

## AJAX Implementation

All page interactions use AJAX for seamless user experience:

- Login form submission via $.ajax()
- User creation with form validation
- Contact creation with instant dashboard update
- Note addition with real-time display
- Contact assignment without page refresh
- Contact type switching with dynamic updates

**No page refreshes occur during normal operation** - all content loads dynamically.

## File Structure

`
dolphin_crm/
 index.php              # Main application entry point
 login.php              # Login handler (AJAX)
 logout.php             # Session termination
 dashboard.php          # Contact list view
 view_contact.php       # Contact detail view
 new_contact.php        # Contact creation form
 add_contact.php        # Contact creation handler
 new_user.php           # User creation form
 add_user.php           # User creation handler
 users.php              # User list view
 add_note.php           # Note creation handler
 list_notes.php         # Notes display
 assign_contact.php     # Contact assignment handler
 switch_type.php        # Contact type switch handler
 db.php                 # Database connection
 schema.sql             # Database schema
 setup_admin.php        # Admin setup script
 css/
    styles.css         # Application styling
 js/
    scripts.js         # AJAX and UI functionality
`

## Database Schema

### Users Table
- id (Primary Key)
- firstname
- lastname
- email (Unique)
- password (hashed)
- role
- created_at

### Contacts Table
- id (Primary Key)
- title
- firstname
- lastname
- email
- telephone
- company
- type (Sales Lead/Support)
- assigned_to (Foreign Key to Users)
- created_by (Foreign Key to Users)
- created_at
- updated_at

### Notes Table
- id (Primary Key)
- contact_id (Foreign Key to Contacts)
- comment
- created_by (Foreign Key to Users)
- created_at

## Configuration

Update database credentials in db.php:

`php
System.Management.Automation.Internal.Host.InternalHost = 'localhost';
 = 'dolphin_crm';
 = 'root'; 
 = ''; 
`

## Security Features

- Password hashing using PHP's password_hash() and password_verify()
- SQL prepared statements to prevent injection
- Session-based authentication
- HTML escaping for XSS protection
- Input validation and sanitization

## Browser Compatibility

- Chrome 60+
- Firefox 55+
- Safari 11+
- Edge 79+

## License

This project is part of INFO 2180 - Web Systems Project 2.

---

**The Dolphin CRM is fully functional and ready for use.**
