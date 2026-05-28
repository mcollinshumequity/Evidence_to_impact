# Evidence to Impact — Dignity-First Maternal Health Consulting

Evidence to Impact is a modern, responsive, premium website designed for maternal‑health consulting and program development services. It features a dignity‑first, high‑end aesthetic with rich color palettes, smooth animations, and clean, semantic layouts.

## Tech Stack & Structure

* **Frontend**: HTML5, Vanilla JavaScript, Tailwind CSS (via CDN with customized plugins)
* **Icons & Fonts**: Google Fonts (Newsreader & Inter), Google Material Symbols
* **Backend Form Handler**: Formspree (`https://formspree.io/f/mnjrlwyl`)
* **Local Dev Server**: Node.js / `serve`

### Project Structure
```text
├── .firebaserc           # Firebase project association
├── firebase.json         # Firebase Hosting configuration
├── package.json          # Development scripts and dependencies
├── public/               # Main application directory
│   ├── index.html        # Homepage
│   ├── about.html        # About page
│   ├── services.html     # Services overview page
│   ├── css/              # Images, icons, and styles
│   └── js/               # Javascript files (e.g., Tailwind configurations)
└── README.md             # This documentation
```

---

## 💻 Local Development

To run the project locally, ensure you have [Node.js](https://nodejs.org/) installed, and follow these steps:

1. **Install dependencies**:
   ```bash
   npm install
   ```

2. **Start the local development server**:
   ```bash
   npm start
   ```
   *This command runs `npx serve public` and launches a lightweight web server to view the pages.*

---

## 🌐 Deployment via Firebase Hosting

This project is fully compatible with **Firebase Hosting** and is pre-configured to deploy under the project ID `evidencetoimpact-92322`.

### Step-by-Step Deployment Guide

1. **Install the Firebase CLI** (if you haven't already):
   ```bash
   npm install -g firebase-tools
   ```

2. **Log in to Firebase**:
   ```bash
   firebase login
   ```
   *This will open a browser window requesting access to your Google account.*

3. **Verify Project Association**:
   The `.firebaserc` file already associates this directory with your Firebase project (`evidencetoimpact-92322`). You can double-check this by running:
   ```bash
   firebase projects:list
   ```

4. **Deploy to Firebase Hosting**:
   ```bash
   firebase deploy --only hosting
   ```
   Once the upload completes, the CLI will output your live URL (e.g., `https://evidencetoimpact-92322.web.app`).

---

## 📬 Form Submissions (Formspree)

All contact/partner forms across the site (`index.html`, `about.html`, and `services.html`) are integrated with **Formspree** pointing to your endpoint:
`https://formspree.io/f/mnjrlwyl`

This allows for fully secure, serverless form processing natively supported by static hosting environments like Firebase Hosting. Form submissions will be delivered directly to the inbox associated with your Formspree account.

