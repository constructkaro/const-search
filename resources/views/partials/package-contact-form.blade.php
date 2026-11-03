<style>
    button.contact-btn { border: 0; cursor: pointer; font-family: inherit; }
    #packageContactDialog {
        width: min(560px, calc(100% - 32px));
        max-height: calc(100dvh - 40px);
        padding: 28px;
        border: 0;
        border-radius: 16px;
        color: #1c2c3e;
        background: #fff;
        box-shadow: 0 20px 60px #0003;
        overflow-y: auto;
    }
    #packageContactDialog::backdrop { background: #07172bb3; }
    #packageContactDialog h2 { margin: 0 35px 12px 0; }
    #packageContactDialog .package-contact-close {
        position: absolute; top: 12px; right: 16px; border: 0;
        background: transparent; font-size: 28px; cursor: pointer;
    }
    #packageContactForm { display: grid; gap: 14px; }
    #packageContactForm label { display: grid; gap: 6px; font-weight: 600; }
    #packageContactForm input, #packageContactForm textarea {
        width: 100%; padding: 11px; border: 1px solid #d9e2ec;
        border-radius: 8px; font: inherit;
    }
    #packageContactForm textarea { min-height: 100px; resize: vertical; }
    #packageContactForm button[type="submit"] {
        padding: 12px; border: 0; border-radius: 8px; background: #1f73b7;
        color: #fff; font: inherit; font-weight: 700; cursor: pointer;
    }
    #packageContactForm button:disabled { opacity: .6; cursor: wait; }
    #packageContactStatus { white-space: pre-line; }
</style>

<dialog id="packageContactDialog" aria-labelledby="packageContactTitle">
    <button type="button" class="package-contact-close" aria-label="Close contact form">&times;</button>
    <h2 id="packageContactTitle">Contact Form</h2>
    <p>Tell us how you would like to customize your {{ $packageType }} {{ ucfirst($package) }} package.</p>
    <form id="packageContactForm" method="POST" action="{{ route('construction.requirement.store') }}">
        @csrf
        <input type="hidden" name="services[]" value="{{ $packageType }} - {{ ucfirst($package) }} package customization">
        <label>Full Name
            <input name="full_name" required maxlength="255" autocomplete="name">
        </label>
        <label>Mobile Number
            <input type="tel" name="mobile" required pattern="[6-9][0-9]{9}" maxlength="10" inputmode="numeric" autocomplete="tel" title="Enter a 10-digit Indian mobile number starting with 6, 7, 8 or 9.">
        </label>
        <label>Email (optional)
            <input type="email" name="email" maxlength="255" autocomplete="email">
        </label>
        <label>City
            <input name="city" value="{{ ucwords(str_replace('-', ' ', $selectedCity)) }}" required maxlength="100" autocomplete="address-level2">
        </label>
        <label>Customization Details
            <textarea name="project_description" required placeholder="Tell us about the changes you need."></textarea>
        </label>
        <button type="submit">Submit Enquiry</button>
    </form>
    <p id="packageContactStatus" role="status" aria-live="polite" hidden></p>
</dialog>

<script>
(() => {
    const dialog = document.getElementById('packageContactDialog');
    const form = document.getElementById('packageContactForm');
    const status = document.getElementById('packageContactStatus');
    const submit = form.querySelector('button[type="submit"]');
    let opener;
    let previousOverflow;

    document.querySelectorAll('[data-open-package-contact]').forEach(button => {
        button.addEventListener('click', () => {
            opener = button;
            previousOverflow = document.body.style.overflow;
            dialog.showModal();
            document.body.style.overflow = 'hidden';
        });
    });

    dialog.querySelector('.package-contact-close').addEventListener('click', () => dialog.close());
    dialog.addEventListener('click', event => {
        const bounds = dialog.getBoundingClientRect();
        if (event.target === dialog && (event.clientX < bounds.left || event.clientX > bounds.right || event.clientY < bounds.top || event.clientY > bounds.bottom)) {
            dialog.close();
        }
    });
    dialog.addEventListener('close', () => {
        document.body.style.overflow = previousOverflow;
        opener?.focus({ preventScroll: true });
    });

    form.addEventListener('submit', async event => {
        event.preventDefault();
        submit.disabled = true;
        status.hidden = false;
        status.textContent = 'Submitting your enquiry...';

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: { 'Accept': 'application/json' },
                body: new FormData(form)
            });
            const data = await response.json();
            if (!response.ok) {
                status.textContent = data.errors
                    ? Object.values(data.errors).flat().join('\n')
                    : 'Unable to submit your enquiry. Please try again.';
                return;
            }
            form.reset();
            form.hidden = true;
            form.style.display = 'none';
            status.textContent = 'Your enquiry has been submitted. Our team will contact you soon.';
        } catch (error) {
            status.textContent = 'Unable to submit your enquiry. Please check your connection and try again.';
        } finally {
            submit.disabled = false;
        }
    });
})();
</script>
