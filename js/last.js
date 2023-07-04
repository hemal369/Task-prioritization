function handleCheckbox(checkbox) {
    const task = checkbox.parentElement;
    if (checkbox.checked) {
        task.classList.add('completed');
    } else {
        task.classList.remove('completed');
    }
}