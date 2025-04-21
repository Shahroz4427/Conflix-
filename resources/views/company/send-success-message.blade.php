<x-app-layout>

    @push('style')
    <style>
    /* Success Message Container */
    .success-message {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        background-color: rgba(0, 0, 0, 0.6);
        /* Dark background with opacity */
    }

    /* Success Message Box */
    .message-content {
        background-color: #38a169;
        /* Green color */
        color: white;
        padding: 20px 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        animation: fadeIn 1s ease-in-out;
    }

    /* Icon Styling */
    .message-icon svg {
        width: 40px;
        height: 40px;
        margin-right: 15px;
    }

    /* Text Styling */
    .message-text {
        font-size: 16px;
    }

    .message-heading {
        font-size: 18px;
        font-weight: bold;
    }

    /* Fade-in Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    </style>
    @endpush


    <x-navbar />

    <!-- Success Message -->
    <div id="success-message" class="success-message">
        <div class="message-content">
            <div class="message-icon">
                <!-- Icon (Optional) -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <div class="message-text">
                <p class="message-heading">Success!</p>
                <p>Conflict Letter Sent Successfully</p>
            </div>
        </div>
    </div>

    @push('script')
    <script>
    setTimeout(() => {
        document.getElementById('success-message').style.display = 'none';
    }, 4000); // Message disappears after 4 seconds
    </script>
    @endpush


</x-app-layout>