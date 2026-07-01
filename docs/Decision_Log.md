# GO-Farmer - Decision Log

## Decision 001

**Title:** User Roles for MVP

**Date:** July 2026

### Decision

The MVP will support only three user roles:

- Farmer
- Transport Provider
- Admin

### Reason

In rural areas, transport providers are often both the vehicle owner and the driver.

Combining these roles reduces development complexity, simplifies authentication, and allows faster MVP development.

Fleet management and separate driver accounts will be introduced in future versions if required.

**Status:** Approved

# GO-Farmer - Decision Log

**Version:** 1.0

**Created:** July 2026

---

# Decision 001

## Title
User Roles for MVP

### Decision

The MVP will support only three user roles:

- Farmer
- Transport Provider
- Admin

### Reason

In rural areas, the transport provider is often both the vehicle owner and the driver. Combining these roles reduces development complexity, simplifies authentication, and allows faster MVP development.

### Status

Approved

---

# Decision 002

## Title
Simple Farmer Registration

### Decision

Farmer registration will require only:

- Full Name
- Mobile Number
- Password
- Confirm Password
- State
- District
- Taluka
- Village

Authentication will be based on:

- Mobile Number
- OTP Verification
- Password

The following will NOT be collected in the MVP:

- Email
- Aadhaar
- PAN
- Farm Documents
- Farm Size

GPS permission will be requested only when creating a transport request, not during registration.

### Reason

A simple registration process increases user adoption and reduces friction for farmers.

### Status

Approved

---

# Decision 003

## Title
Mobile-First Authentication

### Decision

GO-Farmer will use **Mobile Number + OTP + Password** for user authentication.

Email-based login and registration will not be included in the MVP.

### Reason

Most farmers are comfortable using mobile numbers rather than email addresses. This makes the login process simpler and more accessible.

### Status

Approved

---

# Decision 004

## Title
Smart Location Selection

### Decision

GO-Farmer will support two methods for selecting the user's location:

### Method 1 (Recommended)

Use the device's current location to automatically detect:

- State
- District
- Taluka
- Village (where available)

Users can edit any detected value if needed.

### Method 2

Manual selection using dropdowns:

- State
- District
- Taluka
- Village

### Reason

This approach provides the fastest registration experience while still supporting users whose location cannot be detected accurately.

### Status

Approved