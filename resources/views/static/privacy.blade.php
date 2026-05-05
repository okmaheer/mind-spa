@extends('layouts.app')

@section('title', 'Privacy Policy — MindSnap')
@section('description', 'MindSnap privacy policy. We do not sell personal data, require no accounts, and collect no personal information from children.')
@section('canonical', config('app.url') . '/privacy')
@section('robots', 'noindex, follow')

@section('content')

<div class="container" style="max-width:760px; padding-top:60px; padding-bottom:80px;">

  <nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb ms-breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active">Privacy Policy</li>
    </ol>
  </nav>

  <h1 style="font-size:2rem; font-weight:800; color:var(--primary-dark); margin-bottom:8px;">Privacy Policy</h1>
  <p style="color:var(--text-muted); font-size:.9rem; margin-bottom:40px;">Last updated: {{ date('F j, Y') }}</p>

  <div class="ms-section-seo">

    <h2>1. Who We Are</h2>
    <p>MindSnap ("we", "us", "our") operates the website at mindsnap.co. We provide free health calculators, brain quizzes, and educational tools.</p>

    <h2>2. Data We Collect</h2>
    <p>MindSnap does not require account registration. We collect minimal data to operate the service:</p>
    <ul>
      <li><strong>Usage analytics</strong> — page views and search queries are logged in aggregate to understand which tools are popular. No personal identifiers are stored alongside this data.</li>
      <li><strong>Quiz results</strong> — quiz scores are stored against your browser session ID (a temporary, anonymous identifier) to show you your result. Session data expires when you close your browser.</li>
      <li><strong>Server logs</strong> — standard server access logs (IP address, browser type, pages visited) are retained for up to 30 days for security purposes only.</li>
    </ul>

    <h2>3. Children's Privacy (Kids Zone)</h2>
    <p>The MindSnap Kids Zone (<code>/kids</code>) is designed for children aged 5–14. In this section:</p>
    <ul>
      <li>We display <strong>zero advertisements</strong></li>
      <li>We collect <strong>no personal data</strong> from children</li>
      <li>We use <strong>no tracking cookies</strong></li>
      <li>No account or registration is required</li>
    </ul>
    <p>This approach is fully compliant with COPPA (USA) and GDPR-K (UK/EU) because we collect no personal data from children whatsoever.</p>

    <h2>4. Cookies</h2>
    <p>MindSnap uses only a session cookie (a small file stored in your browser) to remember your quiz results within a session. This cookie contains no personal information and is deleted when you close your browser. We do not use advertising cookies or cross-site tracking cookies.</p>

    <h2>5. Third-Party Services</h2>
    <p>MindSnap may use the following third-party services on non-kids pages:</p>
    <ul>
      <li><strong>Google AdSense</strong> — may serve advertisements and set its own cookies on adult pages. Google's privacy policy applies.</li>
      <li><strong>Google Fonts / Bootstrap CDN</strong> — fonts and UI library assets are loaded from CDN providers. Standard CDN access logs may apply.</li>
    </ul>

    <h2>6. Data Sharing</h2>
    <p>We do not sell, rent, or share personal data with third parties for marketing purposes. We do not build user profiles. We do not use data brokers.</p>

    <h2>7. Your Rights</h2>
    <p>Because we do not collect personal data that can be linked to an individual, there is typically no personal data for us to delete, correct, or export. If you have a specific concern, contact us at <a href="mailto:privacy@mindsnap.co">privacy@mindsnap.co</a>.</p>

    <h2>8. Changes to This Policy</h2>
    <p>We may update this policy from time to time. The "last updated" date at the top of this page will reflect any changes. Continued use of MindSnap after changes constitutes acceptance of the updated policy.</p>

    <h2>9. Contact</h2>
    <p>Questions about this privacy policy: <a href="mailto:privacy@mindsnap.co">privacy@mindsnap.co</a></p>

  </div>

</div>

@endsection
