const mainContent = document.querySelector('.main-content');
const emailInput = document.querySelector('.email');
const codeBox = document.querySelector('.code-box');
const codeInput = document.querySelector('.code');
const newPasswordBox = document.querySelector('.new-password-box');
const newPasswordInput = document.querySelector('.new-password');
const confirmPasswordInput = document.querySelector('.confirm-password');
const resendButton = document.querySelector('.resend-btn');
const statusMessage = document.querySelector('.status-message');

let codeSent = false;
let resendTimer = null;

function sendCode() {
  const email = emailInput.value;
  const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  // Send AJAX request to the backend route for sending the OTP code
  fetch('/send-otp', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrf, // Use Laravel CSRF token
    },
    body: JSON.stringify({ email: email }),
  })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'success') {
        codeSent = true;
        // Show the code input box
        codeBox.style.display = 'block';
        statusMessage.innerText = data.message;
        startResendTimer();
      } else {
        statusMessage.innerText = data.message;
      }
    })
    .catch(error => {
      console.error('Error sending code:', error);
      statusMessage.innerText = 'An error occurred while sending the code. Please try again.';
    });
}

function startResendTimer() {
  let seconds = 45; // Adjust the time here (in seconds) for the desired countdown
  resendButton.disabled = true;
  updateResendButtonText(seconds);

  resendTimer = setInterval(() => {
    seconds--;
    if (seconds === 0) {
      clearInterval(resendTimer);
      resendButton.disabled = false;
    }
    updateResendButtonText(seconds);
  }, 1000);
}

function updateResendButtonText(seconds) {
  const remainingTime = `${seconds}s`;
  resendButton.innerText = `Resend Code (${remainingTime})`;
}

function resendCode() {
  const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  if (!codeSent) return;

  // Send AJAX request to the backend route for resending the OTP code
  fetch('/resend-otp', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrf, // Use Laravel CSRF token
    },
    body: JSON.stringify({ email: emailInput.value }),
  })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'success') {
        statusMessage.innerText = data.message;
        startResendTimer();
      } else {
        statusMessage.innerText = data.message;
      }
    })
    .catch(error => {
      console.error('Error resending code:', error);
      statusMessage.innerText = 'An error occurred while resending the code. Please try again.';
    });
}

function verifyCode() {
  const enteredCode = codeInput.value;
  const email = emailInput.value;

  const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  // Send AJAX request to the backend route for verifying the OTP code
  fetch('/verify-otp', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrf, // Use Laravel CSRF token
    },
    body: JSON.stringify({ code: enteredCode, email: email }),
  })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'success') {
        codeBox.style.display = 'none';
        newPasswordBox.style.display = 'block';
        statusMessage.innerText = data.message;
      } else {
        statusMessage.innerText = data.message;
      }
    })
    .catch(error => {
      console.error('Error verifying code:', error);
      statusMessage.innerText = 'An error occurred while verifying the code. Please try again.';
    });
}

function savePassword() {
    const enteredCode = codeInput.value;
    const email = emailInput.value;
  const newPassword = newPasswordInput.value;
  const confirmPassword = confirmPasswordInput.value;
  const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const loginLink = document.querySelector('.login-link');
  const saveBtn = document.querySelector('.save-btn');
  // Send AJAX request to the backend route for saving the new password
  fetch('/save-password', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrf, // Use Laravel CSRF token
    },
    body: JSON.stringify({
        password: newPassword,
        password_confirmation: confirmPassword,
        email: email,
        code: enteredCode,

    }),
  })
  .then(response => response.json())
  .then(data => {
      if (data.status === 'success') {
          // Show the success message and hide the save button
          statusMessage.innerText = data.message;
          saveBtn.style.display = 'none';
          loginLink.style.display = 'block'; // Show the login link
      } else {
          statusMessage.innerText = data.message;
      }
  })
  .catch(error => {
      console.error('Error saving password:', error);
      statusMessage.innerText = 'An error occurred while saving the password. Please try again.';
  });
}
