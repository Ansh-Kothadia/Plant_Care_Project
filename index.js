// Toast functionality
function showToast(title, message) {
    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.innerHTML = `
        <div class="toast-title">${title}</div>
        <div>${message}</div>
    `;
    
    document.getElementById('toast-container').appendChild(toast);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        toast.style.animation = 'slideIn 300ms ease reverse';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Event handlers - using only for click actions as requested
function handleBookAppointment() {
    showToast('Booking Appointment', 'This feature will be available soon!');
}

function handleLearnMore(serviceTitle) {
    showToast('Service Details', 'More information about ${serviceTitle} will be available soon!');
}

function handleSubscribe(planName) {
    showToast('Subscription', 'Thank you for your interest in the ${planName}. Subscription feature will be available soon!');
}