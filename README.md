# HR Harassment Report System

A secure system for reporting harassment incidents with email notifications to HR.

## Setup Instructions

1. Install requirements:
   - PHP 7.4 or higher
   - MySQL 5.7 or higher
   - Web server (Apache/Nginx)

2. Database setup:
   - Create MySQL database using `database.sql`
   - Update database credentials in `config/Database.php`

3. Configuration:
   - Update email settings in `submit_report.php`
   - Configure your web server to serve the application

## File Structure

```
├── config/
│   └── Database.php
├── models/
│   └── Report.php
├── index.html
├── submit_report.php
├── database.sql
└── README.md
```

## Security Notes

- Update database credentials before deployment
- Configure proper email settings
- Implement additional security measures in production