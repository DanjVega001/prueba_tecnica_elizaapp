import {getTasks, renderTasks} from "./get_tasks.js";

const attachUpdateEvent = () => {
    Array.from(document.getElementsByClassName('task_btn_edit')).forEach((value) => {
        value.addEventListener('click', async function () {
            const parent = value.parentElement;
            const input = parent.querySelector('input');
            activateEdit(input)
        });
    });
}

const activateEdit = (input) => {
    input.disabled = !input.disabled;
    let btnAccept = input.parentElement.querySelector('button.task_btn_update');

    if (btnAccept && input.disabled) {
        btnAccept.remove();
    }
    if (!btnAccept && !input.disabled) {

        btnAccept = document.createElement('button');
        btnAccept.classList.add('task_btn_update');

        const svgComplete = document.createElement('img');
        svgComplete.width = 20;
        svgComplete.src = window.location.origin + '/frontend/assets/check.svg';

        btnAccept.append(svgComplete);

        input.parentElement.prepend(btnAccept);
    }


    btnAccept.addEventListener('click', async function () {
        const parent = btnAccept.parentElement;
        const id = parent.getAttribute('data-id');
        const input = parent.querySelector('input');

        await updateTask(id, input.value);
    });

}

const updateTask = async (id, newtask) => {
    const response = await fetch('/api/update_task.php', {
        method: 'PUT',
        headers: {'Content-Type' : 'application/json'},
        body: JSON.stringify({ 'description' : newtask, 'id' : id})
    });

    if (!response.ok) {
        alert("Error al actualizar la tarea.")
        console.log(response);
    }

    const data = await response.json();

    if (data.error) {
        alert(data.error);
        return;
    }
    renderTasks(await getTasks());
}

export {attachUpdateEvent}