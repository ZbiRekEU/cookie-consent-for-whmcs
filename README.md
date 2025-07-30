# Cookie Consent for WHMCS with Google Consent Mode v2

Advanced cookie consent addon module for WHMCS that sets up a comprehensive cookie dialog on your website in 2 minutes with little to no coding required. This enhanced version includes **Google Consent Mode v2 integration** for full GDPR compliance and seamless Google Analytics tracking.

When installed and activated, the module displays a professional cookie consent dialog across your website until visitors take action. The dialog allows users to make informed decisions about cookie usage with granular control over different cookie categories.

## ✨ Key Features

### Cookie Consent Management
- **Enable/disable cookie dialog** with simple toggle
- **Customizable dialog title and message** with HTML support
- **Configurable cookie expiration** (set custom days)
- **Cookie Policy URL integration** for transparency
- **Decline redirect URL** for visitors who reject cookies
- **Responsive & Mobile Friendly** design for all devices

### Cookie Categories
- **Necessary cookies** - Essential for website functionality (always enabled)
- **Analytics cookies** - Website usage tracking and performance analysis
- **Marketing cookies** - Advertising, newsletters, and social media integration

### 🚀 Google Consent Mode v2 Integration
- **Full GDPR compliance** with automatic consent state management
- **Google Analytics 4 (GA4) support** with seamless tracking
- **Google Ads integration** for advertising platforms
- **Regional consent configuration** - Set specific rules for different countries/regions
- **Automatic consent updates** - Real-time consent state synchronization
- **Default consent states** - Configure initial cookie permissions per region

### Advanced Configuration Options
- **Regional targeting** - Define consent rules for specific countries (e.g., PL, EU, DE, FR)
- **Default storage settings** - Pre-configure analytics and advertising cookie permissions
- **Granular consent control** - Users can accept/decline specific cookie types
- **Real-time consent updates** - Automatic Google Consent Mode state synchronization

## 🔧 Installation & Setup

1. Upload the module to your WHMCS installation: `/modules/addons/Cookie/`
2. Navigate to **Setup > Addon Modules** in WHMCS Admin
3. Find "Cookie Consent" and click **Activate**
4. Configure your settings:
   - Basic consent dialog options
   - Google Consent Mode v2 settings (optional)
   - Regional targeting rules
   - Default consent states

## ⚙️ Configuration Options

### Basic Settings
- **Enable**: Toggle cookie dialog on/off
- **Title**: Dialog header text
- **Message**: Consent message (HTML supported)
- **Expires**: Cookie duration in days
- **Policy URL**: Link to your cookie policy
- **Redirect URL**: Where to redirect users who decline

### Google Consent Mode v2 Settings
- **Enable Google Consent Mode**: Activate advanced Google integration
- **Google Analytics 4 ID**: Your GA4 tracking ID (G-XXXXXXXXXX)
- **Google Ads ID**: Your Google Ads ID (AW-XXXXXXXXX) - optional
- **Consent Mode Regions**: Country codes for specific consent rules (comma-separated)
- **Default Ad Storage**: Initial advertising cookie permission (granted/denied)
- **Default Analytics Storage**: Initial analytics cookie permission (granted/denied)

## 🌍 GDPR & Regional Compliance

The module automatically handles different consent requirements based on user location:
- **EU regions**: Strict consent requirements with "denied" defaults
- **Other regions**: More flexible consent handling
- **Customizable regional rules** for specific compliance needs

## 🔗 Integration Benefits

### For Website Owners
- **Legal compliance** with GDPR, CCPA, and other privacy regulations
- **Professional appearance** with customizable, responsive design
- **Easy management** through WHMCS admin interface
- **No coding required** - complete GUI configuration

### For Google Services Users
- **Seamless GA4 integration** with proper consent handling
- **Google Ads compliance** for advertising campaigns
- **Consent Mode v2 support** for enhanced data accuracy
- **Automatic consent synchronization** across all Google services

## 📊 Technical Features

- **Lightweight implementation** - minimal impact on page load speed
- **Cross-device compatibility** - works on desktop, tablet, and mobile
- **Modern JavaScript** with jQuery integration
- **CSS customization support** for branding consistency
- **Multi-language support** with translation files
- **Session-based consent tracking** for optimal user experience

## 🔒 Privacy & Security

- **Client-side consent storage** - no personal data sent to servers
- **Secure cookie handling** with proper expiration management
- **Transparent consent logging** for audit purposes
- **User consent revocation** - visitors can change preferences anytime

## 📋 Compatibility

- **WHMCS**: v7.8 to v8.11+
- **PHP**: 7.4+ (recommended 8.0+)
- **Browsers**: All modern browsers (Chrome, Firefox, Safari, Edge)
- **Google Services**: Analytics 4, Google Ads, Consent Mode v2

## 🎯 Use Cases

Perfect for:
- WHMCS hosting providers requiring GDPR compliance
- E-commerce websites with Google Analytics tracking
- Service providers using Google Ads for marketing
- Any WHMCS installation needing professional cookie consent management

---

**Enhanced by**: Community contributions with Google Consent Mode v2 integration  
**Original by**: [HSCode](https://www.hardsoftcode.com)  
**Version**: 1.0.2+ with Google Consent Mode v2
