import {getTasks, renderTasks} from "./get_tasks.js";

const form = document.getElementById('form_create_task');

form.addEventListener('submit', async(e) => {
    e.preventDefault();

    const task = form.querySelector('input[name="task"]');

    const response = await fetch('/api/create_task.php', {
        method: 'POST',
        headers: {'Content-Type' : 'application/json'},
        body: JSON.stringify({ 'description' : task.value })
    });

    const data = await response.json();

    if (data.error) {
        alert(data.error);
        return;
    }
    renderTasks(await getTasks());
    form.reset();
});