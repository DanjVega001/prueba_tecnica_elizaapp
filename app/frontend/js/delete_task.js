import {getTasks, renderTasks} from "./get_tasks.js";

const attachDeleteEvent = () => {
    Array.from(document.getElementsByClassName('task_btn_delete')).forEach((value) => {
        value.addEventListener('click', async function () {
            const parent = value.parentElement;
            const id = parent.getAttribute('data-id');
            if (id !== null && id.trim() !== '') {
                await deleteTask(id);
                renderTasks(await getTasks());
            }
        });
    });
}

const deleteTask = async (id) => {

    const confirmDelete = confirm('Deseas eliminar la tarea?');

    if (!confirmDelete) {
        return;
    }

    const response = await fetch('/api/delete_task.php?task_id='+id, {
        method: 'DELETE',
    });

    if (response.ok) {
       alert("Tarea eliminada.")
    } else {
        console.log(response);
        alert("Error al eliminar la tarea.")
    }
}

export { deleteTask, attachDeleteEvent }