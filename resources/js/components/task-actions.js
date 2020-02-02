import {changeTimer} from "../utils/utils";

document.addEventListener('DOMContentLoaded', () => {

    const tasks = document.querySelectorAll('.tasks-list .status');
    const endpoints = {
        timerChange: 'timer/change/'
    };

    if (tasks.length) {
        const tasksLength = tasks.length;

        for (let i = 0; i < tasksLength; i++) {
            tasks[i].addEventListener("click", (event) => changeTimer(event, endpoints.timerChange));
        }
    }
});
