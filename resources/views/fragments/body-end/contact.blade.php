<script>
    {
        document.getElementById('character-counter').style.display = 'inline';
        const charCount = document.getElementById('character-count');
        const maxCharCount = parseInt(charCount.innerText);
        const messageField = document.getElementById('message');
        const updateCharCount = () => {
            charCount.innerText = maxCharCount - messageField.value.length;
        };
        messageField.addEventListener('keyup', updateCharCount);
        // Account for any initial value
        updateCharCount();
    }
</script>
