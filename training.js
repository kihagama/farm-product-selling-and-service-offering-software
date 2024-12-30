document.querySelectorAll('.card button').forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('booking-overlay').style.display = 'flex';
        // Get the value from the h3 tag
        const officerId = document.getElementById('officerid').textContent.trim();

        // Set it as the value of the input field
        document.getElementById('booking-officer').value = officerId;
        // Open modal
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }
    });
});

