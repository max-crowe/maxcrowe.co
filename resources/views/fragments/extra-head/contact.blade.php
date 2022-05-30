<style>
form {
    max-width: 800px;
    margin: 0 auto;
}

label {
    font-weight: bold;
    display: block;
}

input:not(input[type=submit]), textarea {
    font-family: var(--default-font);
    width: calc(100% - 12px);
    border: 1px solid var(--neutral-gray);
    border-radius: 8px;
    padding: 5px;
    font-size: 1.1em;
}

textarea {
    height: 20em;
    resize: none;
}

.field {
    margin-bottom: 1em;
}

input[type=submit] {
    display: block;
    margin: 0 auto;
    width: 50%;
}

.form-error {
    color: var(--alert);
    margin: 0;
}

#character-counter {
    color: var(--alert);
    float: right;
    display: none;
}
</style>
