@extends('layouts.app')

@section('title', 'Privacy Policy | ConstructKaro')

@push('styles')
<style>
    .privacy-page {
        background: #eef2f7;
        color: #1c2c3e;
        font-family: 'Poppins', Arial, sans-serif;
        padding: 54px 0 70px;
    }

    .privacy-container {
        width: min(92%, 1040px);
        margin: 0 auto;
    }

    .privacy-header {
        margin-bottom: 26px;
    }

    .privacy-header h1 {
        margin: 0 0 10px;
        color: #10233d;
        font-size: clamp(32px, 5vw, 52px);
        line-height: 1.08;
        letter-spacing: 0;
    }

    .privacy-updated {
        margin: 0;
        color: #667085;
        font-size: 15px;
        font-weight: 600;
    }

    .privacy-card {
        background: #ffffff;
        border: 1px solid #d9e2ec;
        border-radius: 8px;
        box-shadow: 0 14px 38px rgba(16, 35, 57, .10);
        padding: clamp(22px, 4vw, 44px);
    }

    .privacy-card p {
        margin: 0 0 18px;
        color: #344256;
        font-size: 16px;
        line-height: 1.75;
    }

    .privacy-card h2 {
        margin: 32px 0 14px;
        color: #10233d;
        font-size: clamp(22px, 3vw, 28px);
        line-height: 1.25;
        letter-spacing: 0;
    }

    .privacy-card ul {
        margin: 0 0 22px 20px;
        padding: 0;
    }

    .privacy-card li {
        margin-bottom: 12px;
        color: #344256;
        font-size: 16px;
        line-height: 1.7;
        padding-left: 4px;
    }

    .privacy-card strong {
        color: #10233d;
    }

    .privacy-divider {
        height: 1px;
        background: #d9e2ec;
        margin: 30px 0;
    }

    .privacy-contact {
        background: #f7fafc;
        border: 1px solid #d9e2ec;
        border-radius: 8px;
        padding: 18px;
    }

    .privacy-contact p:last-child,
    .privacy-card p:last-child {
        margin-bottom: 0;
    }

    @media (max-width: 640px) {
        .privacy-page {
            padding: 36px 0 48px;
        }

        .privacy-card p,
        .privacy-card li {
            font-size: 15px;
        }
    }
</style>
@endpush

@section('content')
<section class="privacy-page">
    <div class="privacy-container">
        <header class="privacy-header">
            <h1>Privacy Policy</h1>
            <p class="privacy-updated">Last updated: June 6, 2026</p>
        </header>

        <article class="privacy-card">
            <p>This privacy policy ("Privacy Policy" or "Policy") outlines how <strong>Swarajya Construction Pvt. Ltd.</strong>, operating under the brand name <strong>ConstructKaro</strong> ("ConstructKaro", "we", "us", or "our"), collects, uses, stores, and shares the personal data of its <strong>vendors</strong>, including contractors, architects, interior designers, surveyors, and structural consultants, on our platform, <strong>vendor.constructkaro.com</strong> ("Platform"). By accessing or using the Platform and services offered by ConstructKaro, you acknowledge and consent to the practices described in this Privacy Policy.</p>

            <h2>1. Background and Key Information</h2>
            <p><strong>How This Policy Applies:</strong><br>This Privacy Policy applies to all vendors registered with ConstructKaro who provide services through the Platform. This Policy governs the collection and processing of your personal data as part of the vendor onboarding process, and during your engagement with ConstructKaro.</p>
            <p><strong>Review and Updates:</strong><br>We may update this Privacy Policy from time to time. ConstructKaro encourages you to review this Policy periodically. We will notify you of significant changes to this Policy by updating the date at the top of this page. If you continue to use the Platform after such changes, it indicates your acceptance of the new terms.</p>
            <p><strong>Third-Party Services:</strong><br>The Platform may include links to third-party websites or services. These third-party services may collect or share personal data about you. ConstructKaro does not control these third-party services and is not responsible for their privacy practices. We encourage you to read their privacy policies.</p>

            <div class="privacy-divider"></div>

            <h2>2. Personal Data We Collect</h2>
            <p>ConstructKaro collects various types of personal data about you when you engage with the Platform. This may include:</p>
            <ul>
                <li><strong>Identity Data:</strong> Your full name, professional title, business name, and other identifiers used in providing services through ConstructKaro.</li>
                <li><strong>Contact Data:</strong> Your business address, phone number, email address, and location details.</li>
                <li><strong>Commercial Data:</strong> Details of your company's services, licenses, certifications, qualifications, and the projects you manage.</li>
                <li><strong>Transaction Data:</strong> Information about the services you have rendered through the Platform, payment history, invoices, and transactions.</li>
                <li><strong>Technical Data:</strong> IP address, device information, browser type, location data, and website usage data.</li>
                <li><strong>Communication Data:</strong> Any correspondence or messages sent via the Platform, such as service requests, feedback, or inquiries.</li>
            </ul>

            <div class="privacy-divider"></div>

            <h2>3. How We Collect Your Personal Data</h2>
            <p>We collect personal data in the following ways:</p>
            <ul>
                <li><strong>Direct Interactions:</strong> You provide your personal data when registering with ConstructKaro, creating a vendor profile, or communicating with us through the Platform.</li>
                <li><strong>Automated Technologies:</strong> When you use the Platform, we may collect technical data using cookies, web beacons, and similar tracking technologies to enhance your experience and optimize our services.</li>
                <li><strong>Third-Party Data:</strong> We may receive personal data from third parties, such as background check agencies, payment processors, and service providers, as part of the vendor registration or service process.</li>
            </ul>

            <div class="privacy-divider"></div>

            <h2>4. How We Use Your Personal Data</h2>
            <p>ConstructKaro uses your personal data for various legitimate business purposes, including:</p>
            <ul>
                <li><strong>To Provide Services:</strong> To facilitate and manage your account on the Platform, process service requests, and enable payment processing.</li>
                <li><strong>To Improve User Experience:</strong> To enhance the functionality of the Platform, track service performance, and personalize your experience.</li>
                <li><strong>To Communicate with You:</strong> To notify you about platform updates, service changes, and send periodic communications about new opportunities, project offers, or other vendor-related matters.</li>
                <li><strong>For Legal Compliance:</strong> To comply with applicable laws, including data protection regulations, and to respond to legal requests.</li>
                <li><strong>For Vendor Management:</strong> To verify your identity, process your service rates, track transactions, and monitor service quality.</li>
            </ul>

            <div class="privacy-divider"></div>

            <h2>5. Data Security</h2>
            <p>We implement technical and organizational measures to protect your personal data. These measures include encryption, secure servers, firewalls, and access controls to safeguard your information. However, no method of transmission over the internet is 100% secure, and we cannot guarantee the absolute security of your data.</p>

            <div class="privacy-divider"></div>

            <h2>6. Data Sharing and Disclosure</h2>
            <p>We may share your personal data with third parties in the following instances:</p>
            <ul>
                <li><strong>With Service Providers:</strong> Third-party service providers that assist us in operating the Platform, processing payments, and delivering services to you.</li>
                <li><strong>For Legal Compliance:</strong> We may disclose personal data if required by law, in response to legal proceedings, or to protect the rights, property, or safety of ConstructKaro, its users, or others.</li>
                <li><strong>With Your Consent:</strong> We may share your personal data with customers with your explicit consent when necessary.</li>
            </ul>

            <div class="privacy-divider"></div>

            <h2>7. Your Rights Regarding Your Personal Data</h2>
            <p>As a vendor, you have the following rights:</p>
            <ul>
                <li><strong>Access and Correction:</strong> You have the right to request access to your personal data and request corrections or updates to any inaccurate information.</li>
                <li><strong>Deletion:</strong> You may request the deletion of your personal data, subject to any legal or contractual obligations we must fulfill.</li>
                <li><strong>Opt-Out of Marketing:</strong> You may choose not to receive marketing communications from ConstructKaro at any time by following the opt-out instructions provided in our communications.</li>
            </ul>

            <div class="privacy-divider"></div>

            <h2>8. Compliance with the Digital Personal Data Protection Act, 2023</h2>
            <p>ConstructKaro adheres to the provisions of the <strong>Digital Personal Data Protection Act, 2023</strong>. We will process your personal data only for the purposes outlined in this Privacy Policy, and we ensure that all data collection and processing activities comply with this Act.</p>

            <div class="privacy-divider"></div>

            <h2>9. Data Retention</h2>
            <p>We will retain your personal data for as long as necessary to fulfill the purposes for which it was collected, including legal, accounting, and reporting obligations. After this period, your data will be securely deleted or anonymized.</p>

            <div class="privacy-divider"></div>

            <h2>10. Business Transitions</h2>
            <p>In the event of a business transition such as a merger, acquisition, or sale, your personal data may be transferred to the new entity. We will notify you of any such change and provide you with the opportunity to opt-out if necessary.</p>

            <div class="privacy-divider"></div>

            <h2>11. Changes to This Privacy Policy</h2>
            <p>We may revise this Privacy Policy from time to time to reflect changes in our data collection practices or legal requirements. When updates are made, we will post the new Privacy Policy on the Platform and notify you of any material changes.</p>

            <div class="privacy-divider"></div>

            <h2>12. Contact Us</h2>
            <p>If you have any questions or concerns about this Privacy Policy, or if you wish to exercise any of your rights regarding your personal data, please contact us at:</p>
            <div class="privacy-contact">
                <p><strong>Data Protection Officer</strong></p>
                <p><strong>Email:</strong> privacy@constructkaro.com</p>
                <p><strong>Address:</strong> Swarajya Construction Pvt. Ltd., Crescent Pearl B, B-G/1, Veena Nagar, Near St. Anthony Church, Katrang Road, Khopoli-410203</p>
            </div>
        </article>
    </div>
</section>
@endsection
