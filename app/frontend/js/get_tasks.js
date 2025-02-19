import {attachDeleteEvent} from "./delete_task.js";
import {attachUpdateEvent} from "./update_task.js";
import {attachCompletedEvent} from  './completed_task.js';

async function getTasks() {
    const response = await fetch("/api/get_tasks.php");
    if (response.ok) {
        return await response.json();
    }
}

function renderTasks(tasks) {
    const container = document.getElementsByClassName('container')[0];
    container.innerHTML = '';
    tasks.forEach(task => {
        /* Contenedor de las Tareas */
        const container_task = document.createElement('div');
        container_task.setAttribute('id', 'task_' + task.id);
        container_task.setAttribute('data-id', task.id);
        container_task.classList.add('task');

        /* Descripción Tarea */
        const description = document.createElement('input');
        description.value = task.description;
        description.disabled = true;
        description.setAttribute('type', 'text');
        if (task.completed) {
            description.classList.add('completed');
        } else {
            description.classList.remove('completed');
        }

        /* Botón de Eliminar Tarea*/
        const btnDelete = document.createElement('button');
        btnDelete.classList.add('task_btn_delete');

        const svgDelete = document.createElement('img');
        svgDelete.width = 40;
        svgDelete.src = window.location.origin + '/frontend/assets/delete_trash.svg';

        btnDelete.append(svgDelete);

        /* Botón de Editar Tarea */
        const btnEdit = document.createElement('button');
        btnEdit.classList.add('task_btn_edit');
        btnEdit.disabled = task.completed;
        if (task.completed) btnEdit.style.background = '#ccc';

        const svgEdit = document.createElement('img');
        svgEdit.width = 40;
        svgEdit.src = window.location.origin + '/frontend/assets/edit.svg';

        btnEdit.append(svgEdit);

        /* Botón de Completar Tarea */
        const btnComplete = document.createElement('button');
        btnComplete.classList.add('task_btn_complete');
        if (task.completed) btnComplete.classList.add('task_btn_completed');

        const svgComplete = document.createElement('img');
        svgComplete.width = 40;
        svgComplete.src = window.location.origin + '/frontend/assets/' + (task.completed ? 'close.svg' : 'check.svg');

        btnComplete.append(svgComplete);

        container_task.append(description);
        container_task.append(btnDelete);
        container_task.append(btnEdit);
        container_task.append(btnComplete);


        container.append(container_task);
    });

    attachDeleteEvent();
    attachUpdateEvent();
    attachCompletedEvent();
}

document.addEventListener("DOMContentLoaded", async () => {
    const tasks = await getTasks();
    renderTasks(tasks);
});

export {getTasks, renderTasks}
