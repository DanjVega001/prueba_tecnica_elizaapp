import {getTasks, renderTasks} from "./get_tasks.js";

export const attachCompletedEvent = () => {
    Array.from(document.getElementsByClassName('task_btn_complete')).forEach((value) => {
        value.addEventListener('click', async function () {
            const parent = value.parentElement;
            const id = parent.getAttribute('data-id');
            if (id !== null && id.trim() !== '') {
                await completedTask(id);
                renderTasks(await getTasks());
            }
        });
    });
}

const completedTask = async (id) => {

    const response = await fetch('/api/completed_task.php?task_id='+id, {
        method: 'GET',
    });
    if (!response.ok) {
        console.log(response)
    }
}