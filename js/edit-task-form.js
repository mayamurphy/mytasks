function openEditTaskForm() {
    var form = document.getElementById('edit-task-form');
    form.style.display = "inline-block";
};

function closeEditTaskForm() {
    document.getElementById('edit-task-form').style.display = "none";
    location.reload();
}