{{-- Common JavaScript utilities --}}
<script>
    // Password visibility toggle - reusable function
    function togglePasswordVisibility(inputId, iconId) {
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = document.getElementById(iconId);
        
        if (!passwordInput || !toggleIcon) return;
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.textContent = 'visibility_off';
        } else {
            passwordInput.type = 'password';
            toggleIcon.textContent = 'visibility';
        }
    }

    // Image preview handler - reusable function
    function handleImagePreview(input, previewContainerId = 'imagePreview', previewImageId = 'previewImage') {
        const preview = document.getElementById(previewContainerId);
        const previewImage = document.getElementById(previewImageId);
        
        if (!preview || !previewImage || !input.files || !input.files[0]) return;
        
        const file = input.files[0];
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            preview.classList.remove('hidden');
        };
        
        reader.readAsDataURL(file);
    }

    // Remove image preview
    function removeImagePreview(previewContainerId = 'imagePreview', inputId = null) {
        const preview = document.getElementById(previewContainerId);
        if (preview) {
            preview.classList.add('hidden');
        }
        if (inputId) {
            const input = document.getElementById(inputId);
            if (input) {
                input.value = '';
            }
        }
    }

    // Auto-dismiss alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('[data-auto-dismiss]');
        alerts.forEach(alert => {
            const delay = parseInt(alert.getAttribute('data-auto-dismiss')) || 5000;
            setTimeout(() => {
                if (alert.style.display !== 'none') {
                    alert.style.transition = 'opacity 0.3s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 300);
                }
            }, delay);
        });
    });
</script>

