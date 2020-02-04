import {changeTimer} from "../utils/utils";
import endpoints from "../endpoints";

document.addEventListener('DOMContentLoaded', () => {

    const tasks = document.querySelectorAll('.tasks-list .status');
    const task = document.querySelector('.aside-box .status');

    if (tasks.length) {
        const tasksLength = tasks.length;

        for (let i = 0; i < tasksLength; i++) {
            tasks[i].addEventListener("click", (event) => changeTimer(event, endpoints.timerChange));
        }
    }

    if (task) {
        task.addEventListener("click", (event) => changeTimer(event, endpoints.timerChange));
    }
});
