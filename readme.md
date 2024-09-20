# README for SQL Database Structure

This document describes the SQL database structure for the project `bd-peres`. It outlines the tables, their relationships, and the overall schema design.

## Overview

The `bd-peres` database consists of the following tables:

- **address**
- **announcement**
- **categories**
- **images**
- **users**

### 1. Address Table

This table stores information related to addresses.

| Column        | Type        | Description                             |
|---------------|-------------|-----------------------------------------|
| `id`          | int         | Primary key for the address            |
| `street`      | varchar(50) | Street name                            |
| `number`      | varchar(50) | House or apartment number              |
| `complement`  | varchar(20) | Optional address complement             |
| `status`      | int         | Status of the address (default: 1)    |
| `id_category` | int         | Foreign key referencing `categories`   |

### 2. Announcement Table

This table contains property announcements.

| Column        | Type        | Description                              |
|---------------|-------------|------------------------------------------|
| `id`          | int         | Primary key for the announcement        |
| `user_id`     | int         | Foreign key referencing `users`        |
| `title`       | varchar(30) | Title of the announcement                |
| `description` | varchar(30) | Description of the announcement          |
| `price`       | float       | Price of the property                    |
| `address_id`  | int         | Foreign key referencing `address`       |
| `created_at`  | datetime    | Timestamp of when the announcement was created |
| `updated_at`  | datetime    | Timestamp of the last update             |
| `is_deleted`  | int         | Soft delete indicator                    |
| `deleted_at`  | datetime    | Timestamp of deletion                    |

### 3. Categories Table

This table holds categories for different types of properties.

| Column     | Type        | Description                           |
|------------|-------------|---------------------------------------|
| `id`       | int         | Primary key for the category         |
| `type`     | varchar(255)| Type of the category                 |
| `created_at` | datetime  | Timestamp of category creation       |

### 4. Images Table

This table stores images related to announcements.

| Column        | Type        | Description                             |
|---------------|-------------|-----------------------------------------|
| `id`          | int         | Primary key for the image              |
| `announcement_id` | int    | Foreign key referencing `announcement`  |
| `image`       | blob        | Binary data for the image              |
| `filename`    | varchar(255)| Name of the image file                 |
| `mime_type`   | varchar(50) | MIME type of the image                 |
| `created_at`  | datetime    | Timestamp of image upload               |
| `updated_at`  | datetime    | Timestamp of the last update            |

### 5. Users Table

This table contains user information.

| Column        | Type        | Description                             |
|---------------|-------------|-----------------------------------------|
| `id`          | int         | Primary key for the user               |
| `first_name`  | varchar(20) | User's first name                       |
| `last_name`   | varchar(20) | User's last name                        |
| `mail`        | varchar(50) | User's email address                    |
| `password`    | varchar(255)| User's hashed password                  |
| `created_at`  | datetime    | Timestamp of user creation              |
| `updated_at`  | datetime    | Timestamp of the last update            |
| `is_deleted`  | int         | Soft delete indicator                   |
| `deleted_at`  | datetime    | Timestamp of deletion                   |

## Relationships

- The `address` table is linked to the `categories` table through the `id_category` foreign key.
- The `announcement` table is linked to the `users` and `address` tables through the `user_id` and `address_id` foreign keys, respectively.
- The `images` table is linked to the `announcement` table through the `announcement_id` foreign key.

## Notes

- This schema uses the InnoDB storage engine for better performance and support for foreign keys.
- All tables utilize the `utf8mb4` character set for compatibility with a wide range of characters.
- The SQL statements include primary keys, foreign keys, and auto-increment configurations.

## Usage

To create the database and tables, run the provided SQL script in your MySQL environment.

```sql
-- Copy and paste the SQL code into your MySQL client to execute.
