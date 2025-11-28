# Tracklet API Documentation

**Base URL:** `https://yourdomain.com/api`  
**Version:** 1.0  
**Authentication:** Session-based (web) or Bearer Token (mobile)

---

## Table of Contents

1. [Authentication](#authentication)
2. [Response Format](#response-format)
3. [Error Handling](#error-handling)
4. [Public Endpoints](#public-endpoints)
5. [Authenticated Endpoints](#authenticated-endpoints)
6. [Super Admin Endpoints](#super-admin-endpoints)
7. [Models & Data Structures](#models--data-structures)

---

## Authentication

### Session Authentication (Web)
For web requests, use Laravel session cookies. Include cookies in requests.

### Bearer Token Authentication (Mobile)
For mobile apps, use Laravel Sanctum token-based authentication. Include the Bearer token in the Authorization header:

```
Authorization: Bearer {your_token_here}
```

**Getting a Token:**
1. Register a new organization or login using the `/api/register` or `/api/login` endpoints
2. The response will include a `token` field
3. Use this token in subsequent API requests

**Token Management:**
- Tokens are created when you login or register via API
- Tokens are revoked when you logout via `/api/logout`
- Tokens do not expire by default (can be configured in `config/sanctum.php`)

---

## Response Format

### Success Response
```json
{
  "success": true,
  "data": {
    // Response data
  },
  "message": "Optional success message"
}
```

### Error Response
```json
{
  "success": false,
  "message": "Error message",
  "errors": {
    "field_name": ["Validation error message"]
  }
}
```

### HTTP Status Codes
- `200` - Success
- `201` - Created
- `400` - Bad Request
- `401` - Unauthorized
- `403` - Forbidden
- `404` - Not Found
- `422` - Validation Error
- `500` - Server Error

---

## Error Handling

All errors follow the standard error response format. Common error scenarios:

- **401 Unauthorized:** Missing or invalid authentication
- **403 Forbidden:** User doesn't have required permissions
- **404 Not Found:** Resource doesn't exist
- **422 Validation Error:** Request validation failed
- **402 Payment Required:** Subscription required (for subscription-protected routes)

---

## Public Endpoints

### 1. Register (Mobile/API)

Register a new organization and create the admin account. Returns a Bearer token for API authentication.

**Endpoint:** `POST /api/register`

**Request Body:**
```json
{
  "organization_name": "Acme Corporation",
  "organization_slug": "acme-corp",
  "name": "John Doe",
  "email": "john@acme.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

**Response (201 Created):**
```json
{
  "success": true,
  "message": "Organization registered successfully! Please complete your subscription.",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@acme.com",
      "organization_id": 1,
      "roles": [...]
    },
    "token": "1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
    "token_type": "Bearer",
    "must_change_password": false,
    "redirect": "https://yourdomain.com/subscription/checkout"
  }
}
```

---

### 2. Login (Mobile/API)

Login and receive a Bearer token for API authentication.

**Endpoint:** `POST /api/login`

**Request Body:**
```json
{
  "email": "john@acme.com",
  "password": "password123",
  "remember": false
}
```

**Response (200 OK):**
```json
{
  "success": true,
  "message": "Login successful",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@acme.com",
      "organization_id": 1,
      "roles": [...]
    },
    "token": "2|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
    "token_type": "Bearer",
    "must_change_password": false
  }
}
```

**If Password Change Required (403 Forbidden):**
```json
{
  "success": false,
  "message": "You must change your password before continuing.",
  "must_change_password": true,
  "redirect": "https://yourdomain.com/password/change"
}
```

---

### 3. Register Organization (Web)

Register a new organization and create the admin account.

**Endpoint:** `POST /api/register-organization`

**Request Body:**
```json
{
  "organization_name": "Acme Corporation",
  "name": "John Doe",
  "email": "john@acme.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

**Response (200):**
```json
{
  "success": true,
  "data": {
    "message": "Organization registered successfully! Please complete your subscription.",
    "redirect": "/subscription/checkout"
  }
}
```

**Validation Rules:**
- `organization_name`: required, string, max:255
- `name`: required, string, max:255
- `email`: required, email, unique (users and organizations)
- `password`: required, string, min:8, confirmed

**Notes:**
- Organization slug is automatically generated from organization name
- First account created becomes the organization admin
- User is automatically logged in after registration
- Organization is created with `registration_source: "self_registered"`
- User must complete subscription to access platform
- Subscription includes 1-month free trial

---

### 2. Get Invitation Details

Get invitation information by token.

**Endpoint:** `GET /api/invitation/{token}`

**Response (200):**
```json
{
  "success": true,
  "data": {
    "invitation": {
      "id": 1,
      "organization_id": 1,
      "email": "admin@example.com",
      "token": "abc123...",
      "expires_at": "2025-12-05T10:00:00.000000Z",
      "accepted_at": null,
      "created_at": "2025-11-28T10:00:00.000000Z",
      "organization": {
        "id": 1,
        "name": "Example Corp",
        "slug": "example-corp"
      }
    }
  }
}
```

**Error Responses:**
- `404` - Invitation not found
- `410` - Invitation expired
- `400` - Invitation already accepted

---

### 3. Accept Invitation

Accept an organization invitation and create user account.

**Endpoint:** `POST /api/invitation/{token}/accept`

**Request Body:**
```json
{
  "name": "John Doe",
  "email": "admin@example.com",  // Must match invitation email exactly
  "password": "password123",
  "password_confirmation": "password123"
}
```

**Response (200):**
```json
{
  "success": true,
  "data": {
    "message": "Invitation accepted successfully. Please complete your subscription.",
    "redirect": "/subscription/checkout"
  }
}
```

**Validation Rules:**
- `name`: required, string, max:255
- `email`: required, email, must match invitation email exactly
- `password`: required, string, min:8, confirmed

**Notes:**
- Email must match the invitation email exactly (case-sensitive)
- First account created becomes the organization admin
- User is automatically logged in after acceptance
- User must complete subscription to access platform

**Error Responses:**
- `404` - Invitation not found
- `410` - Invitation expired
- `400` - Invitation already accepted
- `422` - Email doesn't match invitation email

---

## Authenticated Endpoints

All authenticated endpoints require valid authentication. Include session cookie or Bearer token.

### 4. Get Current User

Get authenticated user information.

**Endpoint:** `GET /api/user`

**Response (200):**
```json
{
  "success": true,
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "organization_id": 1,
      "email_verified_at": "2025-11-28T10:00:00.000000Z",
      "created_at": "2025-11-28T10:00:00.000000Z",
      "organization": {
        "id": 1,
        "name": "Example Corp",
        "slug": "example-corp",
        "is_subscribed": true,
        "trial_ends_at": "2025-12-28T10:00:00.000000Z"
      },
      "roles": [...]
    },
    "must_change_password": false
  }
}
```

---

### 5. Logout

Logout and revoke the current Bearer token (for API) or destroy session (for web).

**Endpoint:** `POST /api/logout`

**Response (200):**
```json
{
  "success": true,
  "message": "Logged out successfully"
}
```

**Notes:**
- For API requests, this revokes the current Bearer token
- For web requests, this destroys the session
- After logout, you'll need to login again to access protected endpoints

---

### 6. Change Password

Change password for users who are required to change their password on first login.

**Endpoint:** `POST /api/change-password`

**Request Body:**
```json
{
  "current_password": "temporary_password",
  "new_password": "new_secure_password",
  "new_password_confirmation": "new_secure_password"
}
```

**Response (200):**
```json
{
  "success": true,
  "message": "Password changed successfully.",
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "must_change_password": false,
      ...
    }
  }
}
```

**Validation Rules:**
- `current_password`: required, string
- `new_password`: required, string, min:8, confirmed

**Error Responses:**
- `422` - Validation error or current password is incorrect
- `403` - User is not required to change password (but endpoint is still accessible)

**Notes:**
- This endpoint is accessible even if `must_change_password` is false
- After changing password, `must_change_password` is set to `false`
- Users with `must_change_password: true` are redirected to this endpoint on login

---

### 7. Get Dashboard Data

Get dashboard information including trial status.

**Endpoint:** `GET /api/dashboard`

**Response (200):**
```json
{
  "success": true,
  "data": {
    "trial_info": {
      "is_on_trial": true,
      "trial_days_remaining": 15,
      "trial_ends_at": "2025-12-28T10:00:00.000000Z"
    }
  }
}
```

**Notes:**
- `trial_info` is `null` if organization is not on trial
- `trial_days_remaining` is `null` if not on trial

---

### 8. Get Profile

Get user profile information.

**Endpoint:** `GET /api/profile`

**Response (200):**
```json
{
  "success": true,
  "data": {
    // Profile data
  }
}
```

---

### 9. Update Password (Profile)

Update user password.

**Endpoint:** `PUT /api/profile/password`

**Request Body:**
```json
{
  "old-password": "oldpassword123",
  "new-password": "newpassword123",
  "new-password_confirmation": "newpassword123"
}
```

**Response (200):**
```json
{
  "success": true,
  "data": {
    "message": "Password updated successfully"
  }
}
```

**Validation Rules:**
- `old-password`: required, min:8, must match current password
- `new-password`: required, min:8, confirmed, different from old password
- `new-password_confirmation`: required

---

### 8. Get Subscription Checkout

Get subscription checkout information.

**Endpoint:** `GET /api/subscription/checkout`

**Response (200):**
```json
{
  "success": true,
  "data": {
    "organization": {
      "id": 1,
      "name": "Example Corp",
      "is_subscribed": false
    }
  }
}
```

**Error Responses:**
- `403` - User doesn't belong to an organization
- `200` with redirect - Already subscribed

---

### 9. Create Checkout Session

Create Stripe checkout session for subscription.

**Endpoint:** `POST /api/subscription/checkout`

**Request Body:**
```json
{
  "price_id": "price_xxxxx"  // Optional, uses default from config
}
```

**Response (200):**
```json
{
  "success": true,
  "data": {
    "checkout_url": "https://checkout.stripe.com/pay/...",
    "session_id": "cs_test_..."
  }
}
```

**Notes:**
- Redirect user to `checkout_url` to complete payment
- **Subscription includes 1-month (30-day) free trial**
- Full access granted immediately during trial period
- No charges during trial period
- After trial ends, annual subscription begins automatically
- Payment method required at signup but not charged until trial ends

**Error Responses:**
- `403` - User doesn't belong to an organization
- `500` - Failed to create checkout session

---

### 10. Subscription Success

Handle successful subscription (callback from Stripe).

**Endpoint:** `GET /api/subscription/success?session_id={session_id}`

**Query Parameters:**
- `session_id`: Stripe checkout session ID

**Response (200):**
```json
{
  "success": true,
  "data": {
    "message": "Your subscription is active! You're now on a 1-month free trial. Enjoy full access to Tracklet!",
    "redirect": "/",
    "organization": {
      "id": 1,
      "name": "Example Corp",
      "is_subscribed": true,
      "trial_ends_at": "2025-12-28T10:00:00.000000Z"
    },
    "is_trial": true
  }
}
```

---

## Super Admin Endpoints

All super admin endpoints require `super_admin` role.

### 11. List Organizations

Get list of all organizations.

**Endpoint:** `GET /api/super-admin/organizations`

**Response (200):**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Example Corp",
      "email": "admin@example.com",
      "admin": {
        "name": "John Doe",
        "email": "admin@example.com"
      },
      "is_active": true,
      "is_subscribed": true,
      "registration_source": "invited",
      "invitation_status": "joined",
      "invitation_sent_at": "2025-11-28T10:00:00.000000Z",
      "invitation_accepted_at": "2025-11-28T11:00:00.000000Z",
      "created_at": "2025-11-28T10:00:00.000000Z"
    }
  ]
}
```

**Invitation Status Values:**
- `none` - No invitation sent
- `pending` - Invitation sent, not accepted
- `joined` - Invitation accepted
- `expired` - Invitation expired

**Registration Source Values:**
- `invited` - Invited by super admin
- `self_registered` - Self-registered

---

### 12. Get Organization

Get single organization details.

**Endpoint:** `GET /api/super-admin/organizations/{id}`

**Response (200):**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Example Corp",
    "slug": "example-corp",
    "email": "admin@example.com",
    "is_subscribed": true,
    "trial_ends_at": "2025-12-28T10:00:00.000000Z",
    "subscription_ends_at": "2026-11-28T10:00:00.000000Z",
    "registration_source": "invited",
    "created_at": "2025-11-28T10:00:00.000000Z"
  }
}
```

---

### 13. Create Organization (Invite)

Create organization and send invitation email.

**Endpoint:** `POST /api/super-admin/organizations`

**Request Body:**
```json
{
  "name": "New Company",
  "email": "admin@newcompany.com"
}
```

**Response (201):**
```json
{
  "success": true,
  "data": {
    "message": "Organization invited successfully!",
    "organization": {
      "id": 2,
      "name": "New Company",
      "slug": "new-company",
      "email": "admin@newcompany.com"
    }
  }
}
```

**Validation Rules:**
- `name`: required, string, max:255
- `email`: required, email, unique in organization_invitations

**Notes:**
- Organization slug is automatically generated from organization name
- Creates organization with `registration_source: "invited"`
- Sends invitation email to provided email
- Invitation expires in 7 days
- Invitation link points to the invitation acceptance page (GET request)

---

### 14. Update Organization

Update organization details.

**Endpoint:** `PUT /api/super-admin/organizations/{id}`

**Request Body:**
```json
{
  "name": "Updated Company Name",
  "email": "newemail@company.com",
  "is_active": true
}
```

**Response (200):**
```json
{
  "success": true,
  "data": {
    "message": "Organization updated successfully",
    "organization": {
      "id": 1,
      "name": "Updated Company Name",
      "email": "newemail@company.com"
    }
  }
}
```

---

### 15. Delete Organization

Delete an organization.

**Endpoint:** `DELETE /api/super-admin/organizations/{id}`

**Response (200):**
```json
{
  "success": true,
  "data": {
    "message": "Organization deleted successfully"
  }
}
```

**Notes:**
- Soft deletes organization
- Related users and invitations are handled by database constraints

---

### 16. Resend Invitation

Resend invitation email to organization.

**Endpoint:** `POST /api/super-admin/organizations/{id}/resend-invitation`

**Response (200):**
```json
{
  "success": true,
  "data": {
    "message": "Invitation resent successfully"
  }
}
```

---

## Organization-Level Endpoints

All organization-level endpoints require:
- Authentication
- Active subscription or trial (`subscribed` middleware)
- Organization context (`organization` middleware)
- Appropriate role permissions

---

### User Management API

**Required Role:** `admin`

#### 17. List Users

Get list of users in the organization.

**Endpoint:** `GET /api/users`

**Query Parameters:**
- `role` (optional) - Filter by role name
- `search` (optional) - Search by name or email

**Response (200):**
```json
{
  "success": true,
  "data": {
    "users": {
      "data": [
        {
          "id": 1,
          "name": "John Doe",
          "email": "john@example.com",
          "organization_id": 1,
          "created_at": "2025-11-28T10:00:00.000000Z",
          "roles": [
            {
              "id": 2,
              "name": "finance"
            }
          ]
        }
      ],
      "current_page": 1,
      "per_page": 20
    },
    "roles": [
      {"id": 2, "name": "admin"},
      {"id": 3, "name": "finance"},
      {"id": 4, "name": "admin_support"},
      {"id": 5, "name": "general_staff"}
    ]
  }
}
```

**Notes:**
- Organization admins can only see users in their organization
- Super admin can see all users (can filter by `organization_id`)

---

#### 18. Create User

Create a new user in the organization. A random password will be generated and sent to the user via email. The user will be required to change their password on first login.

**Endpoint:** `POST /api/users`

**Request Body:**
```json
{
  "name": "Jane Doe",
  "email": "jane@example.com",
  "role": "finance"
}
```

**Response (201):**
```json
{
  "success": true,
  "data": {
    "message": "User created successfully. An email with login credentials has been sent.",
    "user": {
      "id": 2,
      "name": "Jane Doe",
      "email": "jane@example.com",
      "organization_id": 1,
      "must_change_password": true,
      "roles": [{"id": 3, "name": "finance"}]
    }
  }
}
```

**Validation Rules:**
- `name`: required, string, max:255
- `email`: required, email, unique
- `role`: required, exists in roles, cannot be `super_admin`

**Notes:**
- Password is automatically generated (12 random characters)
- User receives an email with their temporary password
- User must change password on first login (`must_change_password: true`)
- If email sending fails, user is still created (error is logged)

**Available Roles:**
- `admin` - Full access within organization
- `finance` - Access to Expense Tracking Module
- `admin_support` - Access to Inventory, Assets, and Maintenance modules
- `general_staff` - Read-only access

---

#### 19. Get User

Get user details.

**Endpoint:** `GET /api/users/{id}`

**Response (200):**
```json
{
  "success": true,
  "data": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "organization_id": 1,
      "email_verified_at": "2025-11-28T10:00:00.000000Z",
      "created_at": "2025-11-28T10:00:00.000000Z",
      "roles": [{"id": 3, "name": "finance"}],
      "organization": {
        "id": 1,
        "name": "Example Corp"
      }
    }
  }
}
```

---

#### 20. Update User

Update user information. Note: Password cannot be updated through this endpoint. To reset a user's password, delete and recreate the user.

**Endpoint:** `PUT /api/users/{id}`

**Request Body:**
```json
{
  "name": "John Updated",
  "email": "john.updated@example.com",
  "role": "admin"
}
```

**Response (200):**
```json
{
  "success": true,
  "data": {
    "message": "User updated successfully.",
    "user": {
      "id": 1,
      "name": "John Updated",
      "email": "john.updated@example.com",
      "roles": [{"id": 2, "name": "admin"}]
    }
  }
}
```

**Validation Rules:**
- `name`: required, string, max:255
- `email`: required, email, unique (except current user)
- `password`: optional, string, min:8, confirmed (leave blank to keep current)
- `role`: required, exists in roles

---

#### 21. Delete User

Delete a user from the organization.

**Endpoint:** `DELETE /api/users/{id}`

**Response (200):**
```json
{
  "success": true,
  "data": {
    "message": "User deleted successfully."
  }
}
```

**Notes:**
- Cannot delete super_admin users
- Cannot delete your own account
- Only organization admins can delete users in their organization

---

### Expense Tracking API

**Required Role:** `admin` or `finance`

#### 22. List Expenses

Get list of expenses.

**Endpoint:** `GET /api/expenses`

**Query Parameters:**
- `category_id` (optional) - Filter by category
- `date_from` (optional) - Filter from date (YYYY-MM-DD)
- `date_to` (optional) - Filter to date (YYYY-MM-DD)
- `vendor` (optional) - Search vendor/payee

**Response (200):**
```json
{
  "success": true,
  "data": {
    "expenses": {
      "data": [
        {
          "id": 1,
          "expense_date": "2025-11-28",
          "amount": "150.00",
          "vendor_payee": "Office Supplies Co",
          "description": "Stationery purchase",
          "receipt_path": "expenses/receipts/1/receipt.pdf",
          "category": {
            "id": 1,
            "name": "Stationery"
          },
          "user": {
            "id": 1,
            "name": "John Doe"
          }
        }
      ]
    },
    "categories": [
      {"id": 1, "name": "Utilities"},
      {"id": 2, "name": "Stationery"}
    ]
  }
}
```

---

#### 23. Create Expense

Create a new expense.

**Endpoint:** `POST /api/expenses`

**Request Body (multipart/form-data):**
```
expense_category_id: 1
expense_date: 2025-11-28
amount: 150.00
vendor_payee: Office Supplies Co
description: Stationery purchase
receipt: (file) - Optional, PDF/JPG/PNG, max 5MB
```

**Response (201):**
```json
{
  "success": true,
  "data": {
    "message": "Expense created successfully.",
    "expense": {
      "id": 1,
      "expense_date": "2025-11-28",
      "amount": "150.00",
      "category": {"id": 1, "name": "Stationery"},
      "user": {"id": 1, "name": "John Doe"}
    }
  }
}
```

**Validation Rules:**
- `expense_category_id`: required, exists in expense_categories
- `expense_date`: required, date
- `amount`: required, numeric, min:0
- `vendor_payee`: optional, string, max:255
- `description`: optional, string
- `receipt`: optional, file, mimes:pdf,jpg,jpeg,png, max:5120

---

#### 24. Get Expense Reports

Get expense reports (monthly, quarterly, YTD).

**Endpoint:** `GET /api/expenses/reports`

**Query Parameters:**
- `period` (required) - `monthly`, `quarterly`, or `ytd`
- `year` (required) - Year (e.g., 2025)
- `month` (optional) - Month (1-12) - required if period=monthly
- `quarter` (optional) - Quarter (1-4) - required if period=quarterly

**Response (200):**
```json
{
  "success": true,
  "data": {
    "period": "monthly",
    "year": 2025,
    "total_amount": "5000.00",
    "total_count": 25,
    "category_totals": [
      {
        "category": "Utilities",
        "total": "2000.00",
        "count": 10
      },
      {
        "category": "Stationery",
        "total": "1500.00",
        "count": 8
      }
    ],
    "expenses": [...]
  }
}
```

---

#### 25. Get Expense Charts Data

Get data for expense charts.

**Endpoint:** `GET /api/expenses/charts`

**Query Parameters:** Same as reports endpoint

**Response (200):**
```json
{
  "success": true,
  "data": {
    "bar_chart": [
      {"category": "Utilities", "amount": 2000.00},
      {"category": "Stationery", "amount": 1500.00}
    ],
    "line_chart": [
      {"date": "2025-11-01", "amount": 500.00},
      {"date": "2025-11-02", "amount": 300.00}
    ],
    "pie_chart": [
      {
        "category": "Utilities",
        "amount": 2000.00,
        "percentage": 40.0
      }
    ]
  }
}
```

---

#### 26. Expense Categories

**List Categories:** `GET /api/expenses/categories`  
**Create Category:** `POST /api/expenses/categories`  
**Update Category:** `PUT /api/expenses/categories/{id}`  
**Delete Category:** `DELETE /api/expenses/categories/{id}`

---

### Inventory Management API

**Required Role:** `admin` or `admin_support`

#### 27. List Inventory Items

**Endpoint:** `GET /api/inventory/items`

**Query Parameters:**
- `category` (optional) - Filter by category
- `low_stock` (optional) - Filter low stock items (1 or 0)
- `search` (optional) - Search by item name

**Response (200):**
```json
{
  "success": true,
  "data": {
    "items": {
      "data": [
        {
          "id": 1,
          "name": "A4 Paper",
          "category": "Office Supplies",
          "quantity": 50,
          "minimum_threshold": 20,
          "unit_price": "5.00",
          "total_price": "250.00",
          "unit": "reams"
        }
      ]
    },
    "low_stock_count": 3
  }
}
```

---

#### 28. Create Inventory Item

**Endpoint:** `POST /api/inventory/items`

**Request Body:**
```json
{
  "name": "A4 Paper",
  "category": "Office Supplies",
  "quantity": 100,
  "minimum_threshold": 20,
  "unit_price": "5.00",
  "unit": "reams"
}
```

---

#### 29. Log Stock Transaction

**Endpoint:** `POST /api/inventory/items/{id}/stock`

**Request Body:**
```json
{
  "type": "in",
  "quantity": 50,
  "transaction_date": "2025-11-28",
  "reference": "PO-12345",
  "notes": "New purchase",
  "unit_price": "5.00",
  "vendor": "Office Supplies Co"
}
```

**Notes:**
- `type`: `in` or `out`
- `unit_price` and `vendor` are optional, typically used for stock in
- Stock out will reduce quantity (validates sufficient stock)

---

#### 30. Get Low Stock Items

**Endpoint:** `GET /api/inventory/low-stock`

**Response (200):**
```json
{
  "success": true,
  "data": {
    "items": [
      {
        "id": 1,
        "name": "A4 Paper",
        "quantity": 15,
        "minimum_threshold": 20,
        "unit": "reams"
      }
    ]
  }
}
```

---

#### 31. Get Purchase History

**Endpoint:** `GET /api/inventory/purchase-history`

**Query Parameters:**
- `item_id` (optional) - Filter by item
- `date_from` (optional) - Filter from date
- `date_to` (optional) - Filter to date

---

#### 32. Get Aging Report

**Endpoint:** `GET /api/inventory/aging-report`

**Response (200):**
```json
{
  "success": true,
  "data": {
    "items": [
      {
        "id": 1,
        "name": "A4 Paper",
        "quantity": 50,
        "oldest_stock_date": "2025-10-01",
        "age_in_days": 58
      }
    ]
  }
}
```

---

### Asset Management API

**Required Role:** `admin` or `admin_support`

#### 33. List Assets

**Endpoint:** `GET /api/assets`

**Query Parameters:**
- `status` (optional) - `active`, `in_repair`, `retired`
- `category` (optional) - Filter by category
- `assigned_to_user_id` (optional) - Filter by assigned user
- `search` (optional) - Search by name, code, or serial number

**Response (200):**
```json
{
  "success": true,
  "data": {
    "assets": {
      "data": [
        {
          "id": 1,
          "asset_code": "ORG-2025-0001",
          "name": "Dell Laptop",
          "category": "Electronics",
          "purchase_date": "2025-01-15",
          "purchase_price": "1200.00",
          "status": "active",
          "assigned_to_user_id": 2,
          "assignedToUser": {
            "id": 2,
            "name": "Jane Doe"
          }
        }
      ]
    },
    "summary": {
      "total": 50,
      "active": 45,
      "in_repair": 3,
      "retired": 2
    }
  }
}
```

---

#### 34. Create Asset

**Endpoint:** `POST /api/assets`

**Request Body:**
```json
{
  "name": "Dell Laptop",
  "category": "Electronics",
  "purchase_date": "2025-01-15",
  "purchase_price": "1200.00",
  "vendor": "Dell Inc",
  "warranty_expiry": "2027-01-15",
  "serial_number": "DL123456",
  "model_number": "Latitude 5520",
  "assigned_to_user_id": 2,
  "assigned_to_location": "Room 101",
  "description": "Office laptop"
}
```

**Notes:**
- `asset_code` is automatically generated (format: `ORG-YYYY-NNNN`)
- Asset is created with status `active`

---

#### 35. Log Asset Movement

**Endpoint:** `POST /api/assets/{id}/movement`

**Request Body:**
```json
{
  "movement_date": "2025-11-28",
  "movement_type": "assignment",
  "from_user_id": 1,
  "from_location": "Room 101",
  "to_user_id": 2,
  "to_location": "Room 102",
  "reason": "Department transfer",
  "notes": "Moving to marketing department"
}
```

**Movement Types:**
- `assignment` - Asset assigned to user/location
- `location_change` - Asset moved to different location
- `return` - Asset returned
- `other` - Other movement type

---

### Maintenance API

**Required Role:** `admin` or `admin_support`

#### 36. List Maintenance Records

**Endpoint:** `GET /api/maintenance`

**Query Parameters:**
- `status` (optional) - `pending`, `in_progress`, `completed`, `cancelled`
- `type` (optional) - `scheduled`, `repair`, `inspection`, `other`
- `asset_id` (optional) - Filter by asset
- `upcoming` (optional) - Show upcoming maintenance (1 or 0)

**Response (200):**
```json
{
  "success": true,
  "data": {
    "records": {
      "data": [
        {
          "id": 1,
          "asset_id": 1,
          "type": "scheduled",
          "scheduled_date": "2025-12-01",
          "status": "pending",
          "description": "Monthly maintenance check",
          "cost": "150.00",
          "asset": {
            "id": 1,
            "name": "Dell Laptop",
            "asset_code": "ORG-2025-0001"
          }
        }
      ]
    },
    "upcoming_count": 5
  }
}
```

---

#### 37. Create Maintenance Record

**Endpoint:** `POST /api/maintenance`

**Request Body:**
```json
{
  "asset_id": 1,
  "type": "scheduled",
  "scheduled_date": "2025-12-01",
  "description": "Monthly maintenance check",
  "cost": "150.00",
  "service_provider": "Tech Services Inc",
  "next_maintenance_date": "2026-01-01",
  "notes": "Regular maintenance"
}
```

---

#### 38. Get Upcoming Maintenance

**Endpoint:** `GET /api/maintenance/upcoming`

**Response (200):**
```json
{
  "success": true,
  "data": {
    "records": [
      {
        "id": 1,
        "scheduled_date": "2025-12-01",
        "asset": {
          "name": "Dell Laptop",
          "asset_code": "ORG-2025-0001"
        },
        "description": "Monthly maintenance check"
      }
    ]
  }
}
```

**Notes:**
- Returns maintenance scheduled within next 7 days
- Only includes records with status `pending`

---

## Models & Data Structures

### User Model
```json
{
  "id": 1,
  "name": "John Doe",
  "email": "john@example.com",
  "organization_id": 1,
  "email_verified_at": "2025-11-28T10:00:00.000000Z",
  "created_at": "2025-11-28T10:00:00.000000Z",
  "updated_at": "2025-11-28T10:00:00.000000Z"
}
```

### Organization Model
```json
{
  "id": 1,
  "name": "Example Corp",
  "slug": "example-corp",
  "email": "admin@example.com",
  "phone": null,
  "address": null,
  "stripe_id": "cus_xxxxx",
  "pm_type": "card",
  "pm_last_four": "4242",
  "trial_ends_at": "2025-12-28T10:00:00.000000Z",
  "is_subscribed": true,
  "subscription_ends_at": "2026-11-28T10:00:00.000000Z",
  "is_active": true,
  "registration_source": "invited",
  "created_at": "2025-11-28T10:00:00.000000Z",
  "updated_at": "2025-11-28T10:00:00.000000Z"
}
```

**Key Fields:**
- `trial_ends_at`: Date when free trial ends (null if not on trial)
- `is_subscribed`: Boolean indicating if organization has active subscription or is on trial
- `subscription_ends_at`: Date when subscription period ends
- `registration_source`: Either `"invited"` or `"self_registered"`

### Organization Invitation Model
```json
{
  "id": 1,
  "organization_id": 1,
  "email": "admin@example.com",
  "token": "abc123...",
  "invited_by": 1,
  "expires_at": "2025-12-05T10:00:00.000000Z",
  "accepted_at": null,
  "created_at": "2025-11-28T10:00:00.000000Z",
  "updated_at": "2025-11-28T10:00:00.000000Z"
}
```

---

## Subscription Flow

### Trial Period
- **All yearly subscriptions include a 1-month (30-day) free trial**
- Full access granted immediately during trial period
- No charges during trial period
- Payment method required at signup but not charged until trial ends
- Trial status visible on dashboard with days remaining
- Subscription automatically begins after trial ends
- Can cancel anytime during trial without charges

### Subscription Process
1. User registers/invites organization
2. User redirected to subscription checkout
3. User enters payment method (not charged yet)
4. **1-month free trial begins immediately**
5. Full platform access granted
6. After 30 days, subscription automatically begins
7. Payment method charged for annual subscription

### Subscription Status
- `is_subscribed: true` - Organization has active subscription or is on trial
- `trial_ends_at` - Date when trial ends (null if not on trial)
- `subscription_ends_at` - Date when subscription period ends

### Trial Period Details
- **Duration:** 30 days (1 month)
- **Access:** Full platform access during trial
- **Charges:** No charges during trial period
- **Payment Method:** Required at signup but not charged until trial ends
- **Auto-Renewal:** Subscription automatically begins after trial ends
- **Cancellation:** Can cancel anytime during trial without charges

### Access Control
- Routes protected by `subscribed` middleware require active subscription or trial
- Super admin bypasses subscription check
- Users without subscription are redirected to `/subscription/checkout`

---

## Webhook Endpoint

### Stripe Webhook

**Endpoint:** `POST /api/webhook/stripe`

**Note:** This endpoint is for Stripe to send webhook events. Not for direct API calls.

**Events Handled:**
- `customer.subscription.created`
- `customer.subscription.updated`
- `customer.subscription.deleted`
- `customer.subscription.trial_will_end`
- `invoice.payment_succeeded`
- `invoice.payment_failed`
- `invoice.payment_action_required`
- `invoice.upcoming`
- `customer.updated`
- `customer.deleted`
- `payment_method.attached`

---

## Rate Limiting

Currently no rate limiting implemented. Consider implementing for production.

---

## CORS

CORS is configured in `config/cors.php`. Update for mobile app domains.

---

## Testing

### Test Credentials
- **Super Admin:** `superadmin@tracklet.com` / `password`
- **Stripe Test Card:** `4242 4242 4242 4242` (any future expiry, any CVC)

### Test Endpoints
Use Postman, cURL, or your preferred API client. Include authentication headers/cookies.

---

## Support

For API issues or questions:
1. Check response error messages
2. Verify authentication
3. Check request format matches documentation
4. Review server logs

---

---

## Important Notes for Mobile Developers

### Trial Period Handling
- Check `trial_ends_at` field to determine if organization is on trial
- Display trial status and days remaining to users
- Show trial information prominently in app UI
- Trial provides full access - no feature restrictions

### Subscription Status Check
```javascript
// Check if organization has access (trial or subscribed)
const hasAccess = organization.is_subscribed && 
  (organization.trial_ends_at === null || 
   new Date(organization.trial_ends_at) > new Date() ||
   organization.subscription_ends_at === null ||
   new Date(organization.subscription_ends_at) > new Date());
```

### Organization Slug
- Organization slugs are **automatically generated** from organization name
- No need to provide slug in registration/invitation requests
- Slug is URL-friendly and unique

### Invitation Flow
- Invitation link in email uses **GET** request (shows form)
- Form submission uses **POST** request (accepts invitation)
- Email must match invitation email exactly

---

**Last Updated:** November 2025  
**API Version:** 1.0

