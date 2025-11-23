# Social Authentication Setup Guide

This guide will help you set up Facebook, Google, and Apple authentication for your Laravel application.

## Installation

1. **Install Laravel Socialite** (already added to composer.json):
   ```bash
   composer require laravel/socialite
   ```

2. **Run the migration**:
   ```bash
   php artisan migrate
   ```

## Configuration

### 1. Facebook Setup

1. Go to [Facebook Developers](https://developers.facebook.com/)
2. Create a new app or use an existing one
3. Add "Facebook Login" product
4. Go to Settings > Basic and note your App ID and App Secret
5. Add authorized redirect URI: `http://localhost/bis/bis/auth/facebook/callback` (or your production URL)

Add to your `.env` file:
```
FACEBOOK_CLIENT_ID=your_facebook_app_id
FACEBOOK_CLIENT_SECRET=your_facebook_app_secret
FACEBOOK_REDIRECT_URI=http://localhost/bis/bis/auth/facebook/callback
```

### 2. Google Setup

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project or select an existing one
3. Enable "Google+ API" (or "Google Identity Services")
4. Go to "Credentials" > "Create Credentials" > "OAuth 2.0 Client ID"
5. Set application type to "Web application"
6. Add authorized redirect URI: `http://localhost/bis/bis/auth/google/callback` (or your production URL)
7. Note your Client ID and Client Secret

Add to your `.env` file:
```
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost/bis/bis/auth/google/callback
```

### 3. Apple Setup

1. Go to [Apple Developer Portal](https://developer.apple.com/)
2. Navigate to "Certificates, Identifiers & Profiles"
3. Create a new "Services ID" (or use existing)
4. Enable "Sign in with Apple"
5. Configure domains and redirect URLs
6. Create a "Key" for Sign in with Apple
7. Note your Services ID (Client ID), Team ID, Key ID, and download the .p8 key file

Add to your `.env` file:
```
APPLE_CLIENT_ID=your_apple_services_id
APPLE_CLIENT_SECRET=your_apple_client_secret
APPLE_REDIRECT_URI=http://localhost/bis/bis/auth/apple/callback
```

**Note:** Apple requires additional configuration. You may need to use a package like `socialiteproviders/apple` for full Apple Sign In support, as Apple uses JWT tokens instead of standard OAuth2.

## Features

- ✅ Facebook Login
- ✅ Google Login  
- ✅ Apple Login (basic support - may need additional package for full JWT support)
- ✅ Automatic account linking (if user exists with same email)
- ✅ Avatar/profile picture from social accounts
- ✅ Email verification automatically set for social users
- ✅ Default role assignment (anonymous)

## Usage

Users can now:
1. Click on Facebook, Google, or Apple buttons on login/register pages
2. Authenticate with their social account
3. Be automatically logged in and redirected to dashboard
4. If they already have an account with the same email, the social account will be linked

## Notes

- Social authentication users don't need passwords
- Email addresses are automatically verified for social users
- Profile pictures from social accounts are stored in the `avatar` field
- The system will link social accounts to existing users if the email matches

