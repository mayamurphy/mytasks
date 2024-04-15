function openEditTaskForm(id) {
    var form = document.getElementById(id);
    form.style.display = "inline-block";
};

function closeEditTaskForm(id) {
    document.getElementById(id).style.display = "none";
    location.reload();
}